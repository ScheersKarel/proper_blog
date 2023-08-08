<?php 
session_start();
include "components/includes.php";
$connection = dbConnect();
$errorcount = 0;


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
            $_SESSION["emailError"] = "email is leeg";
            $errorcount++;
        }

        if (empty($password)) {
            $_SESSION["WachtwoordError"] = "wachtwoord is leeg";
            $errorcount++;
            header("location: login.php");
        }
        if (!empty($res)) {
            if (password_verify($password, $res[0])) {
                $_SESSION["id"] = $id[0];
                header("location: CRUD.php");
            } 
            
            else {
                $_SESSION["emailError"] = "email of wachtwoord zijn incorrect";
                header("location: login.php");
            }
        } 
        
        else {
            $_SESSION["emailError"] =  "email bestaat niet";
            header("location: login.php");
        }
    }
    if (isset($_POST['registreer'])) {
        header("location: registreer.php");
    }
}