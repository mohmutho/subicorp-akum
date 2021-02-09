<?php
require_once 'Koneksi.php';

$iduser  = $_POST['iduser'];
$idbarang  = $_POST['idbarang'];
$status  = $_POST['status'];


$update = "UPDATE activa_lainnya SET status='$status' WHERE iduser='$iduser' AND id='$id' ";

$hasilUpdate = mysqli_query($conn, $update);

echo($hasilUpdate) ? json_encode(array('kode'=>1,'pesan'=>'berhasil update data')) : json_encode(array('kode'=>2,'pesan'=>'Data gagal diupdate'));

?>