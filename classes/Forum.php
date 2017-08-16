<?php
class Forum extends Application {

  private $_forum_table = 'forum_posts';
  private $_topics_table = 'forum_topics';
  private $_comments_table = 'comments';
  private $_replies_table = 'replies';

  public function addNewPost($strArray = null) {
    if (!empty($strArray)) {
      $this->db->prepareInsert($strArray);

      if ($this->db->insert($this->_forum_table)) {
        return $this->db->_id;
      }
      return 0;
    }
    return 0;
  }

  public function getPost($id) {
    $sql = "SELECT * FROM `{$this->_forum_table}` WHERE `id` = $id";
    $result = $this->db->fetchOne($sql);
    return $result;
  }


  public function getLatestPost($topicid = null) {
    !empty($topicid) ?
      $sql = "SELECT * FROM `{$this->_forum_table}` WHERE `topic` = {$topicid} ORDER BY `id` DESC":
      $sql = "SELECT * FROM `{$this->_forum_table}` WHERE `id` = (SELECT MAX(`id`) FROM `{$this->_forum_table}`)";
    
    $result = $this->db->fetchOne($sql);
    return $result;
  }

  public function getLatestPostWithImage() {
    $sql = "SELECT * FROM `{$this->_forum_table}` WHERE `id` = (SELECT MAX(`id`) FROM `{$this->_forum_table}` WHERE `no_of_images` != 0)";

    $result = $this->db->fetchOne($sql);
    return $result;
  }


  public function getSubPosts($mainpostid = null) {
    if (!empty($mainpostid)) {
      $sql = "SELECT * FROM `{$this->_forum_table}` WHERE `id` != {$mainpostid} AND `no_of_images` != 0 ORDER BY `id` DESC LIMIT 2";

      $result = $this->db->fetchAll($sql);
      return $result;
    }
  }


  public function getNewPostsWithoutImages() {
    $sql = "SELECT * FROM `{$this->_forum_table}` WHERE `no_of_images` = 0 ORDER BY `id` DESC LIMIT 2";

    $result = $this->db->fetchAll($sql);
    return $result;
  }


  public function getTopic($id = null) {
    if (!empty($id)) {
      $sql = "SELECT * FROM `{$this->_topics_table}` WHERE `id` = {$id}";

      $result = $this->db->fetchOne($sql);
      return $result;
    }
  }

  public function getAllTopics() {
    $sql = "SELECT * FROM `{$this->_topics_table}`";

    $result = $this->db->fetchAll($sql);
    return $result;
  }


  public function getRequestType($para) {
    $params = $para;
    if (array_key_exists('id', $params)) {
      return 'single';   //clicked on a single post
    } elseif (array_key_exists('topic', $params)) {
      return 'topic'; // clicked on a topic
    } elseif (array_key_exists('view', $params) && $params['view'] == 'all') {
      return 'home';  // Forum home
    } elseif (array_key_exists('new', $params)) {
      return 'new_post';  // Forum home
    } else {
      return 'error';
    }
  }


  public function getComments($postid = null) {
    if (!empty($postid)) {
      $sql = "SELECT * FROM `{$this->_comments_table}` WHERE `post_id` = {$postid} ORDER BY `id` DESC";
      $result = $this->db->fetchAll($sql);
      return $result;
    }
  }


  public function getReplies($cmnt_id = null) {
    if (!empty($cmnt_id)) {
      $sql = "SELECT * FROM `{$this->_replies_table}` WHERE `comment_id` = {$cmnt_id} ORDER BY `id` ASC";
      $result = $this->db->fetchAll($sql);
      return $result;
    }
  }


  public function addComment($params = null) {
    if (!empty($params)) {
      $this->db->prepareInsert($params);

      if ($this->db->insert($this->_comments_table)) {
        return true;
      }
      return false;
    }
    return false;
  }


  public function addReply($params = null) {
    if (!empty($params)) {
      $this->db->prepareInsert($params);

      if ($this->db->insert($this->_replies_table)) {
        return true;
      }
      return false;
    }
    return false;
  }


  private function getForumPostsStats($topicid = null) {
    if (!empty($topicid)) {
      $sql = "SELECT COUNT(*) FROM `{$this->_forum_table}` WHERE `topic` = {$topicid}";
      $result = $this->db->fetchOne($sql);
      return $result['COUNT(*)'];
    }

  }


  private function getForumCommentsStats($topicid = null) {
    if (!empty($topicid)) {
      $sql = "SELECT COUNT(*) FROM `{$this->_comments_table}` WHERE `post_id` IN (SELECT `id` FROM `{$this->_forum_table}` WHERE `topic` = {$topicid})";
      $result = $this->db->fetchOne($sql);
      return $result['COUNT(*)'];
    }

  }


  private function getPostCommentsStats($postid = null) {
    if (!empty($postid)) {
      $sql = "SELECT COUNT(*) FROM `{$this->_comments_table}` WHERE `post_id` = {$postid}";
      $result = $this->db->fetchOne($sql);
      return $result['COUNT(*)'];
    }

  }




  private function getLatestComment($postid = null) {
    if (!empty($postid)) {
      $sql = "SELECT * FROM `{$this->_comments_table}` WHERE `post_id` = {$postid} ORDER BY `id` DESC";
      $result = $this->db->fetchOne($sql);
      return $result;
    }    
  }


  private function getForumReplyStats($topicid = null) {
    if (!empty($topicid)) {
      $sql = "SELECT COUNT(*) FROM `{$this->_replies_table}` WHERE `comment_id` IN (SELECT `id` FROM `{$this->_comments_table}` WHERE `post_id` IN (SELECT `id` FROM `{$this->_forum_table}` WHERE `topic` = {$topicid}))";
      $result = $this->db->fetchOne($sql);
      return $result['COUNT(*)'];
    }

  }




  private function getTopicReplyStats($postid = null) {
    if (!empty($postid)) {
      $sql = "SELECT * FROM `{$this->_comments_table}` WHERE `post_id` = {$postid}";
      $comments = $this->db->fetchAll($sql);

      $replies = 0;

      $result = array();
      foreach ($comments as $comment) {
        $sql = "SELECT COUNT(*) FROM `{$this->_replies_table}` WHERE `comment_id` = {$comment['id']}";
         $result = $this->db->fetchOne($sql);

         $replies += $result['COUNT(*)'];
      }
       return $replies;
    }

  }


  private function getPagedForumPosts($topicid = 0, $start = 0, $end = 0) {

    $sql = "SELECT * FROM `{$this->_forum_table}` WHERE `topic` = {$topicid} ORDER BY `id` DESC LIMIT {$start}, {$end}";
    $result = $this->db->fetchAll($sql);
    return $result;
  }


  public function prepareForumHtml($case = null, $topicid = null, $id = null) {

    if (!empty($case)) {

      switch ($case) {
        case 'single':

          if (!empty($id)) {
            return $this->prepareSinglePostHtmlPage($id);
          }

          break;

        case 'home':

          return $this->prepareForumHomeHtml();

        break;

        case 'topic':

          return $this->prepareForumTopicHtml($topicid);

        break;

        default:
          return $this->prepareForumHomeHtml();
        break;
      }

    }
  }


  private function prepareForumHomeHtml() {

    $objUser = new User();

    $html_forum = array();

    $forum_topics = $this->getAllTopics();

    $html_forum[] = '<h2 class="page-header"><a href="/?page=forum&view=all" class="forum_header_home">Forum</a></h2>';
    $html_forum[] = '<div class="row">';
    $html_forum[] = '<form action="/?page=search" method="post">';
    $html_forum[] = '<input type="text" class="form-control input-lg" name="search-box" placeholder="What are you looking for?"><br />';
    $html_forum[] = '</form>';
    $html_forum[] = '</div>';

    $html_forum[] = '<div class="row forum-header">';

    $html_forum[] = '<strong><div class="col-lg-6">TOPICS</div><div class="col-lg-2 text-center">POSTS</div><div class="col-lg-2 text-center">COMMENTS / REPLIES</div><div class="col-lg-2">LAST POST</div></strong>';
    $html_forum[] = '</div>'; // row


    $html_forum[] = '<div class="row forum">';

    if (!empty($forum_topics)) {

      foreach ($forum_topics as $forum_topic) {

       $html_forum[] = '<div class="row topic">';

        $html_forum[] = '<div class="col-lg-6 topic-col">';
          $html_forum[] = '<h3><a href="/?page=forum&topic='.$forum_topic['id'].'">'.$forum_topic['topic'].'</a></h3>';
          $html_forum[] = '<p>'.$forum_topic['description'].'</p>';
        $html_forum[] = '</div>';  // col-lg-6

        $html_forum[] = '<div class="col-lg-2 text-center">';
          $html_forum[] = $this->getForumPostsStats($forum_topic['id']);
        $html_forum[] = '</div>'; // col-lg-2

        $html_forum[] = '<div class="col-lg-2 text-center">';
          $html_forum[] = $this->getForumCommentsStats($forum_topic['id']).' / '.$this->getForumReplyStats($forum_topic['id']);
        $html_forum[] = '</div>'; // col-lg-2

        $html_forum[] = '<div class="col-lg-2">';
          $latest_post = $this->getLatestPost($forum_topic['id']);
          if (!empty($latest_post)) {
            $html_forum[] = '<p><time class="timeago" id="timeago-md" datetime="'.$latest_post['created_on'].'"></time></p>';
            $objUser = new User();
            $post_user = $objUser->getUser($latest_post['userid']);
            $html_forum[] = '<p>by <a href="/?page=profile&id='.$post_user['id'].'">'.$post_user['username'].'</a></p>';
          } else {
            $html_forum[] = '<p></p>';
          }
          
        $html_forum[] = '</div>'; // col-lg-2

        $html_forum[] = '</div><hr>'; //Topic
      }


    } else {
      $html_forum[] = '<p>There are no topics to show';
    }
    //echo '</div>'; // forum
    $html_forum[] = '</div>'; // row / forum

    return $html_forum;


  }


  private function prepareForumTopicHtml($topicid = null) {
    if (isset($topicid)) {
      $objUser = new User();
      $topic = $this->getTopic($topicid);
      $topic_name = $topic['topic'];
      $html_topic = array();
      $num_rows = $this->getForumPostsStats($topicid);
      if($num_rows > 0) {
        try {

              $pages = new Paginator($num_rows,9,array(15,3,6,9,12,25,50,100,250,'All'));

              $html_topic[] = '<h2 class="page-header"><a href="/?page=forum&view=all" class="forum_header_home">Forum</a> : '.$topic_name.'</h2>';
              $html_topic[] = '<div class="row">';
              $html_topic[] = '<form action="/?page=search" method="post">';
              $html_topic[] = '<input type="hidden" name="topic" id="topic" value="'.$topicid.'">';
              $html_topic[] = '<input type="text" class="form-control input-lg" id="search-box" name="search-box" placeholder="What are you looking for?"><br />';
              $html_topic[] = '</form>';
              $html_topic[] = '</div>';
              $html_topic[] = '<div class="row">';
              $html_topic[] =	'<div class="col-lg-8">'.$pages->display_pages().'</div>';
              $html_topic[] =	'<div class="col-lg-4 text-right"><span class="">'.$pages->display_jump_menu().$pages->display_items_per_page().'</span></div>';
              $html_topic[] = '</div><br />'; // row
              $html_topic[] = '<div class="row forum-header">';

              $new_post = '';

              if (isset($_SESSION[Login::$_login_front])) {
                $new_post = '<a href="/?page=addpost&topic='.$topicid.'" class="btn btn-info btn-xs">Add New Post</a>';
              } else {
                $new_post = '<a href="#" data-toggle="modal" data-target="#login-modal">Log in</a> to add new posts under this topic.';
              }

              $html_topic[] = '<strong><div class="col-lg-6">POSTS&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.$new_post.'</div><div class="col-lg-2 text-center">COMMENTS</div><div class="col-lg-2 text-center">REPLIES</div><div class="col-lg-2"></div></strong>';
              $html_topic[] = '</div>'; // row


              $html_topic[] = '<div class="row forum">';
              $posts = $this->getPagedForumPosts($topicid, $pages->limit_start, $pages->limit_end);

              
              foreach ($posts as $post) {

                $objUser = new User();
                $post_user = $objUser->getUser($post['userid']);

                $html_topic[] = '<div class="row topic">';

                 $html_topic[] = '<div class="col-lg-6 topic-col">';
                   $html_topic[] = '<span class="topic-title"><a href="/?page=forum&id='.$post['id'].'">'.Helper::shortenString($post['title']).'</a></span>';
                   $html_topic[] = '<p>'.Helper::shortenString($post['message']).'</p>';
                   $html_topic[] = '<span id="postedby">by <a href="/?page=profile&id='.$post['userid'].'">'.$post_user['username'].'</a> - <time class="timeago" datetime="'.$post['created_on'].'"></time></span>';
                 $html_topic[] = '</div>';  // col-lg-6

                 $html_topic[] = '<div class="col-lg-2 text-center">';
                   $html_topic[] = $this->getPostCommentsStats($post['id']);
                 $html_topic[] = '</div>'; // col-lg-2

                 $html_topic[] = '<div class="col-lg-2 text-center">';
                   $html_topic[] = $this->getTopicReplyStats($post['id']);
                 $html_topic[] = '</div>'; // col-lg-2

                 $html_topic[] = '<div class="col-lg-2">';
                    $latest_comment = $this->getLatestComment($post['id']);
                    !empty($latest_comment) ?
                      $html_topic[] = '<p>Last comment: <time class="timeago" id="timeago-md" datetime="'.$latest_comment['created_on'].'"></time></p>' :
                      $html_topic[] = '<p></p>';
                 $html_topic[] = '</div>'; // col-lg-2

                 $html_topic[] = '</div><hr>'; //Topic

              }
              $html_topic[] = '</div><br />'; //row
              $html_topic[] = '<div class="row">';
              $html_topic[] =	'<div class="col-lg-8">'.$pages->display_pages().'</div>';
              $html_topic[] = '</div>'; // row

              return $html_topic;

            } catch(PDOException $e) {
                return 'ERROR: ' . $e->getMessage();
            }
          } else {
            $html_topic[] = '<h2 class="page-header"><a href="/?page=forum&view=all" class="forum_header_home">Forum</a> : '.$topic_name.'</h2>';
            $html_topic[] = '<div class="row forum-header">';

            $html_topic[] = '<strong><div class="col-lg-6">POSTS</div><div class="col-lg-2 text-center">COMMENTS</div><div class="col-lg-2 text-center">REPLIES</div><div class="col-lg-2">LAST COMMENT</div></strong>';
            $html_topic[] = '</div>'; // row

            $html_topic[] = '<div class="row forum">';

              $html_topic[] = '<div class="row topic">';

               $html_topic[] = '<div class="col-lg-6 topic-col">';
                 $html_topic[] = '<h3>There are no posts under this topic.</h3>';
               $html_topic[] = '</div>';  // col-lg-6

               $html_topic[] = '<div class="col-lg-2 text-center">';

               $html_topic[] = '</div>'; // col-lg-2

               $html_topic[] = '<div class="col-lg-2 text-center">';

               $html_topic[] = '</div>'; // col-lg-2

               $html_topic[] = '<div class="col-lg-2">';

               $html_topic[] = '</div>'; // col-lg-2

               $html_topic[] = '</div>'; //Topic


            $html_topic[] = '</div><br />'; //row

            return $html_topic;
          }

    }
  }


  private function prepareSinglePostHtmlPage($id = null){
    if (isset($id)) {
      $objUser = new User();
      $forumPost = $this->getPost($id);
      $userid = $forumPost['userid'];
      $user = $objUser->getUser($userid);
      $postId = $id;
      $topicid = $forumPost['topic'];
      $topic = $this->getTopic($topicid);
      $posted_on = $forumPost['created_on'];
      $img = '';
      $html = array();
      $html_post = array();
      $html_comments = array();

      $html_post[] = '<h2 class="page-header"><a href="/?page=forum&view=all" class="forum_header_home">Forum</a></h2>';
      if ($forumPost['no_of_images'] != 0) {
        $files = Helper::findImageFiles(IMG_ROOT.'/posts/forum/'.$topic['img_folder'], $postId);
        $img = $files[0];
      }

      $html_post[]  = '<div class="thumbnail">';
      $html_post[] .= '<div class="post-image">';

      if ($img != '') {
        $html_post[] .= '<img src="/images/posts/forum/'.$topic['img_folder'].'/'.$img.'" class="img-responsive img-rounded" id="main_post_image">';
      }

      $html_post[] .= '<div class="caption post-content">';
      $html_post[] .= '<h4>'.$forumPost['title'].'</h4>';
      $html_post[] .= '<p class="on_topic">on <a href="/?page=forum&topic='.$topicid.'">'.$topic['topic'].'</a></p>';
      $html_post[] .= '<p>'.Helper::encodeHtml($forumPost['message']).'</p>';
      $html_post[] .= '<p id="postedby">by <a href="/?page=profile&id='.$userid.'">'.$user['username'].'</a> - <time class="timeago" datetime="'.$posted_on.'"></time></p>';
      $html_post[] .= '</div>';
      $html_post[] .= '</div>';
      $html_post[] .= '</div>';
      $html_post[] .= '<h3>Comments</h3>';
      $html_post[] .= '<hr>';
      $html_comments = $this->prepareCommentsArea($postId);
      $html = array_merge($html_post, $html_comments);
      return $html;

    }
  }




  public function prepareCommentsArea($id = null) {

    $comments = $this->getComments($id);

    $html = array();


    if (isset($_SESSION[Login::$_login_front])) {

      //$objCaptcha = new Captcha();
      //$captchaid = $objCaptcha->generateCaptcha();

      $html[] = '<form action="" method="post" id="form-comment" name="form-comment">';
        $html[] = '<div class="form-group post-comment">';
          $html[] = '<div class="row">';
            $html[] = '<div class="col-lg-8 col-md-8">';
              $html[] = '<label for="post-comment">Comment*:</label>';
              $html[] = '<textarea class="form-control vresize" rows="5" id="post-comment" name="post-comment" required></textarea><br />';
              $html[] = '<div class="g-recaptcha" data-sitekey="'.Captcha::$sitekey.'"></div><br />';
              $html[] = '<button type="submit" class="btn btn-info" id="btn-comment" name="btn-comment">&nbsp;&nbsp;&nbsp;&nbsp;Post&nbsp;&nbsp;&nbsp;&nbsp;</button><br />';
              $html[] .= '</div>';
          $html[] = '</div>';

        $html[] = '</div>';
      $html[] = '</form><hr>';

    } else {
      $html[] = 'You must <a href="#" data-toggle="modal" data-target="#login-modal">Sign in</a> to post comments / replies.<hr>';
    }



    if (!empty($comments)) {

      $objUser = new User();
      $cmnt_user = '';
      $cmnt_created_on = '';
      $cmnt_edited_on = '';
      $cmnt_comment = '';
      $imgfiles = array();
      $img = '0-0.jpg';

      foreach ($comments as $comment) {
        $cmnt_user = $objUser->getUser($comment['userid']);
        $cmnt_user_id = $cmnt_user['id'];
        $cmnt_username = $cmnt_user['username'];
        $cmnt_created_on = $comment['created_on'];
        $cmnt_edited_on = $comment['edited_on'];
        $cmnt_comment = $comment['comment'];

        $files = Helper::findImageFiles(IMG_ROOT.'/profile/', $cmnt_user['id']);
        if (!empty($files)) {
          $img = $files[0];
        }


        $replies = $this->getReplies($comment['id']);

        $rply_user = '';
        $rply_created_on = '';
        $rply_edited_on = '';
        $rply_reply = '';



        $html[] = '<section class="comment-list">';
        $html[] = '<!-- First Comment -->';
        $html[] = '<article class="row">';
        $html[] = '<div class="col-md-1 col-sm-1 hidden-xs">';
        $html[] = '<figure class="thumbnail comment-user-img">';
        $html[] = '<a href="/?page=profile&id='.$cmnt_user_id.'"><img class="img-responsive" src="/images/profile/'.$img.'"/></a>';
        $html[] = '<figcaption class="text-center"><a href="/?page=profile&id='.$cmnt_user_id.'">'.$cmnt_username.'</a></figcaption>';
        $html[] = '</figure>';
        $html[] = '</div>';
        $html[] = '<div class="col-md-11 col-sm-11">';
        $html[] = '<div class="panel panel-default arrow left">';
        $html[] = '<div class="panel-body">';
        $html[] = '<header class="text-left">';
        $html[] = '<div class="comment-user"><i class="fa fa-user"></i><a href="/?page=profile&id='.$cmnt_user_id.'">'.$cmnt_username.'</a></div>';
        $html[] = '<time class="timeago" datetime="'.$cmnt_created_on.'"></time>';
        $html[] = '</header>';
        $html[] = '<div class="comment-post">';
        $html[] = '<p>';
        $html[] = $cmnt_comment;
        $html[] = '</p>';
        $html[] = '</div>';

        if (isset($_SESSION[Login::$_login_front])) {

          $html[] = '<form action="" method="post">';
          $html[] = '<input type="hidden" name="comment_id" value="'.$comment['id'].'">';
          $html[] = '<div class="row">';
          //$html[] = '<div class="row"'>
          $html[] = '<div class="col-md-8 col=sm-8">';
          $html[] = '<input type="text" class="form-control input-sm" id="reply" name="reply" placeholder="Enter your reply...">';
          $html[] = '</div>';
          $html[] = '<div class="col-md-1 col=sm-1">';
          $html[] = '<button type="submit" class="btn btn-default btn-sm" id="btn-reply" name="btn-reply"><i class="fa fa-reply"></i> reply</button>';
          $html[] = '</div>';
          $html[] = '</div>';
          $html[] = '</form>';
        }

        //$html[] = '<p class="text-right"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> reply</a></p>';
        $html[] = '</div>';
        $html[] = '</div>';
        $html[] = '</div>';
        $html[] = '</article>';


        if (!empty($replies)) {
          foreach ($replies as $reply) {
            $rply_user = $objUser->getUser($reply['userid']);
            $rply_user_id = $rply_user['id'];
            $rply_username = $rply_user['username'];
            $rply_created_on = $reply['created_on'];
            $rply_edited_on = $reply['edited_on'];
            $rply_reply = $reply['reply'];
            $img = '0-0.jpg';

            $files = Helper::findImageFiles(IMG_ROOT.'/profile/', $rply_user['id']);
            if (!empty($files)) {
              $img = $files[0];
            }


            $html[] = '<article class="row">';
            $html[] = '<div class="col-md-1 col-sm-1 col-md-offset-1 col-sm-offset-0 hidden-xs">';
            $html[] = '<figure class="thumbnail">';
            $html[] = '<a href="/?page=profile&id='.$rply_user_id.'"><img class="img-responsive" src="/images/profile/'.$img.'"/></a>';
            $html[] = '<figcaption class="text-center"><a href="/?page=profile&id='.$rply_user_id.'">'.$rply_username.'</a></figcaption>';
            $html[] = '</figure>';
            $html[] = '</div>';
            $html[] = '<div class="col-md-10 col-sm-10">';
            $html[] = '<div class="panel panel-default arrow left">';
            $html[] = '<div class="panel-heading right">Reply</div>';
            $html[] = '<div class="panel-body">';
            $html[] = '<header class="text-left">';
            $html[] = '<div class="comment-user"><i class="fa fa-user"></i><a href="/?page=profile&id='.$rply_user_id.'">'.$rply_username.'</a></div>';
            $html[] = '<time class="timeago" datetime="'.$rply_created_on.'"></time>';
            $html[] = '</header>';
            $html[] = '<div class="comment-post">';
            $html[] = '<p>';
            $html[] = $rply_reply;
            $html[] = '</p>';
            $html[] = '</div>';
            //$html[] = '<p class="text-right"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> reply</a></p>';
            $html[] = '</div>';
            $html[] = '</div>';
            $html[] = '</div>';
            $html[] = '</article>';
          }
        }

        $html[] = '</section>';
      }


    } else {
      $html[] = '<div>No comments yet.</div>';
    }

    return $html;

  }


  public function prepareForumSearchHtml($_query = null, $_topicid = 0) {

    $search_html = array();

    if (!empty($_query)) {

      $qry = preg_replace("#[^0-9a-z]#i", "", $_query);
      $sql = '';
      
      $_result = '';

      if (!empty($_topicid)) {
        $sql = "SELECT * FROM `{$this->_forum_table}` WHERE `topic` = $_topicid AND (`title` LIKE '%$qry%' OR `message` LIKE '%$qry%') ORDER BY `id` DESC";
      } else {
        $sql = "SELECT * FROM `{$this->_forum_table}` WHERE (`title` LIKE '%$qry%' OR `message` LIKE '%$qry%') ORDER BY `id` DESC";
      }

      $_result = $this->db->query($sql);
      $num_rows = mysqli_num_rows($_result);


        if($num_rows > 0) {
          try {
            $pages = new Paginator($num_rows,9,array(15,3,6,9,12,25,50,100,250,'All'));

            $html_search[] = '<h2 class="page-header">Search results for "'.$qry.'"</h2>';
            $html_search[] = '<div class="row">';
            $html_search[] = '<div class="col-lg-8">'.$pages->display_pages().'</div>';
            $html_search[] = '<div class="col-lg-4 text-right"><span class="">'.$pages->display_jump_menu().$pages->display_items_per_page().'</span></div>';
            $html_search[] = '</div><br />'; // row
            $html_search[] = '<div class="row search-results">';
            $results = $this->getPagedSearchResults($sql, $pages->limit_start, $pages->limit_end);

            foreach ($results as $result) {
              $objUser = new User();
              $post_user = $objUser->getUser($result['userid']);

              $_topic = $this->getTopic($result['topic']);

              $html_search[] = '<div class="row topic">';
                $html_search[] = '<div class="col-lg-6 topic-col">';
                  $html_search[] = '<span class="topic-title"><a href="/?page=forum&id='.$result['id'].'">'.Helper::shortenString($result['title']).
                  '</a></span> on <a href="/?page=forum&topic='.$result['topic'].'">'.$_topic['topic'].'</a>';
                  $html_search[] = '<p>'.Helper::shortenString($result['message']).'</p>';
                  $html_search[] = '<span id="postedby">by <a href="/?page=profile&id='.$post_user['id'].'">'.$post_user['username'].'</a> - <time class="timeago" datetime="'.$result['created_on'].'"></time></span>';
                $html_search[] = '</div>';  // col-lg-6
              $html_search[] = '</div><br />';  // row 
            }
            $html_search[] = '</div><br />'; // search-results 
          } catch(PDOException $e) {
            return 'ERROR: ' . $e->getMessage();
          }
          $html_search[] = $pages->display_pages();
          return $html_search;
        }
    } 

    

  }


  private function getPagedSearchResults($_sql, $start, $end) {
    $sql = $_sql . ' LIMIT ' . $start . ', ' . $end;
    $result = $this->db->fetchAll($sql);
    return $result;
  }




}
?>
