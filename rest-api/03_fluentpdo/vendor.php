<?php
require '/Applications/XAMPP/xamppfiles/htdocs/Dropbox/php/rest-api/03_fluentpdo/vendor/autoload.php';


$pdo = new PDO("mysql:dbname=colegio", "root", "ponsiano");
$fpdo = new FluentPDO($pdo);

var_dump($fpdo);
?>
