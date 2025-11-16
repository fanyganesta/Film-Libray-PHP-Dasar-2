<?php 
    require 'controller.php';
    (isset($_GET['id'])) ? 
    $result = ubahGetData($_GET['id']) : 
    header("Location: index.php?error=Pilih film yang akan dirubah!");

    (isset($_POST['ubahData'])) ?
    ubahData($_POST, $_FILES['file']) : null;
?>

<!DOCTYPE html>
<html> 
<head> 
    <title> Ubah Data </title>
</head>
<body> 

    <h3> Ubah data dari, <?= $result['namaFilm']; ?> </h3>
    <a href="index.php"> Kembali ke halaman utama </a>
    <br>
    <br>
    <br>
    
    <form method="POST" action="" enctype="multipart/form-data"> 
        <input type="hidden" name="id" value="<?= $result['id'] ?>">
        <input type="hidden" name="oldImg" value="<?= $result['img'] ?>">

        <table> 
            <tr> 
                <td colspan="2" style="text-align: center;"> 
                    <?php if(!isset($result['img'])) : ?>
                        <img src="broken-img">
                        <p style="font-style:italic"> (Gambar belum ditambah) </p>
                    <?php else : ?>
                        <img src="img/<?= $result['img']?>" alt="Gambar film" width="100">
                    <?php endif ?>
                </td> 
            </tr>
            <tr> 
                <td> <label for="namaFilm"> Nama Film: </label> </td>
                <td> <input type="text" name="namaFilm" id="namaFilm" value="<?= $result['namaFilm']; ?>" size="25"> </td>
            </tr>
            <tr>
                <td> <label for="deskripsiSingkat"> Deskripsi Singkat: </label> </td>
                <td> <textarea type="textarea" name="deskripsiSingkat" id="deskripsiSingkat" cols="26" rows="6" ><?= $result['deskripsiSingkat']?></textarea></td>
            </tr>
            <tr> 
                <td> <label for="tahunTerbit"> Tahun Terbit: </label> </td>
                <td> <input type="text" name="tahunTerbit" id="tahunTerbit" size="25" value="<?= $result['tahunTerbit']; ?>"> </td>
            </tr>   
            <tr> 
                <td> <label for="rating"> Rating: </label> </td>
                <td> <input type="text" name="rating" id="rating" size="25" value="<?= $result['rating']?>"> </td>
            </tr>
            <tr>
                <td> <label for="file"> Upload File: </label> </td>
                <td> <input type="file" name="file" id="file"> </td>
            </tr>
            <tr> 
                <td colspan="2" style="text-align:center; padding-top: 7px"> 
                    <button type="submit" name="ubahData"> Ubah Data </button>
                </td>
            </tr>
        </table>
    </form>

</body>
</html>