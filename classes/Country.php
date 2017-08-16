<?php
  class Country extends Application {

    private $_table = 'country';

    public function getCountries($cond = null) {

      if(!empty($cond)) {
        $sql = "SELECT * FROM `{$this->_table}` WHERE ". $cond;
        return $this->db->fetchAll($sql);
      } else {
        $sql = "SELECT * FROM `{$this->_table}` ORDER BY `country_name` ASC" ;
        return $this->db->fetchAll($sql);
      }
    }


    public function getCountryById($id = null) {

      if (!empty($id)) {

        $sql =  "SELECT * FROM `{$this->_table}` 
                 WHERE `id` = '".$this->db->sanitize($id)."'";

        return $this->db->fetchOne($sql);
      }

    }

  }
?>
