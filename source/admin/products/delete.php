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
    $products = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
    foreach ($products as $product) {
    }
    $image = $product["image"];
    if(file_exists($image)){
        unlink($image);
    }
    $delete = "DELETE FROM products WHERE id=$id";
    try {
        $result = mysqli_query($conn, $delete);
        header("location:index.php");
    } catch (\Throwable $th) {
        echo $th->getMessage();
    }
?>