<?php

  class Validation {
    // Form object
    private $objForm;

    // for storing all error ids
    private $_errors = array();

  // validation messages
    public $_message = array(
      "first_name" => "Please provide your first name",
      "last_name"  => "Please provide your last name",
      "address_1"  => "Please provide the first line of your address",
      "city"       => "Please provide your city name",
      "province"   => "Please provide your province name",
      "post_code"  => "Please provide your postal code",
      "country"    => "Please select your country",
      "email"      => "Please provide your valid email address",
      "email_duplicated"  => "This email is already used to register",
      "contact"    => "Please provide your contact number",
      "login"      => "Email and / or password were incorrect",
      "password_mismatch" => "Passwords did not match",
      "category"   => "Please select category",
      "sub_category"  => "Please select a sub-category",
      "title"      => "Please input the subject of your post",
      "message"    => "Please input your message",
      "username_exists" => "User name already exists! Please choose a different user name"
      );

      // List of expected fields
      public $_expected = array();

       // List of required fields
      public $_required = array();

      // List of special validation fields
      // array('field_name' => 'format')
      public $_special = array();

      // post array
      public $_post = array();

      // Fields to be removed from $_post array
      public $_post_remove = array();

      //fields to be specifically formatted
      // array('field_name' => format)
      public $_post_format = array();

      public function __construct($objForm) {
        $this->objForm = $objForm;
      }

      public function process() {
        if ($this->objForm->isPost() && !empty($this->_required)) {
          // get only expected fields - remove all others
          $this->_post = $this->objForm->getPostArray($this->_expected);

            if (!empty($this->_post)) {
              foreach ($this->_post as $key => $value) {
                $this->check($key, $value);
              }
            }
        }
      }

      public function check($key, $value) {
        if (!empty($this->_special) && array_key_exists($key, $this->_special)) {
          $this->checkSpecial($key, $value);
        } else {
          if (in_array($key, $this->_required) && empty($value)) {
            $this->addToErrors($key);
          }
        }
      }

      public function checkSpecial($key, $value) {
        switch($this->_special[$key]) {
          case 'email':
            if (!$this->isEmail($value)) {
              $this->addToErrors($key);
            }
          break;
        }
      }


      public function isEmail($email = null) {
        if(!empty($email)) {
          $result = filter_var($email, FILTER_VALIDATE_EMAIL);
          return !$result ? falase : true;
        }
        return falase;
      }

      public function isValid() {
        $this->process();
        if (empty($this->_errors) && !empty($this->_post)) {
          //remove all unwanted fields
          if (!empty($this->_post_remove)) {
            foreach ($this->_post_remove as $value) {
              unset($this->_post[$value]);
            }
          }
          //format all required fields
          if (!empty($this->_post_format)) {
            foreach ($this->_post_format as $key => $value) {
              $this->format($key, $value);
            }
          }
          return true;
        }
        return false;
      }

      public function format($key, $value) {
        switch($key) {
          case 'password':
            $this->_post[$key] = Login::string2hash($this->_post[$key]);
          break;
        }
      }

      public function validate($key) {
        if (!empty($this->_errors) && in_array($key, $this->_errors)) {
          return $this->wrapWarn($this->_message[$key]);
        }
      }

      public function wrapWarn($msg = null) {
        if (!empty($msg)) {
          return "<span class=\"warn text-danger\">{$msg}</span>";
        }
      }


      public function addToErrors($key) {
        $this->_errors[] = $key;
      }



  }
 ?>
