<?php

    function getAllBlogs(PDO $connection):array
    {
       $blog = $connection->query("SELECT * FROM blogs WHERE active = 1")-> fetchAll();

        return $blog;
    }

    function getMyBlogs(PDO $connection, $id):array
    {
       $blog = $connection->query("SELECT * FROM blogs WHERE active = 1 AND user_id = $id")-> fetchAll();

        return $blog; 
    }
    function getSelectedBlogs(PDO $connection, $id):array
    {
       $blog = $connection->query("SELECT * FROM blogs WHERE active = 1 AND id = $id")-> fetchAll();

        return $blog;
    }

    function likeBlog(PDO $connection, string $blog_id, string $user_id): void
    {
    try{
        $userliked = $connection->query("SELECT user_id FROM `user_like_blog` WHERE blog_id = $blog_id")->fetch();
        if($user_id == $userliked[0]){
            echo "you already liked this post";
        }
        
    }
    catch (Exception $e) {
        echo "";
    }
        
        if($user_id != $userliked[0]){
            $getLikes = $connection->query("SELECT likes FROM `blogs` WHERE id = $blog_id");
            $likes = $getLikes->fetch();
    
            $newLikes = $likes[0]+1;
            $connection->query("INSERT INTO `user_like_blog` ( `blog_id`, `user_id`, `likes`) VALUES ($blog_id,$user_id,$newLikes)");
            
            $setlikes = $connection->prepare("UPDATE `blogs` SET `likes`=:likes WHERE id = :id ");
            $setlikes->bindParam(":likes", $newLikes);
            $setlikes->bindParam(":id", $blog_id);
            $setlikes->execute();
            header("location: detail.php");
        }
           
        
        
        
    }
    

    function deleteBlog(PDO $connection , string $id):void
    {
        $update = $connection->prepare("UPDATE `blogs` SET `active`='0' WHERE id = :id ");
        $update->bindParam(":id", $id);
        $update->execute();
        header("Location: CRUD.php");
        exit();
    }

    function updateBlog(PDO $connection, string $id ): void
    {
        $settitle= $connection->prepare("UPDATE `blogs` SET `title`=:title WHERE id = $id ");
        $settitle->bindParam(":title", htmlspecialchars($_POST["title"], ENT_QUOTES));
        $settitle->execute();
  
         $setdetail = $connection->prepare("UPDATE `blogs` SET `detail`=:detail WHERE id = $id");
         $setdetail->bindParam(":detail", htmlspecialchars($_POST["detail"], ENT_QUOTES));
         $setdetail->execute();
          header("Location: CRUD.php");
    }

    function createBlog(PDO $connection, int $id, string $title,string $detail):void
    {
        $update = $connection->prepare("INSERT INTO `blogs`(`user_id`,`title`, `detail`) VALUES (:id, :title, :detail)");
        $update->bindParam(":id", $id);
        $update->bindParam(":title", $title);
        $update->bindParam(":detail", $detail);
        $update->execute();
        header("location: CRUD.php");
    }

    function registreer(PDO $connection, string $first_name, string $last_name, string $email, string $ww):void
    {
        $update = $connection->prepare("INSERT INTO `user`(`first_name`, `last_name`, `email`, `password`) VALUES (:first_name, :last_name, :email, :ww)");
        $update->bindParam(":first_name", $first_name);
        $update->bindParam(":last_name", $last_name);
        $update->bindParam(":email", $email);
        $update->bindParam(":ww", $ww);
        $update->execute();
        header("location: login.php");
    }