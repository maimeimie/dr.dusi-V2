<?php
include('config.php');

// ดึงข้อมูลจากฐานข้อมูล (เหมือนเดิม)
$session_id = isset($_GET['session_id']) ? intval($_GET['session_id']) : 0;

if ($session_id > 0) {
    // ดึงข้อมูลผู้ใช้ และข้อมูลทั่วไป
    $sql_user = "SELECT 
                    u.name_title, u.name, u.surname, u.identification, u.sex, 
                    u.birthday, s.created_at AS assessment_date, 
                    TIMESTAMPDIFF(YEAR, u.birthday, CURDATE()) AS age
                FROM 
                    users_dusi AS u
                INNER JOIN 
                    sessions AS s ON u.user_id = s.user_id
                WHERE 
                    s.session_id = $session_id";
    $result_user = mysqli_query($conn, $sql_user);

    if (!$result_user || mysqli_num_rows($result_user) == 0) {
        die("ไม่พบข้อมูลสำหรับ session_id: " . $session_id);
    }
    
    $user = mysqli_fetch_assoc($result_user);
    
    if (!$user) {
        die("ข้อมูลผู้ใช้ไม่ถูกต้องหรือไม่มีในฐานข้อมูล");
    }    

    // ดึงข้อมูลอุณหภูมิ
    $sql_temperature = "SELECT temperature_range, duration FROM temperatures WHERE session_id = $session_id";
    $result_temperature = mysqli_query($conn, $sql_temperature);
    $temperature = mysqli_fetch_assoc($result_temperature);

    // ดึงข้อมูลโรคประจำตัว
    $sql_diseases = "SELECT disease_name FROM chronic_diseases WHERE session_id = $session_id";
    $result_diseases = mysqli_query($conn, $sql_diseases);
    $diseases = mysqli_fetch_all($result_diseases, MYSQLI_ASSOC);

    // ดึงข้อมูลความเสี่ยง
    $sql_risks = "SELECT risk_name FROM risks WHERE session_id = $session_id";
    $result_risks = mysqli_query($conn, $sql_risks);
    $risks = mysqli_fetch_all($result_risks, MYSQLI_ASSOC);

    // ดึงข้อมูลอาการ
    $sql_symptoms = "SELECT symptom_type, symptom_name, severity_level, severity_description FROM symptoms WHERE session_id = $session_id";
    $result_symptoms = mysqli_query($conn, $sql_symptoms);
    if (!$result_symptoms) {
        die("SQL Error: " . mysqli_error($conn));
    }
    $symptoms = mysqli_fetch_all($result_symptoms, MYSQLI_ASSOC);
    
    if (empty($symptoms)) {
        die("ไม่มีข้อมูลอาการสำหรับ session_id: " . $session_id);
    }

    $assessmentDate = isset($user['created_at']) && !empty($user['created_at']) 
    ? date('d/m/Y', strtotime($user['created_at'])) 
    : 'ไม่ระบุ';

    $assessmentTime = isset($user['created_at']) && !empty($user['created_at']) 
    ? date('H:i:s', strtotime($user['created_at'])) 
    : 'ไม่ระบุ';
    
    echo "<script>console.log('Assessment Date:', '" . $assessmentDate . "');</script>";
    echo "<script>console.log('Assessment Time:', '" . $assessmentTime . "');</script>";
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="ปริ้น.js"></script>
    <title>ฟอร์มการประเมินเบื้องต้น</title>
    <link rel="stylesheet" href="ปริ้น.css">
</head>
<body>
    <div class="form-container">
        <h1>ฟอร์มการประเมินเบื้องต้น</h1>

        <div class="date-time-container">
            <span><strong>วันที่:</strong> <span id="assessment-date"></span></span>
            <span><strong>เวลา:</strong> <span id="assessment-time"></span></span>
        </div>
        
        <!-- ข้อมูลผู้ใช้ -->
        <h2>ข้อมูลผู้ประเมิน</h2>
        <div class="info">
            <p><strong>ชื่อ-นามสกุล:</strong> <span id="user-name"></span></p>
            <p><strong>เลขประจำตัวประชาชน:</strong> <span id="user-id"></span></p>
            <p><strong>วันเกิด:</strong> <span id="user-birthday"></span></p>
            <p><strong>อายุ:</strong> <span id="user-age"></span> ปี</p>
            <p><strong>เพศ:</strong> <span id="user-gender"></span></p>
        </div>

        <!-- ข้อมูลอาการ -->
        <h2>ข้อมูลอาการ</h2>
        <table>
            <thead>
                <tr>
                    <th>อาการ</th>
                    <th>ระดับความรุนแรง</th>
                    <th>เฉดสี</th>
                </tr>
            </thead>
            <tbody id="symptoms-table-body">
                <!-- แถวข้อมูลอาการจะถูกเพิ่มด้วย JavaScript -->
            </tbody>
        </table>

        <!-- ข้อมูลเพิ่มเติม -->
        <h2>ข้อมูลเพิ่มเติม</h2>
        <p><strong>อุณหภูมิ:</strong> <span id="temperature-info"></span></p>
        <p><strong>โรคประจำตัว:</strong> <span id="disease-info"></span></p>
        <p><strong>ความเสี่ยง:</strong> <span id="risk-info"></span></p>

        <button onclick="printForm()">ปริ้นต์ฟอร์ม</button>
    </div>

    <script>
    const user = {
    assessmentDate: "<?php echo $assessmentDate; ?>",
    assessmentTime: "<?php echo $assessmentTime; ?>",
    name: "<?php echo isset($user['name_title']) ? $user['name_title'] . ' ' . $user['name'] . ' ' . $user['surname'] : 'ไม่พบข้อมูล'; ?>",
    age: "<?php echo isset($user['age']) ? $user['age'] : 'ไม่ระบุ'; ?>",
    birthday: "<?php echo isset($user['birthday']) ? date('d/m/Y', strtotime($user['birthday'])) : ''; ?>",
    gender: "<?php echo isset($user['sex']) ? $user['sex'] : ''; ?>",
    identification: "<?php echo isset($user['identification']) ? $user['identification'] : ''; ?>"
};
    const temperature = "<?php echo isset($temperature) ? $temperature['temperature_range'] . ' (' . $temperature['duration'] . ')' : 'ไม่ระบุ'; ?>";
    const diseases = "<?php echo !empty($diseases) ? implode(', ', array_column($diseases, 'disease_name')) : 'ไม่มี'; ?>";
    const risks = "<?php echo !empty($risks) ? implode(', ', array_column($risks, 'risk_name')) : 'ไม่มี'; ?>";
    const symptoms = <?php echo !empty($symptoms) ? json_encode($symptoms, JSON_UNESCAPED_UNICODE) : '[]'; ?>;

    // กำหนดข้อมูลไปยัง HTML
    window.onload = function () {
    console.log("Assessment Date:", user.assessmentDate);
    console.log("Assessment Time:", user.assessmentTime);
    document.getElementById("assessment-date").textContent = user.assessmentDate || "ไม่ระบุ";
    document.getElementById("assessment-time").textContent = user.assessmentTime || "ไม่ระบุ";
    document.getElementById("user-name").textContent = user.name || "ไม่ระบุ";
    document.getElementById("user-age").textContent = user.age || "ไม่ระบุ";
    document.getElementById("user-birthday").textContent = user.birthday || "ไม่ระบุ";
    document.getElementById("user-gender").textContent = user.gender || "ไม่ระบุ";
    document.getElementById("user-id").textContent = user.identification || "ไม่ระบุ";
    document.getElementById("temperature-info").textContent = temperature;
    document.getElementById("disease-info").textContent = diseases;
    document.getElementById("risk-info").textContent = risks;

    const tableBody = document.getElementById("symptoms-table-body");
    symptoms.forEach((symptom) => {
        const row = document.createElement("tr");

        const color = getColorBySeverity(symptom.severity_level);
        const severityText = getSeverityLevelText(symptom.severity_level);

        row.innerHTML = `
            <td>${symptom.symptom_name}</td>
            <td>${severityText} (${symptom.severity_level})</td>
            <td style="background-color: ${color}; color: white;">${color}</td>
        `;
        tableBody.appendChild(row);
    });
};

</script>
</body>
</html>
