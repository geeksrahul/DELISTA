<?php 
    include "../db/config.php";
    session_start();
    if(!isset($_SESSION['user_id'])) {
        header("location:../profile/login.php");
    } else {
        $id = $_GET['id'];
        $query = "DELETE FROM cart WHERE id=$id";
        $result = mysqli_query($conn, $query);
        header("location:cart.php");
    }
?>