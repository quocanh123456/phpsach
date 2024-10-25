<?php
// Cấu hình thông tin kết nối
$server = "localhost";
$username = "root";
$password = "";
$database = "db_hua_quoc_anh";

// Tạo kết nối
$conn = new mysqli($server, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Không cần echo thông báo kết nối thành công
?>
