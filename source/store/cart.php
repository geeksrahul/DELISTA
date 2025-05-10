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
        header("Location:cart.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Shopping Cart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #2c3e50, #34495e);
            color: #ecf0f1;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .cart-container {
            width: 700px;
            margin: 50px auto;
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 8px 25px rgba(0, 0, 0, 0.4);
        }
        .cart-item {
            display: grid;
            grid-template-columns: 120px 1fr 100px 80px;
            gap: 20px;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            border-radius:12px;
            padding: 15px 12px;
            transition: background-color 0.3s ease;
        }
        .cart-item:hover {
            background-color: rgba(255, 255, 255, 0.08);
        }
        .cart-item img {
            width: 100%;
            border-radius: 8px;
            object-fit: cover;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .item-details h5 {
            margin-bottom: 5px;
            font-weight: 600;
        }
        .item-details p {
            color: #bdc3c7;
        }
        .quantity-controls {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }
        .quantity-controls a {
            text-decoration:none;
            background: none;
            border: none;
            color: #e67e22;
            font-size: 18px;
            cursor: pointer;
            transition: color 0.3s ease;
        }
        .quantity-controls a:hover {
            color: #d35400;
        }
        .quantity-controls input {
            min-width: 60px;
            text-align: center;
            border: 1px solid #7f8c8d;
            border-radius: 4px;
            padding: 6px;
            background: rgba(255, 255, 255, 0.1);
            color: #ecf0f1;
        }
        .remove-btn {
            background: none;
            border: none;
            color:rgb(255, 255, 255);
            font-size: 20px;
            cursor: pointer;
            transition: color 0.3s ease;
        }
        .remove-btn:hover {
            color:rgb(255, 25, 0);
        }
        .cart-summary {
            margin-top: 30px;
            text-align: right;
        }
        .cart-summary h4 {
            margin-bottom: 10px;
        }
        .cart-summary a {
            display: inline-block;
            padding: 12px 25px;
            background-color:rgb(0, 81, 211);
            color: white;
            text-decoration: none;
            border-radius: 6px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .cart-summary a:hover {
            background-color:rgb(0, 81, 211);
            background:rgb(36, 88, 192);
            transform: translateY(-2px);
        }
        .empty-cart {
            text-align: center;
            padding: 40px;
        }
        .empty-cart img {
            width: 180px;
            opacity: 0.7;
        }
        .empty-cart p {
            color: #95a5a6;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container cart-container">
        <h2 class="text-center mb-4"><i class="fas fa-shopping-cart"></i> Your Shopping Cart</h2>
        <?php 
            if(mysqli_num_rows($result) > 0) {
                $total = 0;
                foreach($result as $product) {
                    $total += $product['price'] * $product['qty'];
                    echo "
                    <div class='cart-item'>
                        <img src='../uploads/products/$product[image]' alt='Product'>
                        <div class='item-details'>
                            <h5>$product[name]</h5>
                            <p>Price: $$product[price]</p>
                        </div>
                        <div class='quantity-controls'>
                            <a href='update_cart.php?id=$product[id]&op=rmv' onclick='decreaseQty(this)'>-</a>
                            <input type='number' value='$product[qty]' min='1'>
                            <a href='update_cart.php?id=$product[id]&op=add' onclick='increaseQty(this)'>+</a>
                        </div>
                        <a href='remove_from_cart.php?id=$product[id]' class='remove-btn' title='Remove'><i class='fas fa-trash-alt'></i></a>
                    </div>
                    ";
                }
                echo "
                <div class='cart-summary'>
                    <h4>Total: $$total</h4>
                    <a href='checkout.php'>Proceed to Checkout <i class='fas fa-arrow-right'></i></a>
                    <a href='index.php' style='margin-top:10px;'>Continue shopping <i class='fas fa-shopping-bag'></i></a>
                </div>
                ";
            } else {
                echo '
                <div class="empty-cart">
                    <img src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png" alt="Empty Cart">
                    <h4>Your Cart is Empty</h4>
                    <p>Looks like you haven\'t added anything yet.</p>
                    <a href="index.php" class="btn btn-primary">Continue Shopping</a>
                </div>
                ';
            }
        ?>
    </div>
    <script>
        function decreaseQty(button) {
            let input = button.nextElementSibling;
            if (input.value > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }
        function increaseQty(button) {
            let input = button.previousElementSibling;
            input.value = parseInt(input.value) + 1;
        }
    </script>
</body>
</html>