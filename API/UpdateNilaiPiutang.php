<?php
require_once 'Koneksi.php';

$idtransaksi  = $_POST['idtransaksi'];
$jumlah  = $_POST['jumlah'];
    
$update = "UPDATE piutang SET nilai_piutang='$jumlah' WHERE id='$idtransaksi'";

$hasilUpdate = mysqli_query($conn, $update);

echo($hasilUpdate) ? json_encode(array('kode'=>1,'pesan'=>'berhasil menambahkan data')) : json_encode(array('kode'=>2,'pesan'=>'Data gagal Ditambahkan'));

?>