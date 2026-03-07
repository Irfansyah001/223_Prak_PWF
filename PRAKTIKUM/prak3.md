# Praktikum 3: Database Seeding & Migration

## Deskripsi Task
Dalam praktikum ini, kami melakukan konfigurasi database dengan membuat migrasi untuk tabel-tabel utama dan mengisi database dengan data dummy menggunakan seeders dan factories.

## Masalah yang Dihadapi
Terjadi error pada saat menjalankan migration karena urutan eksekusi migration tidak sesuai dengan dependency. Tabel `category` mencoba membuat foreign key yang mereferensikan tabel `product` yang belum ada.

**Solusi:** Mengubah timestamp migration `category_table` dari `2026_03_07_044634` menjadi `2026_03_07_044701` agar tabel `product` dibuat terlebih dahulu sebelum tabel `category`.

## Hasil Database Seeding

### 1. User Data Dummy
![ss user data dummy](../screenshots/datausers.png)

### 2. Products Data Dummy
![ss products data dummy](../screenshots/dataproducts.png)

### 3. Categories Data Dummy
![ss categories data dummy](../screenshots/datacategories.png)
