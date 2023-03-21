<?php
session_start();
include "./functions/database.php";

$connection = dbConnect(
    user: "ID211210_ksblog",
    pass: "1234abcd",
    db: "ID211210_ksblog",
);



$errorcount = 0;
$emailError = "";
$wachtwoordError = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars($_POST["email"], ENT_QUOTES);
    $password = htmlspecialchars($_POST["password"], ENT_QUOTES);


    $userPassword = $connection->prepare("SELECT password FROM `user` WHERE email = :email");
    $userPassword->bindParam(":email", $email);
    $userPassword->execute();

    $userID = $connection->prepare("SELECT id FROM `user` WHERE email = :email");
    $userID->bindParam(":email", $email);
    $userID->execute();

    $res = $userPassword->fetch();
    $id = $userID->fetch();

    if (isset($_POST['login'])) {

        if (empty($email)) {
            $emailError = "email is leeg";
            $errorcount++;
        }

        if (empty($password)) {
            $wachtwoordError = "wachtwoord is leeg";
            $errorcount++;
        }
        if (!empty($res)) {
            if (password_verify($password, $res[0])) {
                $_SESSION["id"] = $id[0];
                header("location: CRUD.php");
            } else {
                $emailError = "email and/or wachtwoord are incorrect";
            }
        } else {
            $emailError =  "email bestaat niet";
        }
    }
    if (isset($_POST['registreer'])) {
        header("location: registreer.php");
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
                <td colspan="2"> <input type="submit" name="login" value="login"></td>
            </tr>
            <tr>
                <td colspan="2"> <input type="submit" name="registreer" value="registreer"></td>
            </tr>

        </table>
    </form>
</body>

</html>