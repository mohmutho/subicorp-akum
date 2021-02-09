<?php
require_once 'Koneksi.php';

$idUser  = $_POST['iduser'];
$namaPenerima = $_POST['namaPenerima'];
$nilaiBarang = $_POST['nilaiBarang'];
$namaBarang = $_POST['namaBarang'];
$tgl = $_POST['tgl'];
$keterangan = $_POST['keterangan'];
$jenis  = $_POST['jenis'];


$insert = "INSERT INTO hibah(iduser, jenis_hibah, nama_penerima, nilai_barang, nama_barang, tgl_penerimaan, keterangan) 
VALUES('$idUser','$jenis','$namaPenerima','$nilaiBarang','$namaBarang','$tgl','$keterangan') ";

$hasilInsert = mysqli_query($conn, $insert);
    
echo($hasilInsert) ? json_encode(array('kode'=>1,'pesan'=>'berhasil menambahkan data')) : json_encode(array('kode'=>2,'pesan'=>'Data gagal Ditambahkan'));

?>