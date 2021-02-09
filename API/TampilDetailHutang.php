<?php
require_once 'Koneksi.php';

$idhutang  = $_GET['idhutang'];
    
$query = "SELECT id,iduser, nama_hutang, nilai_hutang, jenis_hutang,
tgl_transaksi,tgl_jatuh_tempo, 
bukti_transaksi, keterangan, status
FROM hutang WHERE id='$idhutang'";

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