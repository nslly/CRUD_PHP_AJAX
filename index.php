
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
    
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Lora&family=Recursive&family=Uchen&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.0/css/all.css" integrity="sha384-OLYO0LymqQ+uHXELyx93kblK5YIS3B2ZfLGBmsJaUyor7CpMTBsahDHByqSuWW+q" crossorigin="anonymous">
    <title>Exam</title>
</head>
<body>
    <navbar>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Products Exam Logo</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                    </ul>
                    <div class="m-1">
                        <button type="button" class="btn btn-primary">Login</button>
                        <button type="button" class="btn btn-success">Sign-up</button>
                    </div>
                    
                </div>
            </div>
        </nav>
    </navbar>

    <section style="background-color: #eee;">
        <div class="add-product">
            <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Product</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="name" class="col-form-label">Product Name:</label>
                                    <input required type="text" class="form-control" id="name">
                                </div>
                                <div class="form-group">
                                    <label for="unit" class="col-form-label">Unit:</label>
                                    <input required type="text" class="form-control" id="unit">
                                </div>
                                <div class="form-group">
                                    <label for="price" class="col-form-label">Price:</label>
                                    <input required type="number" class="form-control" id="price">
                                </div>
                                <div class="form-group">
                                    <label for="dateOfExpiry" class="col-form-label">Date of Expiry:</label>
                                    <input required type="date" class="form-control" id="dateOfExpiry">
                                </div>
                                <div class="form-group">
                                    <label for="availableInventory" class="col-form-label">Available Inventory:</label>
                                    <input required type="number" class="form-control" id="availableInventory">
                                </div>
                                <div class="form-group">
                                    <label for="image" class="col-form-label">Image:</label>
                                    <input required type="file" name="image" class="form-control" id="image" accept="images/*">
                                </div>
                                <div class="footer mt-4 d-flex justify-content-end">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" id="submitBtn" style="margin:0 0 0 1rem" class="btn btn-primary">Submit</button>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="edit-product">
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                        </div>
                        <div class="modal-body" id="modal-update">
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            if(isset($_SESSION['error_message'])) {
                echo '<div class="alert alert-danger">' . $_SESSION['error_message'] . '</div>';
                unset($_SESSION['error_message']);
            }
        ?>
        
        <div class="container py-5">
            <div class="d-flex flex-column justify-content-sm-center flex-md-row justify-content-md-between bg-light" >
                    <p class="d-flex justify-content-sm-center justify-content-center fs-3 font-weight-bold text-uppercase" style="margin:.5rem !important;">All Products</p>
                    <button type="button" class="btn btn-primary" style="margin:.5rem !important;" data-toggle="modal" data-target="#createModal" data-whatever="@getbootstrap">ADD PRODUCT</button>
            </div>
            
            <div class="row" id="productList">
            </div>
        </div>
    </section>

    <?php require_once('script.php') ?>
</body>
