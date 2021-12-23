<?php

class Filmovi{
    public $filmId;   
    public $naziv;   
    public $trajanje;   
    public $zanr;   
    public $datum;
    
    public function __construct($filmId=null, $naziv=null, $trajanje=null, $zanr=null, $datum=null)
    {
        $this->filmId = $filmId;
        $this->naziv = $naziv;
        $this->trajanje = $trajanje;
        $this->zanr = $zanr;
        $this->datum = $datum;
    }


    public static function getAll(mysqli $conn)
    {
        $query = "SELECT * FROM film";
        $filmovi = $conn->query($query);
        return $filmovi;
    }


    public static function getById($filmId, mysqli $conn){
        $query = "SELECT * FROM film WHERE filmId=$filmId";

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
        $query = "DELETE FROM film WHERE filmId=$this->filmId";
        return $conn->query($query);
    }

    public function update($filmId, mysqli $conn)
    {
        $query = "UPDATE film set naziv = $this->naziv,trajanje = $this->trajanje,zanr = $this->zanr,datum = $this->datum WHERE filmId=$filmId";
        return $conn->query($query);
    }

    public static function add(Filmovi $Filmovi, mysqli $conn)
    {
        $query = "INSERT INTO film(naziv, trajanje, zanr, datum) VALUES('$Filmovi->naziv','$Filmovi->trajanje','$Filmovi->zanr','$Filmovi->datum')";
        return $conn->query($query);
    }
}

?>