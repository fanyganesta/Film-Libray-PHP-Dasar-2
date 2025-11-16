<?php 


?>


<!DOCTYPE html>
<html> 
<head> 
    <title> Login User </title>
</head>
<body> 

    <?php if(isset($_GET['message'])) : ?>
        <p style="color: green; font-style:italic"> <?= $_GET['message']; ?></p>
    <?php endif ?>

    <h3> Selamat datang, silahkan login dahulu </h3>
    <a href="register.php"> Registrasi User </a>
    <br> <br>

    <form method="POST" action="" autocomplete="off">
        <table> 
            <tr>
                <td> <label for="username"> Username:</label> </td>
                <td> <input id="username" name="username" type="text" required></td>
            </tr>
            <tr>
                <td> <label for="password"> Password:</label> </td>
                <td> <input type="password" name="password" id="password" required> </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center; padding-top: 7px">
                    <button type="submit" name="login"> Login </button>
                </td>
            </tr>
        </table>
    </form>

</body>
</html>