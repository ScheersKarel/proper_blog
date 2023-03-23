<?php 
session_start();
include "components/includes.php";
$connection = dbConnect();

$errorcount = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $first_name = htmlspecialchars($_POST["first_name"], ENT_QUOTES);
    $last_name = htmlspecialchars($_POST["last_name"], ENT_QUOTES);
    $email = htmlspecialchars($_POST["email"], ENT_QUOTES);
    $password = htmlspecialchars($_POST["password"], ENT_QUOTES);
    $hPassword = htmlspecialchars($_POST["h_password"], ENT_QUOTES);


    if (isset($_POST['registreer'])) {
        if (empty($first_name)) {
            $_SESSION["voornaamError"] = "voornaam is leeg";
            $errorcount++;
        }
        else{
            $_SESSION["voornaamError"] = "";
        }
        if (empty($last_name)) {
            $_SESSION["achternaamError"]= "achternaam is leeg";
            $errorcount++;
        }
        else{
            $_SESSION["achternaamError"] = "";
        }
        if (empty($email)) {
            $_SESSION["emailError"] = "email is leeg";
            $errorcount++;
        }
        else{
            $_SESSION["emailError"] = "";
        }
        $emailFromDB = $connection->prepare("SELECT * FROM user WHERE email=:email");
        $emailFromDB->bindParam(":email", $email);
        $emailFromDB->execute();
        $user = $emailFromDB->fetch();
        if ($user) {
            $_SESSION["emailError"]= "email bestaat al";
            $errorcount++;
        }

        if (empty($password)) {
            $_SESSION["wachtwoordError"]  = "wachtwoord is leeg";
            $errorcount++;
        }
        else{
            $_SESSION["wachtwoordError"] = "";
        }
        if (empty($hPassword)) {
            $_SESSION["hWachtwoordError"] = "herhaal wachtwoord is leeg";
            $errorcount++;
        }
        else{
            $_SESSION["hWachtwoordError"] = "";
        }
        if ($password != $hPassword) {
            $_SESSION["hWachtwoordError"] = "wachtwoorden komen niet overeen";
            $errorcount++;
        } else {
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $_SESSION["password"] = $password;
        }
        if ($errorcount == 0) {
            $user = new User($first_name, $last_name, $email, $password);
            $user -> addUser();
            header("location: login.php");
            
        }
        else{
            header("location: registreer.php");
        }
    }
}