<?php
include("../conn/conn.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tableId = $_POST['table_id'];
    $status = $_POST['status'];
    
    try {
        $stmt = $conn->prepare("UPDATE tbl_tables SET status = ? WHERE table_id = ?");
        $stmt->execute([$status, $tableId]);
        
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>