<?php

class Karte{
    public $brojKarte;   
    public $userId;   
    public $filmId;   
    public $email;   
    
    
    public function __construct($brojKarte=null, $userId=null, $filmId=null, $email=null)
    {
        $this->brojKarte = $brojKarte;
        $this->userId = $userId;
        $this->filmId = $filmId;
        $this->email = $email;
    }


    public static function getAll(mysqli $conn)
    {
        $query = "SELECT * FROM karta";
        $Karte = $conn->query($query);
        return $Karte;
    }


    public static function getById($brojKarte, mysqli $conn){
        $query = "SELECT * FROM karta WHERE brojKarte=$brojKarte";

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
        $query = "DELETE FROM karta WHERE brojKarte=$this->brojKarte";
        return $conn->query($query);
    }

    public function update($brojKarte, mysqli $conn)
    {
        $query = "UPDATE karta set userId = $this->userId,filmId = $this->filmId,email = $this->email WHERE brojKarte=$brojKarte";
        return $conn->query($query);
    }

    public static function update1($userId=1, $filmId=1, $email='admin@gmail.com', $brojKarte, mysqli $conn)
{
        $query = "UPDATE karta set userId='$userId', filmId='$filmId', email='$email' where brojKarte=$brojKarte";
        return $conn->query($query);
}

    public static function add(Karte $karte, mysqli $conn)
    {
        $query = "INSERT INTO karta(userId, filmId, email) VALUES('$karte->userId','$karte->filmId','$karte->email')";
        return mysqli_query($conn, $query);
    }

}

?>