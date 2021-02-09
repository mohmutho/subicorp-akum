<?php
require_once 'Koneksi.php';

$idhutang  = $_POST['idhutang'];
$nama  = $_POST['nama'];
$nilai = $_POST['nilai'];
$tgltrans = $_POST['tgltrans'];
$tgljatuh = $_POST['tgljatuh'];
$keterangan = $_POST['keterangan'];
$status = "";
$hitung = 0;

$tahun_tanggal_jatuh_tempo = date('Y', strtotime($tgljatuh));
$bulan_tanggal_jatuh_tempo = date('m', strtotime($tgljatuh));
$tanggal_tanggal_jatuh_tempo = date('d', strtotime($tgljatuh));
$tahun_tanggal_transaksi = date('Y', strtotime($tgltrans));
$bulan_tanggal_transaksi = date('m', strtotime($tgltrans));
$tanggal_tanggal_transaksi = date('d', strtotime($tgltrans));

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
    
$update = "UPDATE hutang 
SET nama_hutang='$nama', nilai_hutang='$nilai', tgl_transaksi='$tgltrans', tgl_jatuh_tempo='$tgljatuh', keterangan='$keterangan', status='$status'
WHERE id='$idhutang'";

$hasilUpdate = mysqli_query($conn, $update);

echo($hasilUpdate) ? json_encode(array('kode'=>1,'pesan'=>'berhasil menambahkan data')) : json_encode(array('kode'=>0,'pesan'=>'Data gagal Ditambahkan'));

?>