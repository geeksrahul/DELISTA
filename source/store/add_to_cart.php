<?php 
    include "../db/config.php";
    session_start();
    // checking if user logged in or not
    if(!isset($_SESSION['user_id'])){
        header("location:../profile/login.php");
    }
    $product_id = isset($_POST['product_id']) ? $_POST["product_id"] : $_GET['product_id'];
    $user_id = $_SESSION['user_id'];
    $qty = $_POST["qty"];
    $price = $_POST["price"];
    // checking if product already exist in cart
    $check = $conn->query("SELECT * FROM cart WHERE user_id = $user_id AND product_id = $product_id");
    if ($check->num_rows > 0) {
        // Update quantity
        $query = "UPDATE cart set qty = $qty WHERE user_id = $user_id AND product_id = $product_id";
        $result = mysqli_query($conn, $query);
    } else {
        // Insert new item into cart
        // $conn->query("INSERT INTO cart (user_id, product_id, qty) VALUES ($user_id, $product_id, $qty)");
        $query = "INSERT INTO CART(user_id, product_id, qty, price) VALUES ($user_id, $product_id, $qty, $price)";
        $result = mysqli_query($conn, $query);
    }
    header("location:cart.php");
?>