<?php
 if (isset($_GET['url'])) {
  $url = filter_input(INPUT_GET,'url',FILTER_SANITIZE_URL);
  $url = explode('/', $url);
  $url = array_filter($url);
  print_r($url);
 }
?>
