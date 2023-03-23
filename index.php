<?php
declare(strict_types = 1);

include "components/includes.php";

session_start();

$connection = dbConnect();

$blog = Blog::getBlogs();
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css" type="text/css">
    <title>home</title>
</head>
<body>
    <div class="container">
        <nav>
        <?php include "components/nav.html"; ?>

        </nav>
       
        <?php foreach($blog as $blog): ?>
          

            <form action="formActions.php" method="post">
                <div>
                    <input type="hidden" name="id" value=" <?= $blog['id']; ?>">
                        <button type="submit" name="detail" >
                        <h2> <?php echo $blog["title"]; ?></h2>
                        </button>
                
                        
                </div>
            </form>
           
        <?php endforeach; ?>
    </div>
</body>
</html>