<?php 
    session_start();
    session_destroy();
    if(isset($_SESSION['username'])){
        session_destroy();
        header("Location: login.php?message=Anda berhasil logout");
    } else {
        header("Location: login.php?error=Anda belum login");
    }



?>