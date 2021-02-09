<?php
require_once 'Koneksi.php';

$idUser  = $_GET['idUser'];
    
$query = "SELECT SUM(nilai_tanah) + SUM(nilai_bangunan) + IF((SELECT SUM(nilai_activa) AS PenjualanAsset FROM activa_lainnya where iduser = '$idUser' AND status = 'Jual') IS NULL,'0',
(SELECT SUM(nilai_activa) AS PenjualanAsset FROM activa_lainnya where iduser = '$idUser' AND status = 'Jual')) as PenjualanAsset
FROM activa_tetap where iduser ='$idUser' AND status = 'Jual' ";

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