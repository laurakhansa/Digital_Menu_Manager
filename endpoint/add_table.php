<?php
include("../conn/conn.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tableNumber = $_POST['table_number'];
    $capacity = $_POST['capacity'];
    $location = $_POST['location'];
    $description = $_POST['description'] ?? '';
    
    try {
        $stmt = $conn->prepare("INSERT INTO tbl_tables (table_number, capacity, location, description) VALUES (?, ?, ?, ?)");
        $stmt->execute([$tableNumber, $capacity, $location, $description]);
        
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>