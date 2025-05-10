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
$brandsQuery = "SELECT id, name FROM brands";
$brandsResult = mysqli_query($conn, $brandsQuery);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $stock = $_POST['stock'];
    $category_id = $_POST['category'];
    $brand_id = $_POST['brand'];
    $image = '';

     // Handle Image Upload
     if ($_FILES['image']['name']) {
        $upload_dir = '../../uploads/products/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true); // Create folder if it doesn't exist
        }
        $image = time() . '_' . $_FILES['image']['name'];
        if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir.''.$image)) {
            // Image uploaded successfully
            // echo "<script>alert('Image upload success');</script>";
        } else {
            // echo "<script>alert('Image upload failed');</script>";
        }
    }

    // Insert into database
    $sql = "INSERT INTO products (name, description, price, stock, category_id, image) 
            VALUES ('$name', '$description' , '$price', '$stock', '$category_id', '$image')";
    
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
    <title>Add Product</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css"> <!-- Local Bootstrap -->
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4" style="width: 500px;">
        <h3 class="text-center mb-4">Add New Product</h3>

        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Product Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Product Description</label>
                <input type="text" name="description" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Price ($)</label>
                <input type="number" name="price" class="form-control" step="0.01" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Stock</label>
                <input type="number" name="stock" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="category" class="form-control" required>
                    <option value="" disabled selected>Select Category</option>
                    <?php while ($row = mysqli_fetch_assoc($categoryResult)) : ?>
                        <option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Brands</label>
                <select name="brand" class="form-control" required>
                    <option value="" disabled selected>Select Brands</option>
                    <?php while ($row = mysqli_fetch_assoc($brandsResult)) : ?>
                        <option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Product Image</label>
                <input type="file" name="image" class="form-control">
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success">Add Product</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
