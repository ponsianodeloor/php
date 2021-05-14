<!DOCTYPE html>
<html lang="en" dir="ltr">
 <head>
  <meta charset="utf-8">
  <title></title>
 </head>
 <body>
  <form name="formula" action="mcm.php" method="POST">
    <b>
    <FONT FACE="Comic Sans MS" size=6>introduce el Num1:</FONT>
    <input type=text name="x"></input></br></br>
    <FONT FACE="Comic Sans MS" size=6>introduce el Num2:</FONT>
    <input type=text name="y"></input></br></br>
    <input type=submit value="Multiplo"></input>
    <input type=reset value="Borrar"><br></b>
   </form>
 </body>
</html>
<?php

if (isset($_POST["x"]) && isset($_POST["y"])) {
 // code...
    $a1 = $_POST["x"];
    $b1 = $_POST["y"];

    $resp = mcd($a1,$b1);
    $resp2 = mcm($a1,$b1);

    echo "el mcm es: $resp2<br>";
    //echo "el mcd es: $resp";
}

function mcd($a,$b) {
while (($a % $b) != 0) {
$c = $b;
$b = $a % $b;
$a = $c;
}
return $b;
}

function mcm($a,$b) {
return ($a * $b) / mcd($a,$b);
}

?>
