<?php
require_once __DIR__ . '../../Models/User.php';

class AuthService
{

    private $tokenExpiryTime = 3600; // Tiempo de expiración del token en segundos
    // Constructor para registro y autenticación
    public function register($data)
    {
        // Validar y registrar el usuario
        if (empty($data['name']) || empty($data['email']) || empty($data['password'])) {
            die("Todos los campos son requeridos.");
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            die("El correo electrónico no es válido.");
        }

        if (User::emailExists($data['email'])) {
            die("El correo electrónico ya está registrado.");
        }

        if (strlen($data['password']) < 8 || !preg_match('/[A-Za-z]/', $data['password']) || !preg_match('/[0-9]/', $data['password'])) {
            die("La contraseña debe ser válida.");
        }

        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        $user = new User($data['name'], $data['email'], $hashedPassword);
        $user->save();

        echo json_encode(['message' => 'Usuario registrado exitosamente.']);
    }

    public function login($data)
    {
        // Validar y autenticar al usuario
        $user = User::authenticate($data['email'], $data['password']);
        if ($user) {
            // Generar token y respuesta
            $token = bin2hex(random_bytes(32));
            $_SESSION['token'] = $token;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['expiry'] = time() + $this->tokenExpiryTime;

            // Extraer solo el id y el username para la respuesta
            $response = [
                'message' => 'Inicio de sesión exitoso',
                'user' => [
                    'id' => $user['id'],
                    'name' => $user['name']
                ],
                'token' => $token
            ];

            // Devolver el JSON al cliente
            header('Content-Type: application/json');
            echo json_encode($response);
            return;
        } else {
            http_response_code(401);
            echo json_encode(['message' => 'Correo o contraseña incorrectos']);
        }
    }
}
