#include <SPI.h>                // Inclut la bibliothèque SPI pour la communication SPI
#include <MFRC522.h>            // Inclut la bibliothèque MFRC522 pour le lecteur RFID
#include <WiFi.h>               // Inclut la bibliothèque WiFi pour la connexion WiFi
#include <HTTPClient.h>         // Inclut la bibliothèque HTTPClient pour les requêtes HTTP

// Définition des broches pour le capteur RC522
#define RST_PIN     0           // Définition de la broche RST pour le module RC522
#define SS_PIN      5           // Définition de la broche SS (Slave Select) pour le module RC522

// Définition des broches pour le relais
#define RELAY_PIN   12          // Définition de la broche pour le relais

// Définition des broches pour les LEDs et le buzzer
#define GREEN_LED_PIN  14       // Définition de la broche pour la LED verte
#define RED_LED_PIN    27       // Définition de la broche pour la LED rouge
#define BUZZER_PIN     26       // Définition de la broche pour le buzzer

// Définition des informations de connexion WiFi et l'URL du script PHP 
char ssid[] = "Nom_Réseau_WIFI";    // Définition du SSID du réseau WiFi
char password[] = "MotDePasse_WIFI"; // Définition du mot de passe du réseau WiFi
const char* serverName = "http://ancemot.duckdns.org/tfe/db_access.php"; // URL du serveur pour les requêtes

// Création d'un objet pour le capteur RC522
MFRC522 mfrc522(SS_PIN, RST_PIN); // Instanciation de l'objet mfrc522 avec les broches définies

void setup() {
  Serial.begin(115200);        // Initialisation de la communication série à 115200 bauds
  delay(100);                  // Délai pour stabiliser le démarrage

  // Initialisation du capteur RC522
  Serial.println("Initialisation du capteur RC522...");
  SPI.begin();                 // Initialisation de la communication SPI
  mfrc522.PCD_Init();          // Initialisation du module RC522

  // Initialisation de la connexion WiFi
  Serial.println("Connexion au WiFi...");
  WiFi.begin(ssid, password);  // Connexion au réseau WiFi avec SSID et mot de passe
  while (WiFi.status() != WL_CONNECTED) { // Attente de la connexion WiFi
    delay(500);
    Serial.print(".");
  }
  Serial.println("WiFi connecté."); // Connexion WiFi établie

  // Configuration de la broche de contrôle du relais en tant que sortie
  pinMode(RELAY_PIN, OUTPUT);  // Configuration de la broche du relais en sortie
  digitalWrite(RELAY_PIN, LOW); // Assurez-vous que le relais est initialement éteint

  // Configuration des broches des LEDs et du buzzer en tant que sorties
  pinMode(GREEN_LED_PIN, OUTPUT); // Configuration de la broche de la LED verte en sortie
  pinMode(RED_LED_PIN, OUTPUT);   // Configuration de la broche de la LED rouge en sortie
  pinMode(BUZZER_PIN, OUTPUT);    // Configuration de la broche du buzzer en sortie

  // Assurez-vous que les LEDs et le buzzer sont initialement éteints
  digitalWrite(GREEN_LED_PIN, LOW); // Éteindre la LED verte
  digitalWrite(RED_LED_PIN, LOW);   // Éteindre la LED rouge
  digitalWrite(BUZZER_PIN, LOW);    // Éteindre le buzzer

  Serial.println("Configuration terminée."); // Indique que la configuration est terminée
}

void loop() {
  // Vérifier si une carte RFID est détectée
  if (mfrc522.PICC_IsNewCardPresent() && mfrc522.PICC_ReadCardSerial()) {
    // Lire l'ID de la carte
    String cardID = ""; // Initialisation d'une chaîne pour stocker l'ID de la carte
    for (byte i = 0; i < mfrc522.uid.size; i++) {
      cardID += String(mfrc522.uid.uidByte[i] < 0x10 ? "0" : ""); // Ajouter un zéro pour les valeurs inférieures à 0x10
      cardID += String(mfrc522.uid.uidByte[i], HEX); // Ajouter la valeur hexadécimale du byte
    }
    cardID.toUpperCase(); // Convertir l'ID en majuscules
    Serial.println("ID de la carte: " + cardID); // Afficher l'ID de la carte

    if (WiFi.status() == WL_CONNECTED) { // Vérifier si la connexion WiFi est établie
      HTTPClient http; // Création d'un objet HTTPClient
      http.begin(serverName); // Initialisation de l'objet HTTPClient avec l'URL du serveur

      // Vérification des droits dans la base de données et enregistrement de la tentative d'accès
      http.addHeader("Content-Type", "application/x-www-form-urlencoded"); // Ajouter un en-tête pour la requête POST
      String postData = "cardID=" + cardID; // Créer les données à envoyer en POST
      int httpResponseCode = http.POST(postData); // Envoyer la requête POST et stocker le code de réponse

      if (httpResponseCode > 0) { // Vérifier si la requête a réussi
        String response = http.getString(); // Obtenir la réponse du serveur
        Serial.println("Réponse du serveur: " + response); // Afficher la réponse du serveur
        bool accessGranted = response.indexOf("granted") > 0; // Vérifier si l'accès est autorisé
        if (accessGranted) {
          Serial.println("Accès autorisé.");
          digitalWrite(GREEN_LED_PIN, HIGH); // Allumer la LED verte
          digitalWrite(RELAY_PIN, HIGH); // Activer le relais
          tone(BUZZER_PIN, 1000, 500); // Émettre un son (1 kHz pendant 500 ms)
          delay(5000); // Garder la serrure ouverte pendant 5 secondes
          digitalWrite(RELAY_PIN, LOW); // Désactiver le relais
          digitalWrite(GREEN_LED_PIN, LOW); // Éteindre la LED verte
        } else {
          Serial.println("Accès refusé.");
          digitalWrite(RED_LED_PIN, HIGH); // Allumer la LED rouge
          tone(BUZZER_PIN, 500, 500); // Émettre un son différent (500 Hz pendant 500 ms)
          delay(1000); // Garder la LED rouge allumée pendant 1 seconde
          digitalWrite(RED_LED_PIN, LOW); // Éteindre la LED rouge
        }
      } else {
        Serial.println("Erreur HTTP: " + String(httpResponseCode)); // Afficher l'erreur HTTP si la requête a échoué
      }
      http.end(); // Terminer la requête HTTP
    }
  }

  delay(1000); // Délai avant la prochaine vérification de carte (1 seconde)
  yield(); // Ajouter pour prévenir les redémarrages du watchdog
}
