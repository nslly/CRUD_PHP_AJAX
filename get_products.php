<?php 

    $mysqli = mysqli_connect('localhost',"root","","jr_dev_exam");

    if ($mysqli->connect_errno) {
        echo "console.log($mysqli->connect_error)";
        exit();
    }


    $sql = "SELECT * FROM products";

    $results = mysqli_query($mysqli, $sql);

    if(mysqli_num_rows($results) > 0) {
        while($row = mysqli_fetch_assoc($results)) {
            $inventory_cost = $row['price'] * $row['available_inventory'];
            // all inventory format
            $finalInventory = number_format($inventory_cost);
            //price format
            $finalPrice = number_format($row['price']);

            // date format
            $timestamp = strtotime($row['date_of_expiry']);
            $formattedDate = date("F d, Y", $timestamp);

            $setData = [
                'finalInventory' => $finalInventory,
                'finalPrice'    =>  $finalPrice,
                'formattedDate' =>  $formattedDate,
                'row'           => $row
            ];

            echo json_encode($setData); 
        }
    }


?>