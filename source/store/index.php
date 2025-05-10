<?php 
    include "../db/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* CATEGORY SECTION */
        
        #categories {
            padding: 20px 0px;
            text-align: center;
        }

        #categories h2 {
            font-size: 24px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin-bottom: 20px;
        }

        /* CATEGORY SLIDER CONTAINER */
        .category-container {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* SLIDER */
        .category-slider {
            display: flex;
            gap: 20px;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            padding-bottom: 10px;
            width: 95%;
            scroll-behavior: smooth;
        }

        /* Hide scrollbar */
        .category-slider::-webkit-scrollbar {
            display: none;
        }

        /* CATEGORY BOX */
        .category-box {
            position: relative;
            min-width: 250px;
            height: 300px;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            scroll-snap-align: center;
        }

        .category-box:hover {
            transform: scale(1.01);
        }

        .category-box img {
            width: 100%;
            height: 100%;
            object-fit:cover;
            border-radius: 10px;
        }

        .category-name {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            color: white;
            font-size: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .category-box:hover .category-name {
            opacity: 1;
        }

        /* SLIDER BUTTONS */
        button {
            position: absolute;
            color: #091f40;
            background-color: white;
            border: none;
            cursor: pointer;
            height: 50px;
            width: 50px;
            font-size: 20px;
            border-radius: 50%;
            transition: 0.3s;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        button:hover {
            background-color: #06224a;
            color:white;
        }
        section:nth-child(odd) {
            background-color:rgb(232, 233, 235);
        }
        section:nth-child(even) {
            background-color:rgb(210, 215, 224);
        }
        section:first-of-type {
            margin-top: 70px !important;
        }
        #nextBtn {
            right: 50px;
        }
    </style>
</head>
<body>
    <?php include "../header.php"; ?>
    <?php
        $categories = $conn->query("SELECT * from categories");
        foreach($categories as $category){
            $query = "SELECT * FROM products WHERE category_id = $category[id]";
            $products = $conn->query($query);
            if($products->num_rows > 0 ){
                echo "
                <section id='categories'>
                    <h2 id='$category[name]'> $category[name] </h2>
                    <div class='category-container'>
                        <div class='category-slider'>
                ";
                foreach($products as $row){
                    echo "
                            <div class='category-box'>
                            <a href='/delista/store/product.php?id=$row[id]'>
                                <img src='../uploads/products/$row[image]' alt='$row[name]'>
                                <div class='category-name'> $row[name] </div>
                            </a>
                        </div>
                    ";
                }
                echo "
                                </div>
                            <button id='nextBtn' onclick='scrollSlider(this)'>&#10095;</button>
                        </div>
                    </section>
                ";
            }
        }
    ?>
    <?php 
        include "../footer.php";
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
