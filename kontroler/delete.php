<?php

require "../dbBroker.php";
require "../model/karte.php";

if(isset($_POST['brojKarte'])){
    $obj = new Karte($_POST['brojKarte']);
    $status = $obj->deleteById($conn);
    if ($status){
        echo "Success";
    }else{
        echo "Failed";
    }
}

?>