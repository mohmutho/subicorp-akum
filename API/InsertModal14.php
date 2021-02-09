<?php
require_once 'Koneksi.php';

$idUser  = $_POST['idUser'];
$modal  = $_POST['modal'];
    
$update = "UPDATE saldo_kas SET modal_disetor='$modal' WHERE iduser='$idUser'";

$hasilUpdate = mysqli_query($conn, $update);

echo($hasilUpdate) ? json_encode(array('kode'=>1,'pesan'=>'berhasil menambahkan data')) : json_encode(array('kode'=>2,'pesan'=>'Data gagal Ditambahkan'));

?>