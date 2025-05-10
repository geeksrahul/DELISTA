<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    
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
?>
<div class="container-fluid">
    <div class="row">
        <!-- Include Sidebar -->
        <?php include '../sidebar.php'; ?>
        
        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 content">
            <h2 class="mb-4">Manage Users</h2>
            <div class="table-container">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>City</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch users from the database
                        $query = "SELECT * FROM users";
                        $result = mysqli_query($conn, $query);

                        if(mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                        <td>{$row['username']}</td>
                                        <td>{$row['email']}</td>
                                        <td>{$row['phone']}</td>
                                        <td>{$row['city']}</td>
                                        <td>
                                            <a href='update.php?id={$row['id']}' class='btn btn-warning btn-sm'>Update</a>
                                            <a href='delete.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(Are you sure?)'>Delete</a>
                                        </td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7' class='text-center'>No Users Found</td></tr>";
                        }
                        ?>
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
