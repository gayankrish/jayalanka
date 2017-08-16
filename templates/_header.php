<?php

  $objBusiness = new Business();
  $business = $objBusiness->getBusiness();
  $objCountry = new Country();
  $country = $objCountry->getCountryById($business['country_id']);

  if (Login::isLogged(Login::$_login_front)) {
    $objMenu = new Menu();
    $parentmenuitems = $objMenu->getParents();
    //$menulinks = $objMenu->getLinks();



    $objUser = new User();
  }

  $objForm = new Form();
  $objValid = new Validation($objForm);

// Login Form
/* 
if ($objForm->isPost('login')) {
  if ($objUser->isUser($objForm->getPost('username'), $objForm->getPost('password'))) {

    Login::doLogin($objUser->_id);
  } else {
    $objValid ->addToErrors('login');
  }
}
 */

// Logout

if ($objForm->isPost('btn-logout')) {
  Login::logout(Login::$_login_front);
}


?>
<!DOCTYPE html>
<html>
<head>
  <title><?= $business['name']; ?></title>
  <base href="http://localhost/jayalanka/">


  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <meta name="MobileOptimized" content="width">
  <meta name="HandheldFriendly" content="true">
  
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/main.css">

  <!-- Latest compiled and minified CSS -->
   <link rel="stylesheet" href="css/bootstrap-select.min.css"> 
   <!-- Star rating CSS -->
  <link href="css/jquery.rateyo.min.css" media="all" rel="stylesheet" type="text/css" />




  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!-- Latest compiled and minified JavaScript -->
  <script src="js/bootstrap-select.min.js"></script>
  <!--   <script src="/js/bootstrap.filestyle.js"></script> -->
  <script src="js/jquery.validate.min.js"></script>
  <!-- Star rating -->
  <script src="js/jquery.rateyo.min.js" type="text/javascript"></script>
<!-- 
  <script src="js/jquery.timeago.js" type="text/javascript"></script>
  <script src="js/moment.min.js" type="text/javascript"></script> -->
<!--   <script src="js/bs-photogallery.js"></script> -->
 <!--    <script src="js/photo-gallery.js"></script>  --> 
  <!-- <script src='https://www.google.com/recaptcha/api.js'  async defer></script> navbar-default  navbar-fixed-top -->

</head>
<body>
  <div class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a href="/?page=index" class="navbar-brand"><?= $business['name']; ?></a>
      </div>

      <div class="navbar-collapse collapse" id="navbar">
      <?php if (Login::isLogged(Login::$_login_front)) { ?>
      <ul class="nav navbar-nav">
        <?php
          if (!empty($parentmenuitems)) {
            foreach ($parentmenuitems as $parentmenuitem) {

              if ($parentmenuitem['haschildren'] == 0) {
                echo '<li><a href="'.$parentmenuitem['short_name'].'">'.$parentmenuitem['description'].'</a></li>';
              } else {
                $childmenuitems = $objMenu->getChildrenByParentId($parentmenuitem['id']);
                if (!empty($childmenuitems)) {
                  echo '<li class="dropdown">';
                  echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$parentmenuitem['description'].' <span class="caret"></span></a>';
                  echo '<ul class="dropdown-menu">';
                  foreach ($childmenuitems as $childmenuitem) {
                    echo '<li><a href="'.SITE_URL.'/?page='.$childmenuitem['short_name'].'">'.$childmenuitem['description'].'</a></li>';
                  }
                  echo '</ul>';
                  echo '</li>';
                }

              }
            }
          }


        ?>
        </ul>
        <!-- User Name and Logout Button - Start -->
   <?php } ?>      
        <ul class="nav navbar-nav navbar-right">
    
            <?php
            
              if (Login::isLogged(Login::$_login_front)) {
                echo '<li><p class="navbar-text" id="signed-in-as"><a href="'.SITE_URL.'/?page=user&id='.$_SESSION['cid'].'" title="View profile">'.$objUser->getFirstName(Session::getSession(Login::$_login_front)).'</a></li>';
                //echo '<li><p class="navbar-btn"><a href="/?page=logout&refer="'.$currentpage.' class="btn btn-default">Logout<a/></p><li>';
                echo '<li><form action="" class="navbar-form" method="post"><button type="submit" class="btn btn-default" id="btn-logout" name="btn-logout">Logout</button></form><li>';

              }
            ?>
        <!-- User Name and Logout Button - End -->
        </ul>

    </div>
 
  </div>
</div>


