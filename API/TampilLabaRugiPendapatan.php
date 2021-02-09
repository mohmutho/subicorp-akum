<?php
require_once 'Koneksi.php';

$idUser  = $_GET['idUser'];
    
$query = "SELECT u.nama as NamaPt, IF(SUM(p.total_harga) IS NULL,'0', SUM(p.total_harga)) as PenjualanBarangJasa
FROM user u LEFT JOIN penjualan p ON p.iduser = u.id where u.id ='$idUser' ";

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


?>