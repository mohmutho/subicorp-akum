<?php
require_once 'Koneksi.php';

$idhutang  = $_POST['idhutang'];
$nilai = $_POST['nilaibayar'];
$tanggal = $_POST['tanggal'];
$foto = $_POST['foto'];
$keterangan = $_POST['keterangan'];
$namafoto = '';

if($foto == '' || $foto == null){
    $namafoto = '';
} else {
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/Foto";

    $data = base64_decode($foto);
    $namafoto = uniqid() . '.png';
    
    $lokasi = "$path/Bayar_Hutang/$namafoto";
    
    file_put_contents($lokasi, $data);
}
    
$insert = "INSERT INTO bayar_hutang(hutang_id, nilai_bayar, tanggal, foto_bukti, keterangan) 
VALUES('$idhutang','$nilai','$tanggal','$namafoto','$keterangan')";

$hasilInsert = mysqli_query($conn, $insert);
    
echo($hasilInsert) ? json_encode(array('kode'=>1,'pesan'=>'berhasil menambahkan data')) : json_encode(array('kode'=>2,'pesan'=> 'Data gagal Ditambahkan'));

?>