<?php
 require_once("model/User.php");

 $User = new User;
 $users = $User->getUsers();

 require_once("view/users_view.php");
?>
