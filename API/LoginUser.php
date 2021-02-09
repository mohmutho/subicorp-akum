<?php
require_once 'Koneksi.php';

$user = $_GET['username'];
$pass = $_GET['password'];

$query = "SELECT * FROM user where username = '$user' AND password = '$pass' ";

$hasil = mysqli_query($conn, $query);

$array = array();

$row = mysqli_fetch_assoc($hasil);

if(mysqli_num_rows($hasil) > 0)
{
   echo json_encode(array("kode" => 1, "pesan"=>"Login Berhasil", "iduser"=>$row['id'], "nama"=>$row['nama'], "jenis_usaha"=>$row['jenis_usaha'], "status_opening"=>$row['status_opening']));
}else{
   echo json_encode(array("kode" => 0, "pesan"=>"Data tidak ditemukan", "iduser"=>"0"));
}



?>