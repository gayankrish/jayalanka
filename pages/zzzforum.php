<?php
  require_once('_header.php');

  $objForum = new Forum();
  $objForm = new Form();
  $requestType = 'blank';
   Url::getAll();
  $params = Url::$_params;
  $requestType = $objForum->getRequestType($params);

  !empty($params['topic']) ? $topicId = $params['topic'] : $topicId = '';
  isset($params['id']) ? $postid = $params['id'] : $postid = '';

  if ($objForm->isPost('btn-comment')) {

    $reCaptchaResp = Captcha::verify();
    if ($reCaptchaResp['success'] == 1) {

      $comment = array();
      $comment['comment'] = $objForm->getPost('post-comment');
      $comment['userid'] = $_SESSION[Login::$_login_front];
      $comment['post_id'] = $postid;
      $comment['created_on'] = Helper::setDate();

      $objForum->addComment($comment);
    }
    

  } elseif ($objForm->isPost('btn-reply')) {
    $reply = array();
    $reply['comment_id'] = $objForm->getPost('comment_id');
    $reply['userid'] = $_SESSION[Login::$_login_front];
    $reply['reply'] = $objForm->getPost('reply');
    $reply['created_on'] = Helper::setDate();

    $objForum->addReply($reply);

  }





?>
<div class="container-fluid">
<?php   require_once('_leftsidebar.php'); ?>
    <div class="col-lg-8 col-md-8 col-xs-8">
      <!-- <h2 class="page-header">LankaLife Forum</h2> -->
      <?php
      if (Url::getParam('newpost') != null && Url::getParam('newpost') == 1) {
        echo '<div class="new-post-notification text-center">Your message posted!</div><br />';
      }
      ?>

      <?php
        //$html_tags = array();
        $html_tags = $objForum->prepareForumHtml($requestType, $topicId, $postid);
        if (isset($html_tags)) {
          foreach ($html_tags as $tag) {
            echo $tag;
          }
        } else {
          echo 'No data received.';
        }


      ?>



    </div>
<?php  require_once('_rightsidebar.php'); ?>
</div>

<?php   require_once('_footer.php'); ?>
