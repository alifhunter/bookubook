<?php
include('includes/config.php');
$id = $_GET['id']; #mendapatkan data id  dari method get
if (empty($id)){ #jika id mahasiswany kosong maka alihkan ke halaman semua_mahasiswa.php
header("location:index.php"); #proses pengalihan ke semua_mahasiswa.php
exit(); #akhiri semua script cukup sampai di sini
}
$sql = $connect->query("select * from ebook where id='". $id . "'");
$hasil = mysqli_num_rows($sql);
if ($hasil == 0){ #jik $hasil 0 (tidak ada rows) maka munculkan pesan error
echo "Ebook with id <b>". $id ."</b> is not available.";
exit(); #akhiri semua script cukup sampai di sini
}
$sql_hapus = $connect->query("delete from ebook where id='" . $id. "'"); #perintah sql untuk menghapus data yang ada di tabel mahasiswa dengan id $id_mahasiswa
if ($sql_hapus){ #jika sql_hapus berhasil di jalankan maka munculkan sukses menghapus data
echo "Ebook with id <b>". $id ."</b> successfully deleted. <a href='index.php'>Back</a>";
}
else{
echo "Failed to delete ebook with id<b>" . $id ."</b> cause of ".mysql_error;
}
?>