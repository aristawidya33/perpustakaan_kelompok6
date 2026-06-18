Alur Sistem Informasi Perpustakaan Berbasis Web (Secara Rinci)
Sistem perpustakaan yang Anda buat memiliki 2 jenis pengguna, yaitu:
1.	Admin/Petugas
2.	Mahasiswa/Anggota
Kedua pengguna memiliki hak akses yang berbeda sesuai kebutuhan sistem.
1. Alur Login Sistem
Langkah 1
Pengguna membuka halaman Login.
Langkah 2
Pengguna memasukkan:
•	Username
•	Password
Langkah 3
Sistem memeriksa data ke tabel users.
Langkah 4
Jika data benar:
•	Admin diarahkan ke Dashboard Admin.
•	Mahasiswa diarahkan ke Dashboard Mahasiswa.
Jika salah:
•	Sistem menampilkan pesan gagal login.
2. Alur Admin (Petugas)
Setelah login, admin masuk ke Dashboard Admin.
Dashboard Admin
Dashboard menampilkan informasi:
•	Total Anggota
•	Total Buku
•	Total Peminjaman
•	Total Mahasiswa
•	Buku Terlaris
•	Grafik Statistik Perpustakaan
Tujuannya untuk memudahkan admin melihat kondisi perpustakaan secara cepat.
3. Alur Pengelolaan Data Anggota
Admin membuka menu Data Anggota
Admin dapat:
Tambah Anggota
Mengisi:
•	NIM
•	Nama
•	Jurusan
•	Alamat
•	Nomor HP
Kemudian data disimpan ke tabel anggota.
Edit Anggota
Admin dapat memperbarui data anggota jika terdapat perubahan.
Hapus Anggota
Admin dapat menghapus anggota yang tidak aktif.
Searching Anggota
Admin dapat mencari anggota berdasarkan:
•	NIM
•	Nama
•	Jurusan
4. Alur Pengelolaan Data Buku
Admin membuka menu Data Buku
Admin dapat:
Menambah Buku
Mengisi:
•	Kode Buku
•	Judul Buku
•	Pengarang
•	Penerbit
•	Tahun Terbit
•	Stok
Data disimpan ke tabel buku.
Edit Buku
Mengubah data buku yang sudah ada.
Hapus Buku
Menghapus data buku.
Searching Buku
Pencarian berdasarkan:
•	Kode Buku
•	Judul Buku
•	Pengarang
•	Penerbit
5. Alur Mahasiswa Melihat Buku
Mahasiswa login
↓
Masuk ke Dashboard Mahasiswa
↓
Pilih menu Daftar Buku
↓
Sistem menampilkan seluruh koleksi buku
↓
Mahasiswa dapat melihat:
•	Judul Buku
•	Pengarang
•	Penerbit
•	Stok
Jika stok masih tersedia maka tombol Pinjam akan muncul.
6. Alur Peminjaman Buku
Langkah 1
Mahasiswa memilih buku.
Langkah 2
Klik tombol Pinjam.
Langkah 3
Mengisi tanggal pinjam.
Langkah 4
Sistem menyimpan data ke tabel peminjaman:
•	id_anggota
•	id_buku
•	tanggal_pinjam
•	status = dipinjam
Langkah 5
Stok buku otomatis berkurang 1.
stok = stok - 1
Langkah 6
Data masuk ke Riwayat Peminjaman.
7. Alur Pengembalian Buku
Langkah 1
Admin membuka menu Riwayat Peminjaman.
Langkah 2
Memilih buku yang akan dikembalikan.
Langkah 3
Mengisi tanggal kembali.
Langkah 4
Sistem menghitung:
lama_pinjam =
tanggal_kembali - tanggal_pinjam
Langkah 5
Sistem menghitung denda.
Pada sistem Anda:
•	Maksimal peminjaman = 7 hari
•	Denda = Rp1.000/hari
Contoh:
Pinjam : 1 Juni
Kembali : 10 Juni
Lama pinjam = 9 hari
Terlambat = 2 hari
Denda:
2 x 1000 = Rp2.000
Langkah 6
Status berubah menjadi:
dikembalikan
Langkah 7
Stok buku bertambah otomatis.
stok = stok + 1
8. Alur Perhitungan Denda
Ketika pengembalian dilakukan:
Sistem memeriksa:
if($lama_pinjam > 7)
Jika lebih dari 7 hari:
$denda =
($lama_pinjam - 7) * 1000;
Jika kurang dari atau sama dengan 7 hari:
$denda = 0;
9. Alur Riwayat Peminjaman
Mahasiswa membuka menu:
Riwayat Peminjaman
↓
Sistem menampilkan:
•	Judul Buku
•	Tanggal Pinjam
•	Tanggal Kembali
•	Lama Pinjam
•	Denda
•	Status
Tujuannya agar mahasiswa dapat melihat seluruh aktivitas peminjaman yang pernah dilakukan.
10. Alur Profil Mahasiswa
Mahasiswa membuka menu:
Profil Mahasiswa
↓
Sistem menampilkan:
•	NIM
•	Nama
•	Jurusan
•	Alamat
•	Nomor HP
↓
Mahasiswa dapat:
Mengubah Password
Langkah:
1.	Memasukkan Password Lama
2.	Memasukkan Password Baru
3.	Konfirmasi Password Baru
4.	Klik Simpan
↓
Password diperbarui pada database.
11. Alur Laporan Peminjaman
Admin membuka:
Laporan Peminjaman
↓
Memilih:
•	Bulan
•	Tahun
↓
Sistem menampilkan data peminjaman sesuai periode.
Informasi yang ditampilkan:
•	NIM
•	Nama
•	Judul Buku
•	Tanggal Pinjam
•	Status
↓
Admin dapat Export Excel.
12. Alur Laporan Pengembalian
Admin membuka:
Laporan Pengembalian
↓
Filter bulan dan tahun
↓
Sistem menampilkan:
•	Nama Anggota
•	Judul Buku
•	Tanggal Pinjam
•	Tanggal Kembali
•	Status
↓
Data dapat diekspor ke Excel.
13. Alur Laporan Denda
Admin membuka:
Laporan Denda
↓
Filter bulan dan tahun
↓
Sistem menampilkan:
•	Nama Anggota
•	Judul Buku
•	Lama Pinjam
•	Denda
↓
Sistem menghitung total seluruh denda.
Contoh:
SUM(denda)
↓
Ditampilkan:
Total Denda = Rp xxx.xxx
↓
Dapat diekspor ke Excel.
14. Alur Laporan Buku Terlaris
Admin membuka:
Laporan Buku Terlaris
↓
Sistem menghitung jumlah peminjaman setiap buku.
COUNT(id_buku)
↓
Diurutkan dari yang paling banyak dipinjam.
↓
Menampilkan:
•	Ranking
•	Judul Buku
•	Pengarang
•	Total Dipinjam
↓
Dapat diekspor ke Excel.
15. Alur Logout
Langkah 1
Pengguna menekan tombol Logout.
Langkah 2
Session dihapus.
session_destroy();
Langkah 3
Sistem mengembalikan pengguna ke halaman Login.
Langkah 4
Pengguna harus login kembali untuk mengakses sistem.
Ringkasan Alur Sistem
Login
   │
   ▼
Dashboard
   │
   ├── Data Anggota
   ├── Data Buku
   ├── Peminjaman Buku
   │      │
   │      ▼
   │   Riwayat Peminjaman
   │
   ├── Pengembalian Buku
   │      │
   │      ▼
   │   Perhitungan Denda
   │
   ├── Laporan Peminjaman
   ├── Laporan Pengembalian
   ├── Laporan Denda
   ├── Laporan Buku Terlaris
   │
   └── Logout
Penjelasan ini sudah cukup rinci dan biasanya cocok dijadikan bagian "Analisis dan Alur Sistem" atau "Pembahasan Sistem" pada laporan tugas akhir/perancangan Sistem Informasi Perpustakaan berbasis web.


