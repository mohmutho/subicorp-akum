<?php
require_once 'Koneksi.php';

$idaktiva  = $_GET['idaktiva'];
$jenis = $_GET['jenis'];
    
$query = 
"SELECT *
FROM activa_lainnya 
WHERE id='$idaktiva' AND jenis_activa='$jenis'";

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