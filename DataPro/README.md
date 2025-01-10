# DataPro

DataPro adalah aplikasi berbasis web yang dibangun menggunakan PHP dengan framework CodeIgniter 4. Aplikasi ini dirancang untuk memproses dataset, melakukan analisis statistik, pemodelan Machine Learning, serta menyediakan visualisasi data yang terintegrasi.

---

## Fitur Utama
- **Pengunggahan Dataset:** Mendukung pengunggahan dataset dalam berbagai format.
- **Proses ETL:** Membersihkan dan mempersiapkan data untuk analisis.
- **Visualisasi Data:** Menyediakan visualisasi interaktif untuk membantu memahami pola data.
- **Model Machine Learning:** Melatih dan mengevaluasi model dengan dataset pengguna.
- **Notifikasi Email:** Memberikan laporan hasil analisis melalui email.

---

## Prasyarat
Sebelum menjalankan DataPro, pastikan Anda telah menginstal perangkat berikut:

1. **PHP** (minimal versi 7.4)
3. **XAMPP** atau server lain dengan Apache dan MySQL aktif

---

## Cara Instalasi

1. Clone repository ini:
   ```bash
   git clone https://github.com/username/DataPro.git
   cd DataPro
   ```

2. Install semua dependensi dengan Composer:
   ```bash
   composer install
   ```

3. Konfigurasi file `.env`:
   - Salin file `.env.example` menjadi `.env`:
     ```bash
     cp .env.example .env
     ```
   - Buka file `.env` dan sesuaikan konfigurasi database:
     ```env
     database.default.hostname = localhost
     database.default.database = datapro_db
     database.default.username = root
     database.default.password = 
     database.default.DBDriver = MySQLi
     ```

4. Jalankan migrasi database:
   ```bash
   php spark migrate
   ```

5. Jalankan server menggunakan `php spark`:
   ```bash
   php spark serve
   ```
   Secara default, aplikasi akan tersedia di [http://localhost:8080](http://localhost:8080).

6. Pastikan XAMPP Apache dan MySQL aktif.

---

## Panduan Penggunaan

1. **Mengunggah Dataset:**
   - Akses halaman "Upload Dataset" melalui menu utama.
   - Pilih file dataset yang ingin diunggah.

2. **Proses ETL:**
   - Setelah dataset diunggah, klik tombol "Process Dataset" untuk membersihkan data.

3. **Analisis Data:**
   - Pilih jenis analisis yang diinginkan, seperti visualisasi data atau pelatihan model.

4. **Laporan dan Notifikasi:**
   - Hasil analisis dapat diterima melalui email yang telah dikonfigurasi.

---

## Struktur Direktori

```
DataPro/
|-- app/                 # Folder utama untuk aplikasi CodeIgniter
|-- public/              # Folder publik untuk file yang diakses langsung
|-- writable/            # Folder untuk file sementara (log, cache, dll.)
|-- .env                 # Konfigurasi lingkungan
|-- composer.json        # Konfigurasi Composer
|-- spark                # CLI untuk CodeIgniter
```

---

## Troubleshooting

1. **Error: Database tidak ditemukan**
   - Pastikan database dengan nama `datapro_db` telah dibuat di MySQL.
   - Jalankan kembali perintah migrasi: `php spark migrate`.

2. **Server tidak berjalan di localhost:8080**
   - Pastikan XAMPP Apache aktif.
   - Periksa apakah port 8080 sedang digunakan oleh aplikasi lain, atau jalankan server di port lain:
     ```bash
     php spark serve --port=8000
     ```

3. **Email tidak terkirim**
   - Pastikan konfigurasi email di file `.env` benar:
     ```env
     email.SMTPHost = smtp.gmail.com
     email.SMTPUser = your_email@gmail.com
     email.SMTPPass = your_password
     email.SMTPPort = 587
     ```

---

## Kontribusi

1. Fork repository ini.
2. Buat branch baru untuk fitur atau perbaikan Anda:
   ```bash
   git checkout -b fitur-baru
   ```
3. Commit perubahan Anda:
   ```bash
   git commit -m "Menambahkan fitur baru"
   ```
4. Push ke branch Anda:
   ```bash
   git push origin fitur-baru
   ```
5. Ajukan Pull Request.

---

## Lisensi
Proyek ini dilisensikan di bawah [MIT License](LICENSE).

---

Terima kasih telah menggunakan DataPro!
