<?php
  class Vehicle extends Application {

    private $_table = 'vehicle';
    private $_vehicle_type_table = 'vehicle_type';
    private $_chain_table = 'chain_type';
    private $_vehicle_make_table = 'vehicle_make';
    private $_vehicle_model_table = 'vehicle_model';


    /**
    * Add new Vehicle
    */

    public function addVehicle($params = null) {
      if(!empty($params)) {
        $room_details = '{';
        $remove_keys = array();

        foreach ($params as $key => $value) {
          
          // Convert room_room_details selectpricker array values to comma seperated value string
          if(is_array($params[$key])) {
            
            $str = '';
            foreach ($params[$key] as $key1 => $value1) {
              $str .= $value1.",";
            }

            $str = substr($str, 0, strlen($str)-1);

            unset($params[$key]);
            $params[$key] = $str;
          }

          // Concatenate all room types and count (format: room_type:count)

          if(strpos($key, 'room_type_') !== FALSE && $value != '') {

            $count_name = 'room_count_'.substr($key, strlen($key)-1);

            if ($params[$count_name] != '') {
              $room_details .= $value.":".$params[$count_name].",";
              array_push($remove_keys, $key);
              array_push($remove_keys, $count_name);
            } else {
              array_push($remove_keys, $key);
              array_push($remove_keys, $count_name);
            }

          } elseif(strpos($key, 'room_type_') !== FALSE && $value == '') {
              $count_name = 'room_count_'.substr($key, strlen($key)-1);
              array_push($remove_keys, $key);
              array_push($remove_keys, $count_name);
          }
        }

        if (strlen($room_details) > 1) {
            $room_details = substr($room_details, 0, strlen($room_details)-1);
            $room_details .= "}";
            $params['room_details'] = $room_details;
          } else {
            $room_details = '';
          }

        if(!empty($remove_keys)) {
          foreach ($remove_keys as $key) {
            unset($params[$key]);
          }
        }

        $objCountry = new Country;
        $country = $objCountry->getCountryById($params['country_id']);

        $params['location'] = (!empty($country)) ? $params['city'].",".$country['country_name']:"";



           $this->db->prepareInsert($params);
           // error_log('saving new Vehicle...');
            $reslt = $this->db->insert($this->_table);
            error_log('save result:'.$reslt);
            //error_log("record id: ".$this->db->_id);
           if ($reslt > 0) {
             //error_log('success - saving new Vehicle...');
            return $reslt;
          }
          //error_log('failed - saving new Vehicle...');
          return false;  
        }
        return false;
    }

    public function getVehicles($cond = null, $summary = false) {

      if (!$summary) {
        if (!empty($cond)) {
          $sql = "SELECT * FROM `{$this->_table}` WHERE `status` = 1 AND (".$cond.")";
          return $this->db->fetchAll($sql); 
          //return $sql;
        } else {
          $sql = "SELECT * FROM `{$this->_table}` WHERE `status` = 1";
          return $this->db->fetchAll($sql);       
        }
      } else {
        if (!empty($cond)) {
          $sql = "SELECT COUNT(*) FROM `{$this->_table}` WHERE `status` = 1 AND (".$cond.")";
          $result = $this->db->fetchOne($sql); 
          return $result['COUNT(*)'];
          //return $sql;
        } else {
          $sql = "SELECT COUNT(*) FROM `{$this->_table}` WHERE `status` = 1";
          $result = $this->db->fetchOne($sql); 
          return $result['COUNT(*)'];      
        }
      }

    }


    public function getPagedVehicles($cond = null, $start = 0, $end = 0) {
    
      
      if (!empty($cond)) {
        $sql = "SELECT * FROM `{$this->_table}` WHERE `status` = 1 AND (".$cond.") ORDER BY `id` DESC LIMIT {$start}, {$end}";
        return $this->db->fetchAll($sql); 
        //return $sql;
      } else {
        $sql = "SELECT * FROM `{$this->_table}` WHERE `status` = 1 ORDER BY `id` DESC LIMIT {$start}, {$end}";
        return $this->db->fetchAll($sql);       
      }

    }

    public function getVehicleById($id) {
      if (!empty($id)) {
        $sql = "SELECT * FROM `{$this->_table}` WHERE `id`={$id}";
        return $this->db->fetchOne($sql);
      }      
    }
      

    public function getVehicleTypeById($typeid=null) {
      if (!empty($typeid)) {
        $sql = "SELECT * FROM `{$this->_vehicle_type_table}` WHERE `id`={$typeid}";
        return $this->db->fetchOne($sql);
      }
    }

    public function getVehicleChainById($chainid=null) {
      if (!empty($chainid)) {
        $sql = "SELECT * FROM `{$this->_chain_table}` WHERE `chain_type`='vehicle' AND `id`={$chainid}";
        return $this->db->fetchOne($sql);
      }
    }

    public function getVehicleTypes($cond) {
      if(!empty($cond)) {
        $sql = "SELECT * FROM `{$this->_vehicle_type_table}` WHERE ". $cond;
        return $this->db->fetchAll($sql);
      } else {        
        $sql = "SELECT * FROM `{$this->_vehicle_type_table}`";
        return $this->db->fetchAll($sql);
      }
    }

    public function getVehicleChains() {
      $sql = "SELECT * FROM `{$this->_chain_table}` WHERE `chain_type`='vehicle'";
      return $this->db->fetchAll($sql);
    }

    public function getVehicleMakes() {
      $sql = "SELECT * FROM `{$this->_vehicle_make_table}`";
      return $this->db->fetchAll($sql);
    }

    public function getVehicleMakeById($id) {
    $sql = "SELECT * FROM `{$this->_vehicle_make_table}` WHERE `id`={$id}";
      return $this->db->fetchAll($sql);
    }

    public function getVehicleModels($cond) {
      if(!empty($cond)) {
        $sql = "SELECT * FROM `{$this->_vehicle_model_table}` WHERE ". $cond;
        return $this->db->fetchAll($sql);
      } else {        
        $sql = "SELECT * FROM `{$this->_vehicle_model_table}`";
        return $this->db->fetchAll($sql);
      }
    }

    public function getVehicleModelById($id) {
    $sql = "SELECT * FROM `{$this->_vehicle_model_table}` WHERE `id`={$id}";
      return $this->db->fetchAll($sql);
    }

  }
?>
