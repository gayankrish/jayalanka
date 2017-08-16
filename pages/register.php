<?php

if(Login::isLogged(Login::$_login_front)) {
  Helper::redirect(Login::$_dashboard_front);
}

$objForm = new Form();
$objValid = new Validation($objForm);
$objUser = new User();

// Registration Form
  if ($objForm->isPost('first_name')) {
    $objValid->_expected = array(
            'first_name',
            'last_name',
            'email',
            'username',
            'password',
            'password_confirmation',
            'address_1',
            'address_2',
            'city',
            'province',
            'post_code',
            'country',
            'contact'
          );

    $objValid->_required = array(
            'first_name',
            'last_name',
            'email',
            'username',
            'password',
            'password_confirmation',
            'address_1',
            'city',
            'province',
            'post_code',
            'country',
            'contact'
          );

    $objValid->_special = array(
            'email' => 'email'
    );

    $objValid->_post_remove = array(
            'password_confirmation'
    );

    $objValid->_post_format = array(
            'password' => 'password'
    );

    // Validate password
    $pass_1 = $objForm->getPost('password');
    $pass_2 = $objForm->getPost('password_confirmation');

    if (!empty($pass_1) && !empty($pass_2) && $pass_1 != $pass_2) {
      $objValid->addToErrors('password_mismatch');
    }


    $email = $objForm->getPost('email');
    $user = $objUser->getByEmail($email);

    if (!empty($user)) {
      $objValid->addToErrors('email_duplicated');
    }

    $username = $objForm->getPost('username');
    $user = $objUser->getByUsername($username);

    if (!empty($user)) {
      $objValid->addToErrors('username_exists');
    }

    if ($objValid->isValid()){

      // add hash for activating account
      $objValid->_post['hash'] = Helper::generateHash();
      // add registration date
      $objValid->_post['date'] = Helper::setDate();

      //add default user group
      $objValid->_post['user_group'] = 3;


      if ($objUser->addUser($objValid->_post, $objForm->getPost('password'))) {
        Helper::redirect('/?page=registered');
      } else {
        Helper::redirect('/?page=registered-failed');
      }
    }
  }



include_once('_header.php');
?>

<div class="container-fluid">
<div class="row">
<?php   require_once('_leftsidebar.php'); ?>
<div id="main-content" class="col-md-8 col-lg-8">
<div class="col-md-6 col-lg-6"> <!--     Register - Start            -->
  <form action="" method="post">
    <h2 class="form-signin-heading">Register</h2><hr>

    <div class="row">
      <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
          <label for="first_name" class="sr-only">First Name*</label>
          <input type="text" name="first_name" id="first_name" class="form-control input-md" placeholder="First Name*" value="<?= $objForm->stickyText('first_name') ?>" required>
        </div>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
          <label for="last_name" class="sr-only">Last Name*</label>
          <input type="text" name="last_name" id="last_name" class="form-control input-md" placeholder="Last Name*" value="<?= $objForm->stickyText('last_name') ?>" required>
        </div>
      </div>
    </div>

    <div class="form-group">
      <?= $objValid->validate('email_duplicated'); ?>
      <label for="email" class="sr-only">Email Address*</label>
      <input type="email" name="email" id="email" class="form-control input-md" placeholder="Email Address*" value="<?= $objForm->stickyText('email') ?>" required>
    </div>

    <div class="form-group">
      <?= $objValid->validate('username_exists'); ?>
      <label for="username" class="sr-only">Email Address*</label>
      <input type="text" name="username" id="username" class="form-control input-md" placeholder="User Name*" value="<?= $objForm->stickyText('username') ?>" required>
    </div>

    <div class="row">
      <?= $objValid->validate('password_mismatch'); ?>
      <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">

          <label for="password" class="sr-only">Password*</label>
          <input type="password" name="password" id="password" class="form-control input-md" placeholder="Password*" required>
        </div>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
          <label for="password_confirmation" class="sr-only">Confirm Password*</label>
          <input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-md" placeholder="Confirm Password*" required>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="address_1" class="sr-only">Address Line 1*</label>
      <input type="text" name="address_1" id="address_1" class="form-control input-md" placeholder="Address Line 1*" value="<?= $objForm->stickyText('address_1') ?>" required>
    </div>
    <div class="form-group">
      <label for="address_2" class="sr-only">Address Line 2</label>
      <input type="text" name="address_2" id="address_2" class="form-control input-md" placeholder="Address Line 2" value="<?= $objForm->stickyText('address_2') ?>">
    </div>
    <div class="row">
      <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
          <label for="city" class="sr-only">City*</label>
          <input type="text" name="city" id="city" class="form-control input-md" placeholder="City*" value="<?= $objForm->stickyText('city') ?>" required>
        </div>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
          <label for="province" class="sr-only">Provice*</label>
          <input type="text" name="province" id="province" class="form-control input-md" placeholder="Province*" value="<?= $objForm->stickyText('province') ?>" required>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
          <label for="post_code" class="sr-only">Post Code*</label>
          <input type="text" name="post_code" id="post_code" class="form-control input-md" placeholder="Post Code*" value="<?= $objForm->stickyText('post_code') ?>" required>
        </div>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
          <?= $objForm->getCountriesSelect(204);?>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="contact" class="sr-only">Contact No.*</label>
      <input type="text" name="contact" id="contact" class="form-control input-md" placeholder="Contact No.* e.g. +94 1234 12345" value="<?= $objForm->stickyText('contact') ?>" required>
    </div>
    <input class="btn btn-lg btn-info btn-block" type="submit" value="Register"/>
  </form>
</div> <!--     Register - End            -->
</div>
<?php   require_once('_rightsidebar.php'); ?>
</div>
</div>

<?php   require_once('_footer.php'); ?>
