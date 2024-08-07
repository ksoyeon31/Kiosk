<?php
include 'db.php';

$order = json_decode(file_get_contents('php://input'), true);

foreach ($order as $item) {
    $id = $item['id'];
    $quantity = $item['quantity'];

    // Get current quantity from DB
    $sql = "SELECT quantity FROM menu WHERE id='$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $currentQuantity = $row['quantity'];

    // Calculate new quantity
    $newQuantity = $currentQuantity - $quantity;

    // Update quantity in DB
    if ($newQuantity < 0) {
        echo json_encode(["status" => "error", "message" => "주문량이 재고를 초과합니다."]);
        exit;
    } else {
        $availability = $newQuantity == 0 ? 'x' : 'o';
        $sql = "UPDATE menu SET quantity='$newQuantity', available='$availability' WHERE id='$id'";
        $conn->query($sql);
    }
}

echo json_encode(["status" => "success", "message" => "주문이 완료되었습니다."]);
?>
