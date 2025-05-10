<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    
    <!-- Local Bootstrap CSS -->
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        body {
            background: #f4f7fc;
            font-family: 'Poppins', sans-serif;
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
            padding: 40px;
        }
        .table-container {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        }
        .table th {
            background: #2c3e50;
            color: white;
        }
        .btn-sm {
            font-size: 0.9rem;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .view-btn {
            display: inline-block;
            padding: 6px 10px;
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
<?php 
    // authentication
    session_start();
    if(!isset($_SESSION["admin"])) {
        header("location:../login.php");
        exit();
    }
    include '../../db/config.php'; 

    // Fetch all orders
    $orders = $conn->query("SELECT order_id, user_id, total_price, status FROM orders");
?>
<div class="container-fluid">
    <div class="row">
        <!-- Include Sidebar -->
        <?php include '../sidebar.php'; ?>
        
        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 content">
            <h2 class="mb-4">Manage Orders</h2>
            
            <div class="table-container">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>User ID</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $orders->fetch_assoc()): ?>
                            <tr>
                                <td><?= $row['order_id'] ?></td>
                                <td><?= $row['user_id'] ?></td>
                                <td>$<?= number_format($row['total_price'], 2) ?></td>
                                <td><?= $row['status'] ?></td>
                                <td>
                                    <a href="view.php?order_id=<?= $row['order_id'] ?>" class="view-btn">View</a>
                                   
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<!-- Local Bootstrap JS -->
<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>