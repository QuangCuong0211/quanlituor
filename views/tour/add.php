<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm tour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2>Thêm Tour Mới</h2>

    <form action="?act=booking-save" method="post" class="mt-3">

        <div class="mb-3">
            <label class="form-label">Tên Tour</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="desc" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Giá Tour</label>
            <input type="number" name="price" class="form-control" required>
        </div>

        <button class="btn btn-success">Lưu</button>
        <a href="?act=tour-list" class="btn btn-secondary">Quay lại</a>

    </form>
</div>

</body>
</html>
