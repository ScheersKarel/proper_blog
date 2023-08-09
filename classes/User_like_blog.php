<?php
class User_like_blog
{
    public int $id;
    public int $blog_id;
    public int $user_id;
    public int $likes;



    public function __construct($blog_id, $user_id)
    {
        $this->blog_id = $blog_id;
        $this->user_id = $user_id;
        $this->likes = 0;
    }

    public function like(): void
    {
        $db = DB::getInstance();
       // $userliked = $db->query("SELECT user_id FROM `user_like_blog` WHERE blog_id = $this->blog_id")->fetch();
        $userliked = $db->prepare("SELECT user_id FROM `user_like_blog` WHERE blog_id = :blogID");
        $userliked->bindParam(":blogID", $this->blog_id);
        $userliked->execute();
        $userliked = $userliked->fetch();
        
        if ($userliked !== false) {
            echo "you already liked this post";
        }

        if ($userliked === false) {
            $this->likes = 1;
            $stmt = $db->prepare("INSERT INTO `user_like_blog`(`blog_id`, `user_id`, `likes`) VALUES (:blog_id, :user_id, :like)");
            $stmt->bindParam(":blog_id", $this->blog_id);
            $stmt->bindParam(":user_id", $this->user_id);
            $stmt->bindParam(":like", $this->likes);
            $stmt->execute();

            //$getLikes = $db->query("SELECT likes FROM `blogs` WHERE id = $this->blog_id");
            $getLikes = $db->prepare("SELECT likes FROM `blogs` WHERE id = :blogID");
            $getLikes->bindParam(":blogID", $this->blog_id);
            $likes = $getLikes->fetch();

            $setlikes = $db->prepare("UPDATE `blogs` SET `likes`=:likes WHERE id = :id ");
            $newLikes = $likes[0] + 1;
            $setlikes->bindParam(":likes", $newLikes);
            $setlikes->bindParam(":id", $this->blog_id);
            $setlikes->execute();
            header("location: detail.php");
        }
    }
}
