<?php
class BookingController
{
    private $model;

    public function __construct()
    {
        $this->model = new BookingModel();
    }

    public function list()
    {
        $bookings = $this->model->getAll();
        require_once './views/booking/list.php';
    }

    public function add()
    {
        require_once './views/booking/add.php';
    }

    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: ?act=booking-add");
            exit;
        }

        $data = [];
        $data['customer_name'] = trim($_POST['customer_name'] ?? '');
        $data['phone']         = trim($_POST['phone'] ?? '');
        $data['email']         = trim($_POST['email'] ?? '');
        $data['adult']         = (int)($_POST['adult'] ?? 0);
        $data['children']      = (int)($_POST['children'] ?? 0);
        $data['total_price']   = (float)($_POST['total_price'] ?? 0);
        $data['start_date']    = $_POST['start_date'] ?? '';
        $data['end_date']      = $_POST['end_date'] ?? '';
        $data['note']          = $_POST['note'] ?? '';

        $errors = [];

        if ($data['customer_name'] === '') {
            $errors[] = "Vui lòng nhập tên khách hàng";
        }

        if ($data['phone'] === '') {
            $errors[] = "Vui lòng nhập số điện thoại";
        } elseif (!preg_match('/^[0-9\+\-\s]{8,15}$/', $data['phone'])) {
            $errors[] = "Số điện thoại không hợp lệ";
        }

        if ($data['email'] === '' || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Email không hợp lệ";
        }

        if ($data['adult'] < 1) {
            $errors[] = "Số lượng người lớn phải >= 1";
        }

        if ($data['total_price'] < 0) {
            $errors[] = "Tổng tiền không hợp lệ";
        }

        if ($data['start_date'] === '' || $data['end_date'] === '') {
            $errors[] = "Vui lòng chọn ngày bắt đầu và ngày kết thúc";
        } elseif ($data['start_date'] > $data['end_date']) {
            $errors[] = "Ngày bắt đầu phải nhỏ hơn hoặc bằng ngày kết thúc";
        }

        // Nếu có lỗi -> quay lại form add + giữ dữ liệu cũ
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old']    = $data;
            header("Location: ?act=booking-add");
            exit;
        }

        // Không lỗi -> tạo mã booking + insert DB
        $data['booking_code'] = 'BK-' . date("Y") . '-' . rand(10000, 99999);

        $ok = $this->model->insert($data);

        if ($ok) {
            $_SESSION['success'] = "Thêm booking thành công!";
        } else {
            $_SESSION['error'] = "Thêm booking thất bại!";
        }

        header("Location: ?act=booking-list");
        exit;
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['error'] = "Thiếu ID booking!";
            header("Location: ?act=booking-list");
            exit;
        }

        $booking = $this->model->getOne($id);
        if (!$booking) {
            $_SESSION['error'] = "Không tìm thấy booking!";
            header("Location: ?act=booking-list");
            exit;
        }

        require_once './views/booking/edit.php';
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: ?act=booking-list");
            exit;
        }

        $data = [];
        $data['id']            = (int)($_POST['id'] ?? 0);
        $data['customer_name'] = trim($_POST['customer_name'] ?? '');
        $data['phone']         = trim($_POST['phone'] ?? '');
        $data['email']         = trim($_POST['email'] ?? '');
        $data['adult']         = (int)($_POST['adult'] ?? 0);
        $data['children']      = (int)($_POST['children'] ?? 0);
        $data['total_price']   = (float)($_POST['total_price'] ?? 0);
        $data['start_date']    = $_POST['start_date'] ?? '';
        $data['end_date']      = $_POST['end_date'] ?? '';
        $data['note']          = $_POST['note'] ?? '';

        $errors = [];

        if ($data['id'] <= 0) {
            $errors[] = "ID booking không hợp lệ";
        }

        if ($data['customer_name'] === '') {
            $errors[] = "Vui lòng nhập tên khách hàng";
        }

        if ($data['phone'] === '') {
            $errors[] = "Vui lòng nhập số điện thoại";
        } elseif (!preg_match('/^[0-9\+\-\s]{8,15}$/', $data['phone'])) {
            $errors[] = "Số điện thoại không hợp lệ";
        }

        if ($data['email'] === '' || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Email không hợp lệ";
        }

        if ($data['adult'] < 1) {
            $errors[] = "Số lượng người lớn phải >= 1";
        }   
        if ($data['child'] < 0) {
            $errors[] = "Số lượng trẻ em không được âm";
        }

        if ($data['total_price'] < 0) {
            $errors[] = "Tổng tiền không hợp lệ";
        }

        if ($data['start_date'] === '' || $data['end_date'] === '') {
            $errors[] = "Vui lòng chọn ngày bắt đầu và ngày kết thúc";
        } elseif ($data['start_date'] > $data['end_date']) {
            $errors[] = "Ngày bắt đầu phải nhỏ hơn hoặc bằng ngày kết thúc";
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old']    = $data;
            header("Location: ?act=booking-edit&id=" . $data['id']);
            exit;
        }

        $ok = $this->model->update($data);

        if ($ok) {
            $_SESSION['success'] = "Cập nhật booking thành công!";
        } else {
            $_SESSION['error'] = "Cập nhật booking thất bại!";
        }

        header("Location: ?act=booking-list");
        exit;
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            $_SESSION['error'] = "Thiếu ID booking!";
            header("Location: ?act=booking-list");
            exit;
        }

        $ok = $this->model->delete($id);

        if ($ok) {
            $_SESSION['success'] = "Xóa booking thành công!";
        } else {
            $_SESSION['error'] = "Xóa booking thất bại!";
        }

        header("Location: ?act=booking-list");
        exit;
    }
}
