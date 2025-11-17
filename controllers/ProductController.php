<?php
class ProductController
{
    public $modelProduct;

    public function __construct()
    {
        $this->modelProduct = new ProductModel();
    }

    // =======================
    // 1. TRANG CHỦ
    // =======================
    public function Home()
    {
        $title = "Đây là trang chủ nhé hahaa";
        $thoiTiet = "Hôm nay trời có vẻ là mưa";

        require_once './views/trangchu.php';
    }

    // =======================
    // 2. TRANG ADMIN
    // =======================
    public function Admin()
    {
        require_once './views/admin.php';
    }

    // =======================
    // 3. CRUD TOUR
    // =======================

    // Danh sách tour
    public function tourList()
    {
        $tours = $this->modelProduct->getAllTours();
        require_once './views/tour/list.php';
    }

    // Form thêm tour
    public function tourAdd()
    {
        require_once './views/tour/add.php';
    }

    // Lưu tour mới
    public function tourSave()
    {
        if (!isset($_POST['name']) || !isset($_POST['desc']) || !isset($_POST['price'])) {
            die("Thiếu dữ liệu!");
        }

        $name  = trim($_POST['name']);
        $desc  = trim($_POST['desc']);
        $price = floatval($_POST['price']);

        $this->modelProduct->insertTour($name, $desc, $price);

        header("Location: ?act=tour-list");
        exit;
    }

    // Form sửa tour
    public function tourEdit()
    {
        if (!isset($_GET['id'])) {
            die("Thiếu ID tour!");
        }

        $id = intval($_GET['id']);
        $tour = $this->modelProduct->getTourById($id);

        if (!$tour) {
            die("Tour không tồn tại!");
        }

        require_once './views/tour/edit.php';
    }

    // Cập nhật tour
    public function tourUpdate()
    {
        if (!isset($_POST['id'])) {
            die("Thiếu ID tour!");
        }

        $id    = intval($_POST['id']);
        $name  = $_POST['name'];
        $desc  = $_POST['desc'];
        $price = floatval($_POST['price']);

        $this->modelProduct->updateTour($id, $name, $desc, $price);

        header("Location: ?act=tour-list");
        exit;
    }

    // Xóa tour
    public function tourDelete()
    {
        if (!isset($_GET['id'])) {
            die("Thiếu ID tour!");
        }

        $id = intval($_GET['id']);
        $this->modelProduct->deleteTour($id);

        header("Location: ?act=tour-list");
        exit;
    }
}
