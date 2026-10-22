<?php
  include "../classes/User.php";

  $user = new User;
  $user->update($product_id, $product_name, $price, $quantity);
?>