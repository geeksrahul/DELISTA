<?php 
// Database connection 
include "../db/config.php";

// Get the order ID from the URL 
$order_id = isset($_GET['order_id']) ? (int)$_GET['order_id'] : 0;

// Fetch order details 
$sql = "SELECT o.*, u.username AS user_name, u.email  FROM orders o INNER JOIN users u ON o.user_id = u.id WHERE o.order_id = $order_id;";  
$order_result = $conn->query($sql);  

if ($order_result->num_rows == 0) { 
    die("Order not found!"); 
}  
$order = $order_result->fetch_assoc();

// Fetch order items 
$sql_items = "SELECT oi.*, p.name AS product_name FROM order_items oi INNER JOIN products p ON oi.product_id = p.id WHERE oi.order_id = $order_id;";  
$item_result = $conn->query($sql_items);

// Handle form submission for status update 
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    if (isset($_POST['status'])) {
        $new_status = $_POST['status']; 
        $update_sql = "UPDATE orders SET status = '$new_status' WHERE order_id = $order_id";

        if ($conn->query($update_sql) === TRUE) {
            echo "<script>alert('Order status updated successfully!'); window.location.href='order_details.php?order_id=$order_id';</script>";
            exit();
        } else {
            echo "Error updating status: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order #<?php echo $order_id; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f6f9;
        }
        .container {
            margin-top: 120px !important;
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .details {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            border-left: 4px solid #007bff;
        }
        .details strong {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background: #007bff;
            color: white;
            font-weight: 600;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
        tr:hover {
            background: #f1f1f1;
        }
        .buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }
        .btn {
            padding: 10px 16px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            font-weight: 500;
        }
        .cancel-btn {
            background: #dc3545;
            color: white;
        }
        .cancel-btn:hover {
            background: #c82333;
        }
        .back-btn {
            display: block;
            margin-top: 20px;
            text-align: center;
            text-decoration: none;
            color: #007bff;
            font-weight: 500;
        }
        .back-btn:hover {
            text-decoration: underline;
        }
        .cancel-link {
            display: inline-block;
            padding: 10px 16px;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            font-weight: 500;
            text-decoration: none;
            margin-top: 20px;
        }
        .cancel-link:hover {
            background: #c82333;
        }
    </style>
</head>
<body>
    <?php include "../header.php"; ?>
    <div class="container">
        <h2>Order Details (ID: <?php echo $order_id; ?>)</h2>
        <div class="details">
            <p><strong>User:</strong> <?php echo $order["user_name"]; ?> (<?php echo $order["email"]; ?>)</p>
            <p><strong>Total Price:</strong> $<?php echo number_format($order["total_price"], 2); ?></p>
            <p><strong>Status:</strong> <?php echo ucfirst($order["status"]); ?></p>
        </div>

        <h3>Items Ordered:</h3>
        <table>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Amount</th>
            </tr>
            <?php while ($item = $item_result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $item["product_name"]; ?></td>
                    <td><?php echo $item["quantity"]; ?></td>
                    <td>$<?php echo number_format($item["price"], 2); ?></td>
                    <td>$<?php echo number_format($item["price"]*$item["quantity"], 2); ?></td>
                </tr>
            <?php } ?>
        </table>
        <?php 
            if($order["status"] == "Pending" ) {
                echo 
                "
                    <div class='buttons'>
                        <a href='cancel_order.php?order_id=$order_id' class=' cancel-link'>Cancel Order</a>
                    </div>
                ";
            }
        ?>

        <a href="orders.php" class="back-btn">← Back to Orders</a>
    </div>
</body>
</html>
<?php $conn->close(); ?>