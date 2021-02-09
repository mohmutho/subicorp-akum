<?php
require_once 'Koneksi.php';

$iduser  = $_POST['iduser'];

$update = "UPDATE user SET status_opening='1' WHERE id='$iduser'";

$hasilUpdate = mysqli_query($conn, $update);

echo($hasilUpdate) ? json_encode(array('kode'=>1,'pesan'=>'berhasil update data')) : json_encode(array('kode'=>2,'pesan'=>'Data gagal diupdate'));

?>