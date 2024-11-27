<?php
// src/Database/Database.php
class Database {
    private static $connection;

    private function __construct() {}

    public static function getConnection() {
        if (self::$connection === null) {
            $host = 'localhost';      // Dirección del host (por defecto es localhost)
            $dbname = '';    // Nombre de la base de datos
            $user = '';        // Usuario de la base de datos
            $pass = '';     // Contraseña del usuario

            try {
                // Cambiar el DSN para PostgreSQL
                self::$connection = new PDO("pgsql:host=$host;dbname=$dbname", $user, $pass);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Connection failed: ' . $e->getMessage());
            }
        }
        return self::$connection;
    }
}
