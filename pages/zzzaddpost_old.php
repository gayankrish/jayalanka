<?php
  require_once('_header.php');

  $topicid = Url::getParam('topic');


  $objCategories = new Menu();
  $parentCategories = $objCategories->getAllParents();

  $objForum = new Forum();
  $objForm = new Form();
  $objValid = new Validation($objForm);

  if ($objForm->isPost('message')) {
    $objValid->_expected = array(
              'userid',
              'category',
              'sub_category',
              'title',
              'message',
              'img_url'
              );

    $objValid->_required = array(
              'category',
              'sub_category',
              'title',
              'message'
              );

    if ($objValid->isValid()){

      // add hash for activating account
      //$objValid->_post['hash'] = mt_rand().date('YmdHis').mt_rand();
      // add registration date
      $objValid->_post['created_on'] = Helper::setDate();

      if ($objForum->addNewPost($objValid->_post)) {
        Helper::redirect('/?page=msgposted');
      } else {
        Helper::redirect('/?page=error');
      }
    }
  }

?>
<div class="container-fluid">
<?php   require_once('_leftsidebar.php'); ?>
<div id="main-content" class="col-md-8 col-xs-8 col-lg-8">
<form action="" method="post">
  <?= 'topic_id = '.$topicid; ?>
  <div class="form-group">

    <label for="category">Category</label>
    <select class="form-control" id="category" name="category" disabled>
      <option>Select category...</option>
    <?php

      foreach ($parentCategories as $parentCategory) {
        if ($parentCategory['id'] == $topicid) {
          echo '<option  value="'.$parentCategory['id'].'" selected>'.$parentCategory['name'].'</option>';

        } else {
          echo '<option  value="'.$parentCategory['id'].'">'.$parentCategory['name'].'</option>';
        }
      }

     ?>
   </select>
  </div>
  <input type="hidden" id="userid" value="admin">
  <div class="form-group">

    <label for="sub_category">Sub-Category</label>
    <select class="form-control" id="sub_category" name="sub_category">

   </select>
  </div>
  <div class="form-group">

    <label for="title">Subject</label>
    <input type="text" class="form-control" id="title" name="title" placeholder="Subject" value="<?= $objForm->stickyText('title') ?>">
    <?= $objValid->validate('title'); ?>
  </div>
  <div class="form-group">

    <label for="message">Message</label>
    <textarea class="form-control" id="message" name="message" placeholder="Subject" value="<?= $objForm->stickyText('message') ?>"></textarea>
    <?= $objValid->validate('message'); ?>
  </div>
  <div class="form-group">
    <label for="img_url">File input</label>
    <!-- <input type="file" class="filestyle" data-icon="false" id="img_url" name="img_url"> -->
    <input type="file" id="img_url" name="img_url">
  </div>
  <button type="submit" class="btn btn-default">Post</button>
</form>
</div>
<?php   require_once('_rightsidebar.php'); ?>
</div>

<?php   require_once('_footer.php'); ?>
