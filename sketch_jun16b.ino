#include <SPI.h>
#include <MFRC522.h>
#include <Wire.h>
#include <LiquidCrystal_I2C.h>
#include <WiFi.h>
#include <HTTPClient.h>

// =========================
// RFID RC522
// =========================
#define SS_PIN 5
#define RST_PIN 27

MFRC522 rfid(SS_PIN, RST_PIN);

// =========================
// BUZZER
// =========================
#define BUZZER 25

// =========================
// LCD I2C
// =========================
LiquidCrystal_I2C lcd(0x27, 16, 2);

// =========================
// WIFI
// =========================
const char* ssid = "KostVanJava";
const char* password = "1januari";

// Google Script
String GAS_URL = "https://script.google.com/macros/s/AKfycbykz4TAwPZ1FyoqpK8Ih3yuAb-7DPjExpyz1WKcNUJnTZxGT3j3KdJHJV9zCH4HvTLq/exec";

// =========================
// BUZZER FUNCTION
// =========================
void beepSuccess() {
  digitalWrite(BUZZER, HIGH);
  delay(200);
  digitalWrite(BUZZER, LOW);
}

void beepFail() {
  for (int i = 0; i < 2; i++) {
    digitalWrite(BUZZER, HIGH);
    delay(100);
    digitalWrite(BUZZER, LOW);
    delay(100);
  }
}

// =========================
// STANDBY LCD
// =========================
void tampilStandby() {

  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("Smart Attendance");
  lcd.setCursor(0, 1);
  lcd.print("Silahkan SCAN");
}

// =========================
// KIRIM KE GOOGLE SHEET
// =========================
void kirimAbsensi(String uid, String nama) {

  if (WiFi.status() != WL_CONNECTED) {
    Serial.println("WiFi tidak konek");
    return;
  }

  String namaEncoded = nama;
  namaEncoded.replace(" ", "%20");

  String url = GAS_URL +
               "?uid=" + uid +
               "&nama=" + namaEncoded;

  Serial.println("================================");
  Serial.println("Mengirim Data...");
  Serial.println(url);

  HTTPClient http;
  http.begin(url);

  int httpCode = http.GET();

  Serial.print("HTTP Code: ");
  Serial.println(httpCode);

  String response = http.getString();
  Serial.println("Response: " + response);

  http.end();
}

// =========================
// SETUP
// =========================
void setup() {

  Serial.begin(115200);

  // BUZZER
  pinMode(BUZZER, OUTPUT);
  digitalWrite(BUZZER, LOW);

  // LCD
  Wire.begin(21, 22);
  lcd.init();
  lcd.backlight();

  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("Connecting WiFi");

  // WIFI
  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("\nWiFi Connected");

  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("WiFi Connected");

  delay(2000);

  // RFID
  SPI.begin();
  rfid.PCD_Init();

  Serial.println("SISTEM ABSENSI READY");

  tampilStandby();
}

// =========================
// LOOP
// =========================
void loop() {

  if (!rfid.PICC_IsNewCardPresent()) return;
  if (!rfid.PICC_ReadCardSerial()) return;

  // UID
  String uid = "";

  for (byte i = 0; i < rfid.uid.size; i++) {

    if (rfid.uid.uidByte[i] < 0x10)
      uid += "0";

    uid += String(rfid.uid.uidByte[i], HEX);
  }

  uid.toUpperCase();

  Serial.println("======================");
  Serial.print("UID: ");
  Serial.println(uid);

  // DATABASE
  String nama = "";
  bool terdaftar = false;

  if (uid == "73957595") {
    nama = "Jule SAYANG Akmal";
    terdaftar = true;
  }

  else if (uid == "2332EAA6") {
    nama = "Riki SAYANG JULE";
    terdaftar = true;
  }

  // LCD
  lcd.clear();

  if (terdaftar) {

    lcd.setCursor(0, 0);
    lcd.print("Selamat Datang");

    lcd.setCursor(0, 1);
    lcd.print(nama);

    Serial.println("Nama: " + nama);

    beepSuccess();        // 🔊 bunyi sukses
    kirimAbsensi(uid, nama);

  } else {

    lcd.setCursor(0, 0);
    lcd.print("Akses Ditolak");

    lcd.setCursor(0, 1);
    lcd.print("Tidak Terdaftar");

    Serial.println("Kartu tidak dikenal");

    beepFail();           // 🔊 bunyi gagal
  }

  rfid.PICC_HaltA();
  rfid.PCD_StopCrypto1();

  delay(3000);

  tampilStandby();
}