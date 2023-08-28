<script
    src="https://code.jquery.com/jquery-3.7.0.js"
    integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
    crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function() {
        getProduct();
        
        $('#submitBtn').click(function() {
            let name =  $('#name').val();
            let unit = $('#unit').val();
            let price = $('#price').val();
            let dateOfExpiry = $('#dateOfExpiry').val();
            let availableInventory = $('#availableInventory').val();
            let imageInput = $('#image')[0];
            let imageFile = imageInput.files[0];

            let product = new FormData();
            product.append('name', name);
            product.append('unit', unit);
            product.append('price', price);
            product.append('date_of_expiry', dateOfExpiry);
            product.append('available_inventory', availableInventory);
            product.append('images', imageFile); 


            $.ajax({
                url: "create_product.php",
                type: 'POST',
                data: product,
                contentType: false, 
                processData: false, 
                success: function(response) {
                    alert("Product was successfully submitted.");
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error('Error creating product: ' + error);
                }
            });
        });


        function getProduct() {
            $.ajax({
                url: 'get_products.php', 
                type: 'GET',
                dataType: 'html',
                success: function(response) {
                    let productData = JSON.parse(response);

                    $template = `
                    <div class='col-md-12 col-lg-4 mt-4 mb-4 mb-lg-0 wholeProduct' data-id="${productData.row.id}">
                        <div class='card'>
                                <div class='d-flex justify-content-end p-3'>

                                    <div class='d-flex'>
                                        <button class='btn btn-primary edit-btn' id='edit-button' data-toggle='modal' data-target='#editModal' data-whatever='@getbootstrap' data-id="${productData.row.id}">EDIT</button>                      
                                        <button style='margin: 0 0 0 1rem' class='btn btn-danger delete-product' data-id='${productData.row.id}'>X</button>   
                                    </div>                   
                                </div>
                                <img  class='card-img-top' alt='Image' src="images/${productData.row.images} "/>
                                <div class='card-body'>
                                    <div class='d-flex justify-content-between flex-sm-row flex-column mb-3'>
                                        <h5 class='mb-0 mt-1'>${productData.row.name} </h5>
                                        <h5 class='mb-0 mt-1 text-danger'>₱${productData.finalPrice}</h5>
                                    </div> 
                                    <div class='d-flex justify-content-between'>
                                        <p class='text-muted mb-0'>Unit: <span class='fw-bold'>${productData.row.unit}</span></p>
                                    </div>
                                    <div class='d-flex justify-content-between'>
                                        <p class='text-muted mb-0'>Available: <span class='fw-bold'>${productData.row.available_inventory} pcs.</span></p>
                                    </div>
                                    <div class='d-flex justify-content-between'>
                                        <p class='text-muted mb-0'>Inventory Cost: <span class='fw-bold'>${ productData.finalInventory }</span></p>
                                    </div>
                                    
                                    <div class='d-flex justify-content-between mb-2'>
                                        <p class='text-muted mb-0'>Expiration Date: <span class='fw-bold'>${ productData.formattedDate }</span></p>

                                </div>
                            </div>
                        </div>
                    </div>  
                    `;
                    $('#productList').html($template);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching products: ' + error);
                }
            });
        }


        $(document).on('click', '.edit-btn', function() {
            let productId = $(this).data('id');
            
            $.ajax({
                url: 'get_details.php',
                type: 'GET',
                data: { 
                    id: productId,
                },
                success: function(response) {
                    let productData = JSON.parse(response);
                    let formHtml = `
                        <form method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name" class="col-form-label">Product Name:</label>
                                <input type="hidden" name="id" id="edit-id" value="${productData.id}">
                                <input required type="text" id="edit-name" name="name" class="form-control" value="${productData.name}" >
                            </div>
                            <div class="form-group">
                                <label for="unit" class="col-form-label">Unit:</label>
                                <input required type="text" name="unit"  value="${productData.unit}" id="edit-unit" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="price" class="col-form-label">Price:</label>
                                <input required type="number"  name="price"  value="${productData.price}" id="edit-price" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="dateOfExpiry" class="col-form-label">Date of Expiry:</label>
                                <input required type="date" name="date_of_expiry"  value="${productData.date_of_expiry}" id="edit-date-of-expiry" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="availableInventory" class="col-form-label">Available Inventory:</label>
                                <input required type="number" name="available_inventory"  value="${productData.available_inventory}" id="edit-available-inventory" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="image" class="col-form-label">Image:</label>
                                <input required type="file" name="images" value="${productData.images}" class="form-control" id="edit-image" accept="images/*">
                            </div>
                            <div class="footer mt-4 d-flex justify-content-end">
                                <button type="submit" id="editBtn" style="margin:0 0 0 1rem" class="btn btn-primary">Submit</button>
                            </div>

                        </form>
                        `



                    $("#modal-update").html(formHtml);
                    $("#editModal").modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching product details: ' + error);
                }
            });
        });


            
        $(document).on('click', '#editBtn', function() {

            let edit_id = $('#edit-id').val();
            let edit_name =  $('#edit-name').val();
            let edit_unit = $('#edit-unit').val();
            let edit_price = $('#edit-price').val();
            let edit_dateOfExpiry = $('#edit-date-of-expiry').val();
            
            let edit_availableInventory = $('#edit-available-inventory').val();
            // Get the selected image separately
            let edit_imageInput = $('#edit-image')[0];
            let edit_imageFile = edit_imageInput.files[0];


            let editProduct = new FormData();
            editProduct.append('id', edit_id);
            editProduct.append('name', edit_name);
            editProduct.append('unit', edit_unit);
            editProduct.append('price', edit_price);
            editProduct.append('date_of_expiry', edit_dateOfExpiry);
            editProduct.append('available_inventory', edit_availableInventory);
            editProduct.append('images', edit_imageFile);

            $.ajax({
                url: "update_product.php",
                type: 'POST',
                data: editProduct,
                contentType: false,
                processData: false,
                success: function(response) {
                    alert("It was updated successfuly.");
                    $("#editModal").modal('hide'); 
                },
                error: function(xhr, status, error) {
                    console.error('Error creating product: ' + error);
                }
            });
        });
        


        $(document).on('click', '.delete-product', function() {

            let templateId =  $(this).closest('.wholeProduct');
            let productId = templateId.data('id');

            $.ajax({
                url: 'delete_product.php',
                type: 'POST',
                data: { id: productId }, 
                success: function(response) {
                    alert("The record is now deleted.")
                    templateId.remove();
                },
                error: function(xhr, status, error) {
                    console.error('Error deleting item: ' + error);
                }
            });


        });



    });


</script>