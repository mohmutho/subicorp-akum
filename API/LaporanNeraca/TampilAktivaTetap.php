<?php
require_once 'Koneksi.php';

$iduser  = $_GET['iduser'];
    
$query = "SELECT jenis_activa, nama_activa, nilai_tanah, harga_sisa
FROM activa_tetap 
WHERE iduser='$iduser'";

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