<?php
require_once 'Koneksi.php';

$idUser  = $_GET['iduser'];
    
$query = "SELECT * FROM bayar_hutang b JOIN hutang h ON b.hutang_id = h.id WHERE h.iduser='$idUser' AND h.jenis_hutang='usaha' ";

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