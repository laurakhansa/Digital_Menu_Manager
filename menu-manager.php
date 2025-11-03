<?php include 'check_auth.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Menu Manager</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --dark: #1d3557;
            --light: #f8f9fa;
            --gray: #6c757d;
            --card-bg: rgba(255, 255, 255, 0.95);
        }

        * {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            background-attachment: fixed;
            min-height: 100vh;
            color: #333;
        }

        .glass-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .main-container {
            padding: 30px 0;
        }

        .header-section {
            padding: 25px 0;
            margin-bottom: 30px;
            text-align: center;
        }

        .header-section h1 {
            font-weight: 700;
            color: white;
            font-size: 2.5rem;
            margin-bottom: 10px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .header-section p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.1rem;
        }

        .action-btn {
            background: var(--primary);
            border: none;
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .action-btn:hover {
            background: var(--secondary);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .back-btn {
            color: white;
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            color: var(--success);
            transform: translateX(-5px);
        }

        .table-container {
            padding: 25px;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .table-header h3 {
            font-weight: 600;
            color: var(--dark);
            margin: 0;
        }

        #taskTable {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
        }

        #taskTable thead th {
            background-color: var(--primary);
            color: white;
            font-weight: 500;
            padding: 15px 10px;
            border: none;
        }

        #taskTable tbody td {
            padding: 15px 10px;
            vertical-align: middle;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        #taskTable tbody tr {
            transition: all 0.3s ease;
        }

        #taskTable tbody tr:hover {
            background-color: rgba(67, 97, 238, 0.05);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .menu-image {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .btn-edit, .btn-delete {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .btn-edit {
            background: rgba(76, 201, 240, 0.1);
            color: var(--success);
            border: 1px solid rgba(76, 201, 240, 0.3);
        }

        .btn-edit:hover {
            background: var(--success);
            color: white;
            transform: scale(1.1);
        }

        .btn-delete {
            background: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border: 1px solid rgba(220, 53, 69, 0.3);
        }

        .btn-delete:hover {
            background: #dc3545;
            color: white;
            transform: scale(1.1);
        }

        .modal-header {
            background: var(--primary);
            color: white;
            border-radius: 16px 16px 0 0;
        }

        .modal-content {
            border-radius: 16px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .form-control, .form-select {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
            border-color: var(--primary);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 8px !important;
            margin: 0 3px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: var(--primary) !important;
            border: none !important;
        }

        .loading-spinner {
            display: none;
            text-align: center;
            padding: 20px;
        }

        .spinner-border {
            color: var(--primary);
        }

        @media (max-width: 768px) {
            .table-header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }
            
            .action-buttons {
                justify-content: center;
            }
        }

        body {
            padding-top: 80px; 
        }       
        
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="main-container">
        <div class="container">
            <div class="header-section">
                <h1><i class="fas fa-utensils me-3"></i>Food Menu Manager</h1>
                <p>Manage your restaurant menu with ease</p>
                <a href="./index.php" class="back-btn mt-3">
                    <i class="fas fa-arrow-left"></i> Back to Menu
                </a>
            </div>

            <div class="glass-card table-container">
                <div class="table-header">
                    <h3><i class="fas fa-list me-2"></i>Menu Items</h3>
                    <button type="button" class="btn action-btn" data-bs-toggle="modal" data-bs-target="#addMenuModal">
                        <i class="fas fa-plus-circle"></i> Add New Item
                    </button>
                </div>

                <div class="loading-spinner" id="loadingSpinner">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Loading menu items...</p>
                </div>

                <table class="table table-hover" id="taskTable">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Price</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="menuTableBody">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addMenuModal" tabindex="-1" aria-labelledby="addMenu" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-plus-circle me-2"></i>Add New Menu Item</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addMenuForm" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="image" class="form-label">Menu Image</label>
                                <input type="file" class="form-control" id="image" name="image" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Menu Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn action-btn">Add Item</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateMenuModal" tabindex="-1" aria-labelledby="updateMenu" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Update Menu Item</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateMenuForm" method="POST" enctype="multipart/form-data">
                        <input type="hidden" id="updateMenuId" name="tbl_menu_id">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="updateImage" class="form-label">Menu Image</label>
                                <input type="file" class="form-control" id="updateImage" name="image">
                                <div class="form-text">Leave empty to keep current image</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="updatePrice" class="form-label">Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input type="text" class="form-control" id="updatePrice" name="price" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="updateName" class="form-label">Menu Name</label>
                            <input type="text" class="form-control" id="updateName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="updateDescription" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="updateDescription" rows="3" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn action-btn">Update Item</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        let dataTable;

        $(document).ready(function() {
            dataTable = $('#taskTable').DataTable({
                "language": {
                    "search": "<i class='fas fa-search'></i> Search:",
                    "lengthMenu": "Show _MENU_ entries",
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                    "paginate": {
                        "previous": "<i class='fas fa-chevron-left'></i>",
                        "next": "<i class='fas fa-chevron-right'></i>"
                    }
                },
                "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                       "<'row'<'col-sm-12'tr>>" +
                       "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
            });

            loadMenuItems();

            $('#addMenuForm').on('submit', function(e) {
                e.preventDefault();
                addMenuItem(this);
            });

            $('#updateMenuForm').on('submit', function(e) {
                e.preventDefault();
                updateMenuItem(this);
            });
        });

        function loadMenuItems() {
            $('#loadingSpinner').show();
            
            $.ajax({
                url: './endpoint/get_menu.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#loadingSpinner').hide();
                    
                    dataTable.clear().draw();
                    
                    response.forEach(function(item) {
                        const row = [
                            item.tbl_menu_id,
                            `<img src="${item.image}" class="menu-image" alt="${item.name}">`,
                            item.name,
                            item.description,
                            `₱${parseFloat(item.price).toFixed(2)}`,
                            `<div class="action-buttons">
                                <button class="btn btn-edit" onclick="showUpdateModal(${item.tbl_menu_id}, '${item.name.replace(/'/g, "\\'")}', '${item.description.replace(/'/g, "\\'")}', ${item.price})">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-delete" onclick="deleteMenuItem(${item.tbl_menu_id})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>`
                        ];
                        
                        dataTable.row.add(row).draw(false);
                    });
                },
                error: function() {
                    $('#loadingSpinner').hide();
                    alert('Error loading menu items');
                }
            });
        }

        function addMenuItem(form) {
            const formData = new FormData(form);
            
            $.ajax({
                url: './endpoint/add.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#addMenuModal').modal('hide');
                    $(form)[0].reset();
                    loadMenuItems(); 
                    alert('Menu item added successfully!');
                },
                error: function(xhr, status, error) {
                    alert('Error adding menu item: ' + error);
                }
            });
        }

        function showUpdateModal(id, name, description, price) {
            $("#updateMenuModal").modal("show");
            $("#updateMenuId").val(id);
            $("#updateName").val(name);
            $("#updateDescription").val(description);
            $("#updatePrice").val(price);
        }

        function updateMenuItem(form) {
            const formData = new FormData(form);
            
            $.ajax({
                url: './endpoint/update.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#updateMenuModal').modal('hide');
                    $(form)[0].reset();
                    loadMenuItems(); 
                    alert('Menu item updated successfully!');
                },
                error: function(xhr, status, error) {
                    alert('Error updating menu item: ' + error);
                }
            });
        }

        function deleteMenuItem(id) {
            if (confirm("Are you sure you want to delete this menu item?")) {
                $.ajax({
                    url: './endpoint/delete.php',
                    type: 'GET',
                    data: { menu: id },
                    success: function(response) {
                        loadMenuItems(); 
                        alert('Menu item deleted successfully!');
                    },
                    error: function(xhr, status, error) {
                        alert('Error deleting menu item: ' + error);
                    }
                });
            }
        }
    </script>
</body>
</html>