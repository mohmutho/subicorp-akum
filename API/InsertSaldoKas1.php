<?php
require_once 'Koneksi.php';

$idUser  = $_POST['idUser'];
$saldo  = $_POST['saldo'];
    
$insert = "INSERT INTO saldo_kas(iduser, saldo_kas, created_date) VALUES('$idUser','$saldo',NOW())";
$update = "UPDATE saldo_kas SET saldo_kas='$saldo' WHERE iduser='$idUser'";

$check = "SELECT * FROM saldo_kas WHERE iduser='$idUser'";
$test = mysqli_query($conn, $check);
$checkrows = mysqli_num_rows($test);

if($checkrows > 0){
    $hasilUpdate = mysqli_query($conn, $update);
    
    echo($hasilUpdate) ? json_encode(array("kode"=>1,"pesan"=>"berhasil mengupdate data")) : json_encode(array("kode"=>2,"pesan"=>"Data gagal diupdate"));
} else {
    $hasilInsert = mysqli_query($conn, $insert);
    
    echo($hasilInsert) ? json_encode(array("kode"=>3,"pesan"=>"berhasil menambahkan data")) : json_encode(array("kode"=>2,"pesan"=>"Data gagal Ditambahkan"));
}

?>