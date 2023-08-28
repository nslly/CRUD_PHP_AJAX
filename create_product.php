<?php 

    $mysqli = mysqli_connect("localhost","root","","jr_dev_exam");

    if ($mysqli->connect_errno) {
        echo "console.log($mysqli->connect_error)";
        exit();
    }


    $name= $_POST['name'];
    $unit = $_POST['unit'];
    $price = $_POST['price'];
    $date_of_expiry = $_POST['date_of_expiry'];
    $available_inventory = $_POST['available_inventory'];
    $targetDir = "images/"; 
    $image = basename($_FILES["images"]["name"]);

    $targetFilePath = $targetDir . $image;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION); 
    
    
    // Allow certain file formats 
    $allowTypes = array('jpg','png','jpeg','gif'); 
    if(in_array($fileType, $allowTypes)){ 
        // Upload file to server 
        if(move_uploaded_file($_FILES["images"]["tmp_name"], $targetFilePath)){ 
            // Insert image file name into database 
            
            $sql = "INSERT INTO products (name, unit, price, date_of_expiry, available_inventory, images) 
                VALUES ('$name', '$unit', '$price', '$date_of_expiry', '$available_inventory', '$image')";
            mysqli_query($mysqli, $sql);
            header("Location:update_product.php");
            
        } else{ 
            $statusMsg = "Sorry, there was an error uploading your file."; 
        } 
    }else{ 
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
    } 




?>