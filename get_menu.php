<?php
$servername = "localhost";
$username = "root";  // 본인의 MySQL 사용자 이름
$password = "1234";  // 본인의 MySQL 비밀번호
$dbname = "kiosk";

// 데이터베이스 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL 쿼리 실행
$sql = "SELECT * FROM menu WHERE sell = 'o'";
$result = $conn->query($sql);

$menuItems = [];

if ($result->num_rows > 0) {
    // 데이터 출력
    while($row = $result->fetch_assoc()) {
        $menuItems[] = $row;
    }
}

$conn->close();

// JSON 형태로 데이터 반환
header('Content-Type: application/json');
echo json_encode($menuItems);
?>
