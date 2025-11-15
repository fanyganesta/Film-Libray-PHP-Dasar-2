<?php 

    require 'controller.php';

    // Jadikan proses untuk kebutuhan halaman ini di dalam controller.php
    
    $result = index($_POST) ?? false;
    if ($result != false ){
        $datas = $result['datas'];
        $totalHalaman = $result['totalHalaman'];
        $halamanAktif = $result['halamanAktif'];
    }

    // Jadikan proses untuk fitur pencarian di dalam controller.php
    if( isset( $_POST['cariButton'] )){
        $datas = cariData($_POST);
    }
?>

<!DOCTYPE html>
<html>
<head>

    <title> Film Library </title>
    <link rel="stylesheet" href="css-index.css">

</head>
<body>

    <!-- Beri pemberitahuan berhasil/error proses -->
    <?php if( isset( $_GET['message'] )) : ?>
        <p class="message"> <?= $_GET['message']; ?> </p>
    <?php elseif( isset( $_GET['error'] )) : ?>
        <p class="error"> <?= $_GET['error']; ?> </p>
    <?php endif ?>

    <h3> Selamat datang </h3>
    <br>

    <!-- Tambah fitur pencarian data -->
    <form method="POST" action="">
        <label for="cariData"> Cari Film: </label> <input type="text" id="cariData" name="cariData" value="<?php $key = $datas[0]['key'] ?? null; echo $key;?>">
        <button type="submit" name="cariButton"> Cari </button>
    </form>
    <br>

    <!-- Buat Tabel List Film -->
    <table>
        <tr>
            <th> No </th>
            <th> Judul Film </th>
            <th> Deskripsi Singkat </th>
            <th> Tahun Terbit </th>
            <th> Rating (imdb) </th>
        </tr>

        <!-- Tampilkan data dari database menggunakan foreach -->
        <?php foreach( $datas as $key => $value ) : ?>
            <tr> 
                <td> <?= $key + 1  ?> </td>
                <td> <?= $value['namaFilm'] ?> </td>
                <td class="tdExclude"> <?= $value['deskripsiSingkat'] ?> </td>
                <td> <?= $value['tahunTerbit'] ?> </td>
                <td> <?= $value['rating'] ?> </td>
            </tr>
        <?php endforeach ?>

        <!-- Tampilkan navigasi jika halaman lebih dari 1 -->
         <?php if( $totalHalaman > 1 && !isset($_POST['cariButton'])) : ?>
            <tr> 
                <td colspan="5">
                    <!-- Hilangkan tombol ketika user di halaman pertama -->
                    <?php if( $halamanAktif > 1) : ?>
                        <a href="index.php?halaman=<?= $halamanAktif - 1 ?> "> &laquo; </a>
                    <?php endif ?>

                    <!-- Ulangi sesuai halaman total -->
                    <?php for( $j = 1; $j <= $totalHalaman; $j++ ) : ?>
                        <?php if( $j != $halamanAktif ) : ?>
                            <a href="index.php?halaman=<?= $j; ?>"> <?= $j; ?> </a>
                        <?php else : ?>
                            <p style="font-weight: bold; color: red; display: inline"> <?=$j?> </p>
                        <?php endif ?>
                    <?php endfor ?>

                    <!-- Hilangkan tombol ketika user di halaman terakhir -->
                    <?php if( $halamanAktif < $totalHalaman ) : ?>
                        <a href="index.php?halaman=<?= $halamanAktif + 1 ?>"> &raquo; </a>
                    <?php endif ?>
                </td>
            </tr>
        <?php endif ?>

    </table>
</body>
</html>