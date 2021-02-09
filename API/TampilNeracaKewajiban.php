<?php
require_once 'Koneksi.php';

$idUser  = $_GET['idUser'];

$query = "SELECT DISTINCT(select IF(SUM(nilai_hutang) IS NULL,'0', SUM(nilai_hutang)) FROM hutang WHERE jenis_hutang = 'usaha' AND iduser = '$idUser') as UtangDagang ,
(select IF(SUM(nilai_hutang) IS NULL,'0', SUM(nilai_hutang)) FROM hutang WHERE jenis_hutang = 'lainnya' AND iduser = '$idUser') as UtangGaji ,
(select IF(SUM(nilai_hutang) IS NULL,'0', SUM(nilai_hutang)) FROM hutang WHERE jenis_hutang = 'retur' AND iduser = '$idUser') as UtangRetur ,

(select IF(SUM(nilai_hutang) IS NULL,'0', SUM(nilai_hutang)) FROM hutang WHERE jenis_hutang = 'usaha' AND iduser = '$idUser') +
(select IF(SUM(nilai_hutang) IS NULL,'0', SUM(nilai_hutang)) FROM hutang WHERE jenis_hutang = 'lainnya' AND iduser = '$idUser') +
(select IF(SUM(nilai_hutang) IS NULL,'0', SUM(nilai_hutang)) FROM hutang WHERE jenis_hutang = 'retur' AND iduser = '$idUser') as JumlahKewajibanLancar,

(select IF(SUM(nilai_hutang) IS NULL,'0', SUM(nilai_hutang)) FROM hutang WHERE jenis_hutang = 'bank' AND iduser = '$idUser') as UtangBank ,
(select IF(SUM(nilai_hutang) IS NULL,'0', SUM(nilai_hutang)) FROM hutang WHERE jenis_hutang = 'bank' AND iduser = '$idUser') as JumlahKewajibanJangkaPanjang 

FROM hutang ";

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