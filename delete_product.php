<?php 

    $mysqli = mysqli_connect('localhost',"root","","jr_dev_exam");

    if ($mysqli->connect_errno) {
        echo "console.log($mysqli->connect_error)";
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $productId = $_POST['id'];
        
        $sql = "DELETE FROM products WHERE id = $productId";
        mysqli_query($mysqli, $sql);
    
    }

    
?>