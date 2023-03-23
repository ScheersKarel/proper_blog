<?php
session_start();
include "components/includes.php";

$connection = dbConnect();
$emailError = $_SESSION["emailError"];
$wachtwoordError = $_SESSION["WachtwoordError"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="STYLESHEET" href="index.css" type="text/css">
    <title>Document</title>
</head>

<body>
    <form action = "checks/loginCheck.php" method="post">
        <table>
            <tr>
                <td> <label>email</label></td>
                <td> <input type="text" name="email"></td>
                <td class="error"><?= $emailError ?></td>
            </tr>
            <tr>
                <td> <label>wachtwoord</label></td>
                <td> <input type="password" name="password"></td>
                <td class="error"><?php if($wachtwoordError == "") echo "";  ?></td>
            </tr>

            <tr>
                <td colspan="2"> <input type="submit" name="login" value="login"></td>
            </tr>
            <tr>
                <td colspan="2"> <input type="submit" name="registreer" value="registreer"></td>
            </tr>

        </table>
    </form>
</body>

</html>