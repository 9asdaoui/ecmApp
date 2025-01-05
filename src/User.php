<?php
// namespace Ecm\App;

// use Ecm\App\Database;
require_once "Database.php";

class User
{
    protected $id;
    protected $name;
    protected $email;
    protected $password;
    protected $role;

    public function __construct($id=null, $name=null, $email=null, $password=null, $role = 'client')
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public function login($email,$password){

        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$email]);
        $myuser = $stmt->fetch();

        if($myuser && password_verify($password,$myuser["password"])){
        session_start();


           $_SESSION["userid"]=$myuser["id"];
           $_SESSION["email"]=$myuser["email"];
           $_SESSION["role"]=$myuser["role"];
        

           if ($myuser["role"]=="admin") {
            
            header("location:../layout/admin");
           }else{
            header("location:../layout/user");
           }
        }else{
            return "password or the email is not correct";
        }
    }

}

?>