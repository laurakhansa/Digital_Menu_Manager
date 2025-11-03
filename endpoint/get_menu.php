<?php
include("../conn/conn.php");

header('Content-Type: application/json');

try {
    $stmt = $conn->prepare("SELECT * FROM tbl_menu ORDER BY tbl_menu_id");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($result);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>