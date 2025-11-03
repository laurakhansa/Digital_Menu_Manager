<?php
include("../conn/conn.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tableId = $_POST['table_id'];
    
    try {
        $stmt = $conn->prepare("DELETE FROM tbl_tables WHERE table_id = ?");
        $stmt->execute([$tableId]);
        
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>