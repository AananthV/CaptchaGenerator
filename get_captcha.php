<?php

  $ROOT_PATH = '.';

  require_once($ROOT_PATH . '/helpers/database.php');
  require_once($ROOT_PATH . '/helpers/captcha.php');

  function getCaptcha() {
    $captcha = generateCaptcha();

    $captcha_hashed = password_hash($captcha['String'], PASSWORD_DEFAULT);

    $captcha_id = insertValues(
      'captchas',
      array('captcha_hashed' => $captcha_hashed)
    );

    ob_start();
    imagepng($captcha['Image']);

    return json_encode(array(
      'Message' => 'SUCCESS',
      'captcha_id' => $captcha_id,
      'captcha_image' => base64_encode(ob_get_clean())
    ));

  }

  echo getCaptcha();
?>
