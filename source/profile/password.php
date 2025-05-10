<?php
session_start();
include "../db/config.php";
if (!isset($_SESSION['user_id'])) {
    header('Location:login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
        }
        .sidebar {
            height: 100vh;
            background: linear-gradient(135deg, #563d7c, #764ba2);
            color: white;
            padding-top: 20px;
            position: fixed;
            width: 250px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            transition: 0.3s;
            border-radius: 5px;
            margin: 5px;
        }
        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.2);
        }
        .content {
            margin-left: 250px;
            padding: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            width: 400px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            background: white;
            padding: 30px;
            text-align: center;
        }
        .form-control {
            border-radius: 10px;
            padding: 10px;
        }
        .btn-primary {
            background: #764ba2;
            border: none;
            padding: 10px;
            border-radius: 10px;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background: #563d7c;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <?php include "sidebar.php"; ?>
    </div>
    
    <main class="content">
        <div class="container">
            <div class="card">
                <h2>Change Password</h2>
                <form action="" method="POST">
                    <div class="mb-3">
                        <input type="password" class="form-control" id="current_password" name="old_password" placeholder="old password"  required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" id="new_password" name="new_password" placeholder="new password"  required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="confirm_password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100" name="btn_update_password">Change Password</button>
                </form>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
if (isset($_POST["btn_update_password"])) {
    $id = $_SESSION["user_id"];
    $result = mysqli_query($conn, "SELECT password FROM USERS WHERE ID=$id");
    $user = mysqli_fetch_assoc($result);
    
    $old_password = $_POST["old_password"];
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];
    
    if ($user && password_verify($old_password, $user["password"])) {
        if ($new_password === $confirm_password) {
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
            $update_query = "UPDATE USERS SET PASSWORD='$hashed_password' WHERE id=$id";
            if (mysqli_query($conn, $update_query)) {
                echo "<script>alert('Password updated successfully!');</script>";
                header("location:index.php");
                exit();
            } else {
                echo "<script>alert('Error updating password.');</script>";
            }
        } else {
            echo "<script>alert('New passwords do not match.');</script>";
        }
    } else {
        echo "<script>alert('Incorrect current password.');</script>";
    }
}
?>
