# Sistem Cek Bansos Menggunakan Metode Logika Fuzzy Mamdani

## Deskripsi

Sistem Cek Bansos Menggunakan Metode Logika Fuzzy Mamdani merupakan aplikasi berbasis web yang digunakan untuk membantu proses penentuan kelayakan calon penerima bantuan sosial (Bansos). Sistem ini dibangun menggunakan PHP Native, MySQL, Bootstrap 5, HTML, CSS, dan JavaScript.

Metode yang digunakan adalah Logika Fuzzy Mamdani sehingga proses penilaian menjadi lebih objektif berdasarkan beberapa kriteria yang telah ditentukan.

---

## Fitur Aplikasi

- Login Admin
- Dashboard
- Data Penduduk
- Data Kriteria
- Data Sub Kriteria
- Penilaian Penduduk
- Rule Fuzzy (IF-THEN)
- Proses Fuzzifikasi
- Inferensi
- Defuzzifikasi (Centroid)
- Hasil Seleksi
- Laporan

---

## Teknologi

- PHP Native
- MySQL
- Bootstrap 5
- HTML5
- CSS3
- JavaScript
- XAMPP
- phpMyAdmin

---

## Metode

Metode yang digunakan adalah **Logika Fuzzy Mamdani** dengan tahapan:

1. Fuzzifikasi
2. Pembentukan Rule IF-THEN
3. Inferensi
4. Defuzzifikasi (Centroid)
5. Penentuan Hasil Kelayakan

---

## Struktur Folder

```
admin/
config/
dashboard/
penduduk/
kriteria/
sub_kriteria/
penilaian/
rule_fuzzy/
fuzzy/
hasil/
laporan/
login/
template/
assets/
database/
```

---

## Cara Menjalankan

1. Install XAMPP.
2. Aktifkan Apache dan MySQL.
3. Salin folder project ke:

```
C:\xampp\htdocs\
```

atau

```
C:\xampp82\htdocs\
```

4. Import database `db_bansos_fuzzy.sql` melalui phpMyAdmin.
5. Jalankan aplikasi melalui browser:

```
http://localhost/Sistem-Cek-Bansos-Fuzzy
```

---

## Tujuan

Membantu proses seleksi penerima bantuan sosial agar lebih objektif, transparan, dan tepat sasaran menggunakan metode Logika Fuzzy Mamdani.

---

## Pengembang

**Nama : Eli Putra Iman Jaya Zalukhu**

Program Studi Teknik Informatika

---

## Lisensi

Repository ini dibuat untuk keperluan pembelajaran, penelitian, dan pengembangan Sistem Pendukung Keputusan menggunakan metode Logika Fuzzy Mamdani.