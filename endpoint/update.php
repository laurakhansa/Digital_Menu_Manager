<?php 
include("../conn/conn.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['tbl_menu_id'], $_POST['name'], $_POST['description'], $_POST['price'])) {
        
        $menuId = $_POST['tbl_menu_id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];

        if (!empty($_FILES['image']['name'])) {
            $targetDir = "../images/";
            $targetFile = $targetDir . basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check === false) {
                echo json_encode(['error' => 'File is not an image.']);
                exit();
            }

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                $image = './images/' . basename($_FILES["image"]["name"]);
            } else {
                echo json_encode(['error' => 'Error uploading image.']);
                exit();
            }

            $query = "UPDATE tbl_menu SET name = :name, description = :description, price = :price, image = :image WHERE tbl_menu_id = :tbl_menu_id";
        } else {
            $query = "UPDATE tbl_menu SET name = :name, description = :description, price = :price WHERE tbl_menu_id = :tbl_menu_id";
        }

        try {
            $stmt = $conn->prepare($query);
            
            $stmt->bindParam(":tbl_menu_id", $menuId, PDO::PARAM_INT);
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->bindParam(":description", $description, PDO::PARAM_STR);
            $stmt->bindParam(":price", $price, PDO::PARAM_STR);
            if (!empty($_FILES['image']['name'])) {
                $stmt->bindParam(":image", $image, PDO::PARAM_STR);
            }

            $stmt->execute();

            echo json_encode(['success' => true]);

        } catch (PDOException $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['error' => 'Please fill in all fields!']);
    }
}
?>