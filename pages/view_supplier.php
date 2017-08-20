<?php

require_once('_header.php');
  
Url::getAll();
$params = Url::$_params;

$supplier = $params['supplier'];
$supplier_name = $params['name'];
$supplier_id = $params['id'];
$save_status = (!empty($params['status'])?$params['status'] : "");

require_once('_supplier_params.php');

?>

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1 pull-left">
        <span>
            <h1 class="pageheader"><?= $arr_classes[$supplier].': '.$supplier_name; ?></h1>
        </span><hr>

        <!--  -->
        <div class="panel with-nav-tabs panel-default">
            <div class="panel-heading">
                <ul class="nav nav-tabs">
                    <li role="presentation" class="active"><a href="#basic-info" data-toggle="tab">Basic Info</a></li>
                    <li role="presentation"><a href="#additional-info" data-toggle="tab">Additional Info</a></li>
                </ul>
            </div> <!-- .panel-heading -->
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="basic-info">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="col-md-12 col-sm-12">

                                    <?php
                                        $class = $arr_classes[$supplier];
                                        $objSupplier = new $class();
                                        $func = 'get'.$arr_classes[$supplier].'ById';
                                        $supplier_details = $objSupplier->$func($supplier_id);
                                        //var_dump($supplier_details);
                                        $objFormFactory = new FormFactory();
                                        $basic_info = $objFormFactory->createSupplierDetailsForm($supplier, $supplier_details, 'view', 1);
                                        echo $basic_info;
                                    ?>

                                </div> <!-- .col-md-12 .col-sm-12 -->
                            </div> <!-- .col-md-8 -->


                            <div class="col-md-4">
                                <div class="col-md-12">
                                    <div class="image-preview">

                                        <?php
                                            switch ($supplier) {
                                                case 'hotel':
                                                  $img_dir = HOTEL_IMG_PATH.'/'.$supplier_id;
                                                  break;
                                            
                                                case 'vehicle':
                                                  $img_dir = VEHICLE_IMG_PATH.'/'.$supplier_id;
                                                  break;
                                            
                                                case 'shop':
                                                  $img_dir = SHOP_IMG_PATH.'/'.$supplier_id;
                                                  break;
                                            
                                                case 'restaurant':
                                                  $img_dir = RESTAURANT_IMG_PATH.'/'.$supplier_id;
                                                  break;                              
                                            
                                                default:
                                            
                                                  break;
                                            }

                                            if(is_dir($img_dir)) {
                                                if (count(glob($img_dir."/*.jpg")) <> 0 || count(glob($img_dir."/*.jpeg")) <> 0 || count(glob($img_dir."/*.png")) <> 0) {
                                                  $images = glob($img_dir."/*.{jpg,jpeg,png}", GLOB_BRACE);
              
                                                  $img_count = 0;
                                                  foreach($images as $image) {
                                                  
                                                    $img_uri = str_replace("E:\\xampp\\htdocs\\jayalanka\\images", "http://localhost/jayalanka/images", $image);
                                                    echo '<div class="col-md-6">';
                                                    echo '<img src="'.$img_uri.'" class="thumbnail img-thumbnail" id="img-thumbnail'.($img_count+1).'" name="'.($img_count+1).'" onclick="imgClicked(this)">';
                                                    echo '</div>';
                                                    $img_count ++;
                                                  }
                                                }
                                              }                                            

                                        ?>

                                    </div> <!-- .image-preview -->
                                </div> <!-- .col-md-12 -->
                            </div> <!-- .col-md-4 -->
<!--                             } -->
                        </div> <!-- .row -->
                        <div id="save_status" class="alert" role="alert"></div>
                        </div> <!-- .tab-pane .fade .in .active -->
                        <div class="tab-pane fade in" id="additional-info">
                          <div class="row">
                            <div class="col-md-8">
                              <div class="col-md-12 col-sm-12">

<!--                                   //$objFormBuilder = new FormBuilder();
                                  $additional_grps = $objFormBuilder->createAdditionalInfo($main_table, $mode, $record_id);
                                  $html .= $additional_grps;

                                  $special_grps = $objFormBuilder->createSpecials($main_table, $mode, $record_id);
                                  $html .= $special_grps;
                                  
 -->    
                                <?php
                                    $additional_info = $objFormFactory->createSupplierDetailsForm($supplier, $supplier_details, 'view', 2);
                                    echo $additional_info;
                                ?>
                              </div> <!-- .col-md-12 .col-sm-12 -->
                            </div> <!-- .col-md-8 -->

<!--                             if( $map_required ) { -->
                              <div class="col-md-4">
                                  <div class="col-md-12">
                                  <div class="location_map">
                                  </div> <!-- .location_map -->
                                  </div> <!-- .col-md-12 -->
                              </div> <!-- .col-md-4 -->
<!--                             } -->
                          </div> <!-- .row -->

                    </div> <!-- .tab-pane .fade .in -->
                </div> <!-- .tab-content -->
                <?php if($save_status === 'success') {?>
                          <div id="save_status" class="alert alert-success" role="alert"><strong>Successfully saved!</strong></div>
                         <?php } elseif ($save_status === 'failed') {?>
                            <div id="save_status" class="alert alert-danger" role="alert"><strong>Save failed!</strong></div>
                         <?php } ?>
            </div> <!-- .panel-body -->
            <a href="<?= SITE_URL ?>/?page=edit_supplier&supplier=<?= $supplier;?>&name=<?= $supplier_name;?>&id=<?=$supplier_id;?>" class="btn btn-primary pull-right">Edit</a>
            <button class="btn btn-default" onclick="goBack()">Go Back</button>
        </div> <!-- .panel .with-nav-tabs .panel-default -->

        <!--  -->


    </div> <!-- .row -->
</div> <!-- .container-fluid -->

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

<?php require_once('_header.php'); ?>
