<?php

//Key values of a and b
$a = 3;
$b = 5;
echo "plaintext ";
echo $plaintext = "DEADSPACE";
echo affine_cipher_encryption($plaintext, $a, $b);

echo "<br>plaintext ";
echo $plaintext = "deadspace";
echo affine_cipher_encryption($plaintext, $a, $b);

function affine_cipher_encryption($plaintext, $a, $b){
 $ciphertext = " ";
 for($i = 0; $i < strlen($plaintext); $i++) {

  $j = substr($plaintext, $i, 1); //j es cada letra

  switch ($j) {
   case " ":
    $ciphertext.=" ";
    break;
   case strtoupper($j):
    $ciphertext .= chr(($a * ord($j) + $b - 65) % 26 + 65);
    break;
   case strtolower($j):
    $ciphertext .= chr(($a * ord($j) + $b - 97) % 26 + 97);
    break;
  }
  /*$ciphertext .= chr(($a * ord($j) + $b - 65) % 26 + 65);

  echo "<br> ciphertext".$ciphertext." a ",$a," i ",substr($plaintext, $i, 1),
       " ord(i) ", ord(substr($plaintext, $i, 1)), " a*ord(i) ", $a*ord(substr($plaintext, $i, 1)), " b ", $b, " b-65 ",
       $b-65;
  */
 }
 return $ciphertext;
}
?>
