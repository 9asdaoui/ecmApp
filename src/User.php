<?php
namespace src;
// use src\Database;

class User
{
    protected $id;
    protected $name;
    protected $email;
    protected $password;
    protected $role;

    public function __construct($id, $name, $email, $password, $role = 'client')
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public function login()
    {
    }

    public function browseProducts()
    {
    }
}

?>