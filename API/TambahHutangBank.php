<?php
require_once 'Koneksi.php';

$iduser = $_POST['iduser'];
$nama = $_POST['nama'];
$nilai = $_POST['nilai'];
$tglPenerimaan = $_POST['tglPenerimaan'];
$tglTempo = $_POST['tglTempo'];
$foto = $_POST['bukti'];

if($foto == ''){
    $namafoto = '';
} else {
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/upload";

    $data = base64_decode($foto);;
    $namafoto = uniqid() . '.png';
    
    $lokasi = "$path/bayar_hutang/$namafoto";
    
    file_put_contents($lokasi, $data);
}
    
$insert = "INSERT INTO hutang(iduser, nama_hutang, jenis_hutang, nilai_hutang, tgl_transaksi, tgl_jatuh_tempo, bukti_transaksi) 
VALUES('$iduser','$nama', 'bank','$nilai','$tglPenerimaan','$tglTempo','$namafoto')";

$hasilInsert = mysqli_query($conn, $insert);
    
echo($hasilInsert) ? json_encode(array('kode'=>1,'pesan'=>'berhasil menambahkan data')) : json_encode(array('kode'=>2,'pesan'=>'Data gagal Ditambahkan'));

?>