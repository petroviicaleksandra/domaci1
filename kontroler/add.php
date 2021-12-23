<?php

require "../dbBroker.php";
require "../model/karte.php";

if(isset($_POST['user']) && isset($_POST['film']) 
&& isset($_POST['email'])){
    $prijava = new Karte(null,$_POST['user'],$_POST['film'],$_POST['email'] );
    $status = Karte::add($prijava, $conn);

    if($status){
        echo 'Success';
    }else{
        echo $status;
        echo "Failed";
    }
}


?>