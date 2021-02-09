<?php
require_once 'Koneksi.php';

$idpersediaan  = $_POST['idpersediaan'];
$nama = $_POST['nama'];
$jumlah = $_POST['jumlah'];
$hargaSatuan = $_POST['hargasatuan'];
$total = $_POST['total'];

$update = "UPDATE barang_dagangan
SET nama_barang='$nama', jumlah_barang='$jumlah', harga_satuan ='$hargaSatuan', total_nilai_barang='$total'
WHERE id='$idpersediaan'";

$hasilInsert = mysqli_query($conn, $update);
    
echo($hasilInsert) ? json_encode(array('kode'=>1,'pesan'=>'berhasil menambahkan data')) : json_encode(array('kode'=>0,'pesan'=>'Data gagal Ditambahkan'));

?>