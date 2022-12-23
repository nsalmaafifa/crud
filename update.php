<?php

// Tangkap id dari method GET
$id = $_GET['id'];

// Buat koneksi dengan MySQL
$con = mysqli_connect("localhost","root","","todolist");

// 2. Cek Koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi Gagal:";
    exit();
}else{
    echo "Koneksi Berhasil";
}

// 3. Buat query select semua todo list
$query = "UPDATE task SET status=1 WHERE id='$id' ";

// 4. Jalankan query
$sql = mysqli_query($con,$query);
mysqli_close($con);

if ($sql){
    echo "data berhasil diupdate";
    header("Refresh:0; url=index.php");
}else{
    echo "gagal update ".mysqli_error($con);
}
    
?>