<?php
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
                    


$search_string = '';
$search_placeholder = null;
if ($objForm->isPost('search-box') && !empty($objForm->getPost('search-box'))) {
    $search_query = $objForm->getPost('search-box');

    unset($_POST['search-box']);
    $search_placeholder = 'Search results for: '.$search_query;
    $post = $_POST;
    
   
    
      foreach ($post as $key => $value) {
      $search_string .= "`".$value . "` LIKE '%" . $search_query . "%' OR ";
    }
    $search_string = substr($search_string, 0, strlen($search_string)-3);  
  }
 
/*  elseif ($_GET) {
  $search_query = Url::getParam('search-box');
  echo '$_GET';
} */

$suppliers = array();
if(!empty($search_string)) {
  $func = 'get'.$arr_classes[$supplier].'s';
  $no_of_suppliers = $objSupplier->$func($search_string, true);

  $func = 'getPaged'.$arr_classes[$supplier].'s';
  $pages = new Paginator($no_of_suppliers,9,array(15,3,6,9,12,25,50,100,250,'All'));
  $suppliers = $objSupplier->$func($search_string, $pages->limit_start, $pages->limit_end);
}
?>