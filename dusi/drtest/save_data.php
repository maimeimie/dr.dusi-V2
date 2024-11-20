<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "User not logged in"]);
    exit;
}

$host = 'localhost';
$dbname = 'dusi_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode(["success" => false, "message" => "ไม่สามารถเชื่อมต่อฐานข้อมูล: " . $e->getMessage()]));
}

$user_id = $_SESSION['user_id'];

// รับข้อมูล JSON จากคำขอ
$data = json_decode(file_get_contents("php://input"), true);

if ($data) {
    try {
        // เริ่มต้น Transaction
        $pdo->beginTransaction();

        // บันทึกข้อมูล session
        $sql_session = "INSERT INTO `sessions` (`user_id`) VALUES (:user_id)";
        $stmt = $pdo->prepare($sql_session);
        $stmt->execute(['user_id' => $user_id]);
        
        // ดึง `session_id` ที่เพิ่มล่าสุด
        $session_id = $pdo->lastInsertId();        

        // บันทึกข้อมูลอุณหภูมิใน `temperatures`
        $sql_temperature = "INSERT INTO `temperatures` (`session_id`, `temperature_range`, `duration`) 
                            VALUES (:session_id, :temperature_range, :duration)";
        $stmt = $pdo->prepare($sql_temperature);
        $stmt->execute([
            'session_id' => $session_id,
            'temperature_range' => $data['temperature_range'] ?? null,
            'duration' => $data['duration'] ?? null,
        ]);

        // บันทึกข้อมูลโรคประจำตัวใน `chronic_diseases`
        $sql_disease = "INSERT INTO `chronic_diseases` (`session_id`, `disease_name`) VALUES (:session_id, :disease_name)";
        $stmt = $pdo->prepare($sql_disease);
        foreach ($data['chronic_diseases'] as $disease) {
            $stmt->execute(['session_id' => $session_id, 'disease_name' => $disease]);
        }

        // บันทึกข้อมูลปัจจัยเสี่ยงใน `risks`
        $sql_risk = "INSERT INTO `risks` (`session_id`, `risk_name`) VALUES (:session_id, :risk_name)";
        $stmt = $pdo->prepare($sql_risk);
        foreach ($data['risks'] as $risk) {
            $stmt->execute(['session_id' => $session_id, 'risk_name' => $risk]);
        }

        // บันทึกข้อมูลอาการใน `symptoms`
        $sql_symptom = "INSERT INTO `symptoms` (`session_id`, `symptom_type`, `symptom_name`, `severity_level`, `severity_description`) 
                        VALUES (:session_id, :symptom_type, :symptom_name, :severity_level, :severity_description)";
        $stmt = $pdo->prepare($sql_symptom);

        foreach ($data['symptoms'] as $symptom) {
            // ระดับความรุนแรงและคำอธิบาย
            $severity_level = intval($symptom['severity']);
            $severity_description = "";

            // กำหนดคำอธิบายตามระดับความรุนแรง
            if ($severity_level <= 2) {
                $severity_description = "ระดับเล็กน้อย";
            } elseif ($severity_level <= 5) {
                $severity_description = "ระดับปานกลาง";
            } elseif ($severity_level <= 8) {
                $severity_description = "ระดับสูง";
            } else {
                $severity_description = "ระดับรุนแรงมาก";
            }

            // บันทึกข้อมูลในฐานข้อมูล
            $stmt->execute([
                'session_id' => $session_id,
                'symptom_type' => $symptom['type'],
                'symptom_name' => $symptom['name'],
                'severity_level' => $severity_level,
                'severity_description' => $severity_description
            ]);
        }

        // Commit Transaction
        $pdo->commit();
        echo json_encode(["success" => true, "session_id" => $session_id]);
    } catch (Exception $e) {
        $pdo->rollBack();
        echo json_encode(["success" => false, "message" => "เกิดข้อผิดพลาด: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "message" => "ข้อมูลไม่ถูกต้อง"]);
}
?>
