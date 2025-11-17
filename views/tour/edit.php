<?php
// Kết nối database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quanlitour";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy id từ param URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Truy vấn dữ liệu tour theo id
$tour = null;
if ($id > 0) {
    $stmt = $conn->prepare("SELECT id, name, description, price FROM tours WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $tour = $result->fetch_assoc();
    $stmt->close();
}

$conn->close();

// Nếu không tìm thấy tour thì có thể redirect hoặc thông báo lỗi
if (!$tour) {
    echo "Tour không tồn tại!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa tour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2>Sửa Tour</h2>

    <form action="?act=tour-update" method="post" class="mt-3">

        <input type="hidden" name="id" value="<?= htmlspecialchars($tour['id']) ?>">

        <div class="mb-3">
            <label class="form-label">Tên Tour</label>
            <input type="text" name="name" class="form-control" 
                   value="<?= htmlspecialchars($tour['name']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="desc" class="form-control" rows="4" required><?= htmlspecialchars($tour['description']) ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Giá Tour</label>
            <input type="number" name="price" class="form-control" 
                   value="<?= htmlspecialchars($tour['price']) ?>" required>
        </div>

        <button class="btn btn-success">Cập nhật</button>
        <a href="?act=tour-list" class="btn btn-secondary">Quay lại</a>

    </form>
</div>

</body>
</html>
