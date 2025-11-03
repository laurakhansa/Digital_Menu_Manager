<?php
include('../conn/conn.php');

if (isset($_GET['menu'])) {
    $menu = $_GET['menu'];

    try {
        $stmt = $conn->prepare("SELECT image FROM tbl_menu WHERE tbl_menu_id = :menu");
        $stmt->bindParam(':menu', $menu, PDO::PARAM_INT);
        $stmt->execute();

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $imagePath = "../images/" . basename($row['image']);

            $deleteStmt = $conn->prepare("DELETE FROM tbl_menu WHERE tbl_menu_id = :menu");
            $deleteStmt->bindParam(':menu', $menu, PDO::PARAM_INT);
            $deleteStmt->execute();

            if ($imagePath && file_exists($imagePath)) {
                unlink($imagePath);
            }

            echo "<script>
                    alert('Menu item deleted successfully!');
                    window.location.href = '../menu-manager.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Record not found.');
                    window.location.href = '../menu-manager.php';
                  </script>";
        }
    } catch (PDOException $e) {
        echo "<script>
                alert('Error: " . $e->getMessage() . "');
                window.location.href = '../menu-manager.php';
              </script>";
    }
} else {
    echo "<script>
            window.location.href = '../menu-manager.php';
          </script>";
    exit();
}
?>