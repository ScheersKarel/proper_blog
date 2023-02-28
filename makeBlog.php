<?php

declare(strict_types=1);
session_start();
include "./functions/database.php";
include "./functions/helpers.php";

if (empty($_SESSION["id"])) {
    header("location: login.php");
}

$connection = dbConnect(
    user: "root",
    pass: "",
    db: "blog",
);

$id = $_SESSION["id"];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = htmlspecialchars($_POST["title"], ENT_QUOTES);
    $detail = htmlspecialchars($_POST["detail"], ENT_QUOTES);
    $errorcounter = 0;
    if (isset($_POST['Add'])) {
        if (empty($title)) {
            echo "title is empty";
            $errorcounter++;
        }
        if (empty($detail)) {
            echo "detail is empty";
            $errorcounter++;
        }
        if ($errorcounter == 0) {
            createBlog($connection, $id, $title, $detail);
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
    <title>Document</title>
</head>

<body>
    <form method="post">
        <table>
            <tr>
                <td><label>title blog</label></td>
                <td><input type="text" name="title" id="title"> </td>
            </tr>
            <tr>
                <td><label>detail</label></td>
                <td>
                    <textarea id="detail" name="detail" rows="4" cols="50">

                </textarea>
                </td>
            </tr>
            <td> <input type="submit" name="Add" value="Add" /></td>
            </tr>
        </table>
    </form>
</body>

</html>