<?php
  


  class User extends Application {

    private $_table_user = 'user';
    private $_table_user_group = 'user_group';
    public $_id;
    public $_loginToken = '';

    public function isUser($username, $password) {
      $password = Helper::string2hash($password);
      $sql = "SELECT * FROM `{$this->_table_user}` WHERE `username` = '".$this->db->sanitize($username)."'
              AND `password` = '".$this->db->sanitize($password)."' AND `status` = 1";
      $result = $this->db->fetchOne($sql);

      if (!empty($result)) {
        $this->_id = $result['id'];
        $this->_loginToken = Helper::generateHash();
        return true;
      }
      return false;
    }


    public function addUser($params = null) {
        if (!empty($params)) {

          foreach ($params as $key => $value) {
            if($key == 'password'){
              $params[$key] = Helper::string2hash($value);
            }
          }
          

          $this->db->prepareInsert($params);

          if ($this->db->insert($this->_table_user)) {
            //send email
            /*
            $objEmail = new Email();
            if ($objEmail->process(1, array(
              'email'         => $params['email'],
              'first_name'    => $params['first_name'],
              'last_name'     => $params['last_name'],
              'password'      => $password,
              'hash'          => $params['hash']
            ))) {
              return true;
            } */
            return true;
          }

          return false;
        }
        return false;
    }


    public function getUserByHash($hash = null) {
      if (!empty($hash)) {
        $sql = "SELECT * FROM `{$this->_table_user}` WHERE `hash` = '";
        $sql .= $this->db->sanitize($hash)."'";
        return $this->db->fetchOne($sql);
      }
    }


    public function makeActive($id = null) {
      if (!empty($id)) {
        $sql = "UPDATE `{$this->_table_user}`
                SET `active` = 1
                WHERE `id` = '".$this->db->sanitize($id)."'";
        return $this->db->query($sql);
      }
    }


    public function getByEmail($email) {
      if (!empty($email)) {
        $sql = "SELECT `id` FROM `{$this->_table_user}` WHERE `email` = '";
        $sql .= $this->db->sanitize($email)."' AND `active` = 1";
        return $this->db->fetchOne($sql);
      }
    }


    public function getByUsername($username = null) {
      if (!empty($username)) {
        $sql = "SELECT * FROM `{$this->_table_user}` WHERE `username` = '";
        $sql .= $this->db->sanitize($username)."' AND `status` = 1"; 

        //$sql = "SELECT * FROM `{$this->_table_user}` WHERE `username` = {$username} ";
        return $this->db->fetchOne($sql);
        //return $sql;
      }
    }


    public function getUserByUserid($id = null) {

      if (!empty($id)) {
        $sql =  "SELECT * FROM `{$this->_table_user}`
                 WHERE `id` = '".$this->db->sanitize($id)."'";
        return $this->db->fetchOne($sql);
      }

    }


    public function getFirstName($id = null) {
      if(!empty($id)) {
        $user = $this->getUserByUserid($id);

        if (!empty($user)) {
          return $user['fname'];
        }
      }
    }



    public function updateUser($array = null, $id = null) {
      if (!empty($array) && !empty($id)) {
        $this->db->prepareUpdate($array);
        if ($this->db->update($this->_table_user, $id)) {
          return true;
        }
        return false;
      }
    }

    public function getAccessibleMenuItems($userid) {
      if(!empty($userid)) {
        $user = $this->getUserByUserid($userid);

        if(!empty($user)) {
          $sql = "SELECT `accessible_menu_items` FROM `{$this->_table_user_group}` ";
          $sql .= "WHERE `id`=".$this->db->sanitize($user['usergroup']);

          return $this->db->fetchOne($sql);
        }
      }
    }

  }
?>
