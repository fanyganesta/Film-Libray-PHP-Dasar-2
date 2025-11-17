<?php 
    require 'controller.php';
    checkLogin('username');

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
    
    <!-- Tambah fitur tambah data -->
    <a href="tambah.php"> Tambah data</a>
    <p style="display: inline"> | </p>
    <a href="logout.php"> Logout </a>
    <br>
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
            <th> Gambar </th>
            <th> Action </th>
        </tr>

        <!-- Tampilkan data dari database menggunakan foreach -->
        <?php foreach( $datas as $key => $value ) : ?>
            <tr> 
                <td> <?= $key + 1  ?> </td>
                <?php if(isset($value['img'])) : ?>
                    <td> <img src="img/<?= $value['img']; ?>" alt="Gambar film <?= $key + 1; ?>" width=100> </td>
                <?php else : ?>
                    <td> <p style="font-style: italic"> (Gambar belum ditambah) </p> </td>
                <?php endif ?>
                <td> <?= $value['namaFilm'] ?> </td>
                <td class="tdExclude"> <?= $value['deskripsiSingkat'] ?> </td>
                <td> <?= $value['tahunTerbit'] ?> </td>
                <td> <?= $value['rating'] ?> </td>
                <td> 
                    <a href="ubah.php?id=<?= $value['id']; ?>"> Ubah</a>
                    <p style="display:inline"> | </p>
                    <a href="hapus.php?id=<?= $value['id']; ?>" onclick="return confirm('Apakah yakin untuk menghapus data ini?')"> Hapus</a> 
                </td>
            </tr>
        <?php endforeach ?>

        <!-- Tampilkan navigasi jika halaman lebih dari 1 -->
         <?php if( $totalHalaman > 1 && !isset($_POST['cariButton'])) : ?>
            <tr> 
                <td colspan="7">
                    <!-- Hilangkan tombol ketika user di halaman pertama -->
                    <?php if( $halamanAktif > 1) : ?>
                        <a href="index.php?halaman=<?= $halamanAktif - 1 ?> ">&laquo;</a>
                    <?php endif ?>

                    <!-- Ulangi sesuai halaman total -->
                    <?php for( $j = 1; $j <= $totalHalaman; $j++ ) : ?>
                        <?php if( $j != $halamanAktif ) : ?>
                            <a href="index.php?halaman=<?= $j; ?>"><?= $j; ?></a>
                        <?php else : ?>
                            <p style="font-weight: bold; color: red; display: inline"> <?=$j?> </p>
                        <?php endif ?>
                    <?php endfor ?>

                    <!-- Hilangkan tombol ketika user di halaman terakhir -->
                    <?php if( $halamanAktif < $totalHalaman ) : ?>
                        <a href="index.php?halaman=<?= $halamanAktif + 1 ?>">&raquo;</a>
                    <?php endif ?>
                </td>
            </tr>
        <?php endif ?>

    </table>
</body>
</html>