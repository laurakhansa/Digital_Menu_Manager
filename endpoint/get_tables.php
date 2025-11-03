<?php
include("../conn/conn.php");

header('Content-Type: application/json');

try {
    $stmt = $conn->prepare("SELECT * FROM tbl_tables ORDER BY table_number");
    $stmt->execute();
    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($tables);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>