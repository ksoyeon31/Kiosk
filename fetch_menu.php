<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "admin";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$categories = [
    "COFFEE" => "n1",
    "LATTE" => "n2",
    "HERB TEA" => "n3",
    "FRUIT TEA" => "n4",
    "ADE" => "n5",
    "FRAPPE" => "n6",
    "SMOOTHIE" => "n7",
    "DESSERT" => "n8"
];

$response = [];

foreach ($categories as $category_name => $category_id) {
    $sql = "SELECT * FROM menu WHERE category='$category_name'";
    $result = $conn->query($sql);
    $items = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $items[] = [
                'id' => $row['id'],
                'item_name' => $row['item_name'],
                'price' => $row['price'],
                'sell' => $row['sell'],
                'image_url' => $row['image_url']
            ];
        }
    }

    $response[] = [
        'id' => $category_id,
        'items' => $items
    ];
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>
