<?php
  include "../classes/User.php";

  // create an object
  $user_obj = new User;

  $user_obj->store($_POST);
?>