<?php
require_once 'Koneksi.php';

$idUser  = $_POST['idUser'];
$jenis = $_POST['jenis'];
$nama  = $_POST['nama'];
$jumlah = $_POST['jumlah'];
$satuan = $_POST['satuan'];
$hargaSatuan = $_POST['hargaSatuan'];
$total = $_POST['total'];

$insert = "INSERT INTO barang_dagangan(iduser, jenis_barang, nama_barang, jumlah_barang, satuan, harga_satuan, total_nilai_barang) 
VALUES('$idUser', '$jenis', '$nama', '$jumlah', '$satuan', '$hargaSatuan', '$total')";

$hasilInsert = mysqli_query($conn, $insert);
    
echo($hasilInsert) ? json_encode(array('kode'=>1,'pesan'=>'berhasil menambahkan data')) : json_encode(array('kode'=>2,'pesan'=>'Data gagal Ditambahkan'));

?>