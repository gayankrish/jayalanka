<?php

class Message extends Application {

	private $_table = 'messages';


	public function getMessageById($id = null) {
		
		if(!empty($id)){
			$sql = "SELECT * FROM `{$this->_table}` WHERE `id` = {$id}";
	      	return $this->db->fetchOne($sql);
      	}
	}


	public function getMessagesByFromUser($id = null) {

		if(!empty($id)){		
			$sql = "SELECT * FROM `{$this->_table}` WHERE `fromuserid` = {$id}";
	    	return $this->db->fetchAll($sql);
    	}
	}


	public function getMessagesByToUser($id = null) {

		if(!empty($id)){
			$sql = "SELECT * FROM `{$this->_table}` WHERE `touserid` = {$id}";
    		return $this->db->fetchAll($sql);
    	}
	}


	public function sendMessage($params = null) {

		if(!empty($params)){


          if ($this->db->insert($this->_table)) {
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
	}





}
