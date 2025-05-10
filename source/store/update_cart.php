<?php 
  include "../db/config.php";
  session_start();
  if(!isset($_SESSION['user_id'])) {
      header("location:../profile/login.php");
  } else {
      $id = $_GET['id'];
      $operation = $_GET['op'];
      if($operation === 'rmv'){
        $query = "UPDATE cart SET qty = qty - 1 WHERE id = $id";
      } else {
        $query = "UPDATE cart SET qty = qty + 1 WHERE id = $id";
      }
      $result = mysqli_query($conn, $query);
      header("location:cart.php");
  } 
?>