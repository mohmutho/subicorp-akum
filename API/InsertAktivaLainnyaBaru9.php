<?php
require_once 'Koneksi.php';

$idUser  = $_POST['idUser'];
$jenis = $_POST['jenis'];
$nama  = $_POST['nama'];
$namaPenjual = $_POST['namaPenjual'];
$nilaiAktiva = $_POST['nilaiAktiva'];
$nilaiEkonomi = $_POST['nilaiEkonomi'];
$kuantitas = $_POST['kuantitas'];
$tahunBeli = $_POST['tahunBeli'];
$bulanSisa = $_POST['bulansisa'];
$bulanTerpakai = $_POST['bulanterpakai'];
$akumulasi = $_POST['akumulasi'];
$hargaSisa = $_POST['hargasisa'];

$insert = "INSERT INTO activa_lainnya(iduser, jenis_activa, nama_activa, nama_penjual, nilai_activa, nilai_ekonomi, kuantitas, tahun_beli, bulan_sisa, bulan_terpakai, akumulasi_penyusutan, harga_sisa) 
VALUES('$idUser', '$jenis', '$nama', '$namaPenjual', '$nilaiAktiva', '$nilaiEkonomi', '$kuantitas', '$tahunBeli', '$bulanSisa', '$bulanTerpakai', '$akumulasi', '$hargaSisa')";

$hasilInsert = mysqli_query($conn, $insert);
    
echo($hasilInsert) ? json_encode(array('kode'=>1,'pesan'=>'berhasil menambahkan data')) : json_encode(array('kode'=>2,'pesan'=>'Data gagal Ditambahkan'));

?>