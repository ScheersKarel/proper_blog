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

    public function addBlog() {
        $db = DB::getInstance();
        $stmt = $db->prepare("INSERT INTO `blogs`(`user_id`,`title`, `detail`) VALUES (:user_id, :title, :detail)");
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":detail", $this->detail);
        $stmt->execute();
        header("location: CRUD.php");
    }

    public static function getBlogs() {
        $db = DB::getInstance();
        $stmt = $db->prepare("SELECT * FROM `blogs` WHERE active = 1");
        $stmt->execute();
        $blogs = $stmt->fetchAll();
        return $blogs;
    }

    public static function getMyBlogs($user_id) {
        $db = DB::getInstance();
        $stmt = $db->prepare("SELECT * FROM `blogs` WHERE active = 1 AND user_id = $user_id");
        $stmt->execute();
        $blogs = $stmt->fetchAll();
        return $blogs;
    }

    public static function getSelectedBlogs($blog_id){
        
            $db = DB::getInstance();
            $stmt = $db->prepare("SELECT * FROM `blogs` WHERE active = 1 AND id = $blog_id");
            $stmt->execute();
            $blogs = $stmt->fetchAll();
            return $blogs;
        
    }
}
    /*
    
    private function add(): bool
    {
        $sql = "INSERT INTO artikels SET titel = ?, inhoud = ?";

        try
        {
            $stmt = DB::getInstance()->prepare($sql);
            $stmt->execute([$this->titel, $this->inhoud]);
            $this->id = DB::getInstance()->lastInsertId();
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            die();
        }

        return true;

    }

    private function update(): bool
    {
        if(empty($this->id))
        {
            throw new \Exception("No article selected");
        }

        $sql = "UPDATE artikels SET titel = ?, inhoud = ? WHERE id = ?";

        try
        {
            $stmt = DB::getInstance()->prepare($sql);

            $stmt->bindParam(1, $this->titel, PDO::PARAM_STR);
            $stmt->bindParam(2, $this->inhoud, PDO::PARAM_STR);
            $stmt->bindParam(3, $this->id, PDO::PARAM_INT);

            $stmt->execute();
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            die();
        }

        return true;

    }

    public static function get(): array
    {
        $stmt = DB::getInstance()->prepare("select * from artikels");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, "Article");
    }

    public function find(int $id): object
    {
        $sql = "SELECT * FROM artikels where id = ?";

        try
        {
            $stmt = DB::getInstance()->prepare($sql);
            $stmt->execute([$id]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if(!empty($result))
            {
                $this->id = $result['id'];
                $this->titel = $result['titel'];
                $this->inhoud = $result['inhoud'];
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            die();
        }

        return $this;
    }

    public function delete(): bool
    {
        $sql = "DELETE FROM artikels where id = ?";

        try
        {
            if(empty($this->id))
            {
                throw new \Exception("No article selected");
            }

            $stmt = DB::getInstance()->prepare($sql);
            $stmt->execute([$this->id]);
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            die();
        }

        return true;
    }
}
*/