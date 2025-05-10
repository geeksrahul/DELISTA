<?php 
    // authentication
    session_start();
    if(!isset($_SESSION["admin"])) {
        header("location:../login.php");
    }
?>
<?php
    include "../../db/config.php";
    $id = $_GET["id"];
    $query = "SELECT * FROM USERS WHERE ID=$id";
    $result = mysqli_query($conn, $query);
    foreach($result as $user);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center bg-primary text-light">
                    <h4>Update</h4>
                </div>
                <div class="card-body">
                    <?php if (!empty($success)) { echo "<div class='alert alert-success'>$success</div>"; } ?>
                    <?php if (!empty($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>

                    <form action="" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $user['username'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $user['email'] ?>"  required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" value="<?php echo $user['phone'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" value="<?php echo $user['address'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">City</label>
                            <input type="text" name="city" class="form-control" value="<?php echo $user['city'] ?>"> 
                        </div>
                        <button type="submit" class="form-control btn btn-primary" name="btn_update"> Update </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../../assets/js/bootstrap.bundle.min.js"> </script>
</body>
</html>
<?php 
    if(isset($_POST["btn_update"])){
        $username = $_POST["username"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];
        $city = $_POST["city"];
        $id = $_GET["id"];

        $query = "UPDATE users SET username ='$username', email = '$email', phone = '$phone', address = '$address', city = '$city'  WHERE id = $id";

        try {
            $result = mysqli_query($conn, $query);
            header("location:index.php");
        } catch (\Throwable $th) {
            var_dump($th);
        }


    }
?>
