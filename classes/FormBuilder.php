<?php

    class FormBuilder extends Application {

        private $_table = "internal_formbuilder";

        public function getColumnProperties($table = null, $type = 1 ) {

            if(!empty($table)) {
                $sql = "SELECT `column_properties` FROM `{$this->_table}` WHERE `table_name`='{$table}' AND `info_type`={$type} ORDER BY `sort_order` ASC"; 
                return $this->db->fetchAll($sql);
            }
            

        }

        public function createBasicInfo($table, $mode = null, $record = null) {

                switch ($mode) {
                    case 'new':

                        $html = '';
                    
                              if(!empty($table)) {
                                  $json_default_groups = $this->getColumnProperties($table, 1);
                  
                                  foreach ($json_default_groups as $json_default_group) {
                                      $arr_control_groups = json_decode($json_default_group['column_properties'], true);
                                       foreach ($arr_control_groups as $arr_control_group) {
                                          $html .= '<div class="form-group col-md-6 col-sm-6 text-left">';
                                              $html .= $this->getHtmlTag($arr_control_group);
                                          $html .= '</div>';
                                      } 
                  
                                  }
                              }
                              return $html;    

                        break;

                    case 'edit':

                    

                    $html = '';
                    
                        if(!empty($table)) {
                            $json_default_groups = $this->getColumnProperties($table, 1);
            
                            foreach ($json_default_groups as $json_default_group) {
                                $arr_control_groups = json_decode($json_default_group['column_properties'], true);
                                 foreach ($arr_control_groups as $arr_control_group) {
                                    $html .= '<div class="form-group col-md-6 col-sm-6 text-left">';
                                        $html .= $this->getHtmlTag($arr_control_group);
                                    $html .= '</div>';
                                } 
            
                            }
                        }
                        return $html;

                        # code...
                        break;

                    case 'view':

                    $html = '';
                    
                        if(!empty($table)) {
                            
                            $objHotel = new Hotel();
                            $hotel = $objHotel->getHotelById($record);

                            $json_default_groups = $this->getColumnProperties($table, 1);
            
                            foreach ($json_default_groups as $json_default_group) {
                                $arr_control_groups = json_decode($json_default_group['column_properties'], true);
                                 foreach ($arr_control_groups as $arr_control_group) {
                                    $html .= '<div class="form-group col-md-6 col-sm-6 text-left">';
                                        $html .= $this->getHtmlTag($arr_control_group, $hotel, false);
                                    $html .= '</div>';
                                } 
            
                            }
                        }
                        return $html;                    
                    # code...
                        break;                    

                    default:
                        # code...
                        break;
                }
        }


        public function createAdditionalInfo($table, $mode = null, $record = null) {


            switch ($mode) {
                case 'new':

                    $html = '';
                
                          if(!empty($table)) {
                              $json_default_groups = $this->getColumnProperties($table, 1);
              
                              foreach ($json_default_groups as $json_default_group) {
                                  $arr_control_groups = json_decode($json_default_group['column_properties'], true);
                                   foreach ($arr_control_groups as $arr_control_group) {
                                      $html .= '<div class="form-group col-md-6 col-sm-6 text-left">';
                                          $html .= $this->getHtmlTag($arr_control_group);
                                      $html .= '</div>';
                                  } 
              
                              }
                          }
                          return $html;    

                    break;

                case 'edit':

                

                $html = '';
                
                    if(!empty($table)) {
                        $json_default_groups = $this->getColumnProperties($table, 1);
        
                        foreach ($json_default_groups as $json_default_group) {
                            $arr_control_groups = json_decode($json_default_group['column_properties'], true);
                             foreach ($arr_control_groups as $arr_control_group) {
                                $html .= '<div class="form-group col-md-6 col-sm-6 text-left">';
                                    $html .= $this->getHtmlTag($arr_control_group);
                                $html .= '</div>';
                            } 
        
                        }
                    }
                    return $html;

                    # code...
                    break;

                case 'view':

                $html = '';
                
                    if(!empty($table)) {
                        
                        $objHotel = new Hotel();
                        $hotel = $objHotel->getHotelById($record);

                        $json_default_groups = $this->getColumnProperties($table, 2);
        
                        foreach ($json_default_groups as $json_default_group) {
                            $arr_control_groups = json_decode($json_default_group['column_properties'], true);
                             foreach ($arr_control_groups as $arr_control_group) {
                                $html .= '<div class="form-group col-md-6 col-sm-6 text-left">';
                                    $html .= $this->getHtmlTag($arr_control_group, $hotel, false);
                                $html .= '</div>';
                            } 
        
                        }
                    }
                    return $html;                    
                # code...
                    break;                    

                default:
                    # code...
                    break;
            }            

/*             $html = '';
  
            if(!empty($table)) {
                $json_default_groups = $this->getColumnProperties($table, 2);
                if (!empty($json_default_groups)) {
                    foreach ($json_default_groups as $json_default_group) {
                        $arr_control_groups = json_decode($json_default_group['column_properties'], true);
                        foreach ($arr_control_groups as $arr_control_group) {
                            $html .= '<div class="form-group col-md-6 col-sm-6">';
                                $html .= $this->getHtmlTag($arr_control_group);
                            $html .= '</div>';
                        } 

                    }
                }

            }
            return $html; */
        }      

        public function createSpecials($table, $mode = null, $record = null) {


            switch ($mode) {
                case 'new':

                    $html = '';
                
                          if(!empty($table)) {
                              $json_default_groups = $this->getColumnProperties($table, 3);
              
                              foreach ($json_default_groups as $json_default_group) {
                                  $arr_control_groups = json_decode($json_default_group['column_properties'], true);
                                   foreach ($arr_control_groups as $arr_control_group) {
                                      $html .= '<div class="form-group col-md-6 col-sm-6 text-left">';
                                          $html .= $this->getHtmlTag($arr_control_group);
                                      $html .= '</div>';
                                  } 
              
                              }
                          }
                          return $html;    

                    break;

                case 'edit':

                

                $html = '';
                
                    if(!empty($table)) {
                        $json_default_groups = $this->getColumnProperties($table, 3);
        
                        foreach ($json_default_groups as $json_default_group) {
                            $arr_control_groups = json_decode($json_default_group['column_properties'], true);
                             foreach ($arr_control_groups as $arr_control_group) {
                                $html .= '<div class="form-group col-md-6 col-sm-6 text-left">';
                                    $html .= $this->getHtmlTag($arr_control_group);
                                $html .= '</div>';
                            } 
        
                        }
                    }
                    return $html;

                    # code...
                    break;

                case 'view':

                $html = '';
                
                if (!empty($table)) {
                    $objHotel = new Hotel();
                    $hotel = $objHotel->getHotelById($record);

                    $json_special_groups = $this->getColumnProperties($table, 3);
    
                    if (!empty($json_special_groups)) {
                        foreach ($json_special_groups as $json_special_group) {
                            $arr_json_special_groups = json_decode($json_special_group['column_properties'], true);
    
                            foreach ($arr_json_special_groups as $arr_json_special_group) {
                                //$html .= '<div class="row">';
                                    $html .= '<div class="form-group col-md-12 col-sm-12">';
                                        $html .= $this->getHtmlTag($arr_json_special_group, $hotel, false);
                                    $html .= '</div>';
                                //$html .= '</div>';
                            }
                        }
                    }
                }
                    return $html;                    
                # code...
                    break;                    

                default:
                    # code...
                    break;
            }

            /* $html ='';
            if (!empty($table)) {
                $json_special_groups = $this->getColumnProperties($table, 3);

                if (!empty($json_special_groups)) {
                    foreach ($json_special_groups as $json_special_group) {
                        $arr_json_special_groups = json_decode($json_special_group['column_properties'], true);

                        foreach ($arr_json_special_groups as $arr_json_special_group) {
                            $html .= '<div class="row">';
                                $html .= '<div class="form-group col-md-12 col-sm-6">';
                                    $html .= $this->getHtmlTag($arr_json_special_group);
                                $html .= '</div>';
                            $html .= '</div>';
                        }
                    }
                }
            }
            return $html; */
        }  


        private function getHtmlTag($arr_data, $arr_values = array(), $enabled = true) {

            if (!empty($arr_values)) {
            
            }

            if (!empty($arr_data)) {
                $input_id = $arr_data['col_name'];
                $tag = $arr_data['form_control'];
                $data_type = $arr_data['data_type'];
                $width_class = $arr_data['width_class'];
                $placeholder = $arr_data['placeholder'];
                $required = $arr_data['required'];

                //$tag = null, $data_type = null, $width_class = null, $placeholder = null, $id = null, $required = null

                $element = '';

                $width_class = "0";

                //$test = $tag.', '.$data_type.', '.$width_class.', '.$placeholder.', '.$id.', '.$required;

                if (!empty($tag)) {


                    switch ($tag) {
                        case 'input':

                            if($data_type == 'txt' || $data_type == 'int') {
                                $element = '<label for="'.$input_id.'" class="control-label">'.$placeholder.(($required!='0')?'*':'').'</label>';

                                $element .= '<input type="text" '.
                                            (($width_class!='0')?'class="form-control input-sm '.$width_class.'"':'class="form-control input-sm" ').
                                            /* (($placeholder!="")?'placeholder="'.$placeholder.'" ':''). */
                                            (($input_id!="")?'id="'.$input_id.'" name="'.$input_id.'" ':'').
                                            (($required!='0')?'required ':'').
                                            ((!$enabled)? "disabled ":" ").
                                            (!empty($arr_values[$input_id])? 'value="'.$arr_values[$input_id].'"': "" ).
                                            '>';
                            } else {
                                $element = 'getHtmlTag - else <br>';
                            }

                            if($input_id == 'rank'||$input_id == 'rating') {
                                $element = '<label for="'.$input_id.'" class="control-label">'.$placeholder.(($required!='0')?'*':'').'</label>';
                                $element .= '<div class="form-inline">';
                                    $element .= '<div class="form-group">';
                                        $element .= '<div name="rank" id="rateYo" class="rateyo" data-rateyo-half-star="true"></div>';
                                        if (!empty($arr_values)) {
                                            $element .= '<script>';
                                            $element .= '$(function () {
                                                
                                                 $("#rateYo").rateYo({
                                                   rating: '.$arr_values[$input_id].',
                                                   readOnly: true
                                                 });
                                               });';
                                            $element .= '</script>';
                                        }
                                        $element .= '<input type="hidden" name="rank">';
                                    $element .= '</div>';
                                    $element .= '<div class="form-group">';
                                        $element .= '&nbsp;&nbsp;<b><span class="rating-counter" style="float:right;" name='.((!$enabled)? "disabled":"").'>'.$arr_values[$input_id].'</span></b>';
                                    $element .= '</div>';
                                $element .= '</div>';
                            }

                            break;

                        case 'select-sp':

                        if (empty($arr_values)) {

                            if($input_id == 'country_id') {
                                $objCountry = new Country();
                                $countries = $objCountry->getCountries();
                                $element = '<label for="'.$input_id.'" class="control-label">'.$placeholder.(($required!='0')?'*':'').'</label><br>';
                                $element .= '<select id="'.$input_id.'" name="'.$input_id.'" class="selectpicker form-control" data-live-search="true" title="Please select..." data-size="10" data-live-search-placeholder="Search..." '.((!$enabled)? "disabled":"").'>';

                                foreach ($countries as $country) {
                                    $element .= '<option value="'.$country['id'].'">'.$country['country_name'].'</option>';
                                }
                                $element .= '</select>';
                            }

                            if($input_id == 'hotel_type_id') {
                                $objHotel = new Hotel();
                                $hotel_types = $objHotel->getHotelTypes();
                                $element = '<label for="'.$input_id.'" class="control-label">'.$placeholder.(($required!='0')?'*':'').'</label><br>';
                                $element .= '<select id="'.$input_id.'" name="'.$input_id.'" class="selectpicker form-control" data-live-search="true" title="Please select..." data-size="10" data-live-search-placeholder="Search..." '.((!$enabled)? "disabled":"").'>';

                                foreach ($hotel_types as $hotel_type) {
                                    $element .= '<option value="'.$hotel_type['id'].'">'.$hotel_type['description'].'</option>';
                                }
                                $element .= '</select>';
                            }

                            if($input_id == 'hotel_chain_id') {
                                $objHotel = new Hotel();
                                $hotel_chains = $objHotel->getHotelChains();
                                $element = '<label for="'.$input_id.'" class="control-label">'.$placeholder.(($required!='0')?'*':'').'</label><br>';
                                $element .= '<select id="'.$input_id.'" name="'.$input_id.'" class="selectpicker form-control" data-live-search="true" title="Please select..." data-size="10" data-live-search-placeholder="Search..." '.((!$enabled)? "disabled":"").'>';

                                foreach ($hotel_chains as $hotel_chain) {
                                    $element .= '<option value="'.$hotel_chain['id'].'">'.$hotel_chain['description'].'</option>';
                                }
                                $element .= '</select>';
                            }   

                            if($input_id == 'available_facilities') {
                                $objHotel = new Hotel();
                                $hotel_facilities = $objHotel->getHotelFacilities();
                                $element = '<label for="'.$input_id.'_t" class="control-label">'.$placeholder.(($required!='0')?'*':'').'</label><br>';
                                $element .= '<select id="'.$input_id.'" name="'.$input_id.'[]" class="selectpicker form-control" data-live-search="true" title="Please select..." data-size="10" data-live-search-placeholder="Search..." multiple '.((!$enabled)? "disabled":"").'>';

                                foreach ($hotel_facilities as $hotel_facility) {
                                    $element .= '<option value="'.$hotel_facility['id'].'">'.$hotel_facility['facility'].'</option>';
                                }
                                $element .= '</select>';
                            }

                        } else { /* ************* $arr_values not empty */

                            if($input_id == 'country_id') {
                                $objCountry = new Country();
                                $country = $objCountry->getCountryById($arr_values[$input_id]);

                                $element = '<label for="'.$input_id.'" class="control-label">'.$placeholder.(($required!='0')?'*':'').'</label>';
                                
                                                                $element .= '<input type="text" '.
                                                                            (($width_class!='0')?'class="form-control input-sm '.$width_class.'"':'class="form-control input-sm" ').
                                                                            /* (($placeholder!="")?'placeholder="'.$placeholder.'" ':''). */
                                                                            (($input_id!="")?'id="'.$input_id.'" name="'.$input_id.'" ':'').
                                                                            (($required!='0')?'required ':'').
                                                                            ((!$enabled)? "disabled ":" ").
                                                                            (!empty($arr_values[$input_id])? 'value="'.$country['country_name'].'"': "" ).
                                                                            '>';
                            }

                            if($input_id == 'hotel_type_id') {
                                $objHotel = new Hotel();
                                $hotel_type = $objHotel->getHotelTypeById($arr_values[$input_id]);
                                $element = '<label for="'.$input_id.'" class="control-label">'.$placeholder.(($required!='0')?'*':'').'</label>';
                                
                                $element .= '<input type="text" '.
                                            (($width_class!='0')?'class="form-control input-sm '.$width_class.'"':'class="form-control input-sm" ').
                                            /* (($placeholder!="")?'placeholder="'.$placeholder.'" ':''). */
                                            (($input_id!="")?'id="'.$input_id.'" name="'.$input_id.'" ':'').
                                            (($required!='0')?'required ':'').
                                            ((!$enabled)? "disabled ":" ").
                                            (!empty($arr_values[$input_id])? 'value="'.$hotel_type['description'].'"': "" ).
                                            '>';
                            }

                            if($input_id == 'hotel_chain_id') {
                                $objHotel = new Hotel();
                                $hotel_chain = $objHotel->getHotelChainById($arr_values[$input_id]);
                                $element = '<label for="'.$input_id.'" class="control-label">'.$placeholder.(($required!='0')?'*':'').'</label>';
                                
                                $element .= '<input type="text" '.
                                            (($width_class!='0')?'class="form-control input-sm '.$width_class.'"':'class="form-control input-sm" ').
                                            /* (($placeholder!="")?'placeholder="'.$placeholder.'" ':''). */
                                            (($input_id!="")?'id="'.$input_id.'" name="'.$input_id.'" ':'').
                                            (($required!='0')?'required ':'').
                                            ((!$enabled)? "disabled ":" ").
                                            (!empty($arr_values[$input_id])? 'value="'.$hotel_chain['description'].'"': "" ).
                                            '>';
                            }   

                            if($input_id == 'available_facilities') {

                                $arr_facility_ids = explode(",", $arr_values[$input_id]);
                                $objHotel = new Hotel();
                                $arr_facilities = array();
                                foreach ($arr_facility_ids as $arr_facility_id) {
                                    array_push($arr_facilities, $objHotel->getHotelFacilityById($arr_facility_id));
                                }
                                //return implode(',', $arr_facilities);
                                $element = '<label for="'.$input_id.'" class="control-label">'.$placeholder.(($required!='0')?'*':'').'</label><br>';
                                $element .= '<div class="col-md-12">';

                                $element .= '<table class="table table-bordered">';
                                $element .= '<tbody>';
                          
                                foreach ($arr_facilities as $key => $value) {
                          
                                  if ($key == 0 ) { $element .= '<tr>';}
                                  if( $key != 0 && $key%3 == 0) {
                                    $element .= '</tr><tr>';
                          
                                  }
                          
                          
                                      $element .= '<td >'.$value['facility'].'</td>';
                                    }
                                
                          
                                $element .= '</tbody>';      
                                $element .= '</table>';
                                $element .= '</div>';
                            }
                        }                                                                  

                            
                            break;

                        case 'room_details':

                            //return var_dump(json_decode($arr_values['room_details'], true));
                            
                            if(empty($arr_values)) {
                                
                                $objHotel = new Hotel();
                                $room_types = $objHotel->getRoomTypes();

                                if (!empty($room_types)) {
                                    $element = '<div class="room-detail">';
                                    $element .= '<label class="control-label">Add Room Details</label>&nbsp;&nbsp;<button class="btn btn-sm btn-primary pull-right" name="add_more_types">Add More Types</button><br/><br>';
                                    $element .= '<div class="add_more_room_types">';
                                    $element .= '<div class="form-inline" name="room_type_1">';
                                    //$element .= '<div class="panel panel-default">';
                                    //$element .= '<div class="panel-body">';
                                    $element .= '<div class="form-group" id="room_types">';
                                    
                                    $element .= '<select id="room_type_1" name="room_type_1" class="xform-control selectpicker" data-live-search="true" title="Room Type" data-size="10" data-live-search-placeholder="Search...">';

                                    foreach ($room_types as $room_type) {
                                        $element .= '<option value="'.$room_type['id'].'">'.$room_type['room_type'].'</option>';
                                    }
                                    $element .= '</select>&nbsp;';
                                    $element .= '<input type="number" name="room_count_1" class="form-control" placeholder="Number of Rooms" min="1" path="trainCount">&nbsp;';
                                    //$element .= '<button class="btn btn-primary" name="addTrain"><i class="glyphicon glyphicon-plus"></i></button>&nbsp;';
                                    $element .= '<button class="btn btn-xs btn-danger" name="remove_room_type_1"><i class="glyphicon glyphicon-minus"></i></button>';
                                    $element .= '</div>';
                                    //$element .= '</div>';
                                    //$element .= '</div>';
                                    $element .= '</div><br/>';
                                    $element .= '</div>';
                                    $element .= '</div>';
                                    }
                                } else { // $arr_values not empty
                                    /* $element = 'Room types'; */
                                    //return "values";
                                    $element = '<div class="room-detail">';
                                    $element .= '<label class="control-label">Room Details</label><br/><br>';

                                    $room_types = $arr_values[$input_id];
                                    $arr_room_types = json_decode($room_types, true);
                                    //return $arr_room_types;
                                    $objHotel = new Hotel();
                                    $room_type = array();
                                    foreach ($arr_room_types as $key => $value) {
                                        $room_type[$objHotel->getRoomTypeById($key)['room_type']] = $value;
                                    }

                                    //$element .= '<div class="col-md-12">';
                                    
                                    $element .= '<table class="table table-bordered">';
                                    $element .= '<thead>';
                                    $element .= '<th>Type</th><th>No. of Rooms</th>';
                                    $element .= '</thead>';
                                    $element .= '<tbody>';

                                    foreach ($room_type as $key => $value) {
                                          $element .= '<tr><td>'.$key.'</td><td>'.$value.'</td></tr>';
                                    }
                                    
                                
                                    $element .= '</tbody>';      
                                    $element .= '</table>';
                                    //$element .= '</div>';
                                    $element .= '</div>';

                                }
                            
                            break;
                        
                        case 'text':
                            $element = '<label for="'.$input_id.'" class="control-label">'.$placeholder.(($required!='0')?'*':'').'</label>';
                            //$element .= '<div class="col-sm-8">';
                            $element .= '<textarea rows="4" '.
                                        (($width_class!='0')?'class="form-control '.$width_class.'"':'class="form-control" ').
                                        /* (($placeholder!="")?'placeholder="'.$placeholder.'" ':''). */
                                        (($input_id!="")?'id="'.$input_id.'" name="'.$input_id.'" ':'').
                                        (($required!='0')?'required ':'').
                                        ((!$enabled)? 'style="resize:none" disabled':"").
                                        '>'.(!empty($arr_values[$input_id])?$arr_values[$input_id]: "" ).'</textarea>';                            

                            break;
                        
                        default:
                            $element = 'getHtmlTag - switch default: '.$tag.'<br>';
                            break;
                        
                    }

                }
                return $element;
            }
        }

    }

?>