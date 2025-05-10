<?php 
    // authentication
    session_start();
    if(!isset($_SESSION["admin"])) {
        header("location:../login.php");
    }
?>
<?php
include '../../db/config.php'; // Database connection

// Fetch categories from database
$categoryQuery = "SELECT id, name FROM categories";
$categoryResult = mysqli_query($conn, $categoryQuery);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $description = $_POST['description'];
    $image = '';

    

    // Handle Image Upload
    if ($_FILES['image']['name']) {
        $upload_dir = '../../uploads/categories/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true); // Create folder if it doesn't exist
        }
        $image = '../../uploads/categories/' . time() . '_' . $_FILES['image']['name'];
        if (move_uploaded_file($_FILES['image']['tmp_name'], $image)) {
            // Image uploaded successfully
            // echo "<script>alert('Image upload success');</script>";
        } else {
            // echo "<script>alert('Image upload failed');</script>";
        }
    }

    // Insert into database
    $sql = "INSERT INTO categories(name, description, image) 
            VALUES ('$name', '$description' , '$image')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Product added successfully!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Error adding product');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css"> <!-- Local Bootstrap -->
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4" style="width: 500px;">
        <h3 class="text-center mb-4">Add New Category</h3>

        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Category Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Category Description</label>
                <input type="text" name="description" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Category Image</label>
                <input type="file" name="image" class="form-control">
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success">Add Category</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
