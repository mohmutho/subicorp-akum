<?php
require_once 'Koneksi.php';

$idUser  = $_POST['idUser'];
$laba  = $_POST['laba'];
    
$update = "UPDATE saldo_kas SET saldo_labarugi='$laba' WHERE iduser='$idUser'";

$hasilUpdate = mysqli_query($conn, $update);

echo($hasilUpdate) ? json_encode(array('kode'=>1,'pesan'=>'berhasil menambahkan data')) : json_encode(array('kode'=>2,'pesan'=>'Data gagal Ditambahkan'));

?>