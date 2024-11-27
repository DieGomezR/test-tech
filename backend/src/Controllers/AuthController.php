<?php
require_once __DIR__ . '../../Services/AuthService.php';

class AuthController {

    private $authService;

    public function __construct() {
        $this->authService = new AuthService();
    }
        // Registra un usuario
    public function register() {
        $data = json_decode(file_get_contents('php://input'), true);
        $this->authService->register($data);
    }
        // Inicia sesión
    public function login() {
        $data = json_decode(file_get_contents('php://input'), true);
        $this->authService->login($data);
    }
}
