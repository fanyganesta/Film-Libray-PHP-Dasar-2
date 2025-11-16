<?php 
    require 'controller.php';
    // Cek apakah user membuka halaman hapus secara langsung
    (isset($_GET['id'])) ? hapusData($_GET['id']) :
    header("Location: index.php?error=Pilih data yang akan dihapus!");

    // Buat proses penghapusan data
    function hapusData($request){
        global $db;
        $query = "DELETE FROM datafilm WHERE id = '$request'";
        mysqli_query($db, $query);
        header("Location: index.php?message=Data berhasil dihapus!");
        exit;
    }

?> 