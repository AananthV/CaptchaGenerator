<?php
  $ROOT_PATH = '.';

  require_once($ROOT_PATH . '/config.php');
?>

<div id="captcha"></div>
<button type="button" onclick="insertCaptcha()">Generate New</button>
<input type="text" id="captcha-text" value="">
<button type="button" onclick="verifyCaptcha()">Verify</button>
<div id="verification-message"></div>

<script type="text/javascript">
  let captcha_id = -1;

  let getCaptcha = function() {
    return new Promise(function(resolve, reject) {
      let xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
          resolve(this.responseText);
        }
      };
      xhttp.open("GET", "<?php echo BACKEND . 'get_captcha.php';?>", true);
      xhttp.send();
    });
  }

  let insertCaptcha = async function() {
    let captcha = JSON.parse(await getCaptcha());

    if(captcha.Message == 'SUCCESS') {
      let captcha_div = document.querySelector('#captcha');
      captcha_div.innerHTML = '';

      let captcha_image = document.createElement('img');
      captcha_image.setAttribute('src', 'data:image/png;base64,' + captcha.captcha_image);

      captcha_div.appendChild(captcha_image);

      captcha_id = captcha.captcha_id;
    }
  }

  let verifyCaptcha = function() {
    let captcha_string = document.querySelector('#captcha-text').value;
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        let response = JSON.parse(this.responseText);
        if(response['Message'] == 'VERIFIED') {
          document.querySelector('#verification-message').innerHTML = 'Verified';
        } else {
          document.querySelector('#verification-message').innerHTML = 'Invalid Captcha';
          insertCaptcha();
        }
      }
    };
    xhttp.open("POST", "<?php echo BACKEND . 'verify_captcha.php';?>", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('captcha_id=' + captcha_id + '&captcha_string=' + captcha_string);
  }
</script>
