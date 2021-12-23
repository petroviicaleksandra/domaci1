<?php

require "../dbBroker.php";
require "../model/karte.php";

if (isset($_POST['user']) || isset($_POST['film']) || isset($_POST['email']) || isset($_POST['brojKarte'])) {
    
    $status = Karte::update1($_POST['user'], $_POST['film'], $_POST['email'], $_POST['brojKarte'], $conn);
    if ($status) {
        echo 'Success';
    } else {
        echo $status;
        echo 'Failed';
    }
}

?>