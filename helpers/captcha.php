<?php

  require_once($ROOT_PATH . '/config.php');

  function generateCaptchaImage($string) {
    $width = (strlen($string)*CHARACTER_WIDTH) + 2 * CAPTCHA_X_PADDING;
    $height = CAPTCHA_HEIGHT;

    // Create the image
    $im = imagecreatetruecolor($width, $height);

    // Create some colors
    $white = imagecolorallocate($im, 255, 255, 255);
    $red = imagecolorallocate($im, 255, 0, 0);
    $grey = imagecolorallocate($im, 128, 128, 128);
    $black = imagecolorallocate($im, 0, 0, 0);
    imagefilledrectangle($im, 0, 0, $width, $height, $red);

    $font = FONT_FOLDER . CAPTCHA_FONTS[rand(0, count(CAPTCHA_FONTS) -1)];

    $tb = imagettfbbox(CAPTCHA_FONT_SIZE, 0, $font, $string);

    imagettftext(
      $im,
      CAPTCHA_FONT_SIZE,
      rand(-CAPTCHA_MAX_ANGLE, CAPTCHA_MAX_ANGLE),
      ceil(($width - $tb[2]) / 2),
      ceil(($height - $tb[3]) / 2),
      0x000000,
      $font,
      $string
    );

    return $im;
  }

  function generateCaptchaString() {
    $string = '';
    for($i = 0; $i < CAPTCHA_LENGTH; $i++) {
      $string .= substr(CHARACTER_SET, rand(0, strlen(CHARACTER_SET) - 1), 1);
    }
    return $string;
  }

  function generateCaptcha() {
    $captcha_string = generateCaptchaString();
    return array(
      'String' => $captcha_string,
      'Image' => generateCaptchaImage($captcha_string)
    );
  }

?>
