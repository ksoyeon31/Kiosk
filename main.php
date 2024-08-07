<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>메인화면</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <style>
        @font-face {
            font-family: 'BagelFatOne-Regular';
            src: url('https://fastly.jsdelivr.net/gh/projectnoonnu/noonfonts_JAMO@1.0/BagelFatOne-Regular.woff2') format('woff2');
            font-weight: normal;
            font-style: normal;
        }
        @font-face {
            font-family: 'GOSEONGGEUMGANGNURI';
            src: url('https://cdn.jsdelivr.net/gh/projectnoonnu/2404-2@1.0/GOSEONGGEUMGANGNURI.woff2') format('woff2');
            font-weight: normal;
            font-style: normal;
        }
        body {
            font-family: 'BagelFatOne-Regular';
            overflow: auto;
        }
        form {
            text-align: center;
        }
        #table {
            text-align: center;
        }
        #title {
            font-size: 50px;
            background-color: darkblue;
            color: white;
            cursor: pointer;
            font-weight: bold;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s;
        }
        #menu td {
            background-color: skyblue;
            color: #333;
            font-size: 20px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }
        #menu td:hover {
            background-color: rgb(53, 163, 206);
        }
        td {
            width: 25%;
            cursor: pointer;
            transition: transform 0.2s;
        }
        td:hover {
            transform: scale(1.05);
        }
        td img {
            max-width: 100%;
            height: auto;
        }
        #order {
            width: 100%;
            height: auto;
            text-align: center;
            font-family: 'GOSEONGGEUMGANGNURI';
        }
        input {
            font-family: 'GOSEONGGEUMGANGNURI';
        }
        input[type="button"],
        input[type="reset"],
        input[type="submit"] {
            background-color: darkblue;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        input[type="button"]:hover,
        input[type="reset"]:hover,
        input[type="submit"]:hover {
            background-color: #001f4d;
        }
        .beverage {
            font-family: 'GOSEONGGEUMGANGNURI';
            text-align: center;
        }
        .hidden {
            display: none;
        }
        .popup {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }
        .popup-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 300px;
            position: relative;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .swal2-btn {
            display: inline-block;
            margin: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f0f0f0;
            transition: background-color 0.3s, transform 0.2s;
        }
        .swal2-btn.selected {
            background-color: lightblue;
            transform: scale(1.1);
        }
        .swal2-btn:disabled {
            background-color: #ddd;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <table border='1' id='table' width=100% cellspacing='0'>
        <tr>
            <th colspan='4' id='title'><a onClick="window.location.reload()">ByuRi coffee</a></th>
        </tr>
        <tr id="menu">
            <td id='m1' onclick="show('n1')">COFFEE</td>
            <td id='m2' onclick="show('n2')">LATTE</td>
            <td id='m3' onclick="show('n3')">HERB TEA</td>
            <td id='m4' onclick="show('n4')">FRUIT TEA</td>
        </tr>
        <tr id="menu">
            <td id='m5' onclick="show('n5')">ADE</td>
            <td id='m6' onclick="show('n6')">FRAPPE</td>
            <td id='m7' onclick="show('n7')">SMOOTHIE</td>
            <td id='m8' onclick="show('n8')">DESSERT</td>
        </tr>
    </table><br>
    <element class="beverage">
        <?php
        include 'db.php';
        $categories = ["COFFEE", "LATTE", "HERB TEA", "FRUIT TEA", "ADE", "FRAPPE", "SMOOTHIE", "DESSERT"];
        foreach ($categories as $category) {
            echo "<table border='1' id='n" . (array_search($category, $categories) + 1) . "' class='hidden' width='100%' cellspacing='0'>";
            $sql = "SELECT * FROM menu WHERE category='$category'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $count = 0;
                while ($row = $result->fetch_assoc()) {
                    if ($count % 4 == 0) {
                        if ($count > 0) {
                            echo "</tr>";
                        }
                        echo "<tr>";
                    }
                    $availability = $row['available'] == 'o' ? "" : " (품절)";
                    echo "<td id='c" . $row["id"] . "' class='" . strtolower($category) . "' onclick=\"add('c" . $row["id"] . "')\"><img src='" . $row["image_url"] . "'><br>" . $row["price"] . "원<br><b>" . $row["name"] . $availability . "</b></td>";
                    $count++;
                }
                if ($count % 4 != 0) {
                    echo "</tr>";
                }
            }
            echo "</table>";
        }
        ?>
    </element><br><br>
    
    <form id="orderForm">
        <textarea id="order" name='order' cols="30" rows="10" style="cursor: default;" readonly>주문내역</textarea><br><br>
        <input type='button' value='주문하기' onclick="orderbeverage()">
        <input type='reset' value='초기화'>
        <input id='adminPageButton' type='button' value='관리자페이지' onclick="openLoginPopup()">
    </form>
    
    <div id="loginPopup" class="popup">
        <div class="popup-content">
            <span class="close">&times;</span>
            <h2>관리자 로그인</h2>
            <form id="loginForm" onsubmit="submitLoginForm(event)">
                <label for="id">아이디:</label>
                <input type="text" id="id" name="id" required><br>
                <label for="pwd">비밀번호:</label>
                <input type="password" id="pwd" name="pwd" required><br>
                <button type="submit">로그인</button>
            </form>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var selectedItems = [];

        function show(beverageID) {
            var beverageMenus = document.querySelectorAll('.beverage table');
            beverageMenus.forEach(menu => {
                menu.classList.add('hidden');
            });

            var selectedMenu = document.getElementById(beverageID);
            if (selectedMenu) {
                selectedMenu.classList.remove('hidden');
            }
        }

        function add(n) {
            var el = document.getElementById(n);
            var itemName = el.querySelector('b').innerText.replace(/<br>/g, '').replace(/\n/g, '');
            var price = el.innerText.match(/\d+원/)[0];
            var numericPrice = parseInt(price.replace('원', ''));
            var category = el.className;

            if (category === 'dessert') {
                Swal.fire({
                    title: '수량 선택',
                    html: `
                    <div>
                        <label for="quantity">수량:</label>
                        <input type="number" id="quantity" class="swal2-input" value="1" min="1" max="10">
                    </div>
                `,
                    preConfirm: () => {
                        var quantity = parseInt(document.getElementById('quantity').value);
                        return {
                            quantity: quantity
                        };
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        var quantity = result.value.quantity;
                        var orderDetails = {
                            id: n.replace('c', ''),
                            name: itemName,
                            price: numericPrice * quantity,
                            quantity: quantity
                        };
                        selectedItems.push(orderDetails);
                        updateOrderList();
                    }
                });
            } else {
                var isIcedOnly = category === 'ade' || category === 'frappe' || category === 'smoothie';
                Swal.fire({
                    title: '옵션 선택',
                    html: `
                    <div>
                        <label>온도:</label>
                        <div class="option-buttons" id="temperature-buttons">
                            <button type="button" id="hot" class="swal2-btn" onclick="selectOption('temperature', 'hot')" ${isIcedOnly ? 'disabled' : ''}>Hot</button>
                            <button type="button" id="iced" class="swal2-btn" onclick="selectOption('temperature', 'iced')">Iced</button>
                        </div>
                    </div>
                    <div>
                        <label>사이즈:</label>
                        <div class="option-buttons" id="size-buttons">
                            <button type="button" id="small" class="swal2-btn" onclick="selectOption('size', 'small')">Small</button>
                            <button type="button" id="medium" class="swal2-btn" onclick="selectOption('size', 'medium')">Medium</button>
                            <button type="button" id="large" class="swal2-btn" onclick="selectOption('size', 'large')">Large</button>
                        </div>
                    </div>
                    <div>
                        <label>추가 옵션:</label>
                        <div class="option-buttons" id="extras-buttons">
                            <button type="button" id="none" class="swal2-btn" onclick="selectOption('extras', 'none')">None</button>
                            <button type="button" id="extra_shot" class="swal2-btn" onclick="selectOption('extras', 'extra_shot')">Extra Shot (+500원)</button>
                            <button type="button" id="syrup" class="swal2-btn" onclick="selectOption('extras', 'syrup')">Syrup</button>
                        </div>
                    </div>
                    <div>
                        <label for="quantity">수량:</label>
                        <input type="number" id="quantity" class="swal2-input" value="1" min="1" max="10">
                    </div>
                `,
                    preConfirm: () => {
                        if (!selectedOptions.temperature || !selectedOptions.size || !selectedOptions.extras) {
                            Swal.showValidationMessage('옵션을 선택해주세요!');
                            return false;
                        }
                        return {
                            temperature: selectedOptions['temperature'],
                            size: selectedOptions['size'],
                            extras: selectedOptions['extras'],
                            quantity: parseInt(document.getElementById('quantity').value)
                        };
                    },
                    didOpen: () => {
                        initializeButtonsState();
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        var options = result.value;
                        var extraShotPrice = options.extras === 'extra_shot' ? 500 : 0;
                        var orderDetails = {
                            id: n.replace('c', ''),
                            name: itemName,
                            price: (numericPrice + extraShotPrice) * options.quantity,
                            temperature: options.temperature,
                            size: options.size,
                            extras: options.extras,
                            quantity: options.quantity
                        };
                        selectedItems.push(orderDetails);
                        updateOrderList();
                    }
                });
            }
        }

        var selectedOptions = {
            temperature: null,
            size: null,
            extras: null
        };

        function initializeButtonsState() {
            selectOption('temperature', null);
            selectOption('size', null);
            selectOption('extras', null);
        }

        function selectOption(category, value) {
            selectedOptions[category] = value;
            var buttons = document.getElementById(category + '-buttons').querySelectorAll('.swal2-btn');
            buttons.forEach(button => {
                if (button.id === value) {
                    button.classList.add('selected');
                } else {
                    button.classList.remove('selected');
                }
            });
        }

        function updateOrderList() {
            var orderList = document.getElementById('order');
            var totalQuantity = 0;
            orderList.value = '';

            selectedItems.forEach(order => {
                var itemName = order.name;
                totalQuantity += order.quantity;
                orderList.value += `${itemName} - ${order.size ? order.size : ''} - ${order.extras ? order.extras : ''} - ${order.quantity}개 - ${order.price}원\n`;
            });

            document.getElementById('total-quantity').innerText = totalQuantity;
        }

        function orderbeverage() {
            if (selectedItems.length === 0) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "음료를 선택해주세요!"
                });
            } else {
                var totalAmount = selectedItems.reduce((total, item) => total + item.price, 0);
                var totalQuantity = selectedItems.reduce((total, item) => total + item.quantity, 0);
                Swal.fire({
                    title: "결제 방법 선택",
                    text: `총 수량: ${totalQuantity}개, 총 주문금액: ${totalAmount}원`,
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "현금",
                    cancelButtonText: "신용카드"
                }).then((result) => {
                    if (result.isConfirmed || result.dismiss === Swal.DismissReason.cancel) {
                        fetch('order.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(selectedItems)
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                Swal.fire({
                                    icon: "success",
                                    title: "결제 완료",
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 2000
                                }).then(() => {
                                    resetOrder();
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "결제 실패",
                                    text: data.message
                                });
                            }
                        });
                    }
                });
            }
        }

        function resetOrder() {
            selectedItems = [];
            updateOrderList();
        }

        function openLoginPopup() {
            document.getElementById('loginPopup').style.display = 'block';
        }

        function closeLoginPopup() {
            document.getElementById('loginPopup').style.display = 'none';
        }

        function submitLoginForm(event) {
            event.preventDefault();
            var id = document.getElementById('id').value;
            var pwd = document.getElementById('pwd').value;

            if (id === 'admin' && pwd === '1234') {
                Swal.fire({
                    icon: 'success',
                    title: '로그인 성공',
                    text: '관리자 페이지로 이동합니다.',
                }).then(() => {
                    window.location.href = 'admin.php';
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: '로그인 실패',
                    text: '아이디 또는 비밀번호가 올바르지 않습니다.',
                });
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            var popup = document.getElementById("loginPopup");
            var span = document.getElementsByClassName("close")[0];

            span.onclick = function() {
                popup.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == popup) {
                    popup.style.display = "none";
                }
            }
        });
    </script>
</body>
</html>
