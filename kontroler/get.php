<?php

require "../dbBroker.php";
require "../model/karte.php";

if(isset($_POST['brojKarte'])){
    $myArray = Karte::getById($_POST['brojKarte'], $conn);
    echo json_encode($myArray);
}

?>