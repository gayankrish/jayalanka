<?php
  require_once('_header.php');

  $objClassified = new Classified();
  $objForm = new Form();
  //$requestType = 'blank';
   Url::getAll();
  $params = Url::$_params;
  //$requestType = $objForum->getRequestType($params);

  !empty($params['topic']) ? $itemId = $params['topic'] : $itemId = '';
  isset($params['id']) ? $adId = $params['id'] : $adId = '';
  $ad_type = $params['type'];

?>
<div class="container-fluid">
<?php   require_once('_leftsidebar.php'); ?>
    <div class="col-lg-8 col-md-8 col-xs-8">
      <!-- <h2 class="page-header">LankaLife Forum</h2> -->
      <?php
      if (Url::getParam('newad') != null && Url::getParam('newad') == 1) {
        echo '<div class="new-post-notification text-center">Your message posted!</div><br />';
      }
      ?>

      <?php

        $adTypes = $objClassified->getAdType();


        if (!empty($adTypes) && empty($adId)) {

          if (empty($itemId)) {
            echo '<h2 class="page-header">Classifieds<p class="text-right">'.
                  (!isset($_SESSION[Login::$_login_front])?'<a href="#" data-toggle="modal" data-target="#login-modal">Log in</a> to add new classified</p></h2>':
                                                          '<a href="/?page=newad" class="btn btn-lg btn-primary">New Classified</a></p></h2>');
          } else {
            $item = $objClassified->getAdItem($itemId);
            echo '<h2 class="page-header"><a href="/?page=classifieds&type=1&view=all" class="forum_header_home">Classifieds</a> : '.$item['topic'].'<p class="text-right">'.
                  (!isset($_SESSION[Login::$_login_front])?'<a href="#" data-toggle="modal" data-target="#login-modal">Log in</a> to add new classified</p></h2>':
                                                          '<a href="/?page=newad&topic='.$item['id'].'" class="btn btn-lg btn-primary">New Classified</a></p></h2>');
          }

          echo '<ul class="nav nav-tabs">';
              
              foreach ($adTypes as $adType) {


                if ($adType['id'] == $ad_type) {
                  echo '<li class="active"><a href="'.Url::getShortUrl('type').'&type='.$adType['id'].'" data>'.$adType['type'].'</a></li>';
                } else {
                  echo '<li><a href="'.Url::getShortUrl('type').'&type='.$adType['id'].'">'.$adType['type'].'</a></li>';
                }
                
              }

          echo '</ul><br />';

        }





        $html_tags = $objClassified->prepareAdsHtml($ad_type, $itemId, $adId);
/*
        echo '<pre>';
        var_dump($html_tags);
        echo '<pre>';
*/


        
        foreach ($html_tags as $tag) {
          echo $tag;
        }


      ?>



    </div>
<?php  require_once('_rightsidebar.php'); ?>
</div>

<?php   require_once('_footer.php'); ?>
