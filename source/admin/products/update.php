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
    $query = "SELECT * FROM products WHERE ID=$id";
    $result = mysqli_query($conn, $query);
    foreach($result as $product);
?>
<?php

// Fetch categories from database
$categoryQuery = "SELECT id, name FROM categories";
$categoryResult = mysqli_query($conn, $categoryQuery);
$brandsQuery = "SELECT id, name FROM brands";
$brandsResult = mysqli_query($conn, $brandsQuery);

?>
<?php 
    if(isset($_POST["btn_update"])){
        $name = $_POST["name"];
        $price = $_POST["price"];
        $stock = $_POST["stock"];
        $description = $_POST["description"];
        $category_id = $_POST["category"];
        $brand_id = $_POST["brand"];

        $image = $product["image"];
        // deleting already existing image
        if(file_exists($image)) {
            unlink($image);
        }
        $image = time() . '_' . $_FILES['image']['name'];
        // uploading image at exact location
        try {
            if ($_FILES['image']['name']) {
                $upload_dir = 'uploads/products/';
                if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir.''.$image)) {
                    // Image uploaded successfully
                    echo "<script>alert('Image upload success');</script>";
                } else {
                    echo "<script>alert('Image upload failed');</script>";
                }
            }
            } catch (\Throwable $th) {
                echo "<script>alert('Image upload failed');</script>";
        }

    
        $query = "UPDATE products SET 
                    name = '$name', 
                    price = '$price', 
                    stock = '$stock', 
                    description = '$description',
                    category_id = $category_id, 
                    brand_id = $brand_id
                    WHERE id = $id";
    
        try {
            $result = mysqli_query($conn, $query);
            // echo "<script>alert('Image upload failed');</script>";  
            header("location:index.php"); // Redirect back to product list
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
    <title>Update Product</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css"> <!-- Local Bootstrap -->
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4" style="width: 500px;">
        <h3 class="text-center mb-4">Update Product</h3>

        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Product Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $product['name']; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Product Description</label>
                <input type="text" name="description" class="form-control" value="<?php echo $product['description']; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Price ($)</label>
                <input type="number" name="price" class="form-control" step="0.01" value="<?php echo $product['price']; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Stock</label>
                <input type="number" name="stock" class="form-control" value="<?php echo $product['stock']; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="category" class="form-control" value='<?= $product['category'] ?>' required>
                    <option value="" disabled selected>Select Category</option>
                    <?php while ($row = mysqli_fetch_assoc($categoryResult)) : ?>
                        <option value="<?= $row['id']; ?>" <?= ($product['category_id'] === $row['id']) ? 'selected' : ''; ?> >
                             <?= $row['name']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">

                <label class="form-label">Brands</label>
                <select name="brand" class="form-control" value='<?= $product['category'] ?>' required>
                    <option value="" disabled selected>Select Brands</option>
                    <?php while ($row = mysqli_fetch_assoc($brandsResult)) : ?>
                        <option value="<?= $row['id']; ?>" <?= ($product['brand_id'] === $row['id']) ? 'selected' : ''; ?> >
                             <?= $row['name']?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Product Image</label>
                <input type="file" name="image" class="form-control">
            </div>

            <div class="d-grid gap-2">
                <button type="submit" name="btn_update" class="btn btn-success">Update Product</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
