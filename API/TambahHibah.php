<?php
require_once 'Koneksi.php';

$idUser = $_POST['iduser'];
$namaPemberi = $_POST['namaPemberi'];
$namaBarang  = $_POST['namaBarang'];
$nilai = $_POST['nilai'];
$tgl = $_POST['tgl'];
$bukti = $_POST['bukti'];
$keterangan = $_POST['keterangan'];

$insert = "INSERT INTO hibah(iduser, jenis_hibah, nama_penerima, nama_barang, nilai_barang, tgl_penerimaan, bukti_foto, keterangan)
VALUES('$idUser','Pemasukan','$namaPemberi','$namaBarang','$nilai','$tgl','$bukti','$keterangan') ";

$hasilInsert = mysqli_query($conn, $insert);
    
echo($hasilInsert) ? json_encode(array('kode'=>1,'pesan'=>'berhasil menambahkan data')) : json_encode(array('kode'=>2,'pesan'=>'Data gagal Ditambahkan'));

?>