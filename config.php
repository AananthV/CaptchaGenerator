<?php
  /*
  * The domain where the Form Builder is hosted.
  * It must end in a forward slash '/'
  * 'http://www.example.com/' is valid while 'http://www.example.com' is not.
  */
  //define('DOMAIN', 'http://localhost:8080/form_manager/');
  define('BACKEND', 'http://localhost/cap_gen/');

  define('CLIENT', 'http://localhost/cap_gen/');

  /*
  * The MYSQL database configuration.
  */
  define('DB_HOST', 'localhost');
  define('DB_NAME', 'gen_cap');
  define('DB_USERNAME', 'root');
  define('DB_PASSWORD', '');

  /*
  * Default timezone.
  * Set this to the timezone your MYSQL Databse uses.
  * Must be in IntlTimeZone format.
  */
  define('SERVER_TIMEZONE', "Asia/Calcutta");

  define('CHARACTER_SET', "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789");
  define('CAPTCHA_LENGTH', 6);
  define('FONT_FOLDER', 'C:\xampp\htdocs\cap_gen\fonts\\');
  define('CAPTCHA_FONTS', array('brushield.ttf'));
  define('CAPTCHA_FONT_SIZE', 50);
  define('CAPTCHA_MAX_ANGLE', 15);
  define('CAPTCHA_X_PADDING', 40);
  define('CAPTCHA_Y_PADDING', 20);
  define('CAPTCHA_HEIGHT', 150);
  define('CHARACTER_WIDTH', 30);
  define('COLOR', array(255, 0, 0));
?>
