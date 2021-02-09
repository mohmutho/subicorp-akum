<?php
require_once 'Koneksi.php';

$idUser  = $_GET['iduser'];
    
$query = "SELECT id, nama_activa as nama, IF((nilai_tanah + nilai_bangunan) IS NULL,'0', (nilai_tanah + nilai_bangunan))  as nilai FROM activa_tetap WHERE iduser='$idUser'";

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