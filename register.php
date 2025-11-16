<?php 
    require 'controller.php';
    isset($_POST['register']) ? registerUser($_POST) : null;




?>

<!DOCTYPE html>
<html> 
<head> 
    <title> User Registration </title>
</head>
<body> 
    <?php if(isset($_GET['error'])) : ?>
        <p style="color: red; font-style:italic"> <?= $_GET['error'] ?> </p>
    <?php endif ?>

    <h3> Selamat datang, silahkan mendaftar</h3>

    <a href="login.php"> Halaman login </a>
    <br> <br>

    <form method="POST" action="" autocomplete="off">
        <table> 
            <tr>
                <td> <label for="username"> Username:</label> </td>
                <td> <input id="username" name="username" type="text" required> </td>
            </tr>
            <tr>
                <td> <label for="password"> Password:</label> </td>
                <td> <input type="password" id="password" name="password" required> </td>
            </tr>
            <tr> 
                <td> <label for="passwordKonfirmasi" required> Konfirmasi Password:</label> </td>
                <td> <input type="password" id="passwordKonfirmasi" name="passwordKonfirmasi"></td>
            </tr>
            <tr> 
                <td colspan="2" style="padding-top: 7px; text-align: center">
                    <button type="submit" name="register"> Daftar</button>
                </td>
            </tr>
        </table>
    </form>

</body>
</html>