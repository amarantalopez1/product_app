<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Product List</h1>
        <button id="logout" class="btn btn-danger">Logout</button>
        <button id="create" class="btn btn-primary">Create New Register</button>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Height</th>
                    <th>Length</th>
                    <th>Width</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody id="product-list">
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="createProduct" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Create New Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="create-product-form">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="height">Height</label>
                            <input type="number" id="height" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="length">Length</label>
                            <input type="number" id="length" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="width">Width</label>
                            <input type="number" id="width" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editProduct" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit-product-form">
                        <div class="form-group">
                            <label for="edit-name">Name</label>
                            <input type="text" id="edit-name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-description">Description</label>
                            <textarea id="edit-description" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit-height">Height</label>
                            <input type="number" id="edit-height" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-length">Length</label>
                            <input type="number" id="edit-length" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-width">Width</label>
                            <input type="number" id="edit-width" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        var token = localStorage.getItem('token');
        $.ajax({
            url: "/api/products",
            method: "GET",
            headers: {
                'Authorization': 'Bearer ' + token
            },
            success: function(response) {
                var productList = $('#product-list');
                if (Array.isArray(response) && response.length > 0) {
                    response.forEach(function(product) {
                        productList.append(
                            `<tr>
                                <td>${product.name}</td>
                                <td>${product.description}</td>
                                <td>${product.height}</td>
                                <td>${product.length}</td>
                                <td>${product.width}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning edit-btn" data-id="${product.id}">Edit</button>
                                    <button class="btn btn-sm btn-danger delete-btn" data-id="${product.id}">Delete</button>
                                </td>
                            </tr>`);
                    });
                } else {
                    productList.append('<tr><td colspan="5">No products available.</td></tr>');
                }
            },
            error: function(error) {
                alert("Error fetching products. Please initiate session to verify the token.");
                window.location.href = '/login';
            },
        });
        $('#logout').on('click', function() {
            var token = localStorage.getItem('token');
            $.ajax({
                url: '/api/logout',
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + token
                },
                success: function() {
                    localStorage.removeItem('token');
                    window.location.href = '/login';
                },
                error: function(error) {
                    alert("Error logging out.");
                }
            });
        });
        $('#create').on('click', function() {
            $("#createProduct").modal("show");
            $('#product-form')[0].reset();
            $('#productModalLabel').text('');
            $('#productModal').modal('show');

        });
        $('#create-product-form').on('submit', function(event) {
            event.preventDefault();
            var name = $('#name').val();
            var description = $('#description').val();
            var height = $('#height').val();
            var length = $('#length').val();
            var width = $('#width').val();
            $.ajax({
                url: '/api/products',
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + token
                },
                contentType: 'application/json',
                data: JSON.stringify({
                    name,
                    description,
                    height,
                    length,
                    width
                }),
                success: function(response) {
                    $('#createProduct').modal('hide');
                    alert('Product created successfully!');
                    window.location.reload();
                },
                error: function(error) {
                    alert('Error creating product.');
                }
            });
        });
        $(document).on('click', '.edit-btn', function() {
            currentProductId = $(this).data('id');
            $.ajax({
                url: `/api/products/${currentProductId}`,
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + token
                },
                success: function(response) {
                    $('#edit-name').val(response.name);
                    $('#edit-description').val(response.description);
                    $('#edit-height').val(response.height);
                    $('#edit-length').val(response.length);
                    $('#edit-width').val(response.width);
                    $('#editModalLabel').text('Edit Product');
                    $('#editProduct').modal('show');
                },
                error: function(error) {
                    alert("Error fetching product details.");
                }
            });
        });
        $('#edit-product-form').submit(function(event) {
            event.preventDefault();
            var name = $('#edit-name').val();
            var description = $('#edit-description').val();
            var height = $('#edit-height').val();
            var length = $('#edit-length').val();
            var width = $('#edit-width').val();

            if (currentProductId) {
                $.ajax({
                    url: "/api/products/" + currentProductId,
                    method: "PUT",
                    contentType: "application/json",
                    data: JSON.stringify({
                        name: name,
                        description: description,
                        height: height,
                        length: length,
                        width: width
                    }),
                    headers: {
                        'Authorization': 'Bearer ' + token
                    },
                    success: function(response) {
                        alert("Product updated successfully!");
                        window.location.href = "/products";
                    },
                    error: function(error) {
                        alert("Error updating product. Please try again.");
                    }
                });
            } else {
                alert("Product ID is missing.");
            }
        });
        $(document).on('click', '.delete-btn', function() {
            var productId = $(this).data('id');

            if (confirm("Are you sure you want to delete this product?")) {
                $.ajax({
                    url: `/api/products/${productId}`,
                    method: "DELETE",
                    headers: {
                        'Authorization': 'Bearer ' + token
                    },
                    success: function(response) {
                        alert("Product deleted successfully!");
                        window.location.reload(); 
                    },
                    error: function(error) {
                        alert("Error deleting product. Please try again.");
                    }
                });
            }
        });
    </script>
</body>

</html>
