<?php
  if(!isset($_SESSION)) {
    session_start();
  }

  // site domain name with http
  defined("SITE_URL")
    || define("SITE_URL", "http://".$_SERVER['SERVER_NAME']."/jayalanka");

    // directory separator
    defined("DS")
      || define("DS", DIRECTORY_SEPARATOR);

    // root path
    defined("ROOT_PATH")
      || define("ROOT_PATH", realpath(dirname(__FILE__).DS."..".DS));

    // classes folder
    defined("CLASSES_DIR")
      || define("CLASSES_DIR", "classes");

    // classes folder
    defined("PAGES_DIR")
      || define("PAGES_DIR", "pages");

    // modules folder
    defined("MODULES_DIR")
      || define("MODULES_DIR", "modules");

    // includes folder
    defined("INCLUDES_DIR")
      || define("INCLUDES_DIR", "include");

    // templates folder
    defined("TEMPLATES_DIR")
      || define("TEMPLATES_DIR", "templates");

    // emails path
    defined("EMAILS_PATH")
      || define("EMAILS_PATH", ROOT_PATH.DS."emails");

    // images root folder
    defined("IMG_ROOT")
      || define("IMG_ROOT", ROOT_PATH.DS."images");

    // hotel images path
    defined("HOTEL_IMG_PATH")
      || define("HOTEL_IMG_PATH", IMG_ROOT.DS."hotels");

    // vehicle images path
    defined("VEHICLE_IMG_PATH")
    || define("VEHICLE_IMG_PATH", IMG_ROOT.DS."vehicles");
    
    // restaurant images path
    defined("REST_IMG_PATH")
    || define("REST_IMG_PATH", IMG_ROOT.DS."restaurants");    

    // restaurant images path
    defined("SHOP_IMG_PATH")
    || define("SHOP_IMG_PATH", IMG_ROOT.DS."shops");        

    // javascripts path
    defined("JS_PATH")
      || define("JS_PATH", "js");

    // fonts path
    defined("FONTS_PATH")
      || define("FONTS_PATH", "fonts");

      // add all above to the include path
      set_include_path(implode(PATH_SEPARATOR, array(
        realpath(ROOT_PATH.DS.CLASSES_DIR),
        realpath(ROOT_PATH.DS.PAGES_DIR),
        realpath(ROOT_PATH.DS.MODULES_DIR),
        realpath(ROOT_PATH.DS.INCLUDES_DIR),
        realpath(ROOT_PATH.DS.TEMPLATES_DIR),
        realpath(ROOT_PATH.DS.JS_PATH),
        realpath(ROOT_PATH.DS.HOTEL_IMG_PATH),
        realpath(ROOT_PATH.DS.VEHICLE_IMG_PATH),
        realpath(ROOT_PATH.DS.REST_IMG_PATH),
        realpath(ROOT_PATH.DS.SHOP_IMG_PATH),
        get_include_path()
      )));

?>
