<?php
require_once 'Koneksi.php';


$nama  = $_POST['nama'];
$user  = $_POST['username'];
$email = $_POST['email'];
$pass  = $_POST['password'];
$jenis = $_POST['jenis'];
    
$query = "INSERT INTO user(nama,username,email,password, jenis_usaha) VALUES('$nama','$user','$email','$pass', '$jenis')";
    
$hasil = mysqli_query($conn, $query);
    
echo($hasil) ? json_encode(array('kode'=>1,'pesan'=>'berhasil menambahkan data')) : json_encode(array('kode'=>2,'pesan'=>'Data gagal Ditambahkan'));



?>