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
    $categories = mysqli_query($conn, "SELECT * FROM categories WHERE id=$id");
    foreach ($categories as $category) {
    }
    $image = $category["image"];
    if(file_exists($image)){
        unlink($image);
    }
    $delete = "DELETE FROM categories WHERE id=$id";
    try {
        $result = mysqli_query($conn, $delete);
        header("location:index.php");
    } catch (\Throwable $th) {
        echo $th->getMessage();
    }
?>