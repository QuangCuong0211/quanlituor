<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách Booking</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Danh sách đặt tour</h2>
        <a href="?act=booking-add" class="btn btn-primary">+ Thêm booking</a>
    </div>

    <?php if (!empty($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Mã booking</th>
            <th>Tên KH</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Người lớn</th>
            <th>Trẻ em</th>
            <th>Tổng tiền</th>
            <th>Ngày đi</th>
            <th>Ngày về</th>
            <th>Ghi chú</th>
            <th>Hành động</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($bookings)): ?>
            <?php foreach ($bookings as $item): ?>
                <tr>
                    <td><?= $item['id']; ?></td>
                    <td><?= htmlspecialchars($item['booking_code']); ?></td>
                    <td><?= htmlspecialchars($item['customer_name']); ?></td>
                    <td><?= htmlspecialchars($item['phone']); ?></td>
                    <td><?= htmlspecialchars($item['email']); ?></td>
                    <td><?= $item['adult']; ?></td>
                    <td><?= $item['child']; ?></td>
                    <td><?= number_format($item['total_price']); ?> đ</td>
                    <td><?= $item['start_date']; ?></td>
                    <td><?= $item['end_date']; ?></td>
                    <td><?= nl2br(htmlspecialchars($item['note'])); ?></td>
                    <td>
                        <a href="?act=booking-edit&id=<?= $item['id']; ?>" class="btn btn-sm btn-warning">Sửa</a>
                        <a onclick="return confirm('Xóa booking này?');"
                           href="?act=booking-delete&id=<?= $item['id']; ?>"
                           class="btn btn-sm btn-danger">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="12" class="text-center">Chưa có booking nào</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
