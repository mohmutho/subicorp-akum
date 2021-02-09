<?php
require_once 'Koneksi.php';

$idUser  = $_POST['iduser'];
$namaDividen  = $_POST['nama_dividen'];
$nilaiDividen = $_POST['nilai_dividen'];
$tglDividen = $_POST['tgl_dividen'];




$insert = "INSERT INTO dividen(iduser, nama_dividen, nilai_dividen, tgl_dividen) VALUES('$idUser','$namaDividen','$nilaiDividen','$tglDividen') ";

$hasilInsert = mysqli_query($conn, $insert);
    
echo($hasilInsert) ? json_encode(array('kode'=>1,'pesan'=>'berhasil menambahkan data')) : json_encode(array('kode'=>2,'pesan'=>'Data gagal Ditambahkan'));

?>