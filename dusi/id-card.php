<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dusi_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$html = '';
if (isset($_POST['search'])) {
    $identification = $_POST['identification'];

    if (!empty($identification)) {
        $sql = "SELECT * FROM users_dusi WHERE identification='$identification'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $name_title = $row["name_title"];
                $name = $row["name"];
                $surname = $row["surname"];
                $birthday = $row["birthday"];
                $identification = $row['identification'];
                $sex = $row['sex'];
                $id_card = $row['id_card'] ?? 'ไม่มีข้อมูล';
                $registration_date = $row['registration_date'] ?? 'ไม่มีข้อมูล';

                $html .= "
                    <div class='card' id='card-$id_card'>
                        <div class='card-header'>
                            <img src='drtest/image/DR.DUSI-removebg-preview.png' alt='DR.DUSI Logo' class='logo'>
                            <span>บัตรประจำตัวผู้ป่วย</span>
                        </div>
                        <div class='content'>
                            <p>ชื่อ - สกุล: $name_title $name $surname</p>
                            <p>หมายเลขบัตรประชาชน: $identification</p>
                            <p>วันเกิด: $birthday เพศ: $sex</p>
                        </div>
                        <div class='barcode'>
                            <svg class='barcode' data-id='$id_card'></svg>
                        </div>
                        <div class='footer'>
                            วันที่สร้าง: " . ($registration_date !== 'ไม่มีข้อมูล' ? date('d/m/Y', strtotime($registration_date)) : $registration_date) . "
                        </div>
                        <button class='btn btn-primary' onclick='downloadCard(\"card-$id_card\")'>ดาวน์โหลดบัตร</button>
                    </div>
                ";
            }
        } else {
            $html = "<div class='alert alert-warning'>ไม่พบข้อมูลหมายเลขบัตรประชาชน</div>";
        }
    } else {
        $html = "<div class='alert alert-danger'>กรุณากรอกหมายเลขบัตรประชาชน</div>";
    }
}
?>
<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>สร้างบัตรประชาชน</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .card {
            width: 10cm;
            height: 6.5cm;
            border-radius: 10px;
            border: 2px solid #000;
            background: linear-gradient(to bottom, #ffffff, #e6f7ff);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 10px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            text-align: center;
            margin: 20px 0;
        }
        .card-header {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #3a80ba;
            color: #ffffff;
            width: 100%;
            padding: 5px 0;
            font-size: 16px;
            font-weight: bold;
            border-radius: 10px 10px 0 0;
        }
        .card-header img.logo {
            height: 40px;
            margin-right: 10px;
        }
        .content {
            padding: 10px;
            font-size: 14px;
            text-align: left;
            color: #333333;
        }
        .content p {
            margin: 5px 0;
        }
        .barcode {
            margin-top: 10px;
            display: flex;
            justify-content: center;
        }
        .footer {
            margin-top: 5px;
            font-size: 12px;
            color: #666666;
            font-weight: bold;
        }
        .btn {
            margin-top: 10px;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dom-to-image@2.6.0/src/dom-to-image.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">ระบบบัตรประชาชน</a>
    </nav>

    <div class="container mt-4">
        <form method="POST" action="id-card.php" style="text-align: center;">
            <label for="id_card">หมายเลขบัตรประชาชน:</label>
            <input type="text" name="identification" placeholder="กรอกเลขบัตรประชาชน">
            <button class="btn" type="submit" name="search">ค้นหา</button>
        </form>
        <div id="result">
            <?php echo $html; ?>
        </div>
    </div>

    <script>
        document.querySelectorAll('.barcode').forEach(barcode => {
            const id = barcode.getAttribute('data-id');
            if (id && id !== 'ไม่มีข้อมูล') {
                JsBarcode(barcode, id, {
                    format: "CODE128",
                    lineColor: "#000",
                    width: 2,
                    height: 40,
                    displayValue: true
                });
            }
        });

        function downloadCard(cardId) {
            const node = document.getElementById(cardId);
            domtoimage.toPng(node)
                .then(dataUrl => {
                    const link = document.createElement("a");
                    link.download = `${cardId}.png`;
                    link.href = dataUrl;
                    link.click();
                })
                .catch(error => {
                    console.error("เกิดข้อผิดพลาดในการดาวน์โหลด:", error);
                });
        }
    </script>
</body>
</html>
