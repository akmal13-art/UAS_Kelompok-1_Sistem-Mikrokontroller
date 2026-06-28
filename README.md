# 📋 Smart Attendance System

Sistem Absensi Otomatis berbasis ESP32 yang dirancang untuk melakukan pencatatan kehadiran secara digital dan mengirimkan data absensi secara otomatis ke Google Spreadsheet melalui koneksi internet. Sistem ini memanfaatkan teknologi IoT untuk mempermudah proses rekapitulasi data kehadiran secara real-time.

## 📌 Latar Belakang

Proses absensi secara manual masih banyak digunakan dan sering menimbulkan masalah seperti kehilangan data, kesalahan pencatatan, serta membutuhkan waktu yang lebih lama untuk melakukan rekapitulasi. Dengan memanfaatkan teknologi Internet of Things (IoT), proses absensi dapat dilakukan secara otomatis dan data langsung tersimpan ke Google Spreadsheet sehingga lebih efisien, akurat, dan mudah diakses.

## 🎯 Tujuan

* Mengotomatisasi proses pencatatan kehadiran.
* Menyimpan data absensi secara real-time ke Google Spreadsheet.
* Mengurangi kesalahan pencatatan absensi manual.
* Mempermudah pengelolaan dan rekapitulasi data kehadiran.
* Mengimplementasikan teknologi IoT pada sistem absensi.

## ⚙️ Fitur Sistem

* Absensi otomatis menggunakan RFID atau Fingerprint.
* Pengiriman data ke Google Spreadsheet secara real-time.
* Penyimpanan data berbasis cloud.
* Monitoring data kehadiran secara online.
* Rekap data absensi otomatis.
* Sistem bekerja secara cepat dan akurat.

## 🛠️ Komponen Hardware

| No | Komponen                        | Jumlah     |
| -- | ------------------------------- | ---------- |
| 1  | ESP32                           | 1          |
| 2  | RFID RC522 / Fingerprint Sensor | 1          |
| 3  | LCD I2C 16x2                    | 1          |
| 4  | Buzzer                          | 1          |
| 5  | LED Indikator                   | 2          |
| 6  | Kabel Jumper                    | Secukupnya |
| 7  | Breadboard                      | 1          |
| 8  | Power Supply                    | 1          |

## 💻 Komponen Software

* Arduino IDE
* Google Spreadsheet
* Google Apps Script
* Library ESP32
* Library RFID/Fingerprint

## 🔧 Cara Kerja Sistem

1. Pengguna melakukan absensi menggunakan kartu RFID atau sensor fingerprint.
2. ESP32 membaca ID pengguna.
3. Data pengguna diverifikasi.
4. Sistem mencatat waktu absensi.
5. Data dikirim melalui WiFi ke Google Apps Script.
6. Google Apps Script menyimpan data ke Google Spreadsheet.
7. Status absensi ditampilkan pada LCD.

## 📊 Diagram Sistem

```text
+------------------+
| RFID/Fingerprint |
+---------+--------+
          |
          v
+------------------+
|      ESP32       |
+---------+--------+
          |
          | WiFi
          v
+------------------+
| Google Apps Script|
+---------+--------+
          |
          v
+------------------+
| Google Spreadsheet|
+------------------+
```

## 📂 Struktur Project

```text
Smart-Attendance-System/
│
├── src/
│   └── attendance_system.ino
│
├── docs/
│   ├── wiring_diagram.png
│   ├── flowchart.png
│   └── testing_result.pdf
│
├── assets/
│   └── screenshots/
│
└── README.md
```

## 🚀 Instalasi

### Software

* Arduino IDE
* Driver ESP32

### Library

```cpp
WiFi.h
HTTPClient.h
SPI.h
MFRC522.h
LiquidCrystal_I2C.h
```

Instal library melalui:

```text
Sketch → Include Library → Manage Libraries
```

## ▶️ Menjalankan Program

1. Hubungkan ESP32 ke komputer.
2. Buka file program pada Arduino IDE.
3. Install seluruh library yang dibutuhkan.
4. Masukkan SSID dan Password WiFi.
5. Masukkan URL Google Apps Script.
6. Upload program ke ESP32.
7. Tempelkan kartu RFID atau gunakan fingerprint untuk melakukan absensi.
8. Data akan otomatis tersimpan pada Google Spreadsheet.

## 🧪 Pengujian

### Pengujian RFID/Fingerprint

| Kondisi            | Hasil            |
| ------------------ | ---------------- |
| ID Terdaftar       | Absensi Berhasil |
| ID Tidak Terdaftar | Absensi Ditolak  |

### Pengujian Koneksi Internet

| Kondisi        | Hasil               |
| -------------- | ------------------- |
| WiFi Terhubung | Data Terkirim       |
| WiFi Terputus  | Data Gagal Terkirim |

## 📈 Hasil

Sistem berhasil:

* Membaca data RFID/Fingerprint dengan baik.
* Mengirimkan data absensi ke Google Spreadsheet secara real-time.
* Menyimpan data kehadiran secara otomatis.
* Mempermudah proses monitoring dan rekapitulasi absensi.
* Mengurangi penggunaan kertas dan pencatatan manual.

## 📑 Format Data Google Spreadsheet

| Nama              | ID  | Tanggal    | Jam Masuk |
| ----------------- | --- | ---------- | --------- |
| Akmal Yusril Fani | 001 | 16-06-2026 | 08:00:15  |
| Rayhan Khadafi    | 002 | 16-06-2026 | 08:05:20  |
| Harsya Vil'ardi   | 003 | 16-06-2026 | 08:05:25  |

## 👨‍💻 Pengembang

**Akmal Yusril Fani**
**Rayhan Khadafi**
**Harsya Vil'ardi**
Teknik Informatika
Universitas Teknologi Bandung

## 📚 Mata Kuliah

**Sistem Mikrokontroler**
Ujian Akhir Semester (UAS)

## 📄 Lisensi

Proyek ini dibuat untuk tujuan akademik dan pembelajaran.
