<?php

  $ROOT_PATH = '.';

  require_once($ROOT_PATH . '/helpers/database.php');

  function verify_captcha() {
    if(
      !isset($_POST['captcha_id']) ||
      !isset($_POST['captcha_string']) ||
      !checkIfRowExists('captchas', array('id' => $_POST['captcha_id'], 'verified' => 0))
    ) return json_encode(array(
      'Message' => 'ERROR: INVALID DATA'
    ));

    $captcha_hashed = getValues(
      'captchas',
      array('captcha_hashed'),
      array('id' => array('type' => '=', 'value' => $_POST['captcha_id']))
    )[0]['captcha_hashed'];

    updateValues(
      'captchas',
      array('verified' => 1),
      array('id' => $_POST['captcha_id'])
    );

    if(password_verify($_POST['captcha_string'], $captcha_hashed)) {
      return json_encode(array(
        'Message' => 'VERIFIED'
      ));
    } else return json_encode(array(
      'Message' => 'ERROR: WRONG CAPTCHA'
    ));
  }

  echo verify_captcha();
?>
