<?php
class Post
{
    private $id;
    private $title;
    private $content;
    private $userId;
    private $categoryId;

    public function __construct($title, $content, $userId, $categoryId,)
    {
        $this->title = $title;
        $this->content = $content;
        $this->userId = $userId;
        $this->categoryId = $categoryId;
    }

    public function save()
    {
        $db = Database::getConnection();

        // Verificamos si la categoría existe
        $stmt = $db->prepare("SELECT id FROM categories WHERE id = ?");
        $stmt->execute([$this->categoryId]);
        if ($stmt->rowCount() === 0) {
            throw new Exception("Category not found");
        }

        // Guardamos el post
        $stmt = $db->prepare("INSERT INTO posts (title, content, user_id, category_id) VALUES (?, ?, ?, ?)");
        $stmt->execute([$this->title, $this->content, $this->userId, $this->categoryId]);
    }

    public static function getPosts()
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT posts.id AS idPosts, title, content, users.name AS userName, categories.name AS categoryName FROM posts JOIN users ON posts.user_id = users.id JOIN categories ON posts.category_id = categories.id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getPostsByCategory($categoryId)
    {
        $db = Database::getConnection();

        // Verificamos si la categoría existe
        $stmt = $db->prepare("SELECT id FROM categories WHERE id = ?");
        $stmt->execute([$categoryId]);
        if ($stmt->rowCount() === 0) {
            throw new Exception("Category not found");
        }

        // Listamos los posts
        $stmt = $db->prepare("SELECT posts.id As idPosts, title, content, users.name AS userName, categories.name AS categoryName FROM posts JOIN users ON posts.user_id = users.id JOIN categories ON posts.category_id = categories.id WHERE category_id = ?");
        $stmt->execute([$categoryId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
