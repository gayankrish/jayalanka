<?php
  class Dbase {

    private $_host = "localhost";
    private $_user = "root";
    private $_password = "";
    private $_dbname = "jayadb";

    private $_conndb;
    private $result;
    public $_last_query = null;
    public $_affected_rows = 0;

    public $_insert_keys = array();
    public $_insert_values = array();
    public $_update_sets = array();

    public $_id;

    public function __construct() {
      //$this->connect();
    }

    private function connect() {
      $this->_conndb = mysqli_connect($this->_host, $this->_user, $this->_password, $this->_dbname);

      if(!$this->_conndb) {
        die("Database connection failed:<br />Error: ".mysqli_connect_errno()." - ".mysqli_connect_error());
      }

      mysqli_set_charset($this->_conndb,"utf8");
    }

    public function close($func = null) {
      if (!mysqli_close($this->_conndb)) {
        die("Closing connection failed: Called by function - ".$func);
      }
    }

    public function sanitize($str) {
      if (function_exists("mysqli_real_escape_string")) {
          if (get_magic_quotes_gpc()) {
            $str = stripcslashes($str);
          }
          $this->connect();
          $str = mysqli_real_escape_string($this->_conndb, $str);
          $this->close('sanitize');
      } else {
        if (!get_magic_quotes_gpc()) {
          $str = addcslashes($str);
        }
      }
      return $str;
    }

    public function query($sql) {
      $this->_last_query = $sql;
      $this->connect();
      $this->result = mysqli_query($this->_conndb, $sql);
           // $this->close();
      $this->displayQuery(/*$this->result*/);
      
      return $this->result;
    }

    public function displayQuery() {
      if (!$this->result) {
        $output = "DB query failed <br />
                  Error: ".mysqli_error($this->_conndb)."<br />
                  Last query was: ".$this->_last_query;
        die($output);
      } else {
        
        $this->_affected_rows = mysqli_affected_rows($this->_conndb);
        //$this->close('displayQuery');
      }

    }

    public function fetchAll($sql) {
      //if (!mysql_ping()) { $this->connect(); } 
      //$this->connect();
      $this->result = $this->query($sql);
      //$this->close();
      $out = array();
      while($row = mysqli_fetch_assoc($this->result)) {
        $out[] = $row;
      }
      mysqli_free_result($this->result);
      return $out;
    }

    public function fetchOne($sql) {
      $out = $this->fetchAll($sql);
      return array_shift($out);
    }

    public function lastId() {
      $this->connect();
      return mysqli_insert_id($this->_conndb);
      $this->close();
    }


    public function prepareInsert($array = null) {
      if (!empty($array)) {
        foreach ($array as $key => $value) {
          $this->_insert_keys[] = $key;
          $this->_insert_values[] = $this->sanitize($value);
        }
      }
    }


    public function insert($table = null) {
      if (!empty($table) && !empty($this->_insert_keys) && !empty($this->_insert_values)) {
        $sql = "INSERT INTO `{$table}` (`";
        $sql .= implode("`, `", $this->_insert_keys);
        $sql .= "`) VALUES ('";
        $sql .= implode("', '", $this->_insert_values);
        $sql .= "')";
        //if (!mysql_ping()) { $this->connect(); } 

        //$this->connect();
        error_log($sql);
        if ($this->query($sql)) {
          //$this->_id = $this->lastId();
          //$this->close();
          //return true;

          return mysqli_insert_id($this->_conndb);
          $this->close();
        }
        return false;
      }
    }


    public function prepareUpdate($array = null) {
      if (!empty($array)) {
        foreach ($array as $key => $value) {
          $this->_update_sets[] = "`{$key}` = '".$this->sanitize($value)."'";
        }
      }
    }


    public function update($table = null, $id = null) {
      //return $this->_update_sets;
       if (!empty($table) && !empty($id) && !empty($this->_update_sets)) {
        $sql =  "UPDATE `{$table}` SET ";
        $sql .= implode(", ", $this->_update_sets);
        $sql .= " WHERE `id` = '".$this->sanitize($id)."'";
        //if (!mysql_ping()) { $this->connect(); } 
        //$this->connect();
        return $this->query($sql);
        //return $sql;
        //$this->close();
      } 
    }

  } // End class
?>
