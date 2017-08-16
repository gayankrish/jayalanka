
<?php   
  require_once('_header.php');

  $objUser = new User();






?>
<div class="container-fluid">
<div class="row">

<?php

/* Testing

var_dump($_SESSION);
echo '<br/>';
echo '<pre>';
var_dump($objUser);
echo '</pre>';
echo '<br/>'.Login::$_login_front.'<br />';
echo 'User id: '.$_SESSION[Login::$_login_front];
 */

if (Login::isLogged(Login::$_login_front)) { ?>

<?php } else { ?>

<!-- Login window -Start -->


				<div class="login-container">
					<h1>Please sign in</h1><br>
				  <form action="" method="post" id="login_form">
            <div class="form-group">
  					       <input type="text" class="form-control" name="username" placeholder="Username">
                   <div class="error" id="username_error"></div>
            </div>
            <div class="form-group">
  					       <input type="password" class="form-control" name="password" placeholder="Password">
                   <div class="error" id="password_error"></div>
            </div>
            <div class="error" id="loginerror"></div>
  					<input type="submit" name="login" class="btn btn-primary" id="btn-login" value="Login">
				  </form>

				  <div class="login-help">
					       <a href="/?page=forgotpass">Forgot Password</a> | <a href="/?page=register">New User</a>
				  </div>
				</div>


<!-- Login window -End -->

<?php } ?>




</div>
</div>

<?php   require_once('_footer.php'); ?>
