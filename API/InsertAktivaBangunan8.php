<?php
require_once 'Koneksi.php';

$idUser  = $_POST['iduser'];
$jenis = $_POST['jenis'];
$nama  = $_POST['nama'];
$nilaiTanah = $_POST['nilaitanah'];
$nilaiBangunan = $_POST['nilaibangunan'];
$jenisBangunan = $_POST['jenisbangunan'];
$nilaiEkonomi = $_POST['nilaiekonomi'];
$tglBerdiri = $_POST['tglberdiri'];
$tahunBeli = $_POST['tahunbeli'];
$bulanSisa = $_POST['bulansisa'];
$bulanTerpakai = $_POST['bulanterpakai'];
$akumulasi = $_POST['akumulasi'];
$hargaSisa = $_POST['hargasisa'];
$alamat = $_POST['alamat'];
$sertif = $_POST['sertif'];

$insert = "INSERT INTO activa_tetap(iduser, jenis_activa, nama_activa, nilai_tanah, nilai_bangunan, jenis_bangunan, nilai_ekonomi,tahun_berdiri, tahun_beli, bulan_sisa, bulan_terpakai, akumulasi_penyusutan, harga_sisa, alamat, no_sertifikat) 
VALUES('$idUser', '$jenis', '$nama', '$nilaiTanah', '$nilaiBangunan' , '$jenisBangunan', '$nilaiEkonomi', '$tglBerdiri' , '$tahunBeli', '$bulanSisa', '$bulanTerpakai' , '$akumulasi', '$hargaSisa', '$alamat', '$sertif')";

$hasilInsert = mysqli_query($conn, $insert);
    
echo($hasilInsert) ? json_encode(array('kode'=>1,'pesan'=>'berhasil menambahkan data')) : json_encode(array('kode'=>2,'pesan'=>'Data gagal Ditambahkan'));

?>