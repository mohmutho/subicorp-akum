<?php
require_once 'Koneksi.php';

$idUser  = $_POST['iduser'];
$nama  = $_POST['nama'];
$jumlah  = $_POST['jumlah'];
    
$update = "UPDATE barang_dagangan SET jumlah_barang=jumlah_barang+'$jumlah' WHERE iduser='$idUser' AND nama_barang='$nama' ";

$hasilUpdate = mysqli_query($conn, $update);

echo($hasilUpdate) ? json_encode(array('kode'=>1,'pesan'=>'berhasil menambahkan data')) : json_encode(array('kode'=>2,'pesan'=>'Data gagal Ditambahkan'));

?>