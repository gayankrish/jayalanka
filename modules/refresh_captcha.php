<?php
require_once('../include/autoload.php');

	$prev_id = $_POST['id'];

      $objCaptcha = new Captcha();
      $objCaptcha->deleteCaptcha($prev_id);
      $captchaid = $objCaptcha->generateCaptcha();

      echo $captchaid;

?>