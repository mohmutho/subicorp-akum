<?php
require_once 'Koneksi.php';

$idUser  = $_GET['iduser'];
    
$query = "SELECT * FROM piutang p JOIN bayar_piutang b ON b.piutang_id = p.id WHERE p.iduser='$idUser' AND p.jenis_piutang='lainnya' ";

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