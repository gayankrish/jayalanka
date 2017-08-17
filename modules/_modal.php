<?php

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

if (!isset($tab1_title)) {
  $tab1_title = 'Basic Info';
}

if (!isset($tab2_title)) {
  $tab2_title = 'Additional Info';
}



echo '<!-- Main Modal - Start-->';
echo '<div id="myModal" class="modal fade" role="dialog" data-backdrop="static">';
  echo '<div class="modal-dialog modal-xl">';
    echo '<!-- Modal content-->';
    echo '<div class="modal-content">';
      echo '<div class="modal-header">';
        echo '<button type="button" class="close" data-dismiss="modal">&times;</button>';
        echo '<h4 class="modal-title">'.$modal_title.'</h4>';
      echo '</div> <!-- .modal-header -->';
      echo '<div class="modal-body">';
          echo '<div class="panel with-nav-tabs panel-default">';
            echo '<div class="panel-heading">';
              echo '<ul class="nav nav-tabs">';
                echo '<li role="presentation" class="active"><a href="#basic-info" data-toggle="tab">'.$tab1_title.'</a></li>';
                echo '<li role="presentation"><a href="#additional-info" data-toggle="tab">'.$tab2_title.'</a></li>';
              echo '</ul>';
            echo '</div> <!-- .panel-heading -->';
            echo '<div class="panel-body">';
              echo '<!-- <div class="tab-content"> -->';
                echo '<form class="tab-content" method="post" enctype="multipart/form-data" id="hotel_info">';
                  echo '<div class="tab-pane fade in active" id="basic-info">';
                    echo '<div class="row">';
                      echo '<div class="col-md-8">';
                        echo '<div class="col-md-12 col-sm-12">';
                   
                            $objFormBuilder = new FormBuilder();
                            $basic_grps = $objFormBuilder->createBasicInfo($main_table, $mode, $record_id);
                            echo $basic_grps;
        
                        echo '</div> <!-- .col-md-12 .col-sm-12 -->';
                      echo '</div> <!-- .col-md-8 -->';

                      if( $image_upload_required ){
                        echo '<div class="col-md-4">';
                            echo '<div class="col-md-12">';
                            echo '<div class="image-preview">';
                            echo '</div> <!-- .image-preview -->';
                            echo '</div>';
                            echo '<div class="file_uploder">';
                                echo '<label class="btn btn-info" onclick="$(\'#img_uploader\').click();"><i class="glyphicon glyphicon-upload"></i> Add Images</label>';
                                echo '<input type="file" id="img_uploader" name="img_files[]" accept=".jpg,.jpeg,.png" style="display:none;" multiple />';
                            echo '</div>';
                                echo '<!-- <br><button class="btn btn-default" id="btnImgUpload"><i class="glyphicon glyphicon-upload"></i> Upload</button> -->';
                        echo '</div> <!-- .col-md-4 -->';
                      }
                    echo '</div> <!-- .row -->';
                    echo '<div id="save_status" class="alert" role="alert"></div>';
                  echo '</div> <!-- .tab-pane .fade .in .active -->';
                  echo '<div class="tab-pane fade in" id="additional-info">';
                    echo '<div class="row">';
                      echo '<div class="col-md-8">';
                        echo '<div class="col-md-12 col-sm-12">';

                            //$objFormBuilder = new FormBuilder();
                            $additional_grps = $objFormBuilder->createAdditionalInfo($main_table);
                            echo $additional_grps;

                            $special_grps = $objFormBuilder->createSpecials($main_table);
                            echo $special_grps;

                        echo '</div> <!-- .col-md-12 .col-sm-12 -->';
                      echo '</div> <!-- .col-md-8 -->';

                      if( $map_required ) {
                        echo '<div class="col-md-4">';
                            echo '<div class="col-md-12">';
                            echo '<div class="location_map">';
                            echo '</div> <!-- .location_map -->';
                            echo '</div> <!-- .col-md-12 -->';
                        echo '</div> <!-- .col-md-4 -->';
                      }
                    echo '</div> <!-- .row -->';
                    echo '<div id="save_status" class="alert" role="alert"></div>';
                  echo '</div> <!-- .tab-pane .fade .in -->';
                echo '</form>';
              echo '<!-- </div> --> <!-- .tab-content -->';
            echo '</div> <!-- .panel-body -->';
          echo '</div> <!-- .panel .with-nav-tabs .panel-default -->';
      echo '</div> <!-- .modal-body -->';
      echo '<div class="modal-footer">';
                      
        if ( $close_button_required ) {
            echo '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
        }

        if ( $edit_button_required ) {
            echo '<button class="btn btn-primary" id="cancel">Cancel</button>';
            echo '<button class="btn btn-primary" id="main_modal_edit_button">Edit</button>';
        }

        if ( $save_button_required ) {
            echo '<button class="btn btn-primary" id="main_modal_save_button">Save</button>';
        }
      echo '</div> <!-- .modal-footer -->';
    echo '</div> <!-- .modal-content -->';
  echo '</div> <!-- .modal-dialog .modal-xl -->';
echo '</div> <!-- .modal .fade -->';
echo '<!-- Main Modal - End -->'
?>