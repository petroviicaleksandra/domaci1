<?php

class User{
    public $id;
    public $username;
    public $password;

    public function __construct($id=null,$username=null,$password=null)
    {
        $this->id = $id;
        $this->username = $username;
        $this->$password = $password;
    }

    public static function logInUser($usr, mysqli $conn)
    {
        $query = "SELECT * FROM korisnik WHERE username='$usr->username' and password='$usr->password'";
       
        return $conn->query($query);
    }

    public static function getAll(mysqli $conn)
    {
        $query = "SELECT * FROM korisnik";
        $users = $conn->query($query);
        return $users;
    }


    public static function getById($id, mysqli $conn){
        $query = "SELECT * FROM korisnik WHERE id=$id";

        $myObj = array();
        if($msqlObj = $conn->query($query)){
            while($red = $msqlObj->fetch_array(1)){
                $myObj[]= $red;
            }
        }

        return $myObj;

    }


    public function deleteById(mysqli $conn)
    {
        $query = "DELETE FROM korisnik WHERE id=$this->id";
        return $conn->query($query);
    }

    public function update($id, mysqli $conn)
    {
        $query = "UPDATE korisnik set username = $this->username,password = $this->password WHERE id=$id";
        return $conn->query($query);
    }

    public static function add(User $users, mysqli $conn)
    {
        $query = "INSERT INTO korisnik(username, password) VALUES('$users->username','$users->password')";
        return $conn->query($query);
    }
}




?>