<?php
//require_once('_supplier_params.php');
class FormFactory extends Application {

    private $arr_ref_data = array('hotel'=> array('country' => array('class'=>'Country', 'method'=>'getCountries'),
                                  'hotel_type' => array('class'=>'Hotel', 'method'=>'getHotelTypes'),
                                  'chain_type' => array('class'=>'Hotel', 'method'=>'getHotelChains')));
        
    private $_table = 'internal_columns';
//    private $arr_ref_data;
  


    public function getColumnDetails($table = null) {
        if(!empty($table)) {
            $sql = "SELECT * FROM `{$this->_table}` WHERE `table_name`='{$table}' AND `display` = 1 ORDER BY `display_order` ASC";
            return $this->db->fetchAll($sql);
        }
    }

    public function createSupplierDetailsForm($supplier_type, $arr_data, $display_mode = null, $type = null) { 
        // display_mode: view | edit | new 
        // type: 1 (Basic Info) |  2 (Additional Info)

        if(!empty($display_mode)) {

            $element = '';

            $arr_col_details = $this->getColumnDetails($supplier_type);
            

            if(!empty($arr_col_details)) {

                switch ($display_mode) {

                    case 'view':
                        $element = $this->createSupplierFormForView($supplier_type,  $arr_col_details, $arr_data, $type);
                        break;

                    case 'edit':
                        $element = $this->createSupplierFormForEdit($supplier_type,  $arr_col_details, $arr_data, $type);
                        break;

                    case 3:

                        break;
                    
                    default:
                        # code...
                        break;
                }

            }

            return $element;

        }
    }

    public function createSupplierFormForView($supplier, $col_details, $data, $type) {

        $html = '';

        foreach ($col_details as $col_detail) {
            if ( $col_detail['display_type'] == $type ) {
                $html .= '<div class="form-group col-md-6 col-sm-6 text-left">';
                    $html .= '<div class="col-md-4 text-right"><label>'.$col_detail['comment'].'</label></div>';
                    $html .= '<div class="col-md-8">'.$data[$col_detail['column_name']].'</div><hr>';
                $html .= '</div> <!-- .form-group col-md-6 col-sm-6 text-left-->';
            }
        }

        return $html;



    }

    public function createSupplierFormForEdit($supplier, $col_details, $data, $type) {

        $html = '';
        
        foreach ($col_details as $col_detail) {

            $ref_data = null;
            if ( $col_detail['display_type'] == $type ) {
                $html .= '<div class="form-group col-md-6 col-sm-6 text-left">';
                    $html .= '<div class="col-md-4 text-right"><label for="'.$col_detail['column_name'].'">'.$col_detail['comment'].'</label></div>';

                    if( $col_detail['reference_table'] == "" && ($col_detail['data_type'] == 'int' || $col_detail['data_type'] =='varchar')) {
                        $html .= '<div class="col-md-8"><input type="text" name="'.$col_detail['column_name'].'" class="form-control" id="'.$col_detail['column_name'].'" value="'.$data[$col_detail['column_name']].'"></div><hr>';
                    } elseif ($col_detail['reference_table'] !== "" ) {

                        $ref_table = $col_detail['reference_table'];
                        $ref_col = $col_detail['reference_column'];
                        
                        
                        $class = $this->arr_ref_data[$supplier][$ref_table]['class'];
                        $func = $this->arr_ref_data[$supplier][$ref_table]['method'];

                        $objRef = new $class;
                        $ref_data = $objRef->$func();

                        $html .= '<select id="'.$col_detail['column_name'].'" name="'.$col_detail['column_name'].'" class="selectpicker form-control" data-live-search="true" title="Please select..." data-size="10" data-live-search-placeholder="Search..." >';
                            
                        foreach ($ref_data as $ref) {
                            $html .= '<option value="'.$ref['id'].'"'.(($ref[$ref_col] == $data[$col_detail['column_name']])? " selected":"").'>'.$ref[$ref_col].'</option>';
                        }
                        $html .= '</select>';                        

                    }
                    
                $html .= '</div> <!-- .form-group col-md-6 col-sm-6 text-left-->';
            }            
        }

        return $html;

    }


    public function createSupplierFormForNew($type, $col_details) {

    }

}
?>