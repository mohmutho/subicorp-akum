<?php
require_once 'Koneksi.php';

$idUser  = $_GET['idUser'];
    
$query = "SELECT id, nama_hutang as namaTransaksi, nilai_hutang as nilaiTransaksi, tgl_transaksi as tglTransaksi FROM hutang 
WHERE iduser='$idUser' AND nilai_hutang != '0' AND jenis_hutang != 'lainnya' ";

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