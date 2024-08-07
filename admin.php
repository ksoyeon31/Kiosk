<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>관리자페이지</title>
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
        }
        td img {
            max-width: 100%;
            height: auto;
        }
        .beverage {
            font-family: 'GOSEONGGEUMGANGNURI';
            text-align: center;
        }
        .hidden {
            display: none;
        }
        input[type="button"],
        button[type="button"] {
            background-color: darkblue;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
            font-family: 'GOSEONGGEUMGANGNURI';
            margin: 5px;
        }
        input[type="button"]:hover,
        button[type="button"]:hover {
            background-color: #001f4d;
        }
    </style>
</head>
<body>
    <table border='1' id='table' width=100% cellspacing='0'>
        <tr>
            <th colspan='4' id='title'><a onClick="window.location.reload()">ByuRi coffee</a></th>
        </tr>
        <tr span id="menu">
            <td id='m1' onclick="show('n1')">COFFEE</td>
            <td id='m2' onclick="show('n2')">LATTE</td>
            <td id='m3' onclick="show('n3')">HERB TEA</td>
            <td id='m4' onclick="show('n4')">FRUIT TEA</td>
        </tr>
        <tr span id="menu">
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
        foreach ($categories as $index => $category) {
            echo "<table border='1' id='n" . ($index + 1) . "' name='coffee' bordercolor='black' cellspacing='0' class='hidden'>";
            echo "<tr>";
            $sql = "SELECT * FROM menu WHERE category='$category'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $count = 0;
                while ($row = $result->fetch_assoc()) {
                    if ($count % 4 == 0 && $count != 0) {
                        echo "</tr><tr>";
                    }
                    $availability = $row['available'] == 'o' ? "" : " (품절)";
                    echo "<td id='c" . $row["id"] . "'><img src='" . $row["image_url"] . "' width='100%'><br>" . $row["price"] . "원<br><b>" . $row["name"] . $availability . "</b></td>";
                    $count++;
                }
            }
            echo "</tr></table>";
        }
        ?>
    </element><br><br>
    
    <form id="adminForm" action="admin_action.php" method="post">
        <input type='button' value='수정하기' onclick="change()">
        <input type='button' value='품절/판매' onclick="soldout()">
        <button type='button' onclick="window.location.href='./main.php'">돌아가기</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
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

        function change() {
            Swal.fire({
                title: "수정하기",
                html: `
                    메뉴 ID: <input id="swal-input1" class="swal2-input">
                    가격: <input id="swal-input2" class="swal2-input">
                    수량: <input id="swal-input3" class="swal2-input">
                `,
                focusConfirm: false,
                preConfirm: () => {
                    return {
                        item_id: document.getElementById("swal-input1").value,
                        new_price: document.getElementById("swal-input2").value,
                        new_quantity: document.getElementById("swal-input3").value
                    };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    var form = document.getElementById('adminForm');
                    form.innerHTML += `
                        <input type="hidden" name="action" value="change">
                        <input type="hidden" name="item_id" value="${result.value.item_id}">
                        <input type="hidden" name="new_price" value="${result.value.new_price}">
                        <input type="hidden" name="new_quantity" value="${result.value.new_quantity}">
                    `;
                    form.submit();
                }
            });
        }

        function soldout() {
            Swal.fire({
                title: "품절/판매",
                html: `
                    메뉴 ID: <input id="swal-input1" class="swal2-input">
                    상태: <select id="swal-input2" class="swal2-input">
                        <option value="o">판매</option>
                        <option value="x">품절</option>
                    </select>
                `,
                focusConfirm: false,
                preConfirm: () => {
                    return {
                        item_id: document.getElementById("swal-input1").value,
                        new_status: document.getElementById("swal-input2").value
                    };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    var form = document.getElementById('adminForm');
                    form.innerHTML += `
                        <input type="hidden" name="action" value="soldout">
                        <input type="hidden" name="item_id" value="${result.value.item_id}">
                        <input type="hidden" name="new_status" value="${result.value.new_status}">
                    `;
                    form.submit();
                }
            });
        }
    </script>
</body>
</html>
