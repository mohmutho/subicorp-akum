<?php
require_once 'Koneksi.php';

$idUser  = $_GET['idUser'];

$query = "SELECT DISTINCT
(select IF(SUM(nilai_piutang)  IS NULL,'0', SUM(nilai_piutang)) FROM piutang WHERE (jenis_piutang = 'usaha' OR jenis_piutang = 'lainnya') AND iduser = '$idUser') as PiutangDagang ,
(select IF(SUM(nilai_piutang)  IS NULL,'0', SUM(nilai_piutang)) FROM piutang WHERE jenis_piutang = 'retur' AND iduser = '$idUser') as PiutangRetur 
FROM piutang ";

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