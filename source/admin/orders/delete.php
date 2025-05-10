<?php 
    session_start();
    if(!isset($_SESSION["admin"])) {
        header("location:../login.php");
    }
    include "../../db/config.php";
    $id = $_GET["order_id"];
    $delete_order_items = $conn->query("DELETE FROM order_items WHERE order_id=$id");
    if(!$delete_order_items) {
        die("can't delete order items");
    }
    $delete_order = $conn->query("DELETE FROM orders WHERE order_id = $id");
    if(!$delete_order) {
        die("can't delete order");
    } else {
        header("location:index.php");
    }
?>