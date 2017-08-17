<?php
require_once('../include/autoload.php');

$objHotel = new Hotel();


    if($_POST['display_name']!="") {
        extract($_POST);

        $hotel = $_POST;

        $result = $objHotel->addHotel($hotel);

        echo $result;
    }
?>