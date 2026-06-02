# UAS Sistem Mikrokontroler
## Sistem Monitoring Suhu dan Kelembaban Berbasis Arduino

### Deskripsi Proyek
Proyek ini merupakan tugas Ujian Akhir Semester (UAS) mata kuliah Sistem Mikrokontroler. Sistem yang dibuat berfungsi untuk memonitor suhu dan kelembaban lingkungan secara real-time menggunakan sensor DHT11 yang terhubung ke mikrokontroler Arduino Uno.

Data hasil pembacaan sensor ditampilkan pada LCD 16x2 dan dapat digunakan sebagai media monitoring kondisi lingkungan.

---

## Tujuan Proyek
- Mempelajari implementasi mikrokontroler Arduino.
- Mengintegrasikan sensor dengan mikrokontroler.
- Menampilkan data sensor secara real-time.
- Mengembangkan sistem monitoring sederhana berbasis embedded system.

---

## Komponen yang Digunakan

| No | Komponen | Jumlah |
|-----|----------|---------|
| 1 | Arduino Uno | 1 |
| 2 | Sensor DHT11 | 1 |
| 3 | LCD 16x2 I2C | 1 |
| 4 | Breadboard | 1 |
| 5 | Kabel Jumper | Secukupnya |
| 6 | USB Cable | 1 |

---

## Diagram Sistem

Sensor DHT11 → Arduino Uno → LCD 16x2

---

## Cara Kerja Sistem

1. Sensor DHT11 membaca suhu dan kelembaban lingkungan.
2. Data dikirim ke Arduino Uno.
3. Arduino memproses data yang diterima.
4. Nilai suhu dan kelembaban ditampilkan pada LCD 16x2.
5. Proses berlangsung secara terus menerus (real-time).

---

## Instalasi

### Software
- Arduino IDE

### Library yang Dibutuhkan
- DHT Sensor Library
- Adafruit Unified Sensor
- LiquidCrystal_I2C

Instal library melalui:

Sketch → Include Library → Manage Libraries

---

## Upload Program

1. Hubungkan Arduino ke komputer menggunakan kabel USB.
2. Buka file program (.ino).
3. Pilih Board:
   Tools → Board → Arduino Uno
4. Pilih Port yang sesuai.
5. Klik Upload.

---

## Struktur Folder
