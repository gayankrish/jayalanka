<?php
require_once('../include/autoload.php');

$objUser = new User();

if ( Session::is_session_started() === FALSE ) session_start();

    if($_POST['username']!="" && $_POST['password']!="") {
        extract($_POST);
        $username = $_POST['username'];
        $pass = $_POST['password'];

        if($objUser->isUser($username, $pass)) {
          Login::doLogin($objUser->_id);
          echo 1;
        } else {
          echo 0;
        }
    } else {
      echo 'Username: '.$_POST['username']." : Pass: ".$_POST['password'];
    }
?>
