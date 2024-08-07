<?php
include 'db.php';

$action = $_POST['action'];
$item_id = $_POST['item_id'];

if ($action == 'change') {
    $new_price = $_POST['new_price'];
    $new_quantity = $_POST['new_quantity'];
    
    if (!empty($new_price)) {
        $sql = "UPDATE menu SET price='$new_price' WHERE id='$item_id'";
        $conn->query($sql);
    }
    
    if (!empty($new_quantity)) {
        $sql = "UPDATE menu SET quantity='$new_quantity' WHERE id='$item_id'";
        $conn->query($sql);
    }
    
} elseif ($action == 'soldout') {
    $new_status = $_POST['new_status'];
    $sql = "UPDATE menu SET available='$new_status' WHERE id='$item_id'";
    $conn->query($sql);
}

$conn->close();
header("Location: admin.php");
exit();
?>
