<?php
// Cấu hình kết nối database
$servername = "localhost";  // hoặc IP, thường localhost
$username = "root";         // username mysql
$password = "";             // password mysql, để trống nếu không có
$dbname = "quanlitour";    // tên database

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Truy vấn lấy dữ liệu
$sql = "SELECT id, name, description, price FROM tours";
$result = $conn->query($sql);

// Tạo mảng chứa dữ liệu tours
$tours = [];

if ($result->num_rows > 0) {
    // Lấy từng dòng dữ liệu và push vào mảng
    while($row = $result->fetch_assoc()) {
        $tours[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <title>Danh Sách Tours</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <a href="?act=admin" class="btn btn-secondary">← Dashboard</a>
        <a href="?act=tour-add" class="btn btn-primary">+ Thêm Tour</a>
    </div>

    <h2>Danh Sách Tours</h2>
    <table class="table table-bordered table-hover mt-2">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Tên Tour</th>
                <th>Mô tả</th>
                <th>Giá</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($tours as $tour): ?>
            <tr>
                <td><?= $tour['id'] ?></td>
                <td><?= htmlspecialchars($tour['name']) ?></td>
                <td><?= htmlspecialchars($tour['description']) ?></td>
                <td><?= number_format($tour['price']) ?> VND</td>
                <td>
                    <a href="?act=tour-edit&id=<?= $tour['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                    <a href="?act=tour-delete&id=<?= $tour['id'] ?>" 
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
