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
    protected $image;

    public function __construct($id=null,$image=null, $name=null, $email=null, $password=null, $role = 'client')
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->image = $image;
    }

    public function login($email,$password){

        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('SELECT role,email,id,password,is_active
                                FROM users 
                                join clients on users.id=clients.user_id
                                WHERE email=:email');
        $stmt->execute([
           ':email'=> $email
        ]);
         $myuser = $stmt->fetch();
        if($myuser && password_verify($password,$myuser["password"])){
        session_start();


           $_SESSION["userid"]=$myuser["id"];
           $_SESSION["email"]=$myuser["email"];
           $_SESSION["role"]=$myuser["role"];           
           $_SESSION["is_active"]=$myuser["is_active"];

        

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
// $reda = new User;
// $mess  = $reda->login("oussy@gmail.com","1234");
// echo $mess;
// echo $_SESSION["userid"];
// echo $_SESSION["email"];
// echo $_SESSION["role"];           
// echo $_SESSION["is_active"];
?>