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
  if ($objForm->isPost('search-box') && !empty($objForm->getPost('search-box'))) {
    $search_query = $objForm->getPost('search-box');
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
    <form action="" method="post" class="form-horizontal" role="form">
      <div class="input-group" id="adv-search">
      
        <input type="text" class="form-control" id="search-box" name="search-box" placeholder="Search for hotels" />
        <div class="input-group-btn">
          <div class="btn-group">
            <div class="dropdown dropdown-lg">
              <button type="button" id="dropdown-btn" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filters <span class="caret"></span></button>
                          
              <!-- Dropdow menu start -->
              <div class="dropdown-menu dropdown-menu-right" role="menu">
                
                  <div class="form-group">
                    <label for="filter">Filter by</label>
                    <div class="form-inline">
                      <div class="checkbox">
                        <label for="chkbx-display_name">
                          <input type="checkbox" id="chkbx-display_name" name="chkbx-display_name" value="display_name"> Name &nbsp;
                        </label>
                      </div> <!-- .checkbox -->
                      <div class="checkbox">
                        <label for="chkbx-location">
                          <input type="checkbox" id="chkbx-location" name="chkbx-location" value="location"> Location &nbsp;
                        </label>
                      </div> <!-- .checkbox -->
                      <div class="checkbox">
                        <label for="chkbx-rank">
                          <input type="checkbox" id="chkbx-rank" name="chkbx-rank" value="rank"> Rating &nbsp;
                        </label>
                      </div> <!-- .checkbox -->
                      <div class="checkbox">
                        <label for="chkbx-available_facilities">
                          <input type="checkbox" id="chkbx-available_facilities" name="chkbx-available_facilities" value="available_facilities"> Facilities &nbsp;
                        </label>
                      </div> <!-- .checkbox -->
                    </div> <!-- .form-inline -->
                  </div> <!-- .form-group -->
                  <button type="submit" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                
              </div> <!-- .dropdown-menu .dropdown-menu-right -->
              <!-- Dropdow menu end -->
            </div> <!-- dropdown dropdown-lg -->
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
          </div> <!-- .btn-group -->
        </div> <!-- .input-group-btn -->
      </div> <!-- .input-group -->
      </form>
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
                  echo '<td>'.$hotel['display_name'].'</td>';
                  echo '<td>'.$hotel['city'].', '.$country['country_name'].'</td>';
                  echo '<td>'.Helper::formatString($hotel['contact_nos'], 'phone').'</td>';
                  echo '<td>'.$hotel['rank'].'</td>';
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

<div id="myModal" class="modal fade" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-xl">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Hotel</h4>
      </div> <!-- .modal-header -->
      <div class="modal-body">

          <div class="panel with-nav-tabs panel-default">
            <div class="panel-heading">

              <ul class="nav nav-tabs">
                <li role="presentation" class="active"><a href="#basic-info" data-toggle="tab">Basic Info</a></li>
                <li role="presentation"><a href="#additional-info" data-toggle="tab">Additional Info</a></li>
              </ul>

            </div> <!-- .panel-heading -->
            <div class="panel-body">
              <!-- <div class="tab-content"> -->
                <form class="tab-content" method="post" enctype="multipart/form-data" id="hotel_info">
                  <div class="tab-pane fade in active" id="basic-info">
                    <div class="row">
                      <div class="col-md-8">
                        <div class="col-md-12 col-sm-12">
                          <?php
                            $objFormBuilder = new FormBuilder();
                            $basic_grps = $objFormBuilder->createBasicInfo('hotel');
                            echo $basic_grps;
                          ?>
                        </div> <!-- .col-md-12 .col-sm-12 -->
                      </div> <!-- .col-md-8 -->

                      <div class="col-md-4">
                        <div class="col-md-12">
                          <div class="image-preview">
                            
                          </div> <!-- .image-preview -->
                        </div> 
                          <div class="file_uploder">
                            <label class="btn btn-info" onclick="$('#img_uploader').click();"><i class="glyphicon glyphicon-upload"></i> Add Images</label> 
                              <input type="file" id="img_uploader" name="img_files[]" accept=".jpg,.jpeg,.png" style="display:none;" multiple /> 

                          </div>
                            <!-- <br><button class="btn btn-default" id="btnImgUpload"><i class="glyphicon glyphicon-upload"></i> Upload</button> -->
                      </div> <!-- .col-md-4 -->
                      
                    </div> <!-- .row -->
                    <div id="save_status" class="alert" role="alert"></div>
                  </div> <!-- .tab-pane .fade .in .active -->
                  <div class="tab-pane fade in" id="additional-info">
                    <div class="row">
                      <div class="col-md-8">
                        <div class="col-md-12 col-sm-12">
                          <?php
                            $objFormBuilder = new FormBuilder();
                            $additional_grps = $objFormBuilder->createAdditionalInfo('hotel');
                            echo $additional_grps;

                            $special_grps = $objFormBuilder->createSpecials('hotel');
                            echo $special_grps;
                          ?>
                        </div> <!-- .col-md-12 .col-sm-12 -->
                      </div> <!-- .col-md-8 -->

                      <div class="col-md-4">
                        <div class="col-md-12">
                          <div class="location_map">
  
                          </div> <!-- .location_map -->
                        </div> <!-- .col-md-12 -->

                            <!-- <br><button class="btn btn-default" id="btnImgUpload"><i class="glyphicon glyphicon-upload"></i> Upload</button> -->
                      </div> <!-- .col-md-4 -->
                      
                    </div> <!-- .row -->
                    <div id="save_status" class="alert" role="alert"></div>
                  </div> <!-- .tab-pane .fade .in -->
                </form>
              <!-- </div> --> <!-- .tab-content -->
            </div> <!-- .panel-body -->
          </div> <!-- .panel .with-nav-tabs .panel-default -->
      </div> <!-- .modal-body -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button><button class="btn btn-primary" id="save_hotel">Save</button>
      </div> <!-- .modal-footer -->
    </div> <!-- .modal-content -->

  </div> <!-- .modal-dialog .modal-xl -->
</div> <!-- .modal .fade -->

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
