<?php
    session_start();
    include "../db/config.php"; 
    if(!isset($_SESSION["user_id"])) {
        header("location:../profile/login.php");
    } 
    $user_id = $_SESSION['user_id'];

    $result = $conn->query("SELECT c.id, c.product_id, c.qty, p.name, p.price, p.image
                            FROM cart c 
                            JOIN products p ON c.product_id = p.id
                            WHERE c.user_id = $user_id");
    if (isset($_POST['remove'])) {
        $product_id = $_POST['product_id'];
        $conn->query("DELETE FROM cart WHERE user_id = $user_id AND product_id = $product_id");
        header("Location: cart.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
       .sidebar {
            height: 100vh;
            background: #343a40;
            color: white;
            padding-top: 20px;
            position:fixed;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            transition: 0.3s;
        }
        .sidebar a:hover {
            background: #495057;
        }
        .content {
            padding: 20px;
        }
        .container {
            width: 500px;
            margin-left: 250px !important;
        }
        body {
            background-color: #f8f9fa;
        }
        .cart-container {
            max-width: 900px;
            margin: 50px auto;
        }
        .cart-card {
            background: white;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .cart-card img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
        }
        .cart-details {
            flex: 1;
        }
        .quantity-input {
            width: 60px;
            text-align: center;
        }
        .remove-btn {
            text-decoration:none;
            border: none;
            background: none;
            color: red;
            font-size: 20px;
            cursor: pointer;
        }
        .checkout-btn {
            width: 100%;
            margin-top: 20px;
        }
        .empty-cart {
            max-width: 400px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .empty-cart-img {
            width: 150px;
            opacity: 0.8;
        }
    </style>
</head>
<body class="bg-light container-fluid">
    <div class="row">
        <?php include "sidebar.php"; ?>
    <div class="container cart-container">
        <h2 class="text-center mb-4">🛒 Shopping Cart</h2>
    <?php 
        if(mysqli_num_rows($result) > 0) {
            foreach($result as $product) {
                echo "
                <div class='cart-card d-flex mb-3'>
                    <img src='../uploads/products/$product[image]' alt='Product'>
                    <div class='cart-details'>
                        <h5>$product[name]</h5>
                        <p class='text-muted'>Price: $product[price]</p>
                        <a href='/a'> increase </a>
                        <input type='number' class='form-control quantity-input d-inline-block' value='$product[qty]' min='1'>
                        <a href='/a'> decrease </a> 
                    </div>
                    <a href='../store/remove_from_cart.php?id=$product[id]' class='remove-btn'> ❌ </a>
                </div>
                
                ";
            }
            echo "
                <a class='btn btn-success checkout-btn' href='../store/index.php'> Back to store </a>
                <button class='btn btn-success checkout-btn'> Proceed to Checkout </button>
            ";
        } else {
            echo '
                <div class="empty-cart text-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png" alt="Empty Cart" class="empty-cart-img">
                    <h4 class="mt-3">Your Cart is Empty</h4>
                    <p class="text-muted">Looks like you haven\'t added anything to your cart yet.</p>
                    <a href="index.php" class="btn btn-primary">Continue Shopping</a>
                </div>
                ';
        }
    ?>
</div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>