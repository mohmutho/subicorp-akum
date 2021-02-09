<?php
require_once 'Koneksi.php';

$idUser  = $_POST['iduser'];
$jumlahModal = $_POST['jumlah_modal'];
$tglDisetor = $_POST['tgl_disetor'];
$jenis  = $_POST['jenis'];



$insert = "UPDATE saldo_kas SET modal_disetor = modal_disetor - '$jumlahModal' where iduser = '$idUser' ";

$hasilInsert = mysqli_query($conn, $insert);
    
echo($hasilInsert) ? json_encode(array('kode'=>1,'pesan'=>'berhasil menambahkan data')) : json_encode(array('kode'=>2,'pesan'=>'Data gagal Ditambahkan'));

?>