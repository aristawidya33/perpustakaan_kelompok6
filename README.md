Deskripsi Sistem

Sistem Informasi Perpustakaan Berbasis Web merupakan aplikasi yang dirancang untuk membantu proses pengelolaan perpustakaan secara terkomputerisasi. Sistem ini dibangun menggunakan PHP, MySQL, HTML, CSS, dan JavaScript dengan tujuan mempermudah pengelolaan data buku, anggota, peminjaman, pengembalian, serta pembuatan laporan perpustakaan secara cepat dan akurat.

Sistem memiliki dua jenis pengguna, yaitu Administrator dan Mahasiswa (Anggota). Setiap pengguna memiliki hak akses yang berbeda sesuai dengan kebutuhan masing-masing.

Alur Sistem Administrator
1. Login Administrator

Administrator melakukan login menggunakan username dan password yang telah terdaftar pada sistem.

2. Dashboard Administrator

Setelah berhasil login, administrator akan diarahkan ke halaman dashboard yang menampilkan informasi statistik perpustakaan, seperti:

Total anggota perpustakaan
Total buku
Total peminjaman
Total mahasiswa terdaftar
Buku terlaris
Grafik statistik perpustakaan

Dashboard berfungsi sebagai pusat informasi utama untuk memantau aktivitas perpustakaan.

3. Pengelolaan Data Anggota

Administrator dapat:

Menambahkan data anggota baru
Mengubah data anggota
Menghapus data anggota
Mencari data anggota melalui fitur pencarian

Data anggota meliputi:

NIM
Nama anggota
Jurusan
Alamat
Nomor telepon
4. Pengelolaan Data Buku

Administrator dapat:

Menambah data buku
Mengubah data buku
Menghapus data buku
Mencari buku berdasarkan judul, kode buku, atau pengarang

Informasi buku meliputi:

Kode buku
Judul buku
Pengarang
Penerbit
Tahun terbit
Stok buku
5. Proses Peminjaman Buku

Ketika mahasiswa melakukan peminjaman:

Data peminjaman disimpan ke database
Stok buku otomatis berkurang
Status peminjaman berubah menjadi Dipinjam
6. Proses Pengembalian Buku

Saat buku dikembalikan:

Tanggal pengembalian dicatat
Lama peminjaman dihitung otomatis
Status berubah menjadi Dikembalikan
Stok buku otomatis bertambah
7. Perhitungan Denda Otomatis

Sistem menghitung denda secara otomatis berdasarkan keterlambatan pengembalian.

Contoh:

Batas peminjaman: 7 hari
Denda: Rp1.000/hari

Jika buku terlambat 3 hari maka:

Denda = 3 × Rp1.000 = Rp3.000

8. Laporan Peminjaman

Administrator dapat melihat laporan peminjaman berdasarkan periode tertentu (bulan dan tahun).

Informasi yang ditampilkan:

NIM anggota
Nama anggota
Judul buku
Tanggal peminjaman
Status peminjaman

Laporan dapat diekspor ke Microsoft Excel.

9. Laporan Pengembalian

Menampilkan seluruh data buku yang telah dikembalikan.

Informasi yang ditampilkan:

NIM anggota
Nama anggota
Judul buku
Tanggal pinjam
Tanggal kembali
Status pengembalian

Laporan dapat diekspor ke Microsoft Excel.

10. Laporan Denda

Menampilkan seluruh transaksi yang memiliki denda keterlambatan.

Informasi yang ditampilkan:

Data anggota
Data buku
Lama peminjaman
Besar denda

Sistem juga menampilkan total akumulasi denda yang diperoleh perpustakaan.

11. Laporan Buku Terlaris

Sistem menampilkan daftar buku yang paling sering dipinjam.

Data yang ditampilkan:

Ranking buku
Judul buku
Pengarang
Total peminjaman

Laporan dapat difilter berdasarkan bulan dan tahun serta diekspor ke Excel.

12. Logout

Administrator dapat keluar dari sistem untuk mengakhiri sesi penggunaan.

Alur Sistem Mahasiswa
1. Login Mahasiswa

Mahasiswa masuk ke sistem menggunakan akun yang telah didaftarkan.

2. Dashboard Mahasiswa

Setelah login, mahasiswa akan melihat menu utama yang terdiri dari:

Daftar Buku
Peminjaman Buku
Riwayat Peminjaman
Profil Mahasiswa
Logout
3. Melihat Daftar Buku

Mahasiswa dapat melihat seluruh koleksi buku yang tersedia beserta informasi:

Judul buku
Pengarang
Penerbit
Stok buku
4. Melakukan Peminjaman Buku

Mahasiswa memilih buku yang tersedia kemudian melakukan proses peminjaman.

Setelah peminjaman berhasil:

Data tersimpan ke database
Riwayat peminjaman otomatis bertambah
Stok buku berkurang
5. Melihat Riwayat Peminjaman

Mahasiswa dapat melihat seluruh histori peminjaman yang pernah dilakukan, termasuk status buku yang masih dipinjam atau sudah dikembalikan.

6. Profil Mahasiswa

Halaman profil menampilkan informasi pribadi mahasiswa, seperti:

NIM
Nama
Jurusan
Alamat
Nomor telepon

Mahasiswa juga dapat mengubah password akun secara mandiri melalui halaman profil.

7. Logout

Mahasiswa dapat keluar dari sistem dengan aman setelah selesai menggunakan aplikasi.

Teknologi yang Digunakan
PHP Native
MySQL Database
HTML5
CSS3
JavaScript
Chart.js (Grafik Dashboard)
Microsoft Excel Export

Tujuan Sistem

Sistem ini dikembangkan untuk:

Mempermudah pengelolaan perpustakaan
Mempercepat proses peminjaman dan pengembalian buku
Mengurangi kesalahan pencatatan data
Menghitung denda secara otomatis
Menyediakan laporan secara cepat dan akurat
Membantu pengambilan keputusan melalui statistik dan laporan perpustakaan

Dengan adanya sistem ini, proses administrasi perpustakaan menjadi lebih efektif, efisien, dan terintegrasi dalam satu aplikasi berbasis web.
