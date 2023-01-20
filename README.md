# pemesanan-kendaraan
username-password
ADMIN
sabina-123
ATASAN
tata-123
bibi-123

database version = XAMPP MYSQL V3.3.0

php version = PHP 8.2.0

framework = bootstrap 4.3.1

panduan penggunaan aplikasi

- install db pemesanan_kendaraan.sql
- nyalakan server xampp
- buka locahlhost/pemesanan_kendaraan

alur pemesanan : admin input pemesanan - atasan menyetujui - konfirmasi admin - pesanan dalam status "Dipesan" - pesanan selesai

admin login :
- Admin dapat memasukkan pemesanan kendaraan dengan memilih kendaraan, pemesan, atasan yang menyetujui, dan tanggal kembali (tanggal pinjam akan otomatis terisi tanggal hari ini)
- Kendaraan yang telah dipesan statusnya akan berubah menjadi "Tidak ada" sehingga tidak bisa dipesan.
- Pesanan yang telah ditambahkan akan memasuki status "Menunggu Persetujuan" oleh atasan yang bersangkutan sesuai yang telah diinputkan oleh admin.
- Setelah pesanan disetujui oleh atasan maka pesanan memasuki status "Disetujui" admin harus mengo nfirmasi lagi agar pesanan bisa berubah status menjadi "Dipesan"
- Jika pesanan telah selesai admin dapat mengofirmasi sehingga status pesanan akan berubah menjadi "Selesai"
- Status kendaraan yang selesai dipesan akan berubah menjadi "Ada" dan bisa dipesan kembali.
- "Detail Servis" pada kendaraan bisa dilihat di halaman "Kendaraan", detail yang muncul hanya berdasarkan kendaraan yang dipilih. Untuk data servis lengkap bisa dilihat di halaman "Data Servis"

atasan login :
- Atasan hanya dapat melihat isi pesanan "Menunggu Persetujuan" jika yang bersangkutan yang harus menyetujui, selain itu tidak bisa.
- User level pada atasan hanya dapat menampilkan halaman "Menunggu Persetujuan", "Riwayat Pesanan", "Kendaraan", dan Data Servis.

