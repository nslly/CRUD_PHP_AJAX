<?php 

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
        // Fetch product details based on the productId
        $mysqli = mysqli_connect('localhost',"root","","jr_dev_exam");

        if ($mysqli->connect_errno) {
            echo "console.log($mysqli->connect_error)";
            exit();
        }
    

        $id = $_GET['id'];
        $sql = "SELECT * FROM products WHERE id = $id";
    
        $results = mysqli_query($mysqli, $sql);
    
        if(mysqli_num_rows($results) > 0) {
            $row = mysqli_fetch_assoc($results);
            echo json_encode($row); 
        }

    }


?>