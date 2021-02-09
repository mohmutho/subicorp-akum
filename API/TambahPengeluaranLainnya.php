<?php
require_once 'Koneksi.php';

$idUser  = $_POST['iduser'];
$jenis = $_POST['jenis'];
$nama = $_POST['nama'];
$tgl  = $_POST['tgl'];
$nilai  = $_POST['nilai'];
$jenisBayar  = $_POST['jenis_bayar'];
$cash  = $_POST['cash'];
$kredit  = $_POST['kredit'];
$buktiBayar = $_POST['bukti_bayar'];


$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/Foto";
 
$data = base64_decode($buktiBayar);
$bukti = uniqid() . '.png';
$lokasi = "$path/Pengeluaran/$bukti";

file_put_contents($lokasi, $data);

$insert = "INSERT INTO pengeluaran(iduser, jenis_transaksi, nama_transaksi, tanggal_transaksi, nilai_transaksi, jenis_pembayaran, cash, kredit, bukti_bayar)
VALUES('$idUser','$jenis','$nama','$tgl','$nilai','$jenisBayar','$cash','$kredit','$bukti') ";

$hasilInsert = mysqli_query($conn, $insert);
    
echo($hasilInsert) ? json_encode(array('kode'=>1,'pesan'=>'berhasil menambahkan data')) : json_encode(array('kode'=>2,'pesan'=>'Data gagal Ditambahkan'));

?>