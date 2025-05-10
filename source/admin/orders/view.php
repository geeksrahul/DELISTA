<?php 
// Database connection
include "../../db/config.php";

// Get the order ID from the URL
$order_id = isset($_GET['order_id']) ? (int)$_GET['order_id'] : 0;

// Fetch order details
$sql = "SELECT o.*, u.username AS user_name, u.email, u.phone
FROM orders o
INNER JOIN users u ON o.user_id = u.id
WHERE o.order_id = $order_id;";

$order_result = $conn->query($sql);

if ($order_result->num_rows == 0) {
    die("Order not found!");
}

$order = $order_result->fetch_assoc();

// Fetch order items
$sql_items = "SELECT oi.*, p.name AS product_name 
              FROM order_items oi
              INNER JOIN products p ON oi.product_id = p.id 
              WHERE oi.order_id = $order_id;";

$item_result = $conn->query($sql_items);

// Handle form submission for status update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_status = $_POST['status'];
    
    // Update the order status in the database
    $update_sql = "UPDATE orders SET status = '$new_status' WHERE order_id = $order_id";
    
    if ($conn->query($update_sql) === TRUE) {
        echo "<script>alert('Order status updated successfully!'); window.location.href='view.php?order_id=$order_id';</script>";
        exit();
    } else {
        echo "Error updating status: " . $conn->error;
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
        p {
            font-size: 16px;
            margin: 8px 0;
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
        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 18px;
            background: #007bff;
            color: white;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 500;
            text-decoration: none;
            text-align: center;
            transition: 0.3s;
            display: block;
            width: fit-content;
            margin-left: auto;
            margin-right: auto;
        }
        .back-btn:hover {
            background: #0056b3;
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
        .accept-btn {
            background: #28a745;
            color: white;
        }
        .reject-btn {
            background: #dc3545;
            color: white;
        }
        .accept-btn:hover {
            background: #218838;
        }
        .reject-btn:hover {
            background: #c82333;
        }
        .sidebar {
            height: 100vh;
            background: linear-gradient(135deg, #2c3e50, #1c2833);
            color: white;
            padding-top: 20px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2);
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 12px;
            margin: 8px 15px;
            border-radius: 8px;
            transition: all 0.3s;
            font-weight: 500;
        }
        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.15);
        }
        .content {
            margin: 10px !important;
            padding: 10px !important;
        }
    </style>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <?php include "../sidebar.php"; ?>
        </div>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

            <h2>Order Details (ID: <?php echo $order_id; ?>)</h2>
            
            <div class="details">
                <p><strong>User:</strong> <?php echo $order["user_name"]; ?> (<?php echo $order["email"]; ?>) (<?= $order["phone"] ?>) </p>
                <p><strong>Total Price:</strong> $<?php echo number_format($order["total_price"], 2); ?></p>
                <p><strong>Status:</strong> <?php echo ucfirst($order["status"]); ?></p>
            </div>

            <h3>Items Ordered:</h3>
            <table>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
                <?php while ($item = $item_result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $item["product_name"]; ?></td>
                        <td><?php echo $item["quantity"]; ?></td>
                        <td>$<?php echo number_format($item["price"], 2); ?></td>
                    </tr>
                <?php } ?>
            </table>

            <!-- Buttons to Accept or Reject Order -->
            <form method="post">
                <div class="buttons">
            <?php 
                if($order["status"] == "Pending" ) {
                    echo 
                    '
                        <button type="submit" name="status" value="accepted" class="btn accept-btn btn-success">Accept Order</button>
                        <button type="submit" name="status" value="rejected" class="btn reject-btn btn-danger">Reject Order</button>
                    ';
                }
                if($order["status"] == "Cancelled" or $order["status"] == "Rejected") {
                    echo "
                    <a href='delete.php?order_id=$order[order_id]' class='btn reject-btn'>Delete</a>
                    ";
                }
            ?>
            </div>
        </form>
                <a href="index.php" class="back-btn">← Back to Orders</a>
        </main>
    </div>
</body>
</html>
     

<?php $conn->close(); ?>
