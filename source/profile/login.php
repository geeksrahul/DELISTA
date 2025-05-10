<?php
    include "../db/config.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Check if user exists
        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            session_start();
            echo "Login successful!";
            // You can redirect user to another page like dashboard.php
            foreach($result as $user)
            $_SESSION["user_id"] = $user["id"];
            header("Location:../index.php");
        } else {
            $error = "Invalid email or password!";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
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
        .text-center a {
            text-decoration: none;
            font-weight: bold;
            color: #563d7c;
        }
        .text-center a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Login</h4>
                </div>
                <div class="card-body">
                    <?php if (!empty($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3 text-center">
                            <span>New User? <a href="register.php">Register</a></span>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
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
