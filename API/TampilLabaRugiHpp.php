<?php
require_once 'Koneksi.php';

$idUser  = $_GET['idUser'];
    
$query = "SELECT IF(sum(harga_pokok_penjualan) IS NULL,'0', sum(harga_pokok_penjualan))  AS Hpp
FROM user u JOIN penjualan p ON p.iduser = u.id where u.id ='$idUser' ";

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