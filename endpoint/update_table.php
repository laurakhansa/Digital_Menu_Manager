<?php
include("../conn/conn.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tableId = $_POST['table_id'];
    $tableNumber = $_POST['table_number'];
    $capacity = $_POST['capacity'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    
    try {
        $stmt = $conn->prepare("UPDATE tbl_tables SET table_number = ?, capacity = ?, location = ?, description = ?, status = ? WHERE table_id = ?");
        $stmt->execute([$tableNumber, $capacity, $location, $description, $status, $tableId]);
        
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>