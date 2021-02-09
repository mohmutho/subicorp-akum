<?php
require_once 'Koneksi.php';

$idUser  = $_POST['iduser'];
$tgl  = $_POST['tanggal'];
$namaTransaksi  = $_POST['namaTransaksi'];
$jumlahRetur  = $_POST['jumlahRetur'];
$keterangan  = $_POST['keterangan'];
$buktiBayar  = $_POST['buktiBayar'];
$jenis = 'Pembelian';

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/Foto";
 
$data = base64_decode($buktiBayar);
$bukti = uniqid() . '.png';
$lokasi = "$path/Retur_Pembelian/$bukti";

file_put_contents($lokasi, $data);

$insert = "INSERT INTO retur(iduser, nama_barang, jenis_retur, jumlah, tgl_retur, keterangan, bukti_pembelian) 
VALUES('$idUser','$namaTransaksi','$jenis','$jumlahRetur','$tgl','$keterangan','$bukti') ";

$hasilInsert = mysqli_query($conn, $insert);
    
echo($hasilInsert) ? json_encode(array('kode'=>1,'pesan'=>'berhasil menambahkan data')) : json_encode(array('kode'=>2,'pesan'=>'Data gagal Ditambahkan'));

?>