<?php

class User{

    public int $id;
    public string $first_name;
    public string $last_name;
    public string $email;
    public string $password;


    public function __construct($first_name, $last_name, $email, $password) {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->password = $password;
    }

    public function addUser() {
        $db = DB::getInstance();
        $stmt = $db->prepare("INSERT INTO `user`(`first_name`, `last_name`, `email`, `password`) VALUES (:first_name, :last_name, :email, :ww)");
        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":ww", $this->password);
        $stmt->execute();
        header("location: login.php");
    }
    
}

