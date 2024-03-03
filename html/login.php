<?php
// login.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $username = $data['username'];
    $password = $data['password'];

    // ตรวจสอบล็อกอิน
    if (performLogin($username, $password)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}

function performLogin($username, $password) {
    // เชื่อมต่อกับฐานข้อมูล (ให้แก้ไขข้อมูลการเชื่อมต่อตามที่คุณใช้)
    $servername = "localhost";
    $dbusername = "thamapat";
    $dbpassword = "123456";
    $dbname = "Pmail";

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // ตรวจสอบการเชื่อมต่อ
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // ทำคำสั่ง SQL เพื่อตรวจสอบข้อมูลล็อกอิน
    $sql = "SELECT * FROM users WHERE username = ?";
    
    // ใช้ parameterized statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // ตรวจสอบผลลัพธ์
    if ($result->num_rows > 0) {
        // Fetch ข้อมูลจากฐานข้อมูล
        $row = $result->fetch_assoc();
        
        // ตรวจสอบรหัสผ่าน
        if (password_verify($password, $row['password'])) {
            // ล็อกอินสำเร็จ
            $stmt->close(); // ปิด statement
            $conn->close(); // ปิดการเชื่อมต่อฐานข้อมูล
            return true;
        }
    }

    // ปิดการเชื่อมต่อฐานข้อมูล
    $stmt->close();
    $conn->close();

    // หลังจากล็อกอินสำเร็จ
    header("Location: index.html");
    exit();

    // ล็อกอินไม่สำเร็จ
    return false;
}
?>
