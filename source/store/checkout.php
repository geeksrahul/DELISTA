<?php 
    include "../db/config.php";
    session_start();
    if(!isset($_SESSION["user_id"])) {
        header("location:../profile/login.php");
    }
    $user_id = $_SESSION["user_id"];
    $cart = $conn->query("SELECT * FROM cart WHERE user_id = $user_id");
    $create_order = $conn->query("INSERT INTO orders(user_id, total_price) VALUES($user_id, 0);");
    $select = $conn->query("SELECT MAX(order_id) AS 'id' from orders");
    foreach($select as $order)
    $order_id = $order["id"];
    $total = 0;
    foreach($cart as $product) {
        $product_id = $product["product_id"];
        $qty = $product["qty"];
        $price = $product["price"];
        $insert = $conn -> query("INSERT INTO order_items(order_id,product_id,quantity,price) VALUES($order_id,$product_id,$qty,$price)");
        $delete = $conn -> query("DELETE FROM cart WHERE product_id = $product_id");
        $total = $total + $price*$qty;
    }
    $update_order = $conn -> query("UPDATE orders SET total_price = $total WHERE order_id=$order_id");
    echo "<script> alert('order requested succesfully'); </script>";
    header("location:../profile/orders.php");
?>