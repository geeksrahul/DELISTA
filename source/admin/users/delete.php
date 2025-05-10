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
    $delete = "DELETE FROM users WHERE id=$id";
    try {
        $result = mysqli_query($conn, $delete);
        header("location:index.php");
    } catch (\Throwable $th) {
        echo $th->getMessage();
    }
?>