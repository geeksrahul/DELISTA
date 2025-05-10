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
    $query = "SELECT * FROM brands WHERE ID=$id";
    $result = mysqli_query($conn, $query);
    foreach($result as $category);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Brands</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center bg-primary text-light">
                    <h4>Update Brands</h4>
                </div>
                <div class="card-body">
                    <?php if (!empty($success)) { echo "<div class='alert alert-success'>$success</div>"; } ?>
                    <?php if (!empty($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>

                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Category name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $category['name'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Category Description</label>
                            <input type="text" name="description" class="form-control" value="<?php echo $category['description'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Category Image</label>
                            <input type="file" name="image" class="form-control">
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
        $name = $_POST["name"];
        $description = $_POST["description"];
        $image = $category["image"];
        // deleting already existing image
        if(file_exists($image)) {
            unlink($image);
        }
        // uploading image at exact location
        if ($_FILES['image']['name']) {
            $upload_dir = 'uploads/brands/';
            if (move_uploaded_file($_FILES['image']['tmp_name'], $image)) {
                // Image uploaded successfully
                echo "<script>alert('Image upload success');</script>";
            } else {
                echo "<script>alert('Image upload failed');</script>";
            }
        }

        $query = "UPDATE brands SET name='$name', description='$description', image='$image' WHERE id = $id";

        try {
            $result = mysqli_query($conn, $query);
            header("location:index.php");
        } catch (\Throwable $th) {
            var_dump($th);
        }


    }
?>
