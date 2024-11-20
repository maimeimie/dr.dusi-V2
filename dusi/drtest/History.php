<?php
include('../config.php');

// ตรวจสอบว่ามีการกรอกข้อมูลเพื่อค้นหาหรือไม่
$search_date = isset($_GET['search_date']) ? $_GET['search_date'] : null;
$name = isset($_GET['name']) ? $_GET['name'] : null;
$identification = isset($_GET['identification']) ? $_GET['identification'] : null;

// SQL สำหรับการดึงข้อมูล
$sql = "
    SELECT 
        u.name_title, u.name, u.surname, u.identification,
        s.created_at AS assessment_date,
        t.temperature_range, t.duration,
        GROUP_CONCAT(DISTINCT cd.disease_name SEPARATOR ', ') AS chronic_diseases,
        GROUP_CONCAT(DISTINCT r.risk_name SEPARATOR ', ') AS risks,
        sy.symptom_name, sy.severity_level, sy.severity_description
    FROM 
        users_dusi u
    JOIN 
        sessions s ON u.user_id = s.user_id
    LEFT JOIN 
        temperatures t ON s.session_id = t.session_id
    LEFT JOIN 
        chronic_diseases cd ON s.session_id = cd.session_id
    LEFT JOIN 
        risks r ON s.session_id = r.session_id
    LEFT JOIN 
        symptoms sy ON s.session_id = sy.session_id
    WHERE 1=1
";

// เงื่อนไขการค้นหา
if (!empty($search_date)) {
    $sql .= " AND DATE(s.created_at) = :search_date";
}
if (!empty($name)) {
    $sql .= " AND CONCAT(u.name_title, ' ', u.name, ' ', u.surname) LIKE :name";
}
if (!empty($identification)) {
    $sql .= " AND u.identification LIKE :identification";
}

$sql .= " GROUP BY s.session_id, sy.symptom_id ORDER BY s.created_at DESC";

// เตรียมคำสั่ง SQL
$stmt = $pdo->prepare($sql);

// ผูกค่าที่ค้นหา
if (!empty($search_date)) {
    $stmt->bindValue(':search_date', $search_date);
}
if (!empty($name)) {
    $stmt->bindValue(':name', "%$name%");
}
if (!empty($identification)) {
    $stmt->bindValue(':identification', "%$identification%");
}

// ดำเนินการ SQL
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ฟังก์ชันกำหนดสีตามระดับความรุนแรง
function getColorBySeverity($severity) {
    if ($severity >= 0 && $severity <= 2) return "green";
    if ($severity >= 3 && $severity <= 5) return "yellow";
    if ($severity >= 6 && $severity <= 8) return "orange";
    if ($severity >= 9 && $severity <= 10) return "red";
    return "gray";
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ค้นหาประวัติการประเมินอาการ</title>
    <link rel="stylesheet" href="History.css">
</head>
<body>
    <div class="container">
        <h1>ค้นหาประวัติการประเมินอาการ</h1>
        <button class="btn-link" onclick="window.location.href='../card-user.php'">สร้างการ์ด</button>
        <button class="btn-link" onclick="window.location.href='Home.html'">ย้อนกลับ</button>

        <!-- ฟอร์มค้นหา -->
        <form method="GET" action="History.php">
            <label for="search_date">วันที่:</label>
            <input type="date" name="search_date" id="search_date" value="<?php echo $search_date; ?>">

            <label for="name">ชื่อ-นามสกุล:</label>
            <input type="text" name="name" id="name" placeholder="ค้นหาชื่อ-นามสกุล" value="<?php echo $name; ?>">

            <label for="identification">เลขบัตรประชาชน:</label>
            <input type="text" name="identification" id="identification" placeholder="ค้นหาเลขบัตรประชาชน" value="<?php echo $identification; ?>">

            <button type="submit">ค้นหา</button>
        </form>

        <!-- ตารางแสดงข้อมูล -->
        <table>
            <thead>
                <tr>
                    <th>ชื่อ-นามสกุล</th>
                    <th>เลขบัตรประชาชน</th>
                    <th>อุณหภูมิ</th>
                    <th>วันที่ประเมิน</th>
                    <th>โรคประจำตัว</th>
                    <th>ความเสี่ยง</th>
                    <th>อาการ</th>
                    <th>ระดับความรุนแรง</th>
                    <th>เฉดสี</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($results)): ?>
                    <?php foreach ($results as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['name_title'] . ' ' . $row['name'] . ' ' . $row['surname']); ?></td>
                            <td><?php echo htmlspecialchars($row['identification']); ?></td>
                            <td><?php echo htmlspecialchars($row['temperature_range']); ?> °C</td>
                            <td><?php echo date('d/m/Y H:i', strtotime($row['assessment_date'])); ?></td>
                            <td><?php echo htmlspecialchars($row['chronic_diseases'] ?: 'ไม่มี'); ?></td>
                            <td><?php echo htmlspecialchars($row['risks'] ?: 'ไม่มี'); ?></td>
                            <td><?php echo htmlspecialchars($row['symptom_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['severity_description'] . ' (' . $row['severity_level'] . ')'); ?></td>
                            <td style="background-color: <?php echo getColorBySeverity($row['severity_level']); ?>; color: white;">
                                <?php echo getColorBySeverity($row['severity_level']); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" style="text-align: center;">ไม่พบข้อมูล</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
