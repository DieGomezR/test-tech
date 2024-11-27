<?php
class User {
    private $id;
    private $name;
    private $email;
    private $password;

    public function __construct($name, $email, $password) {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    // Guardar el usuario en la base de datos
    public function save() {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$this->name, $this->email, $this->password]);
    }

    // Autenticar un usuario con email y contraseña
    public static function authenticate($email, $password) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return null;
    }

    // Verificar si el correo electrónico ya está registrado
    public static function emailExists($email) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        // Si se encuentra un registro, el correo ya existe
        return $user !== false;
    }
}
