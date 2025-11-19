<!-- views/booking/add.php -->
<?php
$errors = $_SESSION['errors'] ?? [];
$old    = $_SESSION['old'] ?? [];
unset($_SESSION['errors'], $_SESSION['old']);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Booking</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
<div class="container">
    <h2 class="mb-3">Thêm booking mới</h2>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $err): ?>
                    <li><?= $err; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="?act=booking-save" method="post">
        <div class="mb-3">
            <label class="form-label">Tên khách hàng</label>
            <input type="text" name="customer_name" class="form-control"
                   value="<?= $old['customer_name'] ?? ''; ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Số điện thoại</label>
            <input type="text" name="phone" class="form-control"
                   value="<?= $old['phone'] ?? ''; ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control"
                   value="<?= $old['email'] ?? ''; ?>">
        </div>

        <div class="row">
            <div class="mb-3 col-md-4">
                <label class="form-label">Người lớn</label>
                <input type="number" name="adult" class="form-control"
                       value="<?= $old['adult'] ?? 1; ?>" min="1">
            </div>
            <div class="mb-3 col-md-4">
                <label class="form-label">Trẻ em</label>
                <input type="number" name="child" class="form-control"
                       value="<?= $old['child'] ?? 0; ?>" min="0">
            </div>
            <div class="mb-3 col-md-4">
                <label class="form-label">Tổng tiền (VNĐ)</label>
                <input type="number" name="total_price" class="form-control"
                       value="<?= $old['total_price'] ?? 0; ?>" min="0" step="1000">
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-md-6">
                <label class="form-label">Ngày bắt đầu</label>
                <input type="date" name="start_date" class="form-control"
                       value="<?= $old['start_date'] ?? ''; ?>">
            </div>
            <div class="mb-3 col-md-6">
                <label class="form-label">Ngày kết thúc</label>
                <input type="date" name="end_date" class="form-control"
                       value="<?= $old['end_date'] ?? ''; ?>">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Ghi chú</label>
            <textarea name="note" class="form-control" rows="3"><?= $old['note'] ?? ''; ?></textarea>
        </div>

        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="?act=booking-list" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
</body>
</html>
