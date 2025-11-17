<?php 
    session_start();
    session_destroy();
    setcookie('id', '', time()-3600);
    setcookie('key', '', time()-3600);
    
    if(isset($_SESSION['username'])){
        session_destroy();
        header("Location: login.php?message=Anda berhasil logout");
    } else {
        header("Location: login.php?error=Anda belum login");
    }



?>