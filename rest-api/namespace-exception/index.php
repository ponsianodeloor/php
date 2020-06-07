<?php
 require 'app/lib/Session.php';
 require 'app/lib/Matematica.php';
 require 'app/model/UserModel.php';
 require 'app/provider/UserModel.php';
 require 'app/routes/UserRoute.php';

 use App\Lib\Session,
     App\Lib\Matematica,
     App\Model\UserModel as a,
     App\Provider\UserModel as b,
     App\Routes\UserRoute;

 var_dump(new Session());
 var_dump(new a());
 var_dump(new b());
 var_dump(new UserRoute());

 try {
   var_dump(Matematica::sumar(1,4));
 } catch (Exception $e) {
  var_dump($e);
 }


?>
