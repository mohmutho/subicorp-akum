<?php
require_once 'Koneksi.php';

$idUser  = $_GET['idUser'];
    
$query = "SELECT id, nama_piutang as namaTransaksi, nilai_piutang as nilaiTransaksi, tanggal_transaksi as tglTransaksi FROM piutang WHERE iduser='$idUser' AND nilai_piutang != '0' ";

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