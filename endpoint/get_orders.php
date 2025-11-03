<?php
include("../conn/conn.php");

header('Content-Type: application/json');

try {
    $stmt = $conn->prepare("
        SELECT 
            o.*,
            t.table_number,
            oi.order_item_id,
            oi.menu_id,
            oi.quantity,
            oi.price as item_price,
            oi.item_total,
            m.name as item_name,
            m.image as item_image
        FROM tbl_orders o
        LEFT JOIN tbl_tables t ON o.table_id = t.table_id
        LEFT JOIN tbl_order_items oi ON o.order_id = oi.order_id
        LEFT JOIN tbl_menu m ON oi.menu_id = m.tbl_menu_id
        ORDER BY o.order_date DESC
    ");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $orders = [];
    foreach ($results as $row) {
        $orderId = $row['order_id'];
        
        if (!isset($orders[$orderId])) {
            $orders[$orderId] = [
                'order_id' => $row['order_id'],
                'customer_name' => $row['customer_name'],
                'customer_phone' => $row['customer_phone'],
                'customer_email' => $row['customer_email'],
                'order_type' => $row['order_type'],
                'table_number' => $row['table_number'],
                'delivery_address' => $row['delivery_address'],
                'status' => $row['status'],
                'total_amount' => $row['total_amount'],
                'order_date' => $row['order_date'],
                'special_instructions' => $row['special_instructions'],
                'items' => []
            ];
        }
        
        if ($row['order_item_id']) {
            $orders[$orderId]['items'][] = [
                'name' => $row['item_name'],
                'quantity' => $row['quantity'],
                'price' => $row['item_price'],
                'item_total' => $row['item_total']
            ];
        }
    }

    $formattedOrders = array_values($orders);
    
    echo json_encode($formattedOrders);
    
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>