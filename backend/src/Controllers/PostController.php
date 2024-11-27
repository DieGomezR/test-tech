<?php
class PostController {
    public function createPost() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $title = $data['title'] ?? null;
            $content = $data['content'] ?? null;
            $categoryId = $data['category_id'] ?? null;
            $userId = $data['user_id'] ?? null;

            if ($title && $content && $categoryId) {
                try {
                    $post = new Post($title, $content, $userId, $categoryId);
                    $post->save();
                    http_response_code(201);
                    echo json_encode(['message' => 'Post created successfully']);
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

    public function getAllPosts(){
        try {
            $posts = Post::getPosts();
            http_response_code(200);
            echo json_encode($posts);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(['message' => $e->getMessage()]);
        }
    }

    public function getPostsByCategory($categoryId) {
        try {
            $posts = Post::getPostsByCategory($categoryId);
            http_response_code(200);
            echo json_encode($posts);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(['message' => $e->getMessage()]);
        }
    }
}
