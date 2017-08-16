<?php

require_once('_header.php');

$objForm = new Form();
$objForum = new Forum();
$topicid = 0;
$search_query = '';


if ($objForm->isPost('search-box')) {
	$search_query = $objForm->getPost('search-box');
	if ($objForm->isPost('topic')) {
		$topicid = $objForm->getPost('topic');
	} 
} elseif ($_GET) {
	$search_query = Url::getParam('search-box');
}

?>


<div class="container-fluid">
<?php   require_once('_leftsidebar.php'); ?>
    <div class="col-lg-8 col-md-8 col-xs-8">

      <?php
        $html_tags = array();
      	$html_tags = $objForum->prepareForumSearchHtml($search_query, $topicid);
      	//echo $html_tags;
        foreach ($html_tags as $tag) {
          echo $tag;
        }
      	/*echo '<pre>';
      	var_dump($html_tags);
      	echo '<br />';
      	var_dump($_SERVER);
      	echo '</pre>';
		*/
      ?>



    </div>
<?php  require_once('_rightsidebar.php'); ?>
</div>

<?php   require_once('_footer.php'); ?>