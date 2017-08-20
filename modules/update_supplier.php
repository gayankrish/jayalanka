<?php

require_once('../include/autoload.php');

if (isset($_POST['supplier']) && !empty($_POST['supplier'])) {

    require_once('_supplier_params.php');

    $class = $arr_classes[$_POST['supplier']];
    $func = 'update'.$class;

    $id = $_POST['id'];
    unset($_POST['id']);
    unset($_POST['supplier']);
    $params = $_POST;

    $objSupplier = new $class;
    $result = $objSupplier->$func($id, $params);

    var_dump($result);

}


?>