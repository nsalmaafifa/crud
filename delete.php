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
$query = "DELETE FROM task WHERE id='$id' ";

// 4. Jalankan query
$sql = mysqli_query($con,$query);
mysqli_close($con);

if ($sql){
    echo "data berhasil dihapus";
    header("Refresh:0; url=index.php");
}else{
    echo "gagal hapus ".mysqli_error($con);
}
    
?>