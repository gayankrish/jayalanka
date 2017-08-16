<?php
require_once('../include/autoload.php');

if (isset($_POST['id'])) {
  $out = array();
  $id = $_POST['id'];

  $objCat = new Menu();
  $cat = $objCat->getParentMenuItem($id);
  $tbl_subcat = $cat['children_tbl'];
  $subcats = $objCat->getChildren($tbl_subcat);

  if (!empty($subcats)) {
    foreach ($subcats as $subcat) {
      $out[$subcat['id']] = $subcat['topic'];
    }
    echo json_encode($out);
  }
}

?>
