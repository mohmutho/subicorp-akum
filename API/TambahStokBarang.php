<?php
require_once 'Koneksi.php';

$idUser = $_POST['idUser'];
$jumlahBarang = $_POST['jumlahBarang'];
$namaBarang = $_POST['namaBarang'];
$satuan = $_POST['satuan'];
$jenisBarang = $_POST['jenisBarang'];
$hargaSatuan = $_POST['hargaSatuan'];
$totalNilaiBarang = $_POST['totalNilaiBarang'];

$insert = "INSERT INTO barang_dagangan(iduser, jenis_barang, nama_barang, jumlah_barang, satuan, harga_satuan, total_nilai_barang) 
VALUES('$idUser','$jenisBarang','$namaBarang','$jumlahBarang','$satuan','$hargaSatuan','$totalNilaiBarang') ";

$hasilInsert = mysqli_query($conn, $insert);
    
echo($hasilInsert) ? json_encode(array('kode'=>1,'pesan'=>'berhasil menambahkan data')) : json_encode(array('kode'=>2,'pesan'=>'Data gagal Ditambahkan'));

?>