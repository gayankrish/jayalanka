<?php
  require_once('_header.php');

  $objHotel = new Hotel();
  $objForm = new Form();
  //$requestType = 'blank';
   Url::getAll();
  $params = Url::$_params;
  //$requestType = $objForum->getRequestType($params);

  !empty($params['id']) ? $hotelId = $params['id'] : $hotelId = '';

  $search_string = '';
  $search_placeholder = null;
  if ($objForm->isPost('search-box') && !empty($objForm->getPost('search-box'))) {
    $search_query = $objForm->getPost('search-box');
    $search_placeholder = 'Search results for: '.$search_query;
    foreach ($_POST as $key => $value) {

      
      if(strpos($key, 'chkbx-') !== FALSE) {

        switch ($key) {
          case 'chkbx-available_facilities':
            
              $tmp_search_str = "`facility` LIKE '%".$search_query."%'";
              $search_facilities = $objHotel->getHotelFacilities($tmp_search_str);

              if(!empty($search_facilities)) { // records found in facility table
                $tmp_str = '';
                foreach ($search_facilities as $search_facility) {
                  $tmp_str .= $search_facility['id'].',';
                }
                $tmp_str = substr($tmp_str, 0, strlen($tmp_str)-1); 
                $search_string .= "`".$value . "` LIKE '%" . $tmp_str . "%' OR ";
                continue;
              } else { // no records found in facility table
                $search_string .= "`".$value . "` LIKE '%" . $search_query . "%' OR ";
                continue;
              }

            break;
          
          default:
            # code...
            break;
        }

        $search_string .= "`".$value . "` LIKE '%" . $search_query . "%' OR ";
      }

      
    }
    $search_string = substr($search_string, 0, strlen($search_string)-3);   
  }/*  elseif ($_GET) {
    $search_query = Url::getParam('search-box');
    echo '$_GET';
  } */

  $hotels = array();
  if(!empty($search_string)) {
    $no_of_hotels = $objHotel->getHotels($search_string, true);

    $pages = new Paginator($no_of_hotels,9,array(15,3,6,9,12,25,50,100,250,'All'));
    $hotels = $objHotel->getPagedHotels($search_string, $pages->limit_start, $pages->limit_end);

    //$hotels = $objHotel->getHotels($search_string);
  }

?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-1 pull-left">
    <span>
      <h1 class="pageheader">Hotels</h1><button class="btn btn-success btn-xs pull-right" id="add-new-hotel" title="Add new hotel" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false"><i class="glyphicon glyphicon-plus"></i> Add New Hotel</button>
    </span><hr>
    <?php 
      $filter_options = array(
                      ['id'=>'chkbx-display_name', 'value'=>'display_name', 'text'=>' Name &nbsp;'],
                      ['id'=>'chkbx-location', 'value'=>'location', 'text'=>' Location &nbsp;'],
                      ['id'=>'chkbx-rank', 'value'=>'rank', 'text'=>' Rating &nbsp;'],
                      ['id'=>'chkbx-available_facilities', 'value'=>'available_facilities', 'text'=>' Facilities &nbsp;']
                  );    
      require_once('_search.php'); 
      ?>
    </div> <!-- .col-md-8 .col-md-offset-2 -->

    <br/><br />

    <div class="col-md-10 col-md-offset-1" id="hotel_details_grid">

    <?php 
            if(empty($hotels)) {
              $no_of_hotels = $objHotel->getHotels($search_string, true);              
              $pages = new Paginator($no_of_hotels,9,array(15,3,6,9,12,25,50,100,250,'All'));
              $hotels = $objHotel->getPagedHotels(null, $pages->limit_start, $pages->limit_end);
            }    
    ?>
      <div class="row">
        <div class="col-lg-8"><?= $pages->display_pages()?></div>
        <div class="col-lg-4 text-right"><span class=""><?= $pages->display_jump_menu().$pages->display_items_per_page()?></span></div>
      </div><br />
 
      <table class="table table-condensed table-hover" id="hotel_details_table">
        <thead>
          <tr>
            <th>Hotel Name</th>
            <th>Location</th>
            <th>Contact Nos.</th>
            <th>Rating</th>
            <th class="text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
            //$objHotel = new Hotel();


            $actions = '<td class="text-center">                        
                          <button class="btn btn-xs btn-default" id="show-hotel-details" title="Show Details" name="%record_id%"><i class="glyphicon glyphicon-list-alt"></i></button>
                          <button class="btn btn-xs btn-default" id="edit-hotel-details" title="Edit" name="%record_id%"><i class="glyphicon glyphicon-edit"></i></button>
                          <button class="btn btn-xs btn-danger" id="delete-hotel" title="Delete" name="%record_id%"><i class="glyphicon glyphicon-trash"></i></button>
                        </td>';
            if (!empty($hotels)) {
              $objCountry = new Country();
              
              foreach ($hotels as $hotel) {
                $country = $objCountry->getCountryById($hotel['country_id']);
                echo '<tr>';
                  echo '<td id="td-display_name" name="'.$hotel['id'].'">'.$hotel['display_name'].'</td>';
                  echo '<td id="td-location" name="'.$hotel['id'].'">'.$hotel['city'].', '.$country['country_name'].'</td>';
                  echo '<td id="td-contact_nos" name="'.$hotel['id'].'">'.Helper::formatString($hotel['contact_nos'], 'phone').'</td>';
                  echo '<td id="td-rank" name="'.$hotel['id'].'">'.$hotel['rank'].'</td>';
                  echo str_replace('%record_id%', $hotel['id'], $actions);
                echo '</tr>';
              }
            }
          ?>
        </tbody>
      </table> 

      <br />
      <div class="row">
        <div class="col-lg-8"><?= $pages->display_pages() ?></div>
      </div> <!-- .row -->
    </div> <!-- .col-md-10 .col-md-offset-1 -->
  </div> <!-- row -->
</div> <!-- container-fluid -->

<!-- Main Modal - Start-->

<div class="main-modal">
</div>
<?php 

/* $modal_title = "Add New Hotel";
//$tab1_title
//$tab2_title
$main_table = 'hotel';
$mode = 'new';
$record_id = null;
$image_upload_required = true;
$map_required = true;
$close_button_required = true;
$edit_button_required = false;
$save_button_required = true; */

//require_once('_modal.php');
?>
<!-- Main Modal - End -->

<!-- Image viewer modal - start -->
    <div class="modal fade" id="imgViewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">         
          <div class="modal-body">

          </div> <!-- .modal-body -->
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<!-- Image viewer modal - end -->




<?php   require_once('_footer.php'); ?>
