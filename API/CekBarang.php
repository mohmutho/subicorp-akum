<?php
require_once 'Koneksi.php';

$idUser  = $_GET['idUser'];
$namaBarang  = $_GET['namaBarang'];

$query = "SELECT count(nama_barang) as tersedia FROM barang_dagangan WHERE iduser='$idUser' AND nama_barang='$namaBarang' ";

$hasil = mysqli_query($conn, $query);

$array = array();

while($row = mysqli_fetch_assoc($hasil))
{
  $array[] = $row;    
}

if(mysqli_num_rows($hasil) > 0)
{
   echo json_encode(array("kode" => 1, "result"=>$array));
}else{
   echo json_encode(array("kode" => 0));
}
