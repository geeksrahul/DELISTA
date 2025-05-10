<?php 
    session_start();
    include "../db/config.php";
    if(!isset($_SESSION["user_id"])) {
        header("location:login.php");
    }
    $order_id = $_GET["order_id"];
    // $delete_order_items = $conn->query("DELETE FROM order_items WHERE order_id = $order_id");
    // if(!$delete_order_items){
    //     die("can't delete items");
    // }
    $update_order = $conn->query("UPDATE orders SET status=2 WHERE order_id = $order_id");
    if(!$update_order){
        die("can't update order");
    }
    header("location:orders.php");
?>