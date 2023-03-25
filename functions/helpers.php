<?php

    function likeBlog(PDO $connection, string $blog_id, string $user_id): void
    {
    try{
        $userliked = $connection->prepare("SELECT user_id FROM `user_like_blog` WHERE blog_id = :blog_id ")->fetch();
        $userliked->bindparam(":blog_id", $blog_id);
        if($user_id == $userliked[0]){
            echo "you already liked this post";
        }
        
    }
    catch (Exception $e) {
        echo "";
    }
        
        if($user_id != $userliked[0]){
            $getLikes = $connection->prepare("SELECT likes FROM `blogs` WHERE id = :blog_id");
            $getLikes->bindparam(":blog_id", $blog_id);
            $likes = $getLikes->fetch();
    
            $newLikes = $likes[0]+1;
            $writeUserLikeBlog =  $connection->prepare("INSERT INTO `user_like_blog` ( `blog_id`, `user_id`, `likes`) VALUES (:blog_id, :user_id,$newLikes)");
            $writeUserLikeBlog->bindparam(":blog_id", $blog_id);
            $writeUserLikeBlog->bindparam(":user_id", $user_id);

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

    function updateBlog(PDO $connection, string $blog_id ): void
    {
        $settitle= $connection->prepare("UPDATE `blogs` SET `title`=:title WHERE id = :id ");
        $settitle->bindParam(":title", htmlspecialchars($_POST["title"], ENT_QUOTES));
        $settitle->bindParam(":id", $blog_id );
        $settitle->execute();
  
         $setdetail = $connection->prepare("UPDATE `blogs` SET `detail`=:detail WHERE id = :id");
         $setdetail->bindParam(":detail", htmlspecialchars($_POST["detail"], ENT_QUOTES));
         $settitle->bindParam(":id", $blog_id );
         $setdetail->execute();
          header("Location: CRUD.php");
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