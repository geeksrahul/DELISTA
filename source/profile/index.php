<?php
    session_start();
    include "../db/config.php";
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }
    $id = $_SESSION["user_id"];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
    $user = mysqli_fetch_assoc($result);
?>
<?php 
    if(isset($_POST["btn_update"])){
        $username = $_POST["username"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];
        $city = $_POST["city"];
        $id = $_SESSION["user_id"];
        $query = "UPDATE users SET username ='$username', email = '$email', phone = '$phone', address = '$address', city = '$city'  WHERE id = $id";
        try {
            $result = mysqli_query($conn, $query);
            header("location:temp.php");
        } catch (\Throwable $th) {
            var_dump($th);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
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
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            background: white;
            padding: 30px;
        }
        .form-control {
            border-radius: 8px;
            transition: 0.3s;
        }
        .form-control:focus {
            border-color: #764ba2;
            box-shadow: 0px 0px 5px rgba(118, 75, 162, 0.5);
        }
        .btn-primary {
            background: #563d7c;
            border: none;
            padding: 12px;
            border-radius: 8px;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background: #452b6d;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .content {
                margin-left: 0;
                padding: 20px;
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
                <h2 class="text-center">Profile</h2>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= $user['username'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?= $user['phone'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?= $user['address'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <input type="text"  class="form-control" id="city" name="city" value="<?= $user['city'] ?>" required>
                    </div>
                    <button type="submit" name="btn_update" class="btn btn-primary w-100">Update Profile</button>
                </form>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>




