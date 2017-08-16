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

    // product images path
    defined("FORUM_IMG_PATH")
      || define("FORUM_IMG_PATH", IMG_ROOT.DS."posts".DS."forum");

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
        get_include_path()
      )));

?>
