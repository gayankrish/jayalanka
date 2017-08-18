<?php

$filter_options = array('vehicle'=>array('id'=>'chkbx-model', 'value'=>'model', 'text'=>' Model &nbsp;')
   
    ['id'=>'chkbx-type', 'value'=>'type', 'text'=>' Type &nbsp;'],
    ['id'=>'chkbx-owner_name', 'value'=>'owner_name', 'text'=>' Owner Name &nbsp;'],
    ['id'=>'chkbx-seating_capacity', 'value'=>'seating_capacity', 'text'=>' Seating Capacity &nbsp;']
);

$search_string = '';
$search_placeholder = null;
if ($objForm->isPost('search-box') && !empty($objForm->getPost('search-box'))) {
    $search_query = $objForm->getPost('search-box');
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
  $search_query = Url::getParam('search-box');
  echo '$_GET';
} */

$vehicles = array();
if(!empty($search_string)) {
  $no_of_vehicles = $objVehicle->getVehicles($search_string, true);

  $pages = new Paginator($no_of_vehicles,9,array(15,3,6,9,12,25,50,100,250,'All'));
  $vehicles = $objHotel->getPagedVehicles($search_string, $pages->limit_start, $pages->limit_end);
?>

