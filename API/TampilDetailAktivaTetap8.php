<?php
require_once 'Koneksi.php';

$idaktiva  = $_GET['idaktiva'];
    
$query = "SELECT * FROM activa_tetap WHERE id='$idaktiva'";

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