<?php
namespace Ecm\App;

use Ecm\App\User;
use Ecm\App\Database;


class Client extends User
{
    private $isActive;

    public function __construct($id = null, $name = null, $email = null, $password = null, $isActive = true)
    {
        parent::__construct($id, $name, $email, $password, 'client');
        $this->isActive = $isActive;
    }

    public function register($fullname, $email, $password, $confirmPassword)
    {
        if ($password !== $confirmPassword) {
            return "Passwords do not match.";
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $db = Database::getConnection();

        $stmt = $db->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute(['email' => $email]);

        if ($stmt->rowCount() > 0) {
            return "Email already in use.";
        }

        $stmt = $db->prepare('INSERT INTO users (name, email, password, role, image) VALUES (:name, :email, :password, :role, :image)');
        $stmt->execute([
            'name' => $fullname,
            'email' => $email,
            'password' => $hashedPassword,
            'role' => 'client',
            'image' => 'default.jpg' 
        ]);

        $userId = $db->lastInsertId();

        $stmt = $db->prepare('INSERT INTO clients (user_id, is_active) VALUES (:user_id, :is_active)');
        $stmt->execute([
            'user_id' => $userId,
            'is_active' => $this->isActive
        ]);
        

        return "Registration successful.";
    }

    public function placeOrder()
    {
        // Logic to place an order
    }

    public function deleteOrder($orderId)
    {
        // Logic to delete an order
    }
}
?>