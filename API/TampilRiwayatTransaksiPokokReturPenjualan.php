<?php
require_once 'Koneksi.php';

$idUser  = $_GET['idUser'];
    
$query = "SELECT nama_barang as namaBarang, jumlah as jumlahRetur,jumlah as jumlah , tgl_retur as tglRetur, keterangan as keterangan FROM retur WHERE iduser='$idUser' AND jenis_retur='Penjualan' ";

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