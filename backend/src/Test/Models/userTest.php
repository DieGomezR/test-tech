<?php
// tests/Models/UserTest.php
use PHPUnit\Framework\TestCase;
require_once 'src/Models/User.php';
require_once 'config/Database.php';

class UserTest extends TestCase {

    public function testSaveUser() {
        $password = 'password123';
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $user = new User('TestPHPUnit', 'Testphp@example.com', $hashedPassword);
        $user->save();

        // Verificar que el usuario se guardó en la base de datos
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute(['Testphp@example.com']);
        $savedUser = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertNotEmpty($savedUser);
        $this->assertEquals('TestPHPUnit', $savedUser['name']);
        $this->assertEquals('Testphp@example.com', $savedUser['email']);
    }

    public function testEmailExists() {
        // Paso 2: Intentar hacer login con las credenciales correctas
        $data = [
            'email' => 'Testphp@example.com',
            'password' => 'password123'
        ];

        // Verificar si el correo existe
        $this->assertTrue(User::emailExists($data['email']));
        $this->assertFalse(User::emailExists('nonexistent@example.com'));
    }

    public function testLogin() {
        // Paso 1: Crear y guardar el usuario con el password hasheado
        $password = 'password123';
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $user = new User('Jane Doee', 'jane.doee@example.com', $hashedPassword);
        $user->save();
    
        // Paso 2: Intentar hacer login con las credenciales correctas
        $data = [
            'email' => 'jane.doee@example.com',
            'password' => $password
        ];
    
        // Intentar autenticar al usuario
        $authenticatedUser = User::authenticate($data['email'], $data['password']);
    
        // Verificar que la autenticación fue exitosa
        $this->assertNotNull($authenticatedUser);
        $this->assertEquals('Jane Doee', $authenticatedUser['name']);
        $this->assertEquals('jane.doee@example.com', $authenticatedUser['email']);
    
        // Paso 3: Intentar hacer login con las credenciales incorrectas
        $dataIncorrect = [
            'email' => 'jane.doee@example.com',
            'password' => 'wrongpassword'
        ];
    
        // Intentar autenticar al usuario con contraseña incorrecta
        $authenticatedUserIncorrect = User::authenticate($dataIncorrect['email'], $dataIncorrect['password']);
    
        // Verificar que la autenticación falló
        $this->assertNull($authenticatedUserIncorrect);
    }    
}
