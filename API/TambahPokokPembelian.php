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
$lokasi = "$path/Pembelian/$bukti";

file_put_contents($lokasi, $data);


$insert = "INSERT INTO pembelian(iduser, pembelian_dari, nama_barang, jenis_barang, satuan, jumlah, diskon, harga_diskon, harga_barang, harga_lainnya, total_harga,
tanggal_pembelian, tipe_pembayaran, notes_harga_lainnya, date, bukti_pembelian, total_cash, total_credit)
VALUES('$idUser','$namaCustomer','$namaBarang','$jenisBarang','$satuan','$jumlahBarang','$diskonPembelian','$diskonPembelian','$hargaSatuan',
'$biayaLain','$totalNilaiTransaksi','$tglTransaksi','$jenisPembayaran','$ketBiayaLain',now(),'$bukti','$cash','$kredit') ";

$hasilInsert = mysqli_query($conn, $insert);
    
echo($hasilInsert) ? json_encode(array('kode'=>1,'pesan'=>'berhasil menambahkan data')) : json_encode(array('kode'=>2,'pesan'=>'Data gagal Ditambahkan'));

?>