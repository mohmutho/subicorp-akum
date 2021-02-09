<?php
require_once 'Koneksi.php';

$iduser = $_POST['iduser'];
$nama = $_POST['nama'];
$nilai = $_POST['nilai'];
$tglPenerimaan = $_POST['tglPenerimaan'];
$tglTempo = $_POST['tglTempo'];
$foto = $_POST['bukti'];
$keterangan = $_POST['keterangan'];

if($foto == ''){
    $namafoto = '';
} else {
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/Foto";

    $data = base64_decode($foto);
    $namafoto = uniqid() . '.png';
    
    $lokasi = "$path/Hutang/$namafoto";
    
    file_put_contents($lokasi, $data);
}
    
$insert = "INSERT INTO hutang(iduser, nama_hutang, jenis_hutang, nilai_hutang, tgl_transaksi,  bukti_transaksi, keterangan) 
VALUES('$iduser','$nama','retur','$nilai','$tglPenerimaan','$namafoto','$keterangan')";

$hasilInsert = mysqli_query($conn, $insert);
    
echo($hasilInsert) ? json_encode(array('kode'=>1,'pesan'=>'berhasil menambahkan data')) : json_encode(array('kode'=>2,'pesan'=>'Data gagal Ditambahkan'));

?>