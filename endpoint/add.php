<?php 
include("../conn/conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name'], $_POST['description'], $_POST['price']) && isset($_FILES['image'])) {

        $menuName = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];

        $targetDir = "../images/";

        $imageName = basename($_FILES['image']['name']);
        $imagePath = $targetDir . $imageName;
        $imageType = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
        $imageDbPath = './images/' . $imageName; 

        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($imageType, $allowedTypes)) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                
                try {
                    $stmt = $conn->prepare("INSERT INTO tbl_menu (name, description, price, image) 
                                            VALUES (:name, :description, :price, :image)");

                    $stmt->bindParam(":name", $menuName, PDO::PARAM_STR);
                    $stmt->bindParam(":description", $description, PDO::PARAM_STR);
                    $stmt->bindParam(":price", $price, PDO::PARAM_STR);
                    $stmt->bindParam(":image", $imageDbPath, PDO::PARAM_STR);

                    $stmt->execute();

                    echo "
                    <script>
                        alert('Menu item added successfully!');
                        window.location.href = '../menu-manager.php';
                    </script>
                ";

                } catch (PDOException $e) {
                    echo "
                    <script>
                        alert('Error: " . $e->getMessage() . "');
                        window.history.back();
                    </script>
                    ";
                }

            } else {
                echo "
                <script>
                    alert('Error uploading the image file.');
                    window.history.back();
                </script>
                ";
            }
        } else {
            echo "
            <script>
                alert('Only JPG, JPEG, PNG, and GIF files are allowed.');
                window.history.back();
            </script>
            ";
        }

    } else {
        echo "
        <script>
            alert('Please fill in all fields and upload an image.');
            window.history.back();
        </script>
        ";
    }
} else {
    echo "
    <script>
        alert('Invalid request method.');
        window.history.back();
    </script>
    ";
}
?>