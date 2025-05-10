<?php 
    include "../db/config.php";
    session_start();
    $id = $_GET["id"];
    $query = "SELECT * FROM VIEW_PRODUCT WHERE id=$id";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)<=0){
        header("location:index.php");
    }
    foreach($result as $product){}

    // add to cart logic
   
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $product['name'] ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            position: relative;
        }
        body::before {
            content: "";
            position: fixed; /* Fixed to cover the entire viewport */
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: red !important;
            background: url("../uploads/products/<?= $product['image'] ?>");
            background-repeat:no-repeat;
            background-size:cover;
            background-position:center;
            filter: blur(5px);
            z-index: -1; 
        }
        .product {
            padding: 30px 20px;
            border-radius: 10px;
            background-color: white;
        }
        .content {
            margin-top: 70px;
            height: calc(100vh - 70px);
            width: 100vw;
            display: flex;
            justify-content: center;
            align-items: center;
            border:1px solid black;
        }
        img {
            border-radius:10px;
            aspect-ratio:3/4;
            object-fit:cover;
        }

        #add_to_cart {
            border:2px solid #091f40;
            border-radius:0;
            transition:all ease 0.3s;
            font-weight:bold;
            &:hover {
                color: white;
                background-color: #091f40;
            }
        }
        
    </style>
</head>
<body>
    <?php include "../header.php"; ?>
    <div class="content">
        <div class="row product">
            <!-- Product Image Section -->
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <img src="../uploads/products/<?= $product['image']; ?>" alt="Product Image" class="img-fluid" style="max-height: 400px;">
            </div>

            <!-- Product Details Section -->
            <form action='add_to_cart.php' method='POST' class="col-md-6">
                <input type="hidden" name="product_id" value='<?= $product["id"] ?>'>
                <input type="hidden" name="price" value='<?= $product["price"] ?>'>
                <h2><?php echo $product['name']; ?></h2>
                <p style='width:300px;'><?php echo $product['description']; ?></p>
                <p><strong>Brand:</strong> <?php echo $product['brand']; ?></p>
                <p><strong>Category:</strong> <?php echo $product['category']; ?></p>
                <p><strong>Price:</strong> $<?php echo $product['price']; ?></p>
                <p><strong>Status:</strong> <?= $product['stock']>0 ? '<span class="text-success">Available</span>': '<span class="text-danger"> Out of stock </span>' ; ?></p>
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="qty" class="form-control w-50" value="1" min="1">
                <div class="mt-3">
                    <button type='submit' name='add_to_cart' id="add_to_cart" class="form-control">Add to Cart</button type='submit'>
                </div>
            </form> 
        </div>
    </div>
</body>
</html>