<?php
  include "../classes/User.php";

  $user_obj = new User;

  $user_obj->login($_POST);
?>