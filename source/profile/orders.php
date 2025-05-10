<?php
// Connect to database
include "../db/config.php";

// Fetch all orders
session_start();
$user_id = $_SESSION["user_id"];
$sql = "SELECT order_id, user_id, total_price, status FROM orders WHERE user_id = $user_id AND status <> 5";
$result = $conn->query($sql);
if($result->num_rows <= 0) {
    die("order not founds");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            margin: 20px;
        }
        .container {
            margin-top: 140px !important;
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
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
        }
        tr:nth-child(even) {
            background: #f2f2f2;
        }
        tr:hover {
            background: #e9ecef;
        }
        .view-btn {
            display: inline-block;
            padding: 8px 12px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: 0.3s;
        }
        .view-btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
<?php include "../header.php"; ?>
<div class="container">
    <h2>All Orders</h2>
    <table>
        <tr>
            <th>Order ID</th>
            <th>User ID</th>
            <th>Total Price</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row["order_id"]; ?></td>
                <td><?php echo $row["user_id"]; ?></td>
                <td>$<?php echo number_format($row["total_price"], 2); ?></td>
                <td><?php echo $row["status"]; ?></td>
                <td><a href="view_order.php?order_id=<?php echo $row['order_id']; ?>" class="view-btn">View</a></td>
            </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>

<?php $conn->close(); ?>
