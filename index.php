<?php 

    require 'controller.php';

    // Buat default query untuk menampilkan seluruh data film
    $limit = 5;

    // Ganti index berdasarkan halaman
    if( isset($_GET['halaman']) < 1){
        $halamanAktif = 1;
    } else {
        $halamanAktif = $_GET['halaman'] ?? 1;
    }
    $index = $halamanAktif * $limit - $limit;

    $queryAllFilms = "SELECT * FROM datafilm LIMIT $index, $limit";
    $datas = query( $queryAllFilms );

    // Hitung halaman total
    $countAllFilms = query('SELECT * FROM datafilm');
    $totalHalaman = ceil(count( $countAllFilms ) / $limit );
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
         <?php if( $totalHalaman > 1 ) : ?>
            <tr> 
                <td colspan="5">
                    <!-- Hilangkan tombol ketika user di halaman pertama -->
                    <?php if( $halamanAktif > 1) : ?>
                        <a href="?halaman=<?= $halamanAktif - 1 ?> "> &laquo; </a>
                    <?php endif ?>

                    <!-- Ulangi sesuai halaman total -->
                    <?php for( $j = 1; $j <= $totalHalaman; $j++ ) : ?>
                        <?php if( $j != $halamanAktif ) : ?>
                            <a href="?halaman=<?= $j; ?>"> <?= $j; ?> </a>
                        <?php else : ?>
                            <p style="font-weight: bold; color: red; display: inline"> <?=$j?> </p>
                        <?php endif ?>
                    <?php endfor ?>

                    <!-- Hilangkan tombol ketika user di halaman terakhir -->
                    <?php if( $halamanAktif < $totalHalaman ) : ?>
                        <a href="?halaman=<?= $halamanAktif + 1 ?>"> &raquo; </a>
                    <?php endif ?>
                </td>
            </tr>
        <?php endif ?>

    </table>
</body>
</html>