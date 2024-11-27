<?php
class Category
{
    private $id;
    private $name;
    private $description;

    public function __construct($name, $description)
    {
        $this->name = $name;
        $this->description = $description;
    }

    public function saveCategories()
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO categories (name, description) VALUES (?, ?)");
        $stmt->execute([$this->name, $this->description]);
    }

    public static function getNameCategories()
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT id, name FROM categories");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
