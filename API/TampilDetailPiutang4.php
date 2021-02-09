<?php
require_once 'Koneksi.php';

$idPiutang  = $_GET['idPiutang'];
    
$query = "SELECT id,iduser, nama_piutang, nilai_piutang, 
tanggal_transaksi,
tanggal_jatuh_tempo, 
bukti_transaksi, keterangan, status
FROM piutang WHERE id='$idPiutang'";

//DATE_FORMAT(tanggal_transaksi, '%d %b %Y') AS 

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