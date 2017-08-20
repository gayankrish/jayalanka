<?php

require_once('../include/autoload.php');

if (!empty($_POST['supplier']) && !empty($_POST['id'])) {

    require_once('_supplier_params.php');

    $supplier = $_POST['supplier'];
    $id = $_POST['id'];

    $objSupplier = new $arr_classes[$supplier]();
    $func = 'delete'.$arr_classes[$supplier];
    $result = $objSupplier->$func($id);
    //echo 'result: '.$result;
    //return $objSupplier->$func($id);
    echo $result;

} else {
    return false;
}
?>