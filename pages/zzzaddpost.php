<?php
  require_once('_header.php');


  $topicid = Url::getParam('topic');

  /*
  $objCategories = new Menu();
  //$parentCategories = $objCategories->getAllParents();
  $cat_forum = $objCategories->getParentMenuItem(3);
  $tbl_subcat = $cat_forum['children_tbl'];
  $forum_topics = $objCategories->getChildren($tbl_subcat);
  */
  $objForum = new Forum();
  $objForm = new Form();
  $objValid = new Validation($objForm);

  $forum_topics = $objForum->getAllTopics();

  if ($objForm->isPost('submit')) {
    $objValid->_expected = array(
              'userid',
              'topic',
              'title',
              'message',
              'img_url'
              );

    $objValid->_required = array(
              'topic',
              'title',
              'message'
              );



    if ($objValid->isValid()){

      // add hash for activating account
      //$objValid->_post['hash'] = mt_rand().date('YmdHis').mt_rand();
      // add registration date
    //  $objValid->_post['created_on'] = Helper::setDate();

      $topic_tmp = $objForum->getTopic($objValid->_post['topic']);


      $upload_dir = FORUM_IMG_PATH.'/'.$topic_tmp['img_folder'].'/';
      $errors = array();
      $img_count = 0;
      if (isset($_FILES)) {
        foreach ($_FILES['img_files']['tmp_name'] as $key => $img) {
          $filename = $_FILES['img_files']['name'][$key];
          $filetype = $_FILES['img_files']['type'][$key];
          $filesize = $_FILES['img_files']['size'][$key];
          $file_tmp = $_FILES['img_files']['tmp_name'][$key];


          if (is_dir($upload_dir)) {
            if ($filetype == 'image/jpeg' || $filetype == 'image/png' || $filetype == 'image/bmp') {
              $img_count++;
            } else {
              $errors[] = 'File: '.$filename.' is not a valid image file.';
              unset($_FILES['img_files']['name'][$key]);
              unset($_FILES['img_files']['type'][$key]);
              unset($_FILES['img_files']['size'][$key]);
              unset($_FILES['img_files']['tmp_name'][$key]);
              unset($_FILES['img_files']['errors'][$key]);
           }
          }
        }
      }

      $objValid->_post['no_of_images'] = $img_count;


      $postid = $objForum->addNewPost($objValid->_post);

      $img_count = 0;

      if ($postid > 0) {

        if (isset($_FILES)) {

          foreach ($_FILES['img_files']['tmp_name'] as $key => $img) {
            $img_count++;
            $fileinfo = pathinfo($_FILES['img_files']['name'][$key]);
            $file_ext = $fileinfo['extension'];
            $file_tmp = $_FILES['img_files']['tmp_name'][$key];

            move_uploaded_file($file_tmp, $upload_dir.$postid.'-'.$img_count.'.'.$file_ext);
            
          }
        }

        Helper::redirect('/?page=msgposted&topic='.$topicid);
      } else {
        Helper::redirect('/?page=error');
      }

    }
  }

?>
<div class="container-fluid">
<?php   require_once('_leftsidebar.php'); ?>
<div id="main-content" class="col-md-8 col-xs-8 col-lg-8">
  <h3 class="page-header"><a href="/?page=forum&view=all" class="forum_header_home">Forum</a> : New Post</h3>
<div id="main-content" class="col-md-8 col-xs-8 col-lg-8">

<form action="" method="post" enctype="multipart/form-data">

  <input type="hidden" id="userid" name="userid" value="1">
  <?php
  echo '<pre>';
  echo 'postid: '.$postid.'<br />';
  echo 'img_count: '.$img_count.'<br />';
  var_dump($errors);
  echo '</pre>';
  echo '<pre>';
  var_dump($objValid->_post);
  echo '</pre>';
   ?>
  <div class="form-group">

    <label for="topic">Topic</label>
    <select class="form-control" id="topic" name="topic">
        <?php
          foreach ($forum_topics as $forum_topic) {
            if ($forum_topic['id'] == $topicid) {
              echo '<option  value="'.$forum_topic['id'].'" selected>'.$forum_topic['topic'].'</option>';
            } else {
              echo '<option  value="'.$forum_topic['id'].'">'.$forum_topic['topic'].'</option>';
            }
          }
        ?>
   </select>
  </div>
  <div class="form-group">

    <label for="title">Subject</label>
    <input type="text" class="form-control" id="title" name="title" placeholder="Subject" value="<?= $objForm->stickyText('title') ?>">
    <?= $objValid->validate('title'); ?>
  </div>
  <div class="form-group">

    <label for="message">Message</label>
    <textarea class="form-control" id="message" name="message" placeholder="Message" rows="7" value="<?= $objForm->stickyText('message') ?>"></textarea>
    <?= $objValid->validate('message'); ?>
  </div>
  <div class="form-group">
    <label for="img_url">File input</label>
    <!-- <input type="file" class="filestyle" data-icon="false" id="img_url" name="img_url"> -->
    <input type="file" id="img_files" name="img_files[]" accept=".jpg,.jpeg,.png" multiple>
  </div>
  <div class="g-recaptcha" data-sitekey="<?= Captcha::$sitekey ?>"></div><br />
  <button type="submit" class="btn btn-info" name="submit">&nbsp;&nbsp;&nbsp;&nbsp;Post&nbsp;&nbsp;&nbsp;&nbsp;</button>
</form>
</div>
</div>
<?php   require_once('_rightsidebar.php'); ?>
</div>

<?php   require_once('_footer.php'); ?>
