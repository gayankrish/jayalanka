<?php
require_once('../include/autoload.php');

/**
*
* Required values:
*
* $modal_title: string
* $tab1_title: string
* $tab2_title: string
* $main_table: string
* $mode: string - 'view' | 'edit' | 'new'
* $record_id: string
* $image_upload_required: boolean
* $map_required: boolean
* $close_button_required: boolean
* $edit_button_required: boolean
* $save_button_required: boolean
* 
*/

if(isset($_GET)) {

  $modal_title = $_GET['modal_title'];
  $tab1_title = (isset($_GET['tab1_title'])? $_GET['tab1_title'] : null);
  $tab2_title = (isset($_GET['tab2_title'])? $_GET['tab2_title'] : null);
  $main_table = $_GET['main_table'];
  $mode = $_GET['mode'];
  $record_id = $_GET['record_id'];
  $image_upload_required = $_GET['image_upload_required'];
  $map_required = $_GET['map_required'];
  $close_button_required = $_GET['close_button_required'];
  $edit_button_required = $_GET['edit_button_required'];
  $save_button_required  = $_GET['save_button_required'];

  if($image_upload_required == 'true') { $image_upload_required = true; }
  else { $image_upload_required = false; }

  if($map_required == 'true') { $map_required = true; }
  else { $map_required = false; }

  if($close_button_required == 'true') { $close_button_required = true; }
  else { $close_button_required = false; }

  if($edit_button_required == 'true') { $edit_button_required = true; }
  else { $edit_button_required = false; }

  if($save_button_required == 'true') { $save_button_required = true; }
  else { $save_button_required = false; }


  if (!isset($tab1_title)) {
    $tab1_title = 'Basic Info';
  }

  if (!isset($tab2_title)) {
    $tab2_title = 'Additional Info';
  }

  switch ($mode) {
    case 'new':
      $img_dir = HOTEL_IMG_PATH.'/'.$record_id;
      break;

    case 'edit':
      $cancel_enabled = false;
      $save_enabled = true;
      break;
      
    case 'view':
      $cancel_enabled = false;
      $edit_enabled = true;
      $save_enabled = false;
      break;      
    
    default:
      $img_dir = HOTEL_IMG_PATH.'/'.$record_id;
      break;
  }

  $html = '';

  $html .= '<!-- Main Modal - Start-->';
  $html .= '<div id="myModal" class="modal fade" role="dialog" data-backdrop="static">';
    $html .= '<div class="modal-dialog modal-xl">';
      $html .= '<!-- Modal content-->';
      $html .= '<div class="modal-content">';
        $html .= '<div class="modal-header">';
          $html .= '<button type="button" class="close" data-dismiss="modal">&times;</button>';
          $html .= '<h4 class="modal-title">'.$modal_title.'</h4>';
        $html .= '</div> <!-- .modal-header -->';
        $html .= '<div class="modal-body">';
            $html .= '<div class="panel with-nav-tabs panel-default">';
              $html .= '<div class="panel-heading">';
                $html .= '<ul class="nav nav-tabs">';
                  $html .= '<li role="presentation" class="active"><a href="#basic-info" data-toggle="tab">'.$tab1_title.'</a></li>';
                  $html .= '<li role="presentation"><a href="#additional-info" data-toggle="tab">'.$tab2_title.'</a></li>';
                $html .= '</ul>';
              $html .= '</div> <!-- .panel-heading -->';
              $html .= '<div class="panel-body">';
                $html .= '<!-- <div class="tab-content"> -->';
                  $html .= '<form class="tab-content" method="post" enctype="multipart/form-data" id="hotel_info">';
                    $html .= '<div class="tab-pane fade in active" id="basic-info">';
                      $html .= '<div class="row">';
                        $html .= '<div class="col-md-8">';
                          $html .= '<div class="col-md-12 col-sm-12">';
                    
                              $objFormBuilder = new FormBuilder();
                              $basic_grps = $objFormBuilder->createBasicInfo($main_table, $mode, $record_id);
                              $html .= $basic_grps;
          
                          $html .= '</div> <!-- .col-md-12 .col-sm-12 -->';
                        $html .= '</div> <!-- .col-md-8 -->';
                        
                        
                        if($image_upload_required){
                         
                          $html .= '<div class="col-md-4">';
                              $html .= '<div class="col-md-12">';
                              $html .= '<div class="image-preview">';
                              $html .= '</div> <!-- .image-preview -->';
                              $html .= '</div>';
                              $html .= '<div class="file_uploder">';
                                  $html .= '<label class="btn btn-info" onclick="$(\'#img_uploader\').click();"><i class="glyphicon glyphicon-upload"></i> Add Images</label>';
                                  $html .= '<input type="file" id="img_uploader" name="img_files[]" accept=".jpg,.jpeg,.png" style="display:none;" multiple />';
                              $html .= '</div>';
                                  $html .= '<!-- <br><button class="btn btn-default" id="btnImgUpload"><i class="glyphicon glyphicon-upload"></i> Upload</button> -->';
                          $html .= '</div> <!-- .col-md-4 -->';
                        } else {
                          $html .= '<div class="col-md-4">';
                          $html .= '<div class="col-md-12">';
                          $html .= '<div class="image-preview">';
                          
                          switch ($main_table) {
                            case 'hotel':
                              $img_dir = HOTEL_IMG_PATH.'/'.$record_id;
                              break;

                            case 'vehicle':
                              $img_dir = VEHICLE_IMG_PATH.'/'.$record_id;
                              break;
                              
                            case 'shop':
                              $img_dir = SHOP_IMG_PATH.'/'.$record_id;
                              break;

                            case 'restaurant':
                              $img_dir = RESTAURANT_IMG_PATH.'/'.$record_id;
                              break;                              
                            
                            default:
                              
                              break;
                          }

                          //$img_dir = HOTEL_IMG_PATH.'/'.$record_id;
                          
                          if(is_dir($img_dir)) {
                              if (count(glob($img_dir."/*.jpg")) <> 0 || count(glob($img_dir."/*.jpeg")) <> 0 || count(glob($img_dir."/*.png")) <> 0) {
                                $images = glob($img_dir."/*.{jpg,jpeg,png}", GLOB_BRACE);

                                $img_count = 0;
                                foreach($images as $image) {
                                  
                                  $img_uri = str_replace("D:\\xampp\\htdocs\\jayalanka\\images", "http://localhost/jayalanka/images", $image);
                                  $html .= '<div class="col-md-6">';
                                  $html .= '<img src="'.$img_uri.'" class="thumbnail img-thumbnail" id="img-thumbnail'.($img_count+1).'" name="'.($img_count+1).'" onclick="imgClicked(this)">';
                                  $html .=  '</div>';
                                  $img_count ++;
                                }
                              }
                            }

                          $html .= '</div> <!-- .image-preview -->';
                          $html .= '</div>';
                          $html .= '</div> <!-- .col-md-4 -->';                          
                        }
                      $html .= '</div> <!-- .row -->';
                      $html .= '<div id="save_status" class="alert" role="alert"></div>';
                    $html .= '</div> <!-- .tab-pane .fade .in .active -->';
                    $html .= '<div class="tab-pane fade in" id="additional-info">';
                      $html .= '<div class="row">';
                        $html .= '<div class="col-md-8">';
                          $html .= '<div class="col-md-12 col-sm-12">';

                              //$objFormBuilder = new FormBuilder();
                              $additional_grps = $objFormBuilder->createAdditionalInfo($main_table, $mode, $record_id);
                              $html .= $additional_grps;

                              $special_grps = $objFormBuilder->createSpecials($main_table, $mode, $record_id);
                              $html .= $special_grps;

                          $html .= '</div> <!-- .col-md-12 .col-sm-12 -->';
                        $html .= '</div> <!-- .col-md-8 -->';

                        if( $map_required ) {
                          $html .= '<div class="col-md-4">';
                              $html .= '<div class="col-md-12">';
                              $html .= '<div class="location_map">';
                              $html .= '</div> <!-- .location_map -->';
                              $html .= '</div> <!-- .col-md-12 -->';
                          $html .= '</div> <!-- .col-md-4 -->';
                        }
                      $html .= '</div> <!-- .row -->';
                      $html .= '<div id="save_status" class="alert" role="alert"></div>';
                    $html .= '</div> <!-- .tab-pane .fade .in -->';
                  $html .= '</form>';
                $html .= '<!-- </div> --> <!-- .tab-content -->';
              $html .= '</div> <!-- .panel-body -->';
            $html .= '</div> <!-- .panel .with-nav-tabs .panel-default -->';
        $html .= '</div> <!-- .modal-body -->';
        $html .= '<div class="modal-footer">';
                        
          if ( $close_button_required ) {
              $html .= '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
          }

          if ( $edit_button_required ) {
              $html .= '<button class="btn btn-primary" id="cancel" '.(!$cancel_enabled?" disabled":"").'>Cancel</button>';
              $html .= '<button class="btn btn-primary" id="main_modal_edit_button" '.(!$edit_enabled?" disabled":"").'>Edit</button>';
          }

          if ( $save_button_required ) {
              $html .= '<button class="btn btn-primary" id="main_modal_save_button" '.(!$save_enabled?" disabled":"").'>Save</button>';
          }
        $html .= '</div> <!-- .modal-footer -->';
      $html .= '</div> <!-- .modal-content -->';
    $html .= '</div> <!-- .modal-dialog .modal-xl -->';
  $html .= '</div> <!-- .modal .fade -->';
  $html .= '<!-- Main Modal - End -->';

  echo $html;
  //var_dump($_GET);
} else {
  echo isset($_GET);
}
?>