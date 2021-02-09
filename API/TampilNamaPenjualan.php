<?php
require_once 'Koneksi.php';

$idUser  = $_GET['idUser'];
    
$query = "SELECT id, penjualanke as namaTransaksi, nama_barang as namaBarang, total_harga as nilaiTransaksi, tanggal_penjualan as tglTransaksi, jumlah as jumlah
FROM penjualan WHERE iduser='$idUser'";

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