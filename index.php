<?php
session_start(); // NHỚ CÓ để dùng $_SESSION flash message

require_once './commons/env.php';
require_once './commons/database.php';   // << tạo $conn
require_once './commons/function.php';

// Models
require_once './models/ProductModel.php';
require_once './models/BookingModel.php';

// Controllers
require_once './controllers/ProductController.php';
require_once './controllers/BookingController.php';

$act = $_GET['act'] ?? '/';

$productController = new ProductController();
$bookingController = new BookingController();

$routes = [
    '/'            => ['controller' => $productController, 'method' => 'Home'],
    'admin'        => ['controller' => $productController, 'method' => 'Admin'],

    'tour-list'    => ['controller' => $productController, 'method' => 'tourList'],
    'tour-add'     => ['controller' => $productController, 'method' => 'tourAdd'],
    'tour-save'    => ['controller' => $productController, 'method' => 'tourSave'],
    'tour-edit'    => ['controller' => $productController, 'method' => 'tourEdit'],
    'tour-update'  => ['controller' => $productController, 'method' => 'tourUpdate'],
    'tour-delete'  => ['controller' => $productController, 'method' => 'tourDelete'],

    'booking-list'   => ['controller' => $bookingController, 'method' => 'list'],
    'booking-add'    => ['controller' => $bookingController, 'method' => 'add'],
    'booking-save'   => ['controller' => $bookingController, 'method' => 'save'],
    'booking-edit'   => ['controller' => $bookingController, 'method' => 'edit'],
    'booking-update' => ['controller' => $bookingController, 'method' => 'update'],
    'booking-delete' => ['controller' => $bookingController, 'method' => 'delete'],
];

if (array_key_exists($act, $routes)) {
    $route = $routes[$act];
    $controller = $route['controller'];
    $method = $route['method'];

    if (method_exists($controller, $method)) {
        $controller->$method();
    } else {
        echo "404 - Method không tồn tại!";
    }
} else {
    echo "404 - Không tìm thấy route!";
}
