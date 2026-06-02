# 🌱 Smart Greenhouse

Sistem Smart Greenhouse berbasis mikrokontroler yang dirancang untuk melakukan monitoring dan pengendalian kondisi lingkungan tanaman secara otomatis. Sistem ini memanfaatkan sensor untuk membaca suhu, kelembaban udara, dan kelembaban tanah, kemudian mengaktifkan perangkat seperti pompa air dan kipas sesuai kondisi yang terdeteksi.

## 📌 Latar Belakang

Perawatan tanaman secara manual sering kali kurang efisien karena membutuhkan pemantauan yang terus-menerus. Dengan memanfaatkan teknologi mikrokontroler, proses monitoring dan pengendalian lingkungan tanaman dapat dilakukan secara otomatis sehingga membantu menjaga kondisi pertumbuhan tanaman tetap optimal.

## 🎯 Tujuan

- Memonitor suhu dan kelembaban udara secara real-time.
- Memonitor tingkat kelembaban tanah.
- Mengotomatisasi proses penyiraman tanaman.
- Mengontrol suhu lingkungan greenhouse menggunakan kipas.
- Mengimplementasikan konsep Internet of Things (IoT) dan Smart Farming.

## ⚙️ Fitur Sistem

- Monitoring suhu dan kelembaban udara.
- Monitoring kelembaban tanah.
- Penyiraman tanaman otomatis.
- Kontrol kipas otomatis berdasarkan suhu.
- Tampilan data sensor secara real-time.
- Sistem bekerja tanpa intervensi pengguna.

## 🛠️ Komponen Hardware

| No | Komponen | Jumlah |
|----|-----------|---------|
| 1 | ESP32 / Arduino Uno | 1 |
| 2 | Sensor DHT11/DHT22 | 1 |
| 3 | Sensor Soil Moisture | 1 |
| 4 | Relay Module | 1-2 |
| 5 | Mini Water Pump | 1 |
| 6 | Kipas DC | 1 |
| 7 | Breadboard | 1 |
| 8 | Kabel Jumper | Secukupnya |
| 9 | Power Supply | 1 |

## 🔧 Cara Kerja Sistem

1. Sensor DHT membaca suhu dan kelembaban udara.
2. Sensor Soil Moisture membaca kelembaban tanah.
3. Data sensor diproses oleh mikrokontroler.
4. Jika kelembaban tanah berada di bawah batas minimum, pompa air akan menyala otomatis.
5. Jika suhu melebihi batas yang ditentukan, kipas akan aktif.
6. Data kondisi greenhouse ditampilkan secara real-time.

## 📊 Diagram Sistem

```text
          +----------------+
          | Sensor DHT11   |
          +-------+--------+
                  |
                  v
          +----------------+
          |     ESP32      |
          +-------+--------+
                  ^
                  |
          +-------+--------+
          | Soil Moisture  |
          +----------------+

                  |
                  v

         +------------------+
         | Decision System  |
         +--------+---------+
                  |
        +---------+---------+
        |                   |
        v                   v
 +-------------+     +-------------+
 | Water Pump  |     | Cooling Fan |
 +-------------+     +-------------+
```

## 📂 Struktur Project

```text
Smart-Greenhouse/
│
├── src/
│   └── smart_greenhouse.ino
│
├── docs/
│   ├── wiring_diagram.png
│   ├── greenhouse_design.jpg
│   └── testing_result.pdf
│
├── assets/
│   └── screenshots/
│
└── README.md
```

## 🚀 Instalasi

### Software

- Arduino IDE
- Driver ESP32 (jika menggunakan ESP32)

### Library

```cpp
DHT.h
Adafruit Sensor.h
LiquidCrystal_I2C.h
```

Instal library melalui:

```
Sketch → Include Library → Manage Libraries
```

## ▶️ Menjalankan Program

1. Hubungkan board ESP32/Arduino ke komputer.
2. Buka file program pada Arduino IDE.
3. Pilih board yang sesuai.
4. Pilih port yang terhubung.
5. Klik Upload.
6. Amati data sensor pada LCD atau Serial Monitor.

## 🧪 Pengujian

### Pengujian Sensor Tanah

| Kondisi Tanah | Status Pompa |
|--------------|-------------|
| Kering | ON |
| Lembab | OFF |

### Pengujian Suhu

| Suhu | Status Kipas |
|-------|-------------|
| > 30°C | ON |
| ≤ 30°C | OFF |

## 📈 Hasil

Sistem berhasil:

- Membaca suhu dan kelembaban udara secara real-time.
- Membaca kelembaban tanah dengan baik.
- Menyalakan pompa otomatis saat tanah kering.
- Menyalakan kipas otomatis saat suhu tinggi.
- Membantu menjaga kondisi lingkungan tanaman tetap optimal.

## 👨‍💻 Pengembang

**Akmal Yusril Fani**  
Teknik Informatika  
Universitas Langlangbuana

## 📚 Mata Kuliah

**Sistem Mikrokontroler**  
Ujian Akhir Semester (UAS)

## 📄 Lisensi

Proyek ini dibuat untuk tujuan akademik dan pembelajaran.
