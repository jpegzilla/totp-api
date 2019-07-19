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
  echo "$epoch<br>";
  $time = PadLeft(dechex(floor($epoch / 30)), 16, '0');
  echo "$time<br>";
  $newSecret = Base32ToHex($secret);
  $a = array();
  for ($i=1; $i < $len + 1; $i++) {
    $b = hexdec($time) * $i * hexdec(substr($newSecret, 0, strlen($newSecret)));
    $strpush = (string)$b;
    array_push($a, $strpush[strlen($strpush) - 2]);
  }
  $a = join($a);
  $output = array('totp' => intval($a));
  return json_encode($output, JSON_PRETTY_PRINT);
}
