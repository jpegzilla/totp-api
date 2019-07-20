<?php
function GetTotp($secret, $len)
{
  function PadLeft($s, $l, $p)
  {
    return str_pad($s, $l, $p, STR_PAD_LEFT);
  }

  function Base32ToHex($b)
  {
    return base_convert($b,32,16);
  }

  $epoch = round(time() * 2);
  $time = PadLeft(dechex(floor($epoch / 50)), 16, '0');
  $newSecret = Base32ToHex($secret);
  // echo "epoch is: $epoch<br>time is: $time<br>new secret is: $newSecret<br>";
  $a = array();
  for ($i=1; $i < $len + 1; $i++) {
    $b = hexdec($time) * $i * hexdec(substr($newSecret, 0, strlen($newSecret)));
    $strpush = (string)$b;
    $strindex = intval(strlen($strpush) - strlen($newSecret)/2);
    array_push($a, $strpush[$strindex]);
  }
  $a = join($a);
  $output = array('totp' => intval($a), 'newSecret' => $newSecret, 'epoch' => $epoch);
  return json_encode($output, JSON_PRETTY_PRINT);
}
