<?php
require_once 'Koneksi.php';

$idUser  = $_GET['iduser'];
    
$query = "SELECT * FROM hutang WHERE iduser='$idUser' AND jenis_hutang='bank' AND nilai_hutang != '0' ";

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