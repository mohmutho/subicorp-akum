<?php
require_once 'Koneksi.php';

$idUser  = $_POST['iduser'];
$tglTransaksi  = $_POST['tglTransaksi'];
$namaCustomer  = $_POST['namaCustomer'];
$jenisBarang  = $_POST['jenisBarang'];
$namaBarang  = $_POST['namaBarang'];
$jumlahBarang  = $_POST['jumlahBarang'];
$satuan  = $_POST['satuan'];
$hargaSatuan  = $_POST['hargaSatuan'];
$diskonPembelian  = $_POST['diskonPembelian'];
$totalNilaiBarang  = $_POST['totalNilaiBarang'];
$biayaLain  = $_POST['biayaLain'];
$ketBiayaLain  = $_POST['ketBiayaLain'];
$totalNilaiTransaksi  = $_POST['totalNilaiTransaksi'];
$jenisPembayaran  = $_POST['jenisPembayaran'];
$buktiBayar  = $_POST['buktiBayar'];
$cash  = $_POST['cash'];
$kredit  = $_POST['kredit'];

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/Foto";
 
$data = base64_decode($buktiBayar);
$bukti = uniqid() . '.png';
$lokasi = "$path/Penjualan/$bukti";

file_put_contents($lokasi, $data);

$insert = "INSERT INTO penjualan(iduser, penjualanke, nama_barang, jenis_barang, satuan, jumlah, diskon, harga_diskon, harga_barang, harga_lainnya, total_harga, 
harga_pokok_penjualan,tanggal_penjualan, notes_harga_lainnya, created_date, jenis_pembayaran, bukti_penjualan, total_cash, total_credit) 
VALUES('$idUser','$namaCustomer','$namaBarang','$jenisBarang','$satuan','$jumlahBarang','$diskonPembelian','$diskonPembelian',
'$hargaSatuan','$biayaLain','$totalNilaiTransaksi','$totalNilaiBarang','$tglTransaksi','$ketBiayaLain',now(),'$jenisPembayaran','$bukti','$cash','$kredit') ";

$hasilInsert = mysqli_query($conn, $insert);
    
echo($hasilInsert) ? json_encode(array('kode'=>1,'pesan'=>'berhasil menambahkan data')) : json_encode(array('kode'=>2,'pesan'=>'Data gagal Ditambahkan'));

?>