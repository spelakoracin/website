<?php
   session_start();
   if(isset($_POST['logout'])){
   unset($_SESSION['valid']);
   unset($_SESSION['id_uporabnika']);
   session_destroy();

   echo '<script> window.open("Login.html","_self");</script>';
   }
?>