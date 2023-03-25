<?php

include "./functions/database.php";
include "./functions/helpers.php";
include "classes/DB.php";
include "classes/Blog.php";
include "classes/User_like_blog.php";

$connection = dbConnect();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['delete'])) {
        $id = $_POST["id"];
        deleteBlog($connection, $id);
    }

    if (isset($_POST['update'])) {
        $_SESSION["blog_id"] = $_POST["id"];
        header("location: updateBlog.php");
    }
   
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
           $blog = new Blog($user_id, $_POST["title"], $_POST["detail"]);
           $blog->addBlog();
        }
    }
   
}