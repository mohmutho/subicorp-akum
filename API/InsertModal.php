<?php
require_once 'Koneksi.php';


$iduser  = $_POST['iduser'];
$jumlahModal = $_POST['jumlah_modal'];
$tglDisetor= $_POST['tgl_disetor'];
$jenis  = $_POST['jenis'];

// $buktiSetor = $_POST['bukti_setor'];
    
    
// if($buktiSetor == ''){
// $namafoto = '';
// } else {
//     $path = $_SERVER['DOCUMENT_ROOT'];
//     $path .= "/upload";

//     $data = base64_decode($foto);;
//     $namafoto = uniqid() . '.png';
    
//     $lokasi = "$path/hutang_bank_bukti/$namafoto";
    
//     file_put_contents($lokasi, $data);
// }
    
$query = "INSERT INTO modal(iduser,jumlah_modal,tgl_disetor,jenis) VALUES('$iduser','$jumlahModal','$tglDisetor','$jenis')";
    
$hasil = mysqli_query($conn, $query);
    
echo($hasil) ? json_encode(array('kode'=>1,'pesan'=>'berhasil menambahkan data')) : json_encode(array('kode'=>2,'pesan'=>'Data gagal Ditambahkan'));



?>