<?php
// Hiển thị lỗi để kiểm tra và sửa lỗi
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Bắt đầu session trên hosting
ini_set('session.cookie_domain', '.vysoul.com');
session_start();

// Gọi các file cần thiết để định tuyến và khởi động ứng dụng
require_once 'mvc/Bridge.php';

// Khởi động ứng dụng
$app = new App();
?>
