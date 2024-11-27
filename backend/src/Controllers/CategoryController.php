<?php
class CategoryController
{
    public function createCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $name = $data['name'] ?? null;
            $description = $data['description'] ?? null;

            if ($name && $description) {
                try {
                    $category = new Category($name, $description);
                    $category->saveCategories();
                    http_response_code(201);
                    echo json_encode(['message' => 'Category created successfully']);
                } catch (Exception $e) {
                    http_response_code(400);
                    echo json_encode(['message' => $e->getMessage()]);
                }
            } else {
                http_response_code(400);
                echo json_encode(['message' => 'Missing data']);
            }
        } else {
            http_response_code(401);
            echo json_encode(['message' => 'Unauthorized']);
        }
    }

    public function getCategories()
    {
        try {
            $categories = Category::getNameCategories();
            http_response_code(200);
            echo json_encode($categories);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(['message' => $e->getMessage()]);
        }
    }
}
