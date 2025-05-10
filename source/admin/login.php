<?php
    include "../db/config.php";
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Check if user exists
        $sql = "SELECT * FROM admins WHERE email='$email' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "Login successful!";
            // You can redirect user to another page like dashboard.php
            foreach($result as $user)
            $_SESSION["admin"] = $user;
            header("Location:index.php");
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
    <title>Login | Admin</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #4a69bd;
            color: white;
            font-weight: bold;
            border-radius: 10px 10px 0 0;
        }
        .btn-primary {
            background-color: #4a69bd;
            border: none;
        }
        .btn-primary:hover {
            background-color: #3b5998;
        }
        .alert {
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Admin Login</h4>
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
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
