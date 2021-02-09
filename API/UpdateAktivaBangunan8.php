<?php
require_once 'Koneksi.php';

$idAktiva  = $_POST['idaktiva'];
$nama  = $_POST['nama'];
$nilaiTanah = $_POST['nilaitanah'];
$nilaiBangunan = $_POST['nilaibangunan'];
$tglBerdiri = $_POST['tglberdiri'];
$tglBeli = $_POST['tglbeli'];
$bulanSisa = $_POST['bulansisa'];
$bulanTerpakai = $_POST['bulanterpakai'];
$akumulasi = $_POST['akumulasi'];
$hargaSisa = $_POST['hargasisa'];
$alamat = $_POST['alamat'];
$sertif = $_POST['sertif'];

$update = "UPDATE activa_tetap
SET 
nama_activa='$nama',
nilai_tanah='$nilaiTanah',
nilai_bangunan = '$nilaiBangunan',
tahun_berdiri = '$tglBerdiri',
tahun_beli='$tglBeli',
bulan_sisa='$bulanSisa',
bulan_terpakai='$bulanTerpakai',
akumulasi_penyusutan='$akumulasi',
harga_sisa='$hargaSisa',
alamat='$alamat', 
no_sertifikat='$sertif'
WHERE id='$idAktiva'";

$hasilUpdate = mysqli_query($conn, $update);

echo($hasilUpdate) ? json_encode(array('kode'=>1,'pesan'=>'berhasil menambahkan data')) : json_encode(array('kode'=>0,'pesan'=>'Data gagal Ditambahkan'));

?>