<?php 
    require 'controller.php';

    ( isset( $_POST['tambah'] ) ) ? $result = tambah($_POST, $_FILES) : 0 ;

?>

<!DOCTYPE html>
<html>
<head>
    <title> Tambah Data </title>
</head>
<body>
    <!-- Beritahu berhasil/error hasil proses -->
    <?php if( isset($_GET['message']) ) : ?>
        <p style="color:green; font-style:italic;"> <?= $_GET['message']; ?> </p>
    <?php elseif( isset($_GET['error']) ) : ?>
        <p style="color:red; font-style:italic"> <?= $_GET['error']; ?>
    <?php endif ?>

    <h3> Tambah data baru </h3>

    <form action="" method="POST" enctype="multipart/form-data" autocomplete="off"> 
        <table> 
            <tr> 
                <td> <label for="namaFilm"> Nama Film: </label> </td>
                <td> <input type="text" id="namaFilm" name="namaFilm" required> </td>
            </tr>
            <tr>
                <td> <label for="deskripsiSingkat"> Deskripsi Singkat: </label> </td>
                <td> <input type="textarea" id="deskripsiSingkat" name="deskripsiSingkat" required> </td>
            </tr>
            <tr> 
                <td> <label for="tahunTerbit"> Tahun Terbit: </label> </td>
                <td> <input type="text" id="tahunTerbit" name="tahunTerbit" required> </td>
            </tr>
            <tr> 
                <td> <label for="rating"> Rating (Imdb): </label> </td>
                <td> <input type="text" id="rating" name="rating" required> </td>
            </tr>
            <tr>
                <td> <label for="file"> Upload File: </td>
                <td> <input type="file" name="file" id="file"> </td>
            </tr>
            <tr> 
                <td colspan="2" style="text-align: center; padding-top: 7px"> 
                    <button type="submit" name="tambah"> Tambah Data </button>
                </td>
            </tr>
        </table>
    </form> 
</body>
</html>