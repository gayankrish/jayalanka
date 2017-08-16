<?php
$code = Url::getParam('code');

if (!empty($code)) {
  $objUser = new User();
  $user = $objUser->getUserByHash($code);

  if (!empty($user)) {
    if ($user['active'] == 0) {
      if ($objUser->makeActive($user['id'])) {
        $msg  = "<div class=\"text-center\"><h1>Thank you</h1>";
        $msg .= "<p>Your account has now been successfully activated.<br />";
      } else {
        $msg =  "<div class=\"text-center\"><h1>Activation failed</h1>";
        $msg .= "<p>There has been a problem activating your acount.<br />";
        $msg .= "Please contact administrattor.</p></div>";
      }
    } else {
      $msg =  "<div class=\"text-center\"><h1>Account already activated</h1><br />";
      $msg .= "<p>This account is already active.<br /></p>";
      $msg .= "<p>Please login or use <a href=\"/?page=forgotpass\">Forgot Password</a> page if you don't remember your password.</p></div>";
    }
  } else {
    Helper::redirect("/?page=error");
  }

  require_once('_header.php');
  echo '<div class="container-fluid">';
  require_once('_leftsidebar.php');
  echo '<div class="col-lg-8 col-md-8 col-xs-8">';
  echo $msg;
  echo '</div>';
  require_once('_rightsidebar.php');
  echo '</div>';
  require_once('_footer.php');
} else {
    Helper::redirect("/?page=error");
}
 ?>
