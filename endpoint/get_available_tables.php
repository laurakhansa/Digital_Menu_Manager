<?php
include("../conn/conn.php");

header('Content-Type: application/json');

try {
    $checkTable = $conn->query("SHOW TABLES LIKE 'tbl_tables'");
    if ($checkTable->rowCount() == 0) {
        $createTable = $conn->exec("
            CREATE TABLE `tbl_tables` (
                `table_id` int(11) NOT NULL AUTO_INCREMENT,
                `table_number` varchar(10) NOT NULL,
                `capacity` int(11) NOT NULL,
                `status` enum('available','occupied','reserved','cleaning') NOT NULL DEFAULT 'available',
                `location` varchar(50) DEFAULT 'Main Hall',
                `description` text DEFAULT NULL,
                PRIMARY KEY (`table_id`),
                UNIQUE KEY `table_number` (`table_number`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ");
        
        $sampleTables = [
            ['T1', 4, 'available', 'Main Hall', 'Window side table'],
            ['T2', 2, 'available', 'Main Hall', 'Cozy corner table'],
            ['T3', 6, 'available', 'Main Hall', 'Family table'],
            ['T4', 4, 'available', 'Garden', 'Outdoor seating'],
            ['T5', 8, 'available', 'Private Room', 'VIP table']
        ];
        
        $stmt = $conn->prepare("INSERT INTO tbl_tables (table_number, capacity, status, location, description) VALUES (?, ?, ?, ?, ?)");
        foreach ($sampleTables as $table) {
            $stmt->execute($table);
        }
    }
    
    $stmt = $conn->prepare("SELECT * FROM tbl_tables WHERE status = 'available' ORDER BY table_number");
    $stmt->execute();
    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($tables);
    
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>