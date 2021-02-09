<?php
require_once 'Koneksi.php';

$idUser = $_POST['iduser'];
$jenis = $_POST['jenis'];
$namaAsset  = $_POST['namaAsset'];
$tgl  = $_POST['tgl'];
$jumlahUnit  = $_POST['jumlahUnit'];
$hargaBarang  = $_POST['hargaBarang'];
$totalPembelian  = $_POST['totalPembelian'];
$jenisTransaksi  = $_POST['jenisTransaksi'];


$insert = "INSERT INTO asset(iduser, nama_asset, jenis_asset, jenis_transaksi, nilai_asset, created_date, jumlah_unit, total_asset)
VALUES('$idUser','$namaAsset','$jenis_asset','$jenis_transaksi','$hargaBarang','$tgl','$jumlahUnit','$totalPembelian') ";

$hasilInsert = mysqli_query($conn, $insert);
    
echo($hasilInsert) ? json_encode(array('kode'=>1,'pesan'=>'berhasil menambahkan data')) : json_encode(array('kode'=>2,'pesan'=>'Data gagal Ditambahkan'));

?>