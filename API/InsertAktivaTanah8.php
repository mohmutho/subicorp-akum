<?php
require_once 'Koneksi.php';

$idUser  = $_POST['iduser'];
$jenis = $_POST['jenis'];
$nama  = $_POST['nama'];
$nilai = $_POST['nilai'];
$tahun = $_POST['tahun'];
$alamat = $_POST['alamat'];
$sertif = $_POST['sertif'];

$insert = "INSERT INTO activa_tetap(iduser, jenis_activa, nama_activa, nilai_tanah, tahun_beli, alamat, no_sertifikat) 
VALUES('$idUser', '$jenis', '$nama', '$nilai', '$tahun', '$alamat', '$sertif')";

$hasilInsert = mysqli_query($conn, $insert);
    
echo($hasilInsert) ? json_encode(array('kode'=>1,'pesan'=>'berhasil menambahkan data')) : json_encode(array('kode'=>2,'pesan'=>'Data gagal Ditambahkan'));

?>