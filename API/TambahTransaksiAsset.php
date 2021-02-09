<?php
require_once 'Koneksi.php';

$iduser  = $_POST['iduser'];
$namaAsset  = $_POST['nama_asset'];
$jenisAsset = $_POST['jenis_asset'];
$jenisTransaksi = $_POST['jenis_transaksi'];
$jumlahUnit = $_POST['jumlah_unit'];
$nilaiAsset  = $_POST['nilai_asset'];
$totalAsset = $_POST['total_asset'];
    
$query = "INSERT INTO asset(iduser, nama_asset, jumlah_unit, nilai_asset, total_asset) VALUES('$iduser','$namaAsset','$jumlahUnit','$nilaiAsset','$totalAsset')";
    
$hasil = mysqli_query($conn, $query);
    
echo($hasil) ? json_encode(array('kode'=>1,'pesan'=>'berhasil menambahkan data')) : json_encode(array('kode'=>2,'pesan'=>'Data gagal Ditambahkan'));



?>