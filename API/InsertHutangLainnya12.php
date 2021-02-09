<?php
require_once 'Koneksi.php';

$idUser  = $_POST['idUser'];
$nama  = $_POST['nama'];
$nilai = $_POST['nilai'];
$tanggal_trans = $_POST['tanggal_trans'];
$tanggal_jatuh = $_POST['tanggal_jatuh'];
$foto = $_POST['foto'];
$keterangan = $_POST['keterangan'];
$status = "";
$hitung = 0;

if($foto == ''){
    $namafoto = '';
} else {
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/upload";

    $data = base64_decode($foto);;
    $namafoto = uniqid() . '.png';
    
    $lokasi = "$path/hutang_lain_bukti/$namafoto";
    
    file_put_contents($lokasi, $data);
}

$tahun_tanggal_jatuh_tempo = date('Y', strtotime($tanggal_jatuh));
$bulan_tanggal_jatuh_tempo = date('m', strtotime($tanggal_jatuh));
$tanggal_tanggal_jatuh_tempo = date('d', strtotime($tanggal_jatuh));
$tahun_tanggal_transaksi = date('Y', strtotime($tanggal_trans));
$bulan_tanggal_transaksi = date('m', strtotime($tanggal_trans));
$tanggal_tanggal_transaksi = date('d', strtotime($tanggal_trans));

if ($tanggal_tanggal_transaksi>=15) {
    $hitung = 1+($tahun_tanggal_jatuh_tempo-$tahun_tanggal_transaksi)*12;
    $hitung += $bulan_tanggal_jatuh_tempo-$bulan_tanggal_transaksi;
} else {
    $hitung = ($tahun_tanggal_jatuh_tempo-$tahun_tanggal_transaksi)*12;
    $hitung += $bulan_tanggal_jatuh_tempo-$bulan_tanggal_transaksi;
}

if($hitung < 12){
    $status = "Jangka Pendek";
} else if($hitung >= 12){
    $status = "Jangka Panjang";
}
    
$insert = "INSERT INTO hutang(iduser, nama_hutang, jenis_hutang, nilai_hutang, tgl_transaksi, tgl_jatuh_tempo, bukti_transaksi, keterangan, status) 
VALUES('$idUser','$nama', 'lainnya', '$nilai','$tanggal_trans','$tanggal_jatuh','$namafoto','$keterangan','$status')";

$hasilInsert = mysqli_query($conn, $insert);
    
echo($hasilInsert) ? json_encode(array('kode'=>1,'pesan'=>'berhasil menambahkan data')) : json_encode(array('kode'=>2,'pesan'=>'Data gagal Ditambahkan'));

?>