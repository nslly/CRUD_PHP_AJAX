<?php 

    $mysqli = mysqli_connect('localhost',"root","","jr_dev_exam");

    if ($mysqli->connect_errno) {
        echo "console.log($mysqli->connect_error)";
        exit();
    }


    $id= $_POST['id'];
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
    $allowTypes = array('jpg','png','jpeg','gif','JPG','JPEG'); 
    if(in_array($fileType, $allowTypes)){ 
        // Upload file to server 
        if(move_uploaded_file($_FILES["images"]["tmp_name"], $targetFilePath)){ 
            
            $sql = "UPDATE products SET name = '$name', unit = '$unit', price = '$price', date_of_expiry = '$date_of_expiry', available_inventory = '$available_inventory', images = '$image' WHERE id = '$id'";

            mysqli_query($mysqli, $sql);
            $_SESSION['error_message'] = "Error updating record: " . mysqli_error($mysqli);
            header("Location:index.php");

            
        } else{ 
            $statusMsg = "Sorry, there was an error uploading your file."; 
        } 
    }else{ 
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
    } 


?>