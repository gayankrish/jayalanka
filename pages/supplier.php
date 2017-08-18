<?php
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

<?php   require_once('_footer.php'); ?>