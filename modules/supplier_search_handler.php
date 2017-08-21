<?php
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 10383c33ab6fd2e043636cd35e9fe7a16f4dadeb
$search_options = array();
$search_options['name'] = $arr_page_titles[$supplier];
$filter_options = array(
                    'vehicle'=>array(
                      1 => array('id'=>'chkbx-model', 'value'=>'model', 'text'=>' Model &nbsp;'),
                      2 => array('id'=>'chkbx-type', 'value'=>'type', 'text'=>' Type &nbsp;'),
                      3 => array('id'=>'chkbx-owner_name', 'value'=>'owner_name', 'text'=>' Owner Name &nbsp;'),
                      4 => array('id'=>'chkbx-seating_capacity', 'value'=>'seating_capacity', 'text'=>' Seating Capacity &nbsp;')),
                    'hotel'=>array(
                      1 => array('id'=>'chkbx-display_name', 'value'=>'display_name', 'text'=>' Name &nbsp;'),
                      2 => array('id'=>'chkbx-location', 'value'=>'location', 'text'=>' Location &nbsp;'),
                      3 => array('id'=>'chkbx-rank', 'value'=>'rank', 'text'=>' Rating &nbsp;'),
                      4 => array('id'=>'chkbx-available_facilities', 'value'=>'available_facilities', 'text'=>' Facilities &nbsp;')),
                    'guide'=>array(
                      1 => array('id'=>'chkbx-name', 'value'=>'name', 'text'=>' Name &nbsp;'),
                      2 => array('id'=>'chkbx-type', 'value'=>'type', 'text'=>' Type &nbsp;'),
                      3 => array('id'=>'chkbx-languages', 'value'=>'languages', 'text'=>' Languages &nbsp;'),
                      4 => array('id'=>'chkbx-gender', 'value'=>'gender', 'text'=>' Gender &nbsp;')),
                    'restaurant'=>array(
                      1 => array('id'=>'chkbx-name', 'value'=>'name', 'text'=>' Name &nbsp;'),
                      2 => array('id'=>'chkbx-location', 'value'=>'location', 'text'=>' Location &nbsp;'),
                      3 => array('id'=>'chkbx-type', 'value'=>'type', 'text'=>' Type &nbsp;')),
                    'shop'=>array(
                      1 => array('id'=>'chkbx-name', 'value'=>'name', 'text'=>' Name &nbsp;'),
                      2 => array('id'=>'chkbx-chain', 'value'=>'chain', 'text'=>' Chain &nbsp;'),
                      3 => array('id'=>'chkbx-location', 'value'=>'location', 'text'=>' Location &nbsp;'),
                      4 => array('id'=>'chkbx-type', 'value'=>'type', 'text'=>' Type &nbsp;')),
                    'activity_vendor'=>array(
                      1 => array('id'=>'chkbx-name', 'value'=>'name', 'text'=>' Name &nbsp;'),
                      2 => array('id'=>'chkbx-type', 'value'=>'type', 'text'=>' Type &nbsp;'),
                      3 => array('id'=>'chkbx-location', 'value'=>'location', 'text'=>' Location &nbsp;'))
                    );
                    

<<<<<<< HEAD
=======
=======

$filter_options = array('vehicle'=>array('id'=>'chkbx-model', 'value'=>'model', 'text'=>' Model &nbsp;')
   
    ['id'=>'chkbx-type', 'value'=>'type', 'text'=>' Type &nbsp;'],
    ['id'=>'chkbx-owner_name', 'value'=>'owner_name', 'text'=>' Owner Name &nbsp;'],
    ['id'=>'chkbx-seating_capacity', 'value'=>'seating_capacity', 'text'=>' Seating Capacity &nbsp;']
);
>>>>>>> 5a70be98afc8ed46b81122c60a7e9cc0e04e9d5c
>>>>>>> 10383c33ab6fd2e043636cd35e9fe7a16f4dadeb

$search_string = '';
$search_placeholder = null;
if ($objForm->isPost('search-box') && !empty($objForm->getPost('search-box'))) {
    $search_query = $objForm->getPost('search-box');
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 10383c33ab6fd2e043636cd35e9fe7a16f4dadeb

    unset($_POST['search-box']);
    $search_placeholder = 'Search results for: '.$search_query;
    $post = $_POST;
    
   
    
      foreach ($post as $key => $value) {
      $search_string .= "`".$value . "` LIKE '%" . $search_query . "%' OR ";
    }
    $search_string = substr($search_string, 0, strlen($search_string)-3);  
  }
 
/*  elseif ($_GET) {
<<<<<<< HEAD
=======
=======
    $search_placeholder = 'Search results for: '.$search_query;
    $post = $_POST;

    foreach ($post as $key => $value) {

    
        if(strpos($key, 'chkbx-') !== FALSE) {

          switch ($key) {
            case 'chkbx-model':

                $tmp_search_str = "`model` LIKE '%".$search_query."%'";
                $search_models = $objVehicle->getVehicleModels($tmp_search_str);

                if(!empty($search_models)) { // records found in facility table
                  $tmp_str = '';
                  foreach ($search_models as $search_model) {
                    $tmp_str .= $search_model['id'].',';
                  }
                  $tmp_str = substr($tmp_str, 0, strlen($tmp_str)-1); 
                  $search_string .= "`".$value . "` LIKE '%" . $tmp_str . "%' OR ";
                  continue;
                } else { // no records found in facility table
                  $search_string .= "`".$value . "` LIKE '%" . $search_query . "%' OR ";
                  continue;
                }

              break;

              case 'chkbx-type':
            
                $tmp_search_str = "`type` LIKE '%".$search_query."%'";
                $search_types = $objVehicle->getVehicleTypes($tmp_search_str);

                if(!empty($search_types)) { // records found in facility table
                  $tmp_str = '';
                  foreach ($search_types as $search_type) {
                    $tmp_str .= $search_type['id'].',';
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
>>>>>>> 5a70be98afc8ed46b81122c60a7e9cc0e04e9d5c
>>>>>>> 10383c33ab6fd2e043636cd35e9fe7a16f4dadeb
  $search_query = Url::getParam('search-box');
  echo '$_GET';
} */

<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 10383c33ab6fd2e043636cd35e9fe7a16f4dadeb
$suppliers = array();
if(!empty($search_string)) {
  $func = 'get'.$arr_classes[$supplier].'s';
  $no_of_suppliers = $objSupplier->$func($search_string, true);

  $func = 'getPaged'.$arr_classes[$supplier].'s';
  $pages = new Paginator($no_of_suppliers,9,array(15,3,6,9,12,25,50,100,250,'All'));
  $suppliers = $objSupplier->$func($search_string, $pages->limit_start, $pages->limit_end);
}
<<<<<<< HEAD
?>
=======
?>
=======
$vehicles = array();
if(!empty($search_string)) {
  $no_of_vehicles = $objVehicle->getVehicles($search_string, true);

  $pages = new Paginator($no_of_vehicles,9,array(15,3,6,9,12,25,50,100,250,'All'));
  $vehicles = $objHotel->getPagedVehicles($search_string, $pages->limit_start, $pages->limit_end);
?>

>>>>>>> 5a70be98afc8ed46b81122c60a7e9cc0e04e9d5c
>>>>>>> 10383c33ab6fd2e043636cd35e9fe7a16f4dadeb
