<?php
require_once('../include/autoload.php');

$objHotel = new Hotel();


    if($_POST['display_name']!="") {
        extract($_POST);

        $hotel = $_POST;

        $result = $objHotel->addHotel($hotel);
/*         $username = $_POST['username'];
        $pass = $_POST['password']; */



/*         if($objUser->isUser($username, $pass)) {
          Login::doLogin($objUser->_id);
          echo 1;
        } else {
          echo 0;
        }
    } else {
      echo 'Username: '.$_POST['username']." : Pass: ".$_POST['password'];
    } */
    var_dump($result);
    }
?>