<?php
session_start();
require_once '../config/Database.php';
require_once '../src/Models/User.php';
require_once '../src/Models/Post.php';
require_once '../src/Models/Category.php';
require_once '../src/Controllers/AuthController.php';
require_once '../src/Controllers/PostController.php';
require_once '../src/Controllers/CategoryController.php';

header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); 
header("Access-Control-Allow-Headers: Content-Type, Authorization"); 

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

// Rutas
if ($requestUri === '/api/register' && $requestMethod === 'POST') {
    $controller = new AuthController();
    $controller->register();
} elseif ($requestUri === '/api/login' && $requestMethod === 'POST') {
    $controller = new AuthController();
    $controller->login();
}
elseif ($requestUri === '/api/posts' && $requestMethod === 'POST') {
    $postController = new PostController();
    $postController->createPost();
} elseif ($requestUri === '/api/posts' && $requestMethod === 'GET') {
    $postController = new PostController();
    $postController->getAllPosts();
} elseif (preg_match('/^\/api\/posts\/(\d+)$/', $requestUri, $matches) && $requestMethod === 'GET') {
    $categoryId = $matches[1]; 
    $postController = new PostController();
    $postController->getPostsByCategory($categoryId);
}
elseif ($requestUri === '/api/categories' && $requestMethod === 'POST') {
    $categoryController = new CategoryController();
    $categoryController->createCategory();
} elseif ($requestUri === '/api/categories' && $requestMethod === 'GET') {
    $categoryController = new CategoryController();
    $categoryController->getCategories();
} else {
    http_response_code(404);
    echo json_encode(['message' => 'Not found']);
}
