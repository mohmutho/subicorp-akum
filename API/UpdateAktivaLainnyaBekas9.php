<?php
require_once 'Koneksi.php';

$idAktiva  = $_POST['idaktiva'];
$nama  = $_POST['nama'];
$namaPenjual = $_POST['namapenjual'];
$kuantitas = $_POST['kuantitas'];
$nilaiAktiva = $_POST['nilai'];
$nilaiEkonomi = $_POST['nilaiekonomi'];
$tglBerdiri = $_POST['tglberdiri'];
$tglBeli = $_POST['tglbeli'];
$bulanSisa = $_POST['bulansisa'];
$bulanTerpakai = $_POST['bulanterpakai'];
$akumulasi = $_POST['akumulasi'];
$hargaSisa = $_POST['hargasisa'];

$update = "UPDATE activa_lainnya
SET 
nama_activa='$nama',
nama_penjual='$namaPenjual',
nilai_activa='$nilaiAktiva',
nilai_ekonomi='$nilaiEkonomi',
kuantitas='$kuantitas',
tahun_berdiri='$tglBerdiri',
tahun_beli='$tglBeli',
bulan_sisa='$bulanSisa',
bulan_terpakai='$bulanTerpakai',
akumulasi_penyusutan='$akumulasi',
harga_sisa='$hargaSisa'
WHERE id='$idAktiva'";

$hasilUpdate = mysqli_query($conn, $update);

echo($hasilUpdate) ? json_encode(array('kode'=>1,'pesan'=>'berhasil menambahkan data')) : json_encode(array('kode'=>0,'pesan'=>'Data gagal Ditambahkan'));

?>