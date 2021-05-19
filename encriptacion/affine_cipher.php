<?php

//Key values of a and b
$a = 3;
$b = 5;
echo "plaintext ";
echo $plaintext = "DEADSPACE";
echo $ciphertext = trim(affine_cipher_encryption($plaintext, $a, $b));

/*
echo "<br>plaintext ";
echo $plaintext = "deadspace";
echo affine_cipher_encryption($plaintext, $a, $b);
*/

echo "<br>";
echo $plaintext = affine_cipher_decrypttion("ORFOHYFLR", $a, $b);

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
 }
 return $ciphertext;
}


/**
 * Decrypt a character using the affine cipher
 *
 * @param string $text the ciphertext to decrypt
 * @param array $key the original encryption key
 * @result string the decrypted character
 */
function affine_cipher_decrypttion($ciphertext, $a, $b ) {
    $a = mod_inverse($a, 26);

    $plaintext = '';
    for ($i = 0; $i < strlen($ciphertext); $i++) {
        $num = tmod($a * (num($ciphertext[$i]) - $b), 26);
        $plaintext .= chr($num + ord('a'));
    }

    return $plaintext;
}

/**
 * Calculate the multiplicative inverse modulo m
 *
 * @param int $x integer to calculate inverse for
 * @param int $m modulo
 * @return int the multiplicative inverse modulo m
 */
function mod_inverse($x, $m = 26) {
    list(, $x) = gcd($x, $m);
    return tmod($x, $m);
}

/**
 * Implementation of extended euclidian algorithm. Adapted from:
 * Cryptography - pieces from work by Gordon Royle.
 *
 * @param int $a first integer
 * @param int $b second integer
 * @return array a triple (d, x, y) such that d = gcd(a, b) = xa + yb.
 */
function gcd($a, $b) {
    if ($b == 0) return array($a, 1, 0);

    list ($d, $xp, $yp) = gcd($b, $a % $b);
    list ($d, $x, $y) = array($d, $yp, $xp - $yp * floor($a / $b));

    return array($d, $x, $y);
}

/**
 * Get the numeric value of a character
 *
 * @param string $char the character to get the numeric value for
 * @return int the character's numeric value (0 - 25)
 */
function num( $char ) {
    return ord(strtoupper($char)) - ord('A');
}

/**
 * Represent negative remainders by their positive equivalence classes.
 * By default, PHP will interpret -3 (mod 7) as -3 opposed to 4.
 *
 * @param int $a integer to calculate for
 * @param int $m modulo
 */
function tmod($a, $m = 26) {
    return (($a % $m) + $m) % $m;
}

function z_affine_cipher_decrypttion($ciphertext, $a, $b){
 $plaintext = "";
 for($i = 0; $i < strlen($ciphertext); $i++) {

  $j = substr($ciphertext, $i, 1); //j es cada letra
  $plaintext .= chr(((modinv($a, 26)*ord($j) - ord('A') - $b)) %26 + ord("A"));
 }
 return $plaintext;
}

//decrypt affine_cipher_encryption
function z_egcd($a, $b){

 $x = 0; $y = 1; $u = 1; $v = 0;

	while ($a != 0){
  $q = intdiv($b, $a);
  $r = $b%$a;
		$m = $x-$u*$q;
  $n = $y-$v*$q;
		$b = $a;
  $a = $r;
  $x = $u;
  $y = $v;
  $u = $m;
  $v = $n;
 }

	$gcd = $b;
 $gdc_array = array("gcd"=>$gcd, "x"=>$x, "y"=>$y);
	//return ($gcd, $x, $y)
	return ($gdc_array);
}

function z_modinv($a, $m){
 $gcd_array = egcd($a, $m);
 $gcd = $gcd_array["gcd"];
 $x = $gcd_array["x"];
 $y = $gcd_array["y"];

 if ($gcd !=1) {
  return null;
 }else{
  return $x % $m;
 }
}

?>
