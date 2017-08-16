<?php

 require_once('_header.php'); ?>




 <div class="container-fluid">
<?php   require_once('_leftsidebar.php'); ?>
    <div class="col-lg-8 col-md-8 col-xs-8">
      <!-- <h2 class="page-header">LankaLife Forum</h2> -->


      <?php

        echo Helper::getEscape();
/*
      echo '<pre>';
      var_dump($info);
      echo '</pre>';
*/
        //echo file_get_contents('http://google.com');

      ?>



    </div>
<?php  require_once('_rightsidebar.php'); ?>
</div>




<?php require_once('_footer.php');



/*
if(isset($_POST['submit'])) {

  $upload_dir = IMG_ROOT.'/test/';
  $errors = array();
  $img_count = 0;
  foreach ($_FILES['img_files']['tmp_name'] as $key => $img) {
    $filename = $_FILES['img_files']['name'][$key];
    $filetype = $_FILES['img_files']['type'][$key];
    $filesize = $_FILES['img_files']['size'][$key];
    $file_tmp = $_FILES['img_files']['tmp_name'][$key];


    if (is_dir($upload_dir)) {
      if ($filetype == 'image/jpeg' || $filetype == 'image/png' || $filetype == 'image/bmp') {
        //move_uploaded_file($file_tmp, $upload_dir.$filename);
        $img_count++;
        if($filename == '3.jpg'){
          unset($_FILES['img_files']['name'][$key]);
          unset($_FILES['img_files']['type'][$key]);
          unset($_FILES['img_files']['size'][$key]);
          unset($_FILES['img_files']['tmp_name'][$key]);
          unset($_FILES['img_files']['errors'][$key]);
        }
      } else {
        $errors[] = 'File: '.$filename.' is not a valid image file.';
      }
    }
  }
}

require_once('_header.php');
echo '<div class="container-fluid">';
  echo '<div class="row">';
    require_once('_leftsidebar.php');

?>
  <div class="col-lg-8">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
        <input type="file" class="form-control" name="img_files[]" accept=".jpg,.png,.jpeg,.bmp" multiple>
      </div>
        <input type="submit" name="submit">

      </form>
      <?php 
        echo '<pre>';
        var_dump($_FILES);
        echo '</pre>';
      ?>

  </div>

<?php
    require_once('_rightsidebar.php');
  echo '</div>';
echo '</div>';




////////////////////////////////////////////////////////


      if($num_rows > 0) {
        try {
          $pages = new Paginator($num_rows,9,array(15,3,6,9,12,25,50,100,250,'All'));

            $html_search[] = '<h2 class="page-header">Search results for "'.$qry.'"</h2>';
            $html_search[] = '<div class="row">';
            $html_search[] = '<div class="col-lg-8">'.$pages->display_pages().'</div>';
            $html_search[] = '<div class="col-lg-4 text-right"><span class="">'.$pages->display_jump_menu().$pages->display_items_per_page().'</span></div>';
            $html_search[] = '</div><br />'; // row
            $html_search[] = '<div class="row search-results">';
            $results = getPagedSearchResults($qry, $pages->limit_start, $pages->limit_end);

            foreach ($results as $result) {
              $objUser = new User();
              $post_user = $objUser->getUser($result['userid']);

              $html_search[] = '<div class="row topic">';

                $html_search[] = '<div class="col-lg-6 topic-col">';
                  $html_search[] = '<span class="topic-title"><a href="/?page=forum&id='.$result['id'].'">'.Helper::shortenString($result['title']).'</a></span>';
                  $html_search[] = '<p>'.Helper::shortenString($result['message']).'</p>';
                  $html_search[] = '<span id="postedby">by <a href="/?page=profile&id='.$post_user['userid'].'">'.$post_user['username'].'</a> - <time class="timeago" datetime="'.$result['created_on'].'"></time></span>';
                $html_search[] = '</div>';  // col-lg-6
              $html_search[] = '</div>';  // row 
            }
            $html_search[] = '</div><br />'; // search-results          

*/

////////////////////////////////////////////////////////

$var = 5;

echo 'variable is: '.($var != 0 ? 'not 0 and it\'s '.$var:'0');

?>
