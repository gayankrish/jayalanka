<?php
<<<<<<< HEAD
require_once('_header.php');
Url::getAll();
$params = Url::$_params;
$supplier = $params['supplier'];

require_once('_supplier_params.php');
$objSupplier = new $arr_classes[$supplier];
$objForm = new Form();
require_once('supplier_search_handler.php');
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1 pull-left">
      <span>
        <h1 class="pageheader"><?= $arr_page_titles[$supplier]; ?></h1><button class="btn btn-success btn-xs pull-right" id="add-new-"<?= $supplier;?> title="Add new "<?= $supplier;?> data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false"><i class="glyphicon glyphicon-plus"></i> Add New <?= $arr_classes[$supplier]?></button>
      </span><hr>

      <?php  require_once('_supplier_search.php'); ?>

      <div class="row">
        <div class="col-sm-12" id="<?= $supplier ?>_details_grid">

          <?php 
            if(empty($suppliers)) {
              $func = 'get'.$arr_classes[$supplier].'s';
              $no_of_suppliers = $objSupplier->$func($search_string, true);
              $pages = new Paginator($no_of_suppliers,9,array(15,3,6,9,12,25,50,100,250,'All'));
              $func = 'getPaged'.$arr_classes[$supplier].'s';
              $suppliers = $objSupplier->$func(null, $pages->limit_start, $pages->limit_end);
            }    
          ?>

          <div class="row">
            <div class="col-sm-8"><?= $pages->display_pages()?></div>
            <div class="col-sm-4 text-right"><span class=""><?= $pages->display_jump_menu().$pages->display_items_per_page()?></span></div>
          </div><!-- .row --><br />

          <table class="table table-condensed table-hover" id="<?= $supplier ?>_details_table">
            <thead>
              <tr>
                <?php
                  foreach ($arr_table_headings[$supplier] as $key => $value) {
                    echo '<th '.(($value=='Actions')? 'class="text-center"':'').'>'.$value.'</th>';
                  }
                ?>
              </tr>
            </thead>
            <tbody>
              <?php 

                  if(!empty($suppliers)) {
                    foreach ($suppliers as $asupplier) {
                      echo '<tr>';
                      foreach ( $arr_table_headings[$supplier] as $key => $value ) {
                        if ($key !== 'actions') {
                          echo '<td>'.$asupplier[$key].'</td>';
                        } else {
                          //echo '<td>'.$actions.'</td>';
                          $new_actions = str_replace('%record_id%', $asupplier['id'], $actions);
                          $new_actions = str_replace('%supplier_type%', $supplier, $new_actions);
                          $new_actions = str_replace('%supplier_name%', $asupplier['display_name'], $new_actions);
                          $new_actions = str_replace('%supplier%', $supplier, $new_actions);
                          echo $new_actions;
                        }
                      }
                      echo '</tr>';
                    }
                  }
                
              ?>
            </tbody>
          </table>
        </div> <!-- .col-sm-12 -->
      </div> <!-- .row -->
      <div class="row">
        <div class="col-lg-8"><?= $pages->display_pages() ?></div>
      </div> <!-- .row -->
    </div> <!-- .col-sm-10 .col-sm-offset-1 .pull-left -->

    <!-- Delete Supplier Modal -->
    <div id="delete-supplier-modal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Delete Record</h4>
          </div>
          <div class="modal-body">
                  <input type="hidden" id="modal_supplier_name">
                  <input type="hidden" id="modal_supplier">
                  <input type="hidden" id="modal_supplier_id">
            <p>Are you sure you want to delete the record: <span class="supplier-name"></span>?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger delete-confirm">Yes</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          </div>
        </div>

      </div>
    </div>
    <!-- Delete Supplier Modal -->

  </div> <!-- .row -->
</div> <!-- .container-fluid -->
=======
  require_once('_header.php');

  Url::getAll();
  $params = Url::$_params;

  $supplier = $params['supplier'];

  $arr_classes = array('hotel'=>'Hotel', 'guide'=>'Guide', 
                       'vehicle'=>'Vehicle', 'restaurant'=>'Restaurant',
                       'shop'=>'Shop', 'activity_providers' => 'ActivityProvider');

  $objSupplier = new $arr_classes($supplier);
  $objForm = new Form();

  

?>
>>>>>>> 5a70be98afc8ed46b81122c60a7e9cc0e04e9d5c

<?php   require_once('_footer.php'); ?>