<?php
namespace src;
use src\User;
// require_once "User.php";

class Admin extends User
{
    public function __construct($id, $name, $email, $password)
    {
        parent::__construct($id, $name, $email, $password, 'admin');
    }

    public function manageUsers()
    {
        // Logic to manage users
    }

    public function viewStatistics()
    {
        // Logic to view admin statistics
    }

    public function addProduct()
    {
        // Logic to add a product
    }

    public function updateProduct($productId)
    {
        // Logic to update a product
    }

    public function deleteProduct($productId)
    {
        // Logic to delete a product
    }
}
?>