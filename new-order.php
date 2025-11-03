<?php include 'check_auth.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flavor Haven - New Order</title>

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
            padding: 30px;
            margin-bottom: 30px;
        }

        .menu-item-card {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }

        .menu-item-card:hover {
            border-color: var(--primary);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .menu-item-image {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            object-fit: cover;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .quantity-btn {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            border: 1px solid #ddd;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .quantity-input {
            width: 60px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 5px;
        }

        .order-summary {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            position: sticky;
            top: 100px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .total-amount {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            border-top: 2px solid #ddd;
            padding-top: 10px;
            margin-top: 10px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 600;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(67, 97, 238, 0.3);
        }

        .form-section {
            margin-bottom: 30px;
        }

        .form-section h4 {
            color: var(--dark);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--primary);
        }

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
                <h1><i class="fas fa-plus-circle me-3"></i>Create New Order</h1>
                <p class="mt-3">Add items and customer details to create a new order</p>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="glass-card order-card">
                        <div class="form-section">
                            <h4><i class="fas fa-user me-2"></i>Customer Details</h4>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Customer Name *</label>
                                    <input type="text" class="form-control" id="customerName" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Phone Number *</label>
                                    <input type="tel" class="form-control" id="customerPhone" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="customerEmail">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Order Type *</label>
                                    <select class="form-select" id="orderType" required>
                                        <option value="dine_in">Dine In</option>
                                        <option value="takeaway">Takeaway</option>
                                        <option value="delivery">Delivery</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row" id="dineInFields" style="display: none;">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Table Number</label>
                                    <select class="form-select" id="tableNumber">
                                        <option value="">Select a table...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row d-none" id="deliveryFields">
                                <div class="col-12 mb-3">
                                    <label class="form-label">Delivery Address</label>
                                    <textarea class="form-control" id="deliveryAddress" rows="3"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <h4><i class="fas fa-utensils me-2"></i>Menu Items</h4>
                            <div id="menuItemsContainer">
                            </div>
                        </div>

                        <div class="form-section">
                            <h4><i class="fas fa-sticky-note me-2"></i>Special Instructions</h4>
                            <textarea class="form-control" id="specialInstructions" rows="3" placeholder="Any special requests or instructions..."></textarea>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="glass-card order-card order-summary">
                        <h4 class="mb-4">Order Summary</h4>
                        <div id="orderSummary">
                            <div class="text-center text-muted">
                                <i class="fas fa-shopping-cart fa-2x mb-2"></i>
                                <p>No items added yet</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button class="btn btn-primary w-100" onclick="placeOrder()">
                                <i class="fas fa-paper-plane me-2"></i> Place Order
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        let cart = [];
        let menuItems = [];
        let autoAddItemId = null;

        function getUrlParameter(name) {
            name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
            var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
            var results = regex.exec(location.search);
            return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
        }

        $(document).ready(function() {
            autoAddItemId = getUrlParameter('add_item');
            
            loadMenuItems();
            
            checkOrderType();
            
            $('#orderType').change(function() {
                checkOrderType();
            });
        });

        function checkOrderType() {
            const type = $('#orderType').val();
            if (type === 'dine_in') {
                loadAvailableTables();
                $('#dineInFields').show();
                $('#deliveryFields').addClass('d-none');
            } else if (type === 'delivery') {
                $('#dineInFields').hide();
                $('#deliveryFields').removeClass('d-none');
            } else {
                $('#dineInFields').hide();
                $('#deliveryFields').addClass('d-none');
            }
        }

        function loadAvailableTables() {
            $.ajax({
                url: './endpoint/get_available_tables.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log('Available tables:', response);
                    let html = '<option value="">Select a table...</option>';
                    if (response && response.length > 0) {
                        response.forEach(table => {
                            html += `<option value="${table.table_id}">${table.table_number} (${table.capacity} persons) - ${table.location}</option>`;
                        });
                    } else {
                        html = '<option value="">No available tables</option>';
                    }
                    $('#tableNumber').html(html);
                },
                error: function(xhr, status, error) {
                    console.error('Error loading tables:', error);
                    $('#tableNumber').html('<option value="">Error loading tables</option>');
                }
            });
        }

        function loadMenuItems() {
            $.ajax({
                url: './endpoint/get_menu.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    menuItems = response;
                    displayMenuItems(response);

                    if (autoAddItemId) {
                        const item = menuItems.find(item => item.tbl_menu_id == autoAddItemId);
                        if (item) {
                            addToCart(parseInt(autoAddItemId));
                            $('html, body').animate({
                                scrollTop: $('.order-summary').offset().top
                            }, 500);
                        }
                    }
                },
                error: function() {
                    alert('Error loading menu items');
                }
            });
        }

        function displayMenuItems(items) {
            let html = '';
            items.forEach(item => {
                html += `
                    <div class="menu-item-card">
                        <div class="row align-items-center">
                            <div class="col-2">
                                <img src="${item.image}" class="menu-item-image" alt="${item.name}">
                            </div>
                            <div class="col-5">
                                <h6 class="mb-1">${item.name}</h6>
                                <p class="text-muted small mb-0">${item.description.substring(0, 60)}...</p>
                            </div>
                            <div class="col-3">
                                <strong>₱${parseFloat(item.price).toFixed(2)}</strong>
                            </div>
                            <div class="col-2">
                                <button class="btn btn-sm btn-outline-primary w-100" onclick="addToCart(${item.tbl_menu_id})">
                                    <i class="fas fa-plus"></i> Add
                                </button>
                            </div>
                        </div>
                    </div>
                `;
            });
            $('#menuItemsContainer').html(html);
        }

        function addToCart(menuId) {
            const menuItem = menuItems.find(item => item.tbl_menu_id == menuId);
            const existingItem = cart.find(item => item.menu_id == menuId);

            if (existingItem) {
                existingItem.quantity += 1;
                existingItem.total = existingItem.quantity * existingItem.price;
            } else {
                cart.push({
                    menu_id: menuId,
                    name: menuItem.name,
                    price: parseFloat(menuItem.price),
                    quantity: 1,
                    total: parseFloat(menuItem.price)
                });
            }

            updateOrderSummary();
        }

        function updateCartItem(menuId, quantity) {
            if (quantity <= 0) {
                removeFromCart(menuId);
                return;
            }

            const item = cart.find(item => item.menu_id == menuId);
            if (item) {
                item.quantity = quantity;
                item.total = item.quantity * item.price;
                updateOrderSummary();
            }
        }

        function removeFromCart(menuId) {
            cart = cart.filter(item => item.menu_id != menuId);
            updateOrderSummary();
        }

        function updateOrderSummary() {
            const summaryElement = $('#orderSummary');
            
            if (cart.length === 0) {
                summaryElement.html(`
                    <div class="text-center text-muted">
                        <i class="fas fa-shopping-cart fa-2x mb-2"></i>
                        <p>No items added yet</p>
                    </div>
                `);
                return;
            }

            let html = '';
            let subtotal = 0;

            cart.forEach(item => {
                subtotal += item.total;
                html += `
                    <div class="summary-item">
                        <div>
                            <strong>${item.name}</strong>
                            <br>
                            <small>₱${item.price.toFixed(2)} × ${item.quantity}</small>
                        </div>
                        <div class="text-end">
                            <strong>₱${item.total.toFixed(2)}</strong>
                            <br>
                            <div class="quantity-controls mt-1">
                                <button class="quantity-btn btn-sm" onclick="updateCartItem(${item.menu_id}, ${item.quantity - 1})">-</button>
                                <span class="mx-2">${item.quantity}</span>
                                <button class="quantity-btn btn-sm" onclick="updateCartItem(${item.menu_id}, ${item.quantity + 1})">+</button>
                            </div>
                        </div>
                    </div>
                `;
            });

            html += `
                <div class="summary-item total-amount">
                    <span>Total:</span>
                    <span>₱${subtotal.toFixed(2)}</span>
                </div>
            `;

            summaryElement.html(html);
        }

        function placeOrder() {
            const customerName = $('#customerName').val();
            const customerPhone = $('#customerPhone').val();
            const orderType = $('#orderType').val();
            
            if (!customerName || !customerPhone) {
                alert('Please fill in all required customer details');
                return;
            }

            if (cart.length === 0) {
                alert('Please add at least one item to the order');
                return;
            }

            const orderData = {
                customer_name: customerName,
                customer_phone: customerPhone,
                customer_email: $('#customerEmail').val(),
                order_type: orderType,
                table_id: orderType === 'dine_in' ? $('#tableNumber').val() : null,
                delivery_address: orderType === 'delivery' ? $('#deliveryAddress').val() : null,
                special_instructions: $('#specialInstructions').val(),
                items: cart,
                total_amount: cart.reduce((sum, item) => sum + item.total, 0)
            };

            $.ajax({
                url: './endpoint/create_order.php',
                type: 'POST',
                data: JSON.stringify(orderData),
                contentType: 'application/json',
                success: function(response) {
                    if (response.success) {
                        alert('Order placed successfully!');
                        window.location.href = 'orders.php';
                    } else {
                        alert('Error: ' + response.error);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error placing order: ' + error);
                }
            });
        }
    </script>
</body>
</html>