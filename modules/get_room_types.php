<?php
require_once('../include/autoload.php');

/* if (isset($_POST['id'])) {
  $out = array();
  $id = $_POST['id']; */

  $objHotel = new Hotel();
  $roomtypes = $objHotel->getRoomTypes();

  if (!empty($roomtypes)) {
/*     foreach ($roomtypes as $roomtype) {
      $out['id'] = $roomtype['topic'];
    } */
    echo json_encode($roomtypes);
  }

?>
