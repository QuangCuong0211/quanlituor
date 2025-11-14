<?php
// ----------- GIẢ LẬP DỮ LIỆU TOUR (thay bằng database sau) -----------
$tours = [
    ["id" => 1, "name" => "Tour Đà Nẵng 3N2Đ", "price" => 3500000],
    ["id" => 2, "name" => "Tour Đà Lạt 2N1Đ", "price" => 2500000],
    ["id" => 3, "name" => "Tour Nha Trang 4N3Đ", "price" => 4200000],
];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin - Quản Lý Tour</title>
    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: #f4f4f4;
        }

        /* SIDEBAR */
        .sidebar {
            width: 220px;
            height: 100vh;
            background: #1E293B;
            color: #fff;
            position: fixed;
            left: 0;
            top: 0;
            padding-top: 20px;
        }
        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: #fff;
            text-decoration: none;
        }
        .sidebar a:hover {
            background: #334155;
        }

        /* CONTENT */
        .content {
            margin-left: 220px;
            padding: 20px;
        }

        .card {
            background: #fff;
            padding: 18px;
            border-radius: 8px;
            box-shadow: 0px 2px 5px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #eaeaea;
        }

        .btn {
            padding: 6px 10px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            color: #fff;
        }
        .btn-edit { background: #0ea5e9; }
        .btn-delete { background: #ef4444; }
        .btn-add { background: #10b981; padding: 8px 15px; display: inline-block; margin-bottom: 10px; }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>Admin</h2>
    <a href="#">Dashboard</a>
    <a href="#">Quản lý Tour</a>
    <a href="#">Quản lý Khách hàng</a>
    <a href="#">Quản lý Đặt Tour</a>
    <a href="#">Báo cáo</a>
</div>

<!-- MAIN CONTENT -->
<div class="content">
    <h1>Quản Lý Tour Du Lịch</h1>

    <a href="#" class="btn btn-add">+ Thêm Tour</a>

    <div class="card">
        <table>
            <tr>
                <th>ID</th>
                <th>Tên Tour</th>
                <th>Giá</th>
                <th>Hành động</th>
            </tr>

            <?php foreach ($tours as $tour): ?>
            <tr>
                <td><?= $tour["id"] ?></td>
                <td><?= $tour["name"] ?></td>
                <td><?= number_format($tour["price"]) ?>đ</td>
                <td>
                    <a href="#" class="btn btn-edit">Sửa</a>
                    <a href="#" class="btn btn-delete" onclick="return confirm('Xóa tour này?')">Xóa</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

</body>
</html>
