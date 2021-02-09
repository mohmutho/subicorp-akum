<?php
require_once 'Koneksi.php';

$idUser  = $_GET['idUser'];
    
$query = "SELECT u.nama as NamaPt, IF(sk.saldo_kas IS NULL,'0', sk.saldo_kas) as SaldoKas, 
IF(SUM(bd.total_nilai_barang) IS NULL,'0', SUM(bd.harga_satuan * bd.jumlah_barang)) as Persediaan, 
'0' as SuratBerharga, sk.saldo_kas + SUM(p.nilai_piutang) + SUM(bd.harga_satuan * bd.jumlah_barang)  as JumlahAktivaLancar
FROM user u JOIN saldo_kas sk ON sk.iduser = u.id JOIN piutang p ON p.iduser = u.id  JOIN barang_dagangan bd ON bd.iduser = u.id where u.id ='$idUser' ";

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