<?php
// namespace Ecm\App;
// use Ecm\App\ProductManager;
require_once "User.php";

class Admin extends User
{

    public function __construct($id=null, $name=null, $email=null, $password=null)
    {
        parent::__construct($id, $name, $email, $password, 'admin');
    }


}