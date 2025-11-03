<?php
include("../conn/conn.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = $_POST['order_id'] ?? null;
    $status = $_POST['status'] ?? null;
    
    if (!$orderId || !$status) {
        echo json_encode(['error' => 'Missing order_id or status']);
        exit();
    }
    
    try {
        $stmt = $conn->prepare("UPDATE tbl_orders SET status = ? WHERE order_id = ?");
        $stmt->execute([$status, $orderId]);
        
        echo json_encode(['success' => true]);
        
    } catch (PDOException $e) {
        error_log("Update order status error: " . $e->getMessage());
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>