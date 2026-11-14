APLIKASI KAS MUSHOLA / MASJID - PHP + MYSQL (MVP)

FITUR
- Login admin/bendahara
- Dashboard total pemasukan, pengeluaran, saldo
- Tambah dan edit transaksi
- Filter berdasarkan bulan dan jenis
- Cetak daftar transaksi
- Hapus transaksi hanya untuk role admin

PERSIAPAN (Windows dengan XAMPP)
1. Install XAMPP.
2. Jalankan Apache dan MySQL.
3. Extract folder kas_mushola_mysql ke C:\xampp\htdocs\
4. Buka http://localhost/phpmyadmin
5. Import file database.sql.
6. Pastikan config.php sesuai konfigurasi MySQL Anda.
7. Buka http://localhost/kas_mushola_mysql/login.php

LOGIN DEMO
Username: admin
Password: admin123

PENTING
- Segera ubah password demo sebelum dipakai sungguhan.
- Versi ini masih MVP untuk pengujian lokal.
- Belum ada fitur reset password, backup otomatis, audit log, CSRF token,
  multi-cabang, atau deployment HTTPS. Jangan langsung dipasang publik.
- Data transaksi contoh belum dimasukkan; mulai dari saldo awal dan transaksi
  yang benar-benar tercatat.
