<?php
    include "../db/config.php";
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Secure input data
        $username = $_POST["username"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $password = $_POST["password"];
        $address = $_POST["address"];
        $city = $_POST["city"];

        // Basic validation
        if (empty($username) || empty($email) || empty($phone) || empty($_POST["password"])) {
            $error = "All fields except Address & City are required!";
        } else {
            $sql = "INSERT INTO users (username, email, phone, password, address, city) 
                    VALUES ('$username', '$email', '$phone', '$password', '$address', '$city')";

            if ($conn->query($sql) === TRUE) {
                $success = "Registration successful!";
                header("location:login.php");
            } else {
                $error = "Error: " . $conn->error;
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            padding: 50px 0px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background: #563d7c;
            color: white;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
        .btn-primary {
            background: #563d7c;
            border: none;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background: #452c63;
        }
        .form-control {
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Register</h4>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($success)) { echo "<div class='alert alert-success'>$success</div>"; } ?>
                        <?php if (!empty($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input type="text" name="address" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">City</label>
                                <input type="text" name="city" class="form-control">
                            </div>
                            <div class="mb-3 text-center">
                                <span>Already Registered? <a href="login.php"> Login </a></span>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Register</button>
                            <a href="../">back to home</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
