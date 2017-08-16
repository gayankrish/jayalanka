<?php
  class Menu extends Application {

    private $_table = 'internal_menu1';

    public function getParents($usergroup = null) {

      
      $sql = "SELECT * FROM `{$this->_table}` WHERE `parent` = 0";
      return $this->db->fetchAll($sql);
    }

    

    public function getParentMenuItem($id) {
      $sql = "SELECT * FROM `{$this->_table}` WHERE `id` = {$id}";
      return $this->db->fetchOne($sql);
    }

    public function getAllParents() {
      $sql = "SELECT * FROM `{$this->_table}` WHERE `parent` IN (0, -1)";
      return $this->db->fetchAll($sql);
    }

    public function getChildren($tablename) {
      $sql = "SELECT * FROM `{$tablename}`";
      return $this->db->fetchAll($sql);
    }


    public function getChildrenByParentId($id) {
      $sql = "SELECT * FROM `{$this->_table}` WHERE `parent` = {$id}";
      return $this->db->fetchAll($sql);
    }


    public function getLinks() {
      $sql = "SELECT * FROM `{$this->_table}` WHERE `parent` = -1";
      return $this->db->fetchAll($sql);
    }


    public function getAllMenuItems() {
      $sql = "SELECT * FROM `{$this->_table}` ORDER BY `sort_order` ASC";
      return $this->db->fetchAll($sql);
    }

  }
?>
