<?php
class Blog {
    public $id;
    public $user_id;
    public $title;
    public $detail;

    public function __construct($user_id, $title, $detail) {
        $this->user_id = $user_id;
        $this->title = $title;
        $this->detail = $detail;
    }

    public function addBlog() : void{
        $db = DB::getInstance();
        $stmt = $db->prepare("INSERT INTO `blogs`(`user_id`,`title`, `detail`) VALUES (:user_id, :title, :detail)");
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":detail", $this->detail);
        $stmt->execute();
        header("location: CRUD.php");
    }

    public static function getBlogs(): array {
        $db = DB::getInstance();
        $stmt = $db->prepare("SELECT * FROM `blogs` WHERE active = 1");
        $stmt->execute();
        $blogs = $stmt->fetchAll();
        return $blogs;
    }

    public static function getMyBlogs($user_id): array  {
        $db = DB::getInstance();
        $stmt = $db->prepare("SELECT * FROM `blogs` WHERE active = 1 AND user_id = $user_id");
        $stmt->execute();
        $blogs = $stmt->fetchAll();
        return $blogs;
    }

    public static function getSelectedBlogs($blog_id): array {
        
            $db = DB::getInstance();
            $stmt = $db->prepare("SELECT * FROM `blogs` WHERE active = 1 AND id = $blog_id");
            $stmt->execute();
            $blogs = $stmt->fetchAll();
            return $blogs;
        
    }
}