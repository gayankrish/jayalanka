<?php
  require_once('_header.php');

  $objVehicle = new Vehicle();
  $objForm = new Form();
  //$requestType = 'blank';
   Url::getAll();
  $params = Url::$_params;
  //$requestType = $objForum->getRequestType($params);

  !empty($params['id']) ? $vehicleid = $params['id'] : $vehicleid = '';

  $search_string = '';
  $search_placeholder = null;
  if ($objForm->isPost('search-box') && !empty($objForm->getPost('search-box'))) {
    $search_query = $objForm->getPost('search-box');
    $search_placeholder = 'Search results for: '.$search_query;
    foreach ($_POST as $key => $value) {

      
      if(strpos($key, 'chkbx-') !== FALSE) {

        switch ($key) {
          case 'chkbx-model':
            
              $tmp_search_str = "`model` LIKE '%".$search_query."%'";
              $search_models = $objVehicle->getVehicleModels($tmp_search_str);

              if(!empty($search_models)) { // records found in facility table
                $tmp_str = '';
                foreach ($search_models as $search_model) {
                  $tmp_str .= $search_model['id'].',';
                }
                $tmp_str = substr($tmp_str, 0, strlen($tmp_str)-1); 
                $search_string .= "`".$value . "` LIKE '%" . $tmp_str . "%' OR ";
                continue;
              } else { // no records found in facility table
                $search_string .= "`".$value . "` LIKE '%" . $search_query . "%' OR ";
                continue;
              }

            break;

            case 'chkbx-type':
            
              $tmp_search_str = "`type` LIKE '%".$search_query."%'";
              $search_types = $objVehicle->getVehicleTypes($tmp_search_str);

              if(!empty($search_types)) { // records found in facility table
                $tmp_str = '';
                foreach ($search_types as $search_type) {
                  $tmp_str .= $search_type['id'].',';
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

  $vehicles = array();
  if(!empty($search_string)) {
    $no_of_vehicles = $objVehicle->getVehicles($search_string, true);

    $pages = new Paginator($no_of_vehicles,9,array(15,3,6,9,12,25,50,100,250,'All'));
    $vehicles = $objHotel->getPagedVehicles($search_string, $pages->limit_start, $pages->limit_end);

;
  }

?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-1 pull-left">
    <span>
      <h1 class="pageheader">Vehicles</h1><button class="btn btn-success btn-xs pull-right" id="add-new-vehicle" title="Add new vehicle" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false"><i class="glyphicon glyphicon-plus"></i> Add New Vehicle</button>
    </span><hr>
    <?php 
      $filter_options = array(
                      ['id'=>'chkbx-model', 'value'=>'model', 'text'=>' Model &nbsp;'],
                      ['id'=>'chkbx-type', 'value'=>'type', 'text'=>' Type &nbsp;'],
                      ['id'=>'chkbx-owner_name', 'value'=>'owner_name', 'text'=>' Owner Name &nbsp;'],
                      ['id'=>'chkbx-seating_capacity', 'value'=>'seating_capacity', 'text'=>' Seating Capacity &nbsp;']
                  );    
      require_once('_search.php'); 
      ?>
    </div> <!-- .col-md-8 .col-md-offset-2 -->

    <br/><br />

    <div class="col-md-10 col-md-offset-1" id="hotel_details_grid">

    <?php 
            if(empty($vehicles)) {
              $no_of_vehicles = $objHotel->getHotels($search_string, true);              
              $pages = new Paginator($no_of_vehicles,9,array(15,3,6,9,12,25,50,100,250,'All'));
              $vehicles = $objVehicle->getPagedVehicles(null, $pages->limit_start, $pages->limit_end);
            }    
    ?>
      <div class="row">
        <div class="col-lg-8"><?= $pages->display_pages()?></div>
        <div class="col-lg-4 text-right"><span class=""><?= $pages->display_jump_menu().$pages->display_items_per_page()?></span></div>
      </div><br />
 
      <table class="table table-condensed table-hover" id="vehicle_details_table">
        <thead>
          <tr>
            <th>Model</th>
            <th>Year</th>
            <th>Seating Capacity</th>
            <th>Owner Name</th>
            <th>Contact Nos.</th>
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
