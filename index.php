<?php

include './utils.php';

if (isset($_GET['secret'], $_GET['length']) ) {
  $secret = $_GET['secret'];
  $length = $_GET['length'];
  $totp = GetTotp($secret, $length);
  echo($totp);
  exit;
} else {
  echo 'nothing to see here...';
  exit;
}