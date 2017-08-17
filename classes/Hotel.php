<?php
  class Hotel extends Application {

    private $_table = 'hotel';
    private $_type_table = 'hotel_type';
    private $_chain_table = 'chain_type';
    private $_hotel_facilities_table = 'hotel_facility';
    private $_room_type_table = 'room_type';


    /**
    * Add new hotel
    */

    public function addHotel($params = null) {
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
           // error_log('saving new hotel...');
            $reslt = $this->db->insert($this->_table);
            error_log('save result:'.$reslt);
           if ($reslt) {
             //error_log('success - saving new hotel...');
            return true;
          }
          //error_log('failed - saving new hotel...');
          return false;  
        }
        return false;
    }

    public function getHotels($cond = null) {
      if (!empty($cond)) {
        $sql = "SELECT * FROM `{$this->_table}` WHERE `status` = 1 AND (".$cond.")";
        return $this->db->fetchAll($sql); 
        //return $sql;
      } else {
        $sql = "SELECT * FROM `{$this->_table}` WHERE `status` = 1";
        return $this->db->fetchAll($sql);       
      }

    }

    public function getHotelTypeById($typeid=null) {
      if (!empty($typeid)) {
        $sql = "SELECT * FROM `{$this->_type_table}` WHERE `id`={$typeid}";
        return $this->db->fetchOne($sql);
      }
    }

    public function getHotelChainById($chainid=null) {
      if (!empty($chainid)) {
        $sql = "SELECT * FROM `{$this->_chain_table}` WHERE `chain_type`='hotel' AND `id`={$chainid}";
        return $this->db->fetchOne($sql);
      }
    }

    public function getHotelTypes() {
      $sql = "SELECT * FROM `{$this->_type_table}`";
      return $this->db->fetchAll($sql);
    }

    public function getHotelChains() {
      $sql = "SELECT * FROM `{$this->_chain_table}` WHERE `chain_type`='hotel'";
      return $this->db->fetchAll($sql);
    }

    public function getHotelFacilities($cond = null) {

      if(!empty($cond)) {
        $sql = "SELECT * FROM `{$this->_hotel_facilities_table}` WHERE ". $cond;
        return $this->db->fetchAll($sql);
      } else {        
        $sql = "SELECT * FROM `{$this->_hotel_facilities_table}`";
        return $this->db->fetchAll($sql);
      }

    }

    public function getRoomTypes() {
      $sql = "SELECT * FROM `{$this->_room_type_table}`";
      return $this->db->fetchAll($sql);
    }

  }
?>
