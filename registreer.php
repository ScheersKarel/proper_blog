<?php
session_start();
include "components/includes.php";
$connection = dbConnect();

$voornaamError = $_SESSION["voornaamError"];
$achternaamError = $_SESSION["achternaamError"];
$emailError = $_SESSION["emailError"];
$wachtwoordError = $_SESSION["wachtwoordError"];
$hWachtwoordError = $_SESSION["hWachtwoordError"];

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
    <form action="registreerCheck.php" method="post">
        <table>
            <tr>
                <td> <label>voornaam</label></td>
                <td> <input type="text" name="first_name"></td>
                <td class="error"><?= $voornaamError ?></td>
            </tr>
            <tr>
                <td> <label>achternaam</label></td>
                <td> <input type="text" name="last_name"></td>
                <td class="error"><?= $achternaamError ?></td>
            </tr>
            <tr>
                <td> <label>email</label></td>
                <td> <input type="text" name="email"></td>
                <td class="error"><?= $emailError ?></td>
            </tr>
            <tr>
                <td> <label>wachtwoord</label></td>
                <td> <input type="password" name="password"></td>
                <td class="error"><?= $wachtwoordError ?></td>
            </tr>
            <tr>
                <td> <label>herhaal wachtwoord</label></td>
                <td> <input type="password" name="h_password"></td>
                <td class="error"><?= $hWachtwoordError ?></td>
            </tr>
            <tr>
                <td colspan="2"> <input type="submit" name="registreer" value="registreer"></td>
            </tr>

        </table>
    </form>
</body>

</html>