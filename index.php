<?php
require_once './commons/env.php';
require_once './commons/function.php';

// Controllers
require_once './controllers/ProductController.php';

// Models
require_once './models/ProductModel.php';

$act = $_GET['act'] ?? '/';

$controller = new ProductController();

// Danh sách route rõ ràng (key = route, value = phương thức)
$routes = [
    '/'           => 'Home',
    'admin'       => 'Admin',

    // Tour CRUD
    'tour-list'   => 'tourList',
    'tour-add'    => 'tourAdd',
    'tour-save'   => 'tourSave',
    'tour-edit'   => 'tourEdit',
    'tour-update' => 'tourUpdate',
    'tour-delete' => 'tourDelete',
];

// Kiểm tra route tồn tại
if (array_key_exists($act, $routes)) {
    $method = $routes[$act];

    // Gọi hàm Controller
    $controller->$method();

} else {
    // 404
    echo "404 - Không tìm thấy route!";
}
