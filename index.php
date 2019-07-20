<?php
header("Access-Control-Allow-Origin: *");

include './utils.php';

if (isset($_GET['secret'], $_GET['length']) && $_GET['length'] > 0) {
  $secret = $_GET['secret'];
  $length = $_GET['length'];
  $totp = GetTotp($secret, $length);
  echo $totp;
  exit;
} else {
  $output = json_encode('please specify (int) length and (string) secret as url params.');
  echo $output;
  exit;
}
