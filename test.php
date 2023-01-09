<?php
  $phone = '19123528388';
  if(preg_match("/^09[0-9]{9}$/", $phone)) {
    // $phone is valid
    echo 'Valid phone';
  } else {
    echo 'invalid';
  }

  $email = 'makelsevilla@gmailcom';

  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo 'valid email';
  }
?>  