<?php
class Classified extends Application {

  private $_classified_table = 'classifieds';
  private $_clsfd_types_table = 'classified_types';
  private $_clsfd_items_table = 'classified_items';

  private $_vehicle_makes_table = 'vehicle_makes';
  private $_vehicle_models_table = 'vehicle_models';
  private $_vehicle_types_table = 'vehicle_types';

  private $_property_type_table = 'property_type';
  private $_bldng_type_table = 'building_type';
  private $_floor_area_unit_table = 'floor_area_unit';


//*********************************************************************

  private function getCatId($cat = null) {

    $catid = 0;

    if (!empty($cat)) {
      $cat = strtolower($cat);
    

      switch ($cat) {
        case 'properties':
          $catid = 1;
          break;

        case 'vehicles':
          $catid = 2;
          break;

        case 'appliances':
          $catid = 3;
          break;

        case 'other':
          $catid = 4;
          break;

        case 'furniture':
          $catid = 5;
          break;

        default:
          $catid = 0;   // retireve all
          break;
        }
      }
      return $catid; 
  }

//*********************************************************************
  
  public function getAllActiveAds($ad_type = 1, $catId = null, $limit = 0) {

    //$catid = $this->getCatId($cat);
      

      if ($catId != 0) {
        $sql = "SELECT * FROM `{$this->_classified_table}` WHERE `item_type` = {$catId} AND `classified_type` = {$ad_type} AND `active` = 1 ORDER BY `id` DESC".($limit != 0? ' LIMIT '.$limit : '');
      } else {
        $sql = "SELECT * FROM `{$this->_classified_table}` WHERE  `active` = 1  AND `classified_type` = {$ad_type} ORDER BY `id` DESC".($limit != 0? " LIMIT ".$limit : '');
      }

      $result = $this->db->fetchAll($sql);
      return $result;
  }


//*********************************************************************

    public function getRequestType($para) {
    $params = $para;
    if (array_key_exists('id', $params)) {
      return 'single';   //clicked on a single post
    } elseif (array_key_exists('item', $params)) {
      return 'item'; // clicked on an item/category
    } elseif (array_key_exists('view', $params) && $params['view'] == 'all') {
      return 'home';  // Forum home
    } elseif (array_key_exists('new', $params)) {
      return 'new_post';  // Forum home
    } else {
      return 'error';
    }
  }
 

//*********************************************************************

  public function getLatestAdsWithImages($cat = null) {

    $catid = $this->getCatId($cat);

      if ($catid != 0) {
        $sql = "SELECT * FROM `{$this->_classified_table}` WHERE `no_of_images` != 0 AND `item_type` = {$catid} AND `active` = 1 ORDER BY `id` DESC LIMIT {$this->_items_for_home_page}";
      } else {
        $sql = "SELECT * FROM `{$this->_classified_table}` WHERE `no_of_images` != 0 AND `active` = 1 ORDER BY `id` DESC LIMIT {$this->_items_for_home_page}";
      }

      $result = $this->db->fetchAll($sql);
      return $result;
  }
  

//*********************************************************************


  public function getAdDetails($id = null) {

    if (!empty($id)) {

      $sql = "SELECT * FROM `{$this->_classified_table}` WHERE `id` = {$id}";
      $result = $this->db->fetchOne($sql);
      return $result;

    }

  }

//*********************************************************************

  public function getLatestAdsWithoutImages($cat = null) {

    $catid = $this->getCatId($cat);

      if ($catid != 0) {
        $sql = "SELECT * FROM `{$this->_classified_table}` WHERE `no_of_images` = 0 AND `item_type` = {$catid} AND `active` = 1 ORDER BY `id` DESC LIMIT 4";
      } else {
        $sql = "SELECT * FROM `{$this->_classified_table}` WHERE `no_of_images` = 0 AND `active` = 1 ORDER BY `id` DESC LIMIT 4";
      }

    $result = $this->db->fetchAll($sql);
    return $result;
  }
  
//*********************************************************************

  public function getAdType($id = null) {
    if (!empty($id)) {
      $sql = "SELECT * FROM `{$this->_clsfd_types_table}` WHERE `id` = {$id}";
      $result = $this->db->fetchOne($sql);
      return $result;
    } else {
      $sql = "SELECT * FROM `{$this->_clsfd_types_table}`";
      $result = $this->db->fetchAll($sql);
      return $result;
    }
  }

//*********************************************************************

  public function getAdItem($id = null) {
    if (!empty($id)) {
      $sql = "SELECT * FROM `{$this->_clsfd_items_table}` WHERE `id` = {$id}";
      $result = $this->db->fetchOne($sql);
      return $result;
    } else {
      $sql = "SELECT * FROM `{$this->_clsfd_items_table}` ORDER BY `sort_order` ASC";
      $result = $this->db->fetchAll($sql);
      return $result;
    }

  }

//*********************************************************************

  private function getVehicleDetails($ad = null) {

    if (!empty($ad)) {

      //$vehicle = $this->getAdDetails($adId);

      //if (!empty($vehicle)) {

        $result = array();

        $result['Type'] = $this->getVehicleType($ad['vehicle_type']);
        $result['Make'] = $this->getVehicleMake($ad['make_id']);
        $result['Model'] = $this->getVehicleModel($ad['model_id']);
        return $result;

      //}



    }

  }

//*********************************************************************  

  private function getVehicleType($typeId = null) {

    if (!empty($typeId)) {

      $sql = "SELECT * FROM `{$this->_vehicle_types_table}` WHERE `id` = {$typeId}";
      $result = $this->db->fetchOne($sql);
      return $result['vehicle_type'];

    }

  }


//*********************************************************************  

  private function getVehicleMake($makeId = null) {

    if (!empty($makeId)) {

      $sql = "SELECT * FROM `{$this->_vehicle_makes_table}` WHERE `id` = {$makeId}";
      $result = $this->db->fetchOne($sql);
      return $result['make'];

    }

  }


//*********************************************************************  

  private function getVehicleModel($modelId = null) {

    if (!empty($modelId)) {

      $sql = "SELECT * FROM `{$this->_vehicle_models_table}` WHERE `id` = {$modelId}";
      $result = $this->db->fetchOne($sql);
      return $result['model'];

    }

  }


//*********************************************************************  

  private function getPropertyDetails($ad = null) {

    if (!empty($ad)) {

      $result = array();

      $result['Type'] = $this->getPropertyType($ad['property_type']);
      $result['unit'] = $this->getFloorAreaUnit($ad['floor_area_unit']);

      return $result;

    }
  }

//*********************************************************************  

  private function getPropertyType($id = null) {

    if (!empty($id)) {

      $sql = "SELECT * FROM `{$this->_property_type_table}` WHERE `id` = {$id}";
      $result = $this->db->fetchOne($sql);
      return $result['type'];

    }
  }


//*********************************************************************  

  private function getFloorAreaUnit($id = null) {

    if (!empty($id)) {

      $sql = "SELECT * FROM `{$this->_floor_area_unit_table}` WHERE `id` = {$id}";
      $result = $this->db->fetchOne($sql);
      return $result['unit'];

    }
  }  


//*********************************************************************  

  private function getAdAdditionalInfo($ad = null) {

    if (!empty($ad)) {

      $arrAddInfo = array();
      if ($ad['vehicle_type'] != 0) {   // Vehicle Ad

        
        $arrAddInfo = $this->getVehicleDetails($ad);
        $arrAddInfo['Year'] = $ad['year'];
        $arrAddInfo['Color'] = $ad['color'];
        $arrAddInfo['Mileage'] = $ad['mileage'];
        $arrAddInfo['Price'] = $ad['price'];



      } elseif ($ad['property_type'] != 0) { // Property Ad

        $arrAddInfo = $this->getPropertyDetails($ad);
        $arrAddInfo['Land_size'] = $ad['land_size'];
        $arrAddInfo['Floor_area'] = $ad['floor_area'];
        $arrAddInfo['Floors'] = $ad['no_of_floors'];
        $arrAddInfo['Rooms'] = $ad['no_of_rooms'];
        $arrAddInfo['Bathrooms'] = $ad['no_of_bathrooms'];

      }
      return $arrAddInfo;
    }

  }


//*********************************************************************  


  public function prepareAdsHtml($ad_type = 1, $itemId = null, $adId = null, $limit = 8, $indexPage = false) {

    if (!empty($itemId) && empty($adId)) {

      // Show one category

      return $this->prepareAdsCategoryHtml($ad_type, $itemId, 24);



    } elseif (empty($itemId) && !empty($adId)) {

      // Show single Ad

      return $this->prepareAdsSinglePageHtml($adId);
      


    } elseif (empty($itemId) && empty($adId)) {

      // Show classifieds home
      
      return $this->prepareAdsHomeHtml($ad_type, $limit, $indexPage);

    }

  }


//*********************************************************************

private function prepareAdsSinglePageHtml($id = null) {

  if (!empty($id)) {

    $ad = $this->getAdDetails($id);

    if (!empty($ad)) {

      // code to be modified  - Start

      $html = array();

      $adItem = $this->getAdItem($ad['item_type']);
      $adType = $this->getAdType($ad['classified_type']);

      $objUser = new User();
      $user = $objUser->getUser($ad['userid']);

      $html[] = '<h2 class="page-header"><a href="/?page=classifieds&type=1&view=all" class="forum_header_home">Classifieds</a> :
                                          <a href="/?page=classifieds&type=1&topic='.$adItem['id'].'" class="forum_header_home">'.$adItem['topic'].'</a></h2>';
      if ($ad['no_of_images'] != 0) {
        $files = Helper::findImageFiles(IMG_ROOT.'/posts/classifieds/'.$adItem['img_folder'], $ad['id']);
        $img = $files[0];
      }

      $html[] = '<div class="thumbnail">';
      $html[] = '<div class="post-image">';

      if ($img != '') {
        $html[] = '<img src="/images/posts/classifieds/'.$adItem['img_folder'].'/'.$img.'" class="img-responsive img-rounded" id="main_post_image">';
      } else {
        $html[] = '<img src="/images/posts/classifieds/0-0.png" class="img-responsive img-rounded" id="main_post_image">';
      }

      $html[] = '<div class="caption post-content">';
      $html[] = '<h4>'.$adType['type'].' - '.$ad['title'].'</h4>';
      $html[] = '<p class="on_topic">on <a href="/?page=classifieds&type=1&topic='.$adItem['id'].'" class="forum_header_home">'.$adItem['topic'].'</a></p>';
      $html[] = '<p>'.Helper::encodeHtml($ad['message']).'</p><br />';

      $adAdditionalInfo = $this->getAdAdditionalInfo($ad);
      $floor_area = '';
      $unit = '';

      foreach ($adAdditionalInfo as $key => $value) {
        if ($key == 'Mileage') {
          $html[] = '<p><strong>'.$key.':</strong> '.$value.' Km</p>';
        } else {
          $floor_area .= $key == 'Floor_area'? '<p><strong>'.str_replace('_', ' ', $key).':</strong> '.$value.' ':'';
          $unit .= $key == 'unit'? $value.'</p>':'';
          $html[] = '<p><strong>'.str_replace('_', ' ', $key).':</strong> '.$value.'</p>';
        }

      }

      $html[] = $floor_area.$unit;
      
      $html[] = '<strong>Contact: </strong><span id="contact_no"><input type="hidden" id="cnt_no" value="'.$user['contact'].'"><a class="btn btn-sm btn-info" id="show_contact"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Show Contact&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></a></span><br />';
      

      //$html[] = $adAdditionalInfo;

      $html[] = '<br /><p id="postedby">by <a href="/?page=profile&id='.$userid.'">'.$user['username'].'</a> - <time class="timeago" datetime="'.$ad['created_on'].'"></time>'.
                      (!empty($ad['edited_on'])?'<time class="timeago" datetime="'.$ad['edited_on'].'"></time></p>':'</p>');
      $html[] = '</div>';
      $html[] = '</div>';
      $html[] = '</div>';
     
      // code to be modified  - End

      return $html;

    }


  }

}


//*********************************************************************

  private function prepareAdsHomeHtml($ad_type = 1, $limit = 0, $index = false) {

    $html = array();

    if ($index == false) {

      
      $html[] = '<div class="row">';
      $html[] = '<form action="/?page=search" method="post">';
      //$html[] = '<input type="hidden" name="topic" id="topic" value="'.$topicid.'">';
      $html[] = '<input type="text" class="form-control input-lg" id="search-box" name="search-box" placeholder="What are you looking for?"><br />';
      $html[] = '</form>';
      $html[] = '</div>';

    }

      $aditems = $this->getAdItem();

     

      foreach ($aditems as $aditem) {

        $ad_id = '';
        $title = '';
        $message = '';
        $img = '';
        $created_on = '';
        $ad_item = '';       

        $html[] = '<h4 class="topic-header"><a href="/?page=classifieds&type=1&topic='.$aditem['id'].'">'.$aditem['topic'].'</a></h4>';
        $html[] = '<div class="row">';

        $active_ads = $this->getAllActiveAds($ad_type, $aditem['id'], $limit);

            if (!empty($active_ads)) {

              foreach ($active_ads as $active_ad) {

                $ad_id = $active_ad['id'];
                $title = $active_ad['title'];
                $message = $active_ad['message'];
                $cat = $this->getAdItem($active_ad['item_type']);

                $files = array();
                $files = Helper::findImageFiles(IMG_ROOT.'/posts/classifieds/'.$cat['img_folder'], $active_ad['id']);

                if (!empty($files)) {
                  $img = $files[0];
                  $img_path = 'images/posts/classifieds/'.$cat['img_folder'].'/'.$img;
                } else {
                  $img_path = 'images/posts/classifieds/0-0.png';
                }

                $created_on = $active_ad['created_on'];

                $ad_item_id = $this->getAdItem($active_ad['item_type']);
                $ad_item = $ad_item_id['topic'];

                $html[] = '<div class="col-lg-3 col-md-3">';
                $html[] = '<div class="thumbnail  box-shadow">';
                $html[] = '<div class="ad-image">';
                $html[] = '<img src="'.$img_path.'" class="img-responsive img-rounded" id="ad_image"><br />';
                $html[] = '<span class="ad-price">'.Helper::formatCurrency($active_ad['price'], 'Rs').'</span>';
                $html[] = '<div class="caption post-content">';
                $html[] = '<h4><a href="/?page=classifieds&id='.$ad_id.'">'.Helper::encodeHtml($title).'</a></h4>';
                $html[] = '<p class="on_topic">on <a href="/?page=classifieds&topic='.$ad_item_id['id'].'">'.$ad_item.'</a></p>';
                $html[] = '<p>'.Helper::shortenString(Helper::encodeHtml($message)).'</p>';
                $html[] = '<p><time class="timeago" datetime="'.$created_on.'"></time></p>';
                $html[] = '</div>';
                $html[] = '</div>';
                $html[] = '</div>';
                $html[] = '</div>';

              }

            } else {
              $html[] = '<div class="col-lg-12 col-md-12">';
              $html[] = "No items";
              $html[] = '</div>';
            }

          $html[] = '</div>';
          $html[] = '<hr>';
      }
   
 
    return $html;
  }

//*********************************************************************

  private function prepareAdsCategoryHtml($ad_type = 1, $itemId = null, $limit) {

    $html = array();

     
      $html[] = '<div class="row">';
      $html[] = '<form action="/?page=search" method="post">';
      //$html[] = '<input type="hidden" name="topic" id="topic" value="'.$topicid.'">';
      $html[] = '<input type="text" class="form-control input-lg" id="search-box" name="search-box" placeholder="What are you looking for?"><br />';
      $html[] = '</form>';
      $html[] = '</div>';

        $ad_id = '';
        $title = '';
        $message = '';
        $img = '';
        $created_on = '';
        $ad_item = '';   

        $active_ads = $this->getAllActiveAds($ad_type, $itemId, $limit);    

        $html[] = '<h4 class="topic-header"><a href="/?page=classifieds&type='.$ad_type.'&item='.$aditem['id'].'">'.$aditem['topic'].'</a></h4>';
        $html[] = '<div class="row">';



            if (!empty($active_ads)) {

              foreach ($active_ads as $active_ad) {

                $ad_id = $active_ad['id'];
                $title = $active_ad['title'];
                $message = $active_ad['message'];
                $cat = $this->getAdItem($active_ad['item_type']);

                $files = array();
                $files = Helper::findImageFiles(IMG_ROOT.'/posts/classifieds/'.$cat['img_folder'], $active_ad['id']);

                if (!empty($files)) {
                  $img = $files[0];
                  $img_path = 'images/posts/classifieds/'.$cat['img_folder'].'/'.$img;
                } else {
                  $img_path = 'images/posts/classifieds/0-0.png';
                }

                $created_on = $active_ad['created_on'];

                $ad_item_id = $this->getAdItem($active_ad['item_type']);
                $ad_item = $ad_item_id['topic'];

                $html[] = '<div class="col-lg-2 col-md-2">';
                $html[] = '<div class="thumbnail  box-shadow">';
                $html[] = '<div class="ad-image">';
                $html[] = '<img src="'.$img_path.'" class="img-responsive img-rounded" id="ad_image"><br />';
                $html[] = '<span class="ad-price">'.Helper::formatCurrency($active_ad['price'], 'Rs').'</span>';
                $html[] = '<div class="caption post-content">';
                $html[] = '<h4><a href="/?page=classifieds&id='.$ad_id.'">'.Helper::encodeHtml($title).'</a></h4>';
                $html[] = '<p class="on_topic">on <a href="/?page=classifieds&topic='.$ad_item_id['id'].'">'.$ad_item.'</a></p>';
                $html[] = '<p>'.Helper::shortenString(Helper::encodeHtml($message)).'</p>';
                $html[] = '<p><time class="timeago" datetime="'.$created_on.'"></time></p>';
                $html[] = '</div>';
                $html[] = '</div>';
                $html[] = '</div>';
                $html[] = '</div>';

              }

            } else {
              $html[] = '<div class="col-lg-12 col-md-12">';
              $html[] = "No items";
              $html[] = '</div>';
            }

          $html[] = '</div>';
          $html[] = '<hr>';
      
   
 
    return $html;
  }

//*********************************************************************

}
?>
