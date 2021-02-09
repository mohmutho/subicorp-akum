<?php
require_once 'Koneksi.php';

$idUser  = $_POST['idUser'];
$saldo  = $_POST['saldo'];
    
$update = "UPDATE saldo_kas SET saldo_bank='$saldo' WHERE iduser='$idUser'";

$hasilUpdate = mysqli_query($conn, $update);

echo($hasilUpdate) ? json_encode(array('kode'=>1,'pesan'=>'berhasil menambahkan data')) : json_encode(array('kode'=>2,'pesan'=>'Data gagal Ditambahkan'));

?>