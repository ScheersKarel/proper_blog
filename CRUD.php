<?php

declare(strict_types=1);

include "components/includes.php";

session_start();
if (empty($_SESSION["id"])) {
    header("location: login.php");
}

$blog = Blog::getMyBlogs($_SESSION["id"]);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="STYLESHEET" href="index.css" type="text/css">
    <title>home</title>
</head>

<body>
    <div class="container">
        <nav>
            <a href="makeBlog.php">Create new blog</a>
            <?php include "components/nav.html"; ?>
        </nav>
        
        <?php foreach ($blog as $blog) : ?>

            <form action="formActions.php" method="post">
                <div>
                    <input type="hidden" name="id" value=" <?= $blog['id']; ?>">

                    <h2> <?php echo $blog["title"]; ?></h2>

                    <p><?php echo $blog["detail"] ?></p>
                    

                    <button name="update">
                        update blog
                    </button>

                    <button name="delete">
                        delete blog
                    </button>



                </div>
            </form>
        <?php endforeach; ?>

    </div>

    
</body>

</html>