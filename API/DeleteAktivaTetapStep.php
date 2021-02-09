<?php
require_once 'Koneksi.php';

$id  = $_POST['id'];

$query = "DELETE FROM activa_tetap WHERE id='$id' ";
    
$hasilInsert = mysqli_query($conn, $query);
    
echo($hasilInsert) ? json_encode(array('kode'=>1,'pesan'=>'berhasil hapus data')) : json_encode(array('kode'=>0,'pesan'=>'Data gagal dihapus'));

?>