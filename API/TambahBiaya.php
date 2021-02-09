<?php
require_once 'Koneksi.php';

$idUser = $_POST['iduser'];
$namaBiaya = $_POST['nama_biaya'];
$tglDikeluarkan  = $_POST['tgl_dikeluarkan'];
$nilai  = $_POST['nilai'];

$insert = "INSERT INTO biaya(iduser, nama_biaya, nilai, tgl_dikeluarkan) VALUES('$idUser','$namaBiaya','$nilai','$tglDikeluarkan') ";

$hasilInsert = mysqli_query($conn, $insert);
    
echo($hasilInsert) ? json_encode(array('kode'=>1,'pesan'=>'berhasil menambahkan data')) : json_encode(array('kode'=>2,'pesan'=>'Data gagal Ditambahkan'));

?>