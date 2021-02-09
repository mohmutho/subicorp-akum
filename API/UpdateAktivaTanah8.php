<?php
require_once 'Koneksi.php';

$idAktiva  = $_POST['idaktiva'];
$nama  = $_POST['nama'];
$nilai = $_POST['nilai'];
$tglBeli = $_POST['tglbeli'];
$alamat = $_POST['alamat'];
$sertif = $_POST['sertif'];

$update = "UPDATE activa_tetap
SET nama_activa='$nama', nilai_tanah='$nilai', tahun_beli='$tglBeli', alamat='$alamat', no_sertifikat='$sertif'
WHERE id='$idAktiva'";

$hasilUpdate = mysqli_query($conn, $update);

echo($hasilUpdate) ? json_encode(array('kode'=>1,'pesan'=>'berhasil menambahkan data')) : json_encode(array('kode'=>0,'pesan'=>'Data gagal Ditambahkan'));

?>