<?php include 'check_auth.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flavor Haven - Table Management</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --accent: #f72585;
            --dark: #1d3557;
            --light: #f8f9fa;
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
            padding-top: 80px;
        }

        .glass-card {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }

        .main-container {
            padding: 40px 0;
        }

        .header-section {
            padding: 30px 0;
            margin-bottom: 40px;
            text-align: center;
        }

        .header-section h1 {
            font-weight: 800;
            color: white;
            font-size: 3rem;
            margin-bottom: 15px;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .header-section p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto;
        }

        .table-card {
            padding: 25px;
            margin-bottom: 25px;
        }

        .table-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .table-item {
            background: white;
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 3px solid transparent;
        }

        .table-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .table-item.available {
            border-color: #28a745;
        }

        .table-item.occupied {
            border-color: #dc3545;
        }

        .table-item.reserved {
            border-color: #ffc107;
        }

        .table-item.cleaning {
            border-color: #17a2b8;
        }

        .table-number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--dark);
        }

        .table-status {
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.8rem;
            margin-bottom: 10px;
            display: inline-block;
        }

        .status-available { background: #d4edda; color: #155724; }
        .status-occupied { background: #f8d7da; color: #721c24; }
        .status-reserved { background: #fff3cd; color: #856404; }
        .status-cleaning { background: #d1ecf1; color: #0c5460; }

        .table-capacity {
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 5px;
        }

        .table-location {
            font-size: 0.9rem;
            color: #888;
            margin-bottom: 15px;
        }

        .table-actions {
            display: flex;
            gap: 8px;
            justify-content: center;
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 0.8rem;
        }

        .stats-card {
            text-align: center;
            padding: 20px;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .stat-available { color: #28a745; }
        .stat-occupied { color: #dc3545; }
        .stat-reserved { color: #ffc107; }
        .stat-cleaning { color: #17a2b8; }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 600;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(67, 97, 238, 0.3);
        }

        @media (max-width: 768px) {
            body {
                padding-top: 70px;
            }
            
            .header-section h1 {
                font-size: 2.2rem;
            }
            
            .table-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="main-container">
        <div class="container">
            <div class="header-section">
                <h1><i class="fas fa-chair me-3"></i>Table Management</h1>
                <p class="mt-3">Manage restaurant tables and track their status in real-time</p>
                <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#addTableModal">
                    <i class="fas fa-plus-circle me-2"></i> Add New Table
                </button>
            </div>

            <div class="row mb-4">
                <div class="col-md-3 col-6">
                    <div class="glass-card stats-card">
                        <div class="stat-number stat-available" id="availableCount">0</div>
                        <div class="stat-label">Available</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="glass-card stats-card">
                        <div class="stat-number stat-occupied" id="occupiedCount">0</div>
                        <div class="stat-label">Occupied</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="glass-card stats-card">
                        <div class="stat-number stat-reserved" id="reservedCount">0</div>
                        <div class="stat-label">Reserved</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="glass-card stats-card">
                        <div class="stat-number stat-cleaning" id="cleaningCount">0</div>
                        <div class="stat-label">Cleaning</div>
                    </div>
                </div>
            </div>

            <div class="glass-card table-card">
                <h3 class="mb-4"><i class="fas fa-table me-2"></i>All Tables</h3>
                <div id="tablesContainer" class="table-grid">
                    <div class="text-center py-4 w-100">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2">Loading tables...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addTableModal" tabindex="-1" aria-labelledby="addTableModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTableModalLabel"><i class="fas fa-plus-circle me-2"></i>Add New Table</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addTableForm">
                        <div class="mb-3">
                            <label for="tableNumber" class="form-label">Table Number *</label>
                            <input type="text" class="form-control" id="tableNumber" name="table_number" required>
                        </div>
                        <div class="mb-3">
                            <label for="capacity" class="form-label">Capacity *</label>
                            <input type="number" class="form-control" id="capacity" name="capacity" min="1" max="20" required>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <select class="form-select" id="location" name="location">
                                <option value="Main Hall">Main Hall</option>
                                <option value="Garden">Garden</option>
                                <option value="Private Room">Private Room</option>
                                <option value="Terrace">Terrace</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Optional description..."></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add Table</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateTableModal" tabindex="-1" aria-labelledby="updateTableModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateTableModalLabel"><i class="fas fa-edit me-2"></i>Update Table</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateTableForm">
                        <input type="hidden" id="updateTableId" name="table_id">
                        <div class="mb-3">
                            <label for="updateTableNumber" class="form-label">Table Number *</label>
                            <input type="text" class="form-control" id="updateTableNumber" name="table_number" required>
                        </div>
                        <div class="mb-3">
                            <label for="updateCapacity" class="form-label">Capacity *</label>
                            <input type="number" class="form-control" id="updateCapacity" name="capacity" min="1" max="20" required>
                        </div>
                        <div class="mb-3">
                            <label for="updateLocation" class="form-label">Location</label>
                            <select class="form-select" id="updateLocation" name="location">
                                <option value="Main Hall">Main Hall</option>
                                <option value="Garden">Garden</option>
                                <option value="Private Room">Private Room</option>
                                <option value="Terrace">Terrace</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="updateDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="updateDescription" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="updateStatus" class="form-label">Status</label>
                            <select class="form-select" id="updateStatus" name="status">
                                <option value="available">Available</option>
                                <option value="occupied">Occupied</option>
                                <option value="reserved">Reserved</option>
                                <option value="cleaning">Cleaning</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update Table</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            loadTables();
            
            $('#addTableForm').on('submit', function(e) {
                e.preventDefault();
                addTable(this);
            });

            $('#updateTableForm').on('submit', function(e) {
                e.preventDefault();
                updateTable(this);
            });
        });

        function loadTables() {
            $.ajax({
                url: './endpoint/get_tables.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    displayTables(response);
                    updateStats(response);
                },
                error: function() {
                    $('#tablesContainer').html('<div class="text-center text-danger py-4">Error loading tables</div>');
                }
            });
        }

        function displayTables(tables) {
            if (tables.length === 0) {
                $('#tablesContainer').html('<div class="text-center text-muted py-4">No tables found. Add your first table!</div>');
                return;
            }

            let html = '';
            tables.forEach(table => {
                html += `
                    <div class="table-item ${table.status}">
                        <div class="table-number">${table.table_number}</div>
                        <div class="table-status status-${table.status}">${table.status.charAt(0).toUpperCase() + table.status.slice(1)}</div>
                        <div class="table-capacity">
                            <i class="fas fa-users me-1"></i> ${table.capacity} persons
                        </div>
                        <div class="table-location">
                            <i class="fas fa-map-marker-alt me-1"></i> ${table.location}
                        </div>
                        ${table.description ? `<div class="table-description small text-muted mb-3">${table.description}</div>` : ''}
                        <div class="table-actions">
                            <button class="btn btn-sm btn-outline-primary" onclick="showUpdateModal(${table.table_id}, '${table.table_number}', ${table.capacity}, '${table.location}', '${table.description}', '${table.status}')">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger" onclick="deleteTable(${table.table_id})">
                                <i class="fas fa-trash"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-secondary" onclick="updateTableStatus(${table.table_id}, 'available')">
                                <i class="fas fa-check"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-warning" onclick="updateTableStatus(${table.table_id}, 'occupied')">
                                <i class="fas fa-utensils"></i>
                            </button>
                        </div>
                    </div>
                `;
            });
            $('#tablesContainer').html(html);
        }

        function updateStats(tables) {
            const availableCount = tables.filter(table => table.status === 'available').length;
            const occupiedCount = tables.filter(table => table.status === 'occupied').length;
            const reservedCount = tables.filter(table => table.status === 'reserved').length;
            const cleaningCount = tables.filter(table => table.status === 'cleaning').length;

            $('#availableCount').text(availableCount);
            $('#occupiedCount').text(occupiedCount);
            $('#reservedCount').text(reservedCount);
            $('#cleaningCount').text(cleaningCount);
        }

        function addTable(form) {
            const formData = new FormData(form);
            
            $.ajax({
                url: './endpoint/add_table.php',
                type: 'POST',
                data: $(form).serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#addTableModal').modal('hide');
                        $(form)[0].reset();
                        loadTables();
                        alert('Table added successfully!');
                    } else {
                        alert('Error: ' + response.error);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error adding table: ' + error);
                }
            });
        }

        function showUpdateModal(id, number, capacity, location, description, status) {
            $("#updateTableModal").modal("show");
            $("#updateTableId").val(id);
            $("#updateTableNumber").val(number);
            $("#updateCapacity").val(capacity);
            $("#updateLocation").val(location);
            $("#updateDescription").val(description);
            $("#updateStatus").val(status);
        }

        function updateTable(form) {
            $.ajax({
                url: './endpoint/update_table.php',
                type: 'POST',
                data: $(form).serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#updateTableModal').modal('hide');
                        loadTables();
                        alert('Table updated successfully!');
                    } else {
                        alert('Error: ' + response.error);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error updating table: ' + error);
                }
            });
        }

        function deleteTable(tableId) {
            if (confirm("Are you sure you want to delete this table?")) {
                $.ajax({
                    url: './endpoint/delete_table.php',
                    type: 'POST',
                    data: { table_id: tableId },
                    success: function(response) {
                        if (response.success) {
                            loadTables();
                            alert('Table deleted successfully!');
                        } else {
                            alert('Error: ' + response.error);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Error deleting table: ' + error);
                    }
                });
            }
        }

        function updateTableStatus(tableId, newStatus) {
            $.ajax({
                url: './endpoint/update_table_status.php',
                type: 'POST',
                data: {
                    table_id: tableId,
                    status: newStatus
                },
                success: function(response) {
                    if (response.success) {
                        loadTables();
                    } else {
                        alert('Error: ' + response.error);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error updating table status: ' + error);
                }
            });
        }
    </script>
</body>
</html>