<?php   require_once('_header.php');

$topicid = Url::getParam('topic');
$objForum = new Forum();
$topic = $objForum->getTopic($topicid);

?>
<div class="container-fluid">
<?php   require_once('_leftsidebar.php'); ?>
    <div class="col-lg-8 col-md-8 col-xs-8">
      <div  id="msg-area">
        <input type="hidden" id="fadeout" value="<?= SITE_URL.'/?page=forum&topic='.$topicid; ?>">
      <h1>Message Posted</h1>
      <p>Your message posted successfully.</p>
      <p id="timoutmsg"><i>This page will be redirected to <?= $topic['topic'];?> page in <span id="timeoutval">5</span> second(s).</i></p>
    </div>
    </div>
<?php   require_once('_rightsidebar.php'); ?>
</div>

<?php   require_once('_footer.php'); ?>
