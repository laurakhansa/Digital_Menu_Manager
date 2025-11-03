<?php
include("../conn/conn.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    try {
        $conn->beginTransaction();

        $stmt = $conn->prepare("
            INSERT INTO tbl_orders 
            (customer_name, customer_phone, customer_email, order_type, table_id, delivery_address, special_instructions, total_amount) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        
        $stmt->execute([
            $input['customer_name'],
            $input['customer_phone'],
            $input['customer_email'] ?? null,
            $input['order_type'],
            $input['table_id'] ?? null,
            $input['delivery_address'] ?? null,
            $input['special_instructions'] ?? null,
            $input['total_amount']
        ]);
        
        $orderId = $conn->lastInsertId();

        $stmt = $conn->prepare("
            INSERT INTO tbl_order_items 
            (order_id, menu_id, quantity, price, item_total) 
            VALUES (?, ?, ?, ?, ?)
        ");

        foreach ($input['items'] as $item) {
            $stmt->execute([
                $orderId,
                $item['menu_id'],
                $item['quantity'],
                $item['price'],
                $item['total']
            ]);
        }

        if ($input['order_type'] === 'dine_in' && $input['table_id']) {
            $stmt = $conn->prepare("UPDATE tbl_tables SET status = 'occupied' WHERE table_id = ?");
            $stmt->execute([$input['table_id']]);
        }

        $stmt = $conn->prepare("
            INSERT INTO tbl_payments 
            (order_id, payment_method, amount) 
            VALUES (?, 'cash', ?)
        ");
        
        $stmt->execute([$orderId, $input['total_amount']]);

        $conn->commit();
        
        echo json_encode(['success' => true, 'order_id' => $orderId]);
        
    } catch (PDOException $e) {
        $conn->rollBack();
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>