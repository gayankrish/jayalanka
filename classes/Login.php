<?php

  class Login {

    public static $_login_page_front = "/?page=login";
    public static $_dashboard_front = "/?page=orders";
    public static $_login_front = "cid";

    public static $_login_page_admin = "/admin";
    public static $_dashboard_admin = "/admin/?page=products";
    public static $_login_admin = "aid";

    public static $_valid_login = "valid";
    public static $_referrer = "refer";



    public static function string2hash($string = null) {

      if (!empty($string)) {
        return hash('sha512', $string);
      }
    }

    public static function isLogged($case = null) {
      if (!empty($case)) {
        if (isset($_SESSION[self::$_valid_login]) && $_SESSION[self::$_valid_login] == 1) {
          return isset($_SESSION[$case]) ? true : false;
        }
        return false;
      }
      return false;
    }


    public static function loginFront($id, $url = null){
      $url = !empty($url) ? $url : self::$_dashboard_front;
      $_SESSION[self::$_login_front] = $id;
      $_SESSION[self::$_valid_login] = 1;
      Helper::redirect($url);
    }


    public static function doLogin($id) {
      $_SESSION[self::$_login_front] = $id;
      $_SESSION[self::$_valid_login] = 1;

    }

    public static function logout($case = null) {

      if (!empty($case)) {
/*         
        $_SESSION[$case] = null;
        $_SESSION[self::$_valid_login] = 0;
        unset($_SESSION[$case]);
 */
      //session_unset();
      session_destroy();

      } else {
        //l$_SESSION[$_valid_login] = 0;
        session_destroy();
      }
    }

    public static function restrictFront() {
      if (!self::isLogged(self::$_login_front)) {
        $url = Url::currentPage() != "logout" ? self::$_login_page_front."&".
                  self::$_referrer."=".Url::currentPage() : self::$_login_page_front;

      Helper::redirect($url);
      }
    }







  }

?>
