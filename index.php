<?php
session_start(); // NHỚ CÓ để dùng $_SESSION flash message

require_once './commons/env.php';
require_once './commons/database.php';   // << tạo $conn
require_once './commons/function.php';

// Models
require_once './models/TourModel.php';
require_once './models/BookingModel.php';
require_once './models/CategoryModel.php';

// Controllers
require_once './controllers/TourController.php';
require_once './controllers/BookingController.php';
require_once './controllers/CategoryController.php';

$act = $_GET['act'] ?? '/';

$tourController = new TourController();
$bookingController = new BookingController();
$categoryController = new CategoryController();

$routes = [
    '/'            => ['controller' => $tourController, 'method' => 'Home'],
    'admin'        => ['controller' => $tourController, 'method' => 'Admin'],

    'tour-list'    => ['controller' => $tourController, 'method' => 'tourList'],
    'tour-add'     => ['controller' => $tourController, 'method' => 'tourAdd'],
    'tour-save'    => ['controller' => $tourController, 'method' => 'tourSave'],
    'tour-edit'    => ['controller' => $tourController, 'method' => 'tourEdit'],
    'tour-update'  => ['controller' => $tourController, 'method' => 'tourUpdate'],
    'tour-delete'  => ['controller' => $tourController, 'method' => 'tourDelete'],

    'booking-list'   => ['controller' => $bookingController, 'method' => 'index'],
    'booking-add'    => ['controller' => $bookingController, 'method' => 'create'],
    'booking-save'   => ['controller' => $bookingController, 'method' => 'store'],
    'booking-edit'   => ['controller' => $bookingController, 'method' => 'edit'],
    'booking-update' => ['controller' => $bookingController, 'method' => 'update'],
    'booking-delete' => ['controller' => $bookingController, 'method' => 'delete'],

    'category-list'   => ['controller' => $categoryController, 'method' => 'categoryList'],
    'category-add'    => ['controller' => $categoryController, 'method' => 'categoryAdd'],
    'category-save'   => ['controller' => $categoryController, 'method' => 'categorySave'],
    'category-edit'   => ['controller' => $categoryController, 'method' => 'categoryEdit'],
    'category-update' => ['controller' => $categoryController, 'method' => 'categoryUpdate'],
    'category-delete' => ['controller' => $categoryController, 'method' => 'categoryDelete'],

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
