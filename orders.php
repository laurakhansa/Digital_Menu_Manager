<?php include 'check_auth.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flavor Haven - Orders</title>

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

        .order-card {
            padding: 25px;
            margin-bottom: 25px;
        }

        .order-status {
            padding: 6px 15px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .status-pending { background: #fff3cd; color: #856404; }
        .status-confirmed { background: #cce7ff; color: #004085; }
        .status-preparing { background: #d1edff; color: #0c5460; }
        .status-ready { background: #d4edda; color: #155724; }
        .status-completed { background: #d1e7dd; color: #0f5132; }
        .status-cancelled { background: #f8d7da; color: #721c24; }

        .order-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid rgba(0,0,0,0.1);
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            object-fit: cover;
        }

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

        .stats-card {
            text-align: center;
            padding: 20px;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .stat-pending { color: #ffc107; }
        .stat-preparing { color: #0dcaf0; }
        .stat-ready { color: #198754; }
        .stat-completed { color: #6f42c1; }

        @media (max-width: 768px) {
            body {
                padding-top: 70px;
            }
            
            .header-section h1 {
                font-size: 2.2rem;
            }
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="main-container">
        <div class="container">
            <div class="header-section">
                <h1><i class="fas fa-shopping-cart me-3"></i>Order Management</h1>
                <p class="mt-3">Track and manage customer orders in real-time</p>
                <a href="new-order.php" class="btn btn-primary mt-3">
                    <i class="fas fa-plus-circle me-2"></i> Create New Order
                </a>
            </div>

            <div class="row mb-4">
                <div class="col-md-3 col-6">
                    <div class="glass-card stats-card">
                        <div class="stat-number stat-pending" id="pendingCount">0</div>
                        <div class="stat-label">Pending</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="glass-card stats-card">
                        <div class="stat-number stat-preparing" id="preparingCount">0</div>
                        <div class="stat-label">Preparing</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="glass-card stats-card">
                        <div class="stat-number stat-ready" id="readyCount">0</div>
                        <div class="stat-label">Ready</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="glass-card stats-card">
                        <div class="stat-number stat-completed" id="completedCount">0</div>
                        <div class="stat-label">Completed</div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="glass-card order-card">
                        <h3 class="mb-4"><i class="fas fa-clock me-2"></i>Active Orders</h3>
                        <div id="activeOrders">
                            <div class="text-center py-4">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <p class="mt-2">Loading orders...</p>
                            </div>
                        </div>
                    </div>

                    <div class="glass-card order-card">
                        <h3 class="mb-4"><i class="fas fa-history me-2"></i>Recent Orders</h3>
                        <div id="recentOrders">
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="glass-card order-card">
                        <h4 class="mb-4"><i class="fas fa-bolt me-2"></i>Quick Actions</h4>
                        
                        <button class="btn btn-primary w-100 mb-3" onclick="window.location.href='new-order.php'">
                            <i class="fas fa-plus me-2"></i>New Order
                        </button>
                        
                        <button class="btn btn-outline-primary w-100 mb-3" onclick="printOrders()">
                            <i class="fas fa-print me-2"></i>Print Today's Orders
                        </button>
                        
                        <button class="btn btn-outline-primary w-100 mb-3" onclick="exportOrders()">
                            <i class="fas fa-download me-2"></i>Export Orders
                        </button>
                    </div>

                    <div class="glass-card order-card">
                        <h4 class="mb-4"><i class="fas fa-chart-bar me-2"></i>Today's Summary</h4>
                        
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <span>Total Orders:</span>
                                <strong id="todayTotal">0</strong>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <span>Total Revenue:</span>
                                <strong id="todayRevenue">₱0.00</strong>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <span>Average Order:</span>
                                <strong id="todayAverage">₱0.00</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            loadOrders();
            setInterval(loadOrders, 30000); 
        });

        function loadOrders() {
            $.ajax({
                url: './endpoint/get_orders.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    displayOrders(response);
                    updateStats(response);
                },
                error: function() {
                    $('#activeOrders').html('<div class="text-center text-danger py-4">Error loading orders</div>');
                }
            });
        }

        function displayOrders(orders) {
            const activeOrders = orders.filter(order => 
                order.status !== 'completed' && order.status !== 'cancelled'
            );
            
            const recentOrders = orders.filter(order => 
                order.status === 'completed' || order.status === 'cancelled'
            ).slice(0, 5); 

            if (activeOrders.length === 0) {
                $('#activeOrders').html('<div class="text-center text-muted py-4">No active orders</div>');
            } else {
                let html = '';
                activeOrders.forEach(order => {
                    html += createOrderCard(order);
                });
                $('#activeOrders').html(html);
            }

            if (recentOrders.length === 0) {
                $('#recentOrders').html('<div class="text-center text-muted py-4">No recent orders</div>');
            } else {
                let html = '';
                recentOrders.forEach(order => {
                    html += createOrderCard(order, true);
                });
                $('#recentOrders').html(html);
            }
        }

        function createOrderCard(order, isRecent = false) {
            const statusClass = `status-${order.status}`;
            const statusText = order.status.charAt(0).toUpperCase() + order.status.slice(1);
            
            const orderTypeText = order.order_type.replace('_', ' ');
            const orderTypeIcon = order.order_type === 'dine_in' ? 'fa-utensils' : 
                                order.order_type === 'takeaway' ? 'fa-box' : 'fa-truck';
            
            let itemsHtml = '';
            order.items.forEach(item => {
                itemsHtml += `
                    <div class="order-item">
                        <div>
                            <strong>${item.name}</strong>
                            <br>
                            <small class="text-muted">Qty: ${item.quantity} × ₱${parseFloat(item.price).toFixed(2)}</small>
                        </div>
                        <div>
                            <strong>₱${parseFloat(item.item_total).toFixed(2)}</strong>
                        </div>
                    </div>
                `;
            });

            return `
                <div class="order-card glass-card mb-3">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h5 class="mb-1">Order #${order.order_id}</h5>
                            <p class="mb-1"><strong>${order.customer_name}</strong> • ${order.customer_phone}</p>
                            <p class="mb-0">
                                <i class="fas ${orderTypeIcon} me-1"></i>
                                ${orderTypeText}
                                ${order.table_number ? `• Table ${order.table_number}` : ''}
                            </p>
                        </div>
                        <div class="text-end">
                            <span class="order-status ${statusClass}">${statusText}</span>
                            <br>
                            <small class="text-muted">${formatDate(order.order_date)}</small>
                            <br>
                            <strong>₱${parseFloat(order.total_amount).toFixed(2)}</strong>
                        </div>
                    </div>
                    
                    ${itemsHtml}
                    
                    ${!isRecent ? `
                    <div class="mt-3">
                        <label class="form-label">Update Status:</label>
                        <select class="form-select" onchange="updateOrderStatus(${order.order_id}, this.value)">
                            <option value="pending" ${order.status === 'pending' ? 'selected' : ''}>Pending</option>
                            <option value="confirmed" ${order.status === 'confirmed' ? 'selected' : ''}>Confirmed</option>
                            <option value="preparing" ${order.status === 'preparing' ? 'selected' : ''}>Preparing</option>
                            <option value="ready" ${order.status === 'ready' ? 'selected' : ''}>Ready</option>
                            <option value="completed" ${order.status === 'completed' ? 'selected' : ''}>Completed</option>
                            <option value="cancelled" ${order.status === 'cancelled' ? 'selected' : ''}>Cancelled</option>
                        </select>
                    </div>
                    ` : ''}
                </div>
            `;
        }

        function updateStats(orders) {
            const today = new Date().toISOString().split('T')[0];
            const todayOrders = orders.filter(order => order.order_date.startsWith(today));
            
            const pendingCount = orders.filter(order => order.status === 'pending').length;
            const preparingCount = orders.filter(order => order.status === 'preparing').length;
            const readyCount = orders.filter(order => order.status === 'ready').length;
            const completedCount = orders.filter(order => order.status === 'completed').length;
            
            const todayTotal = todayOrders.length;
            const todayRevenue = todayOrders.reduce((sum, order) => sum + parseFloat(order.total_amount), 0);
            const todayAverage = todayTotal > 0 ? todayRevenue / todayTotal : 0;

            $('#pendingCount').text(pendingCount);
            $('#preparingCount').text(preparingCount);
            $('#readyCount').text(readyCount);
            $('#completedCount').text(completedCount);
            $('#todayTotal').text(todayTotal);
            $('#todayRevenue').text('₱' + todayRevenue.toFixed(2));
            $('#todayAverage').text('₱' + todayAverage.toFixed(2));
        }

        function updateOrderStatus(orderId, newStatus) {
            $.ajax({
                url: './endpoint/update_order_status.php',
                type: 'POST',
                data: {
                    order_id: orderId,
                    status: newStatus
                },
                success: function(response) {
                    loadOrders(); 
                },
                error: function() {
                    alert('Error updating order status');
                }
            });
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleTimeString() + ' ' + date.toLocaleDateString();
        }

        function printOrders() {
            window.print();
        }

        function exportOrders() {
            alert('Export feature would be implemented here');
        }
    </script>
</body>
</html>