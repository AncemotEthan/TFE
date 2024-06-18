#include <WiFi.h>   // Importation de la bibliothèque WiFi
#include <HTTPClient.h>   // Importation de la bibliothèque HTTPClient
#include <SPI.h>    // Importation de la bibliothèque SPI
#include <MFRC522.h>    // Importation de la bibliothèque MFRC522

#define SS_PIN 5    // Définition du numéro de broche SS
#define RST_PIN 0   // Définition du numéro de broche RST

MFRC522 mfrc522(SS_PIN, RST_PIN);   // Initialisation de l'objet MFRC522

#define ON_Board_LED 3    // Définition du numéro de broche de la LED embarquée

//----------------------------------------SSID et mot de passe de votre routeur WiFi----------------------------------------------//
const char* ssid = "Nom_Réseau_WIFI";   // Nom du réseau WiFi
const char* password = "MotDePasse_WIFI";    // Mot de passe du réseau WiFi
//---------------------------------------------------------------------------------------------------------------------------------//


WiFiServer server(80);    // Initialisation du serveur WiFi sur le port 80

int readsuccess;    // Variable pour indiquer si la lecture de la carte a réussi
byte readcard[4];   // Tableau pour stocker les données de la carte lue
char str[32] = "";    // Chaîne de caractères pour stocker les données de la carte lue sous forme de texte
String StrUID;    // Chaîne de caractères pour stocker l'UID de la carte lue

void array_to_string(byte array[], unsigned int len, char buffer[]) {   // Fonction pour convertir un tableau de bytes en une chaîne de caractères
  for (unsigned int i = 0; i < len; i++) {    // Boucle à travers les éléments du tableau
    byte nib1 = (array[i] >> 4) & 0x0F;   // Extraction du premier demi-octet
    byte nib2 = (array[i] >> 0) & 0x0F;   // Extraction du deuxième demi-octet
    buffer[i * 2 + 0] = nib1 < 0xA ? '0' + nib1 : 'A' + nib1 - 0xA;   // Conversion du premier demi-octet en caractère hexadécimal
    buffer[i * 2 + 1] = nib2 < 0xA ? '0' + nib2 : 'A' + nib2 - 0xA;   // Conversion du deuxième demi-octet en caractère hexadécimal
  }   // Fin de la boucle
  buffer[len * 2] = '\0';   // Terminaison de la chaîne de caractères
}   // Fin de la fonction

int getid() {   // Fonction pour obtenir l'identifiant de la carte
  if (!mfrc522.PICC_IsNewCardPresent()) {   // Vérification si une nouvelle carte est présente
    return 0;   // Retourne 0 si aucune carte n'est détectée
  }   // Fin de la condition
  if (!mfrc522.PICC_ReadCardSerial()) {   // Lecture de l'identifiant de la carte
    return 0;   // Retourne 0 en cas d'échec de lecture
  }   // Fin de la condition

  Serial.print("THE UID OF THE SCANNED CARD IS : ");    // Affichage du message de l'UID de la carte scannée
  for (int i = 0; i < 4; i++) {   // Boucle pour parcourir les 4 octets de l'UID
    readcard[i] = mfrc522.uid.uidByte[i];   // Lecture de chaque octet de l'UID
    array_to_string(readcard, 4, str);    // Conversion de l'UID en une chaîne de caractères
    StrUID = str;   // Stockage de l'UID converti dans une variable de type String
  }   // Fin de la boucle
  mfrc522.PICC_HaltA();   // Arrêt de la communication avec la carte RFID
  return 1;   // Retourne 1 pour indiquer que la lecture de l'UID a réussi
}   // Fin de la fonction



void setup() {    // Fonction de configuration
  Serial.begin(115200);   // Initialisation de la communication série
  SPI.begin();    // Initialisation de la communication SPI
  mfrc522.PCD_Init();   // Initialisation du module RFID
  delay(500);   // Délai de 500 millisecondes

  WiFi.begin(ssid, password);   // Connexion au réseau WiFi
  Serial.println("");   // Affichage d'une ligne vide

  pinMode(ON_Board_LED, OUTPUT);    // Configuration de la broche de la LED embarquée en mode sortie
  digitalWrite(ON_Board_LED, HIGH);   // Désactivation de la LED embarquée

  Serial.print("Connecting");   // Affichage du message de connexion
  while (WiFi.status() != WL_CONNECTED) {   // Attente de la connexion au réseau WiFi
    Serial.print(".");    // Affichage d'un point pour indiquer la progression
    digitalWrite(ON_Board_LED, LOW);    // Allumage de la LED embarquée
    delay(250);   // Délai de 250 millisecondes
    digitalWrite(ON_Board_LED, HIGH);   // Extinction de la LED embarquée
    delay(250);   // Délai de 250 millisecondes
  }   // Fin de la boucle
  digitalWrite(ON_Board_LED, HIGH);   // Allumage de la LED embarquée
  Serial.println("");   // Affichage d'une ligne vide
  Serial.print("Successfully connected to : ");   // Affichage du message de connexion réussie
  Serial.println(ssid);   // Affichage du nom du réseau WiFi
  Serial.print("IP address: ");   // Affichage du message d'adresse IP
  Serial.println(WiFi.localIP());   // Affichage de l'adresse IP locale
  Serial.println("Please tag a card or keychain to see the UID !");   // Message d'attente pour scanner une carte
  Serial.println("");   // Affichage d'une ligne vide
}   // Fin de la fonction de configuration

void loop() {   // Fonction principale
  readsuccess = getid();    // Appel de la fonction pour obtenir l'identifiant de la carte
  if (readsuccess) {    // Vérification si la lecture de l'UID a réussi
    digitalWrite(ON_Board_LED, LOW);    // Allumage de la LED embarquée
    HTTPClient http;    // Création d'un objet HTTPClient
    String UIDresultSend, postData;   // Déclaration de variables pour stocker l'UID et les données POST
    UIDresultSend = StrUID;   // Attribution de la valeur de l'UID à la variable UIDresultSend
    postData = "UIDresult=" + UIDresultSend; // Construction des données POST
    http.begin("http://ancemot.duckdns.org/tfe/getUID.php");    // Initialisation de la connexion HTTP
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");    // Ajout de l'en-tête HTTP
    int httpCode = http.POST(postData);   // Envoi des données POST au serveur
    String payload = http.getString();    // Récupération de la réponse du serveur
    Serial.println(UIDresultSend);    // Affichage de l'UID de la carte
    Serial.println(httpCode);   // Affichage du code HTTP de la réponse
    Serial.println(payload);    // Affichage du contenu de la réponse
    http.end();   // Fin de la connexion HTTP
    delay(1000);    // Attente de 1 seconde
    digitalWrite(ON_Board_LED, HIGH);   // Extinction de la LED embarquée
  }   // Fin de la condition
}   // Fin de la fonction principale
