<?php
session_start();
include "./functions/database.php";
include "./functions/helpers.php";
include "classes/DB.php";
include "classes/User.php";



$connection = dbConnect(
    user: "ID211210_ksblog",
    pass: "1234abcd",
    db: "ID211210_ksblog",
);


$voornaamError = "";
$achternaamError = "";
$emailError = "";
$wachtwoordError = "";
$hWachtwoordError = "";
$errorcount = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $first_name = htmlspecialchars($_POST["first_name"], ENT_QUOTES);
    $last_name = htmlspecialchars($_POST["last_name"], ENT_QUOTES);
    $email = htmlspecialchars($_POST["email"], ENT_QUOTES);
    $password = htmlspecialchars($_POST["password"], ENT_QUOTES);
    $hPassword = htmlspecialchars($_POST["h_password"], ENT_QUOTES);


    if (isset($_POST['registreer'])) {
        if (empty($first_name)) {
            $voornaamError = "voornaam is leeg";
            $errorcount++;
        }
        if (empty($last_name)) {
            $achternaamError = "achternaam is leeg";
            $errorcount++;
        }
        if (empty($email)) {
            $emailError = "email is leeg";
            $errorcount++;
        }
        $emailFromDB = $connection->prepare("SELECT * FROM user WHERE email=:email");
        $emailFromDB->bindParam(":email", $email);
        $emailFromDB->execute();
        $user = $emailFromDB->fetch();
        if ($user) {
            $emailError = "email bestaat al";
            $errorcount++;
        }

        if (empty($password)) {
            $wachtwoordError = "wachtwoord is leeg";
            $errorcount++;
        }
        if (empty($hPassword)) {
            $hWachtwoordError = "herhaal wachtwoord is leeg";
            $errorcount++;
        }
        if ($password != $hPassword) {
            $hWachtwoordError = "wachtwoorden komen niet overeen";
            $errorcount++;
        } else {
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $_SESSION["password"] = $password;
        }
        if ($errorcount == 0) {
            $user = new User($first_name, $last_name, $email, $password);
            $user -> addUser();
            
        }
    }
}

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
    <form method="post">
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