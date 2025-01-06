<?php
// namespace Ecm\App;
// use Ecm\App\User;
// use Ecm\App\Database;
require_once "User.php";
require_once "Database.php";


class Client extends User
{
    private $isActive;

    public function __construct($id=null,$image=null, $name=null, $email=null, $password=null, $isActive = true)
    {
        parent::__construct($id,$image, $name, $email, $password, 'client');
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
    

    public function rendreRow()
    {         
        if($this->isActive=="active"){
            $btn="disactivate";
            $style = "statubtndis";
        }else{
            $btn="activate";
            $style = "statubtnact";
        };
        
        
        return
        '<tr style="font-size: large;">
            <td >'.$this->id.'</td>
            <td ><img style="width: 50px;height: 46px;" src=../'.$this->image.'></td>
            <td>'.$this->name.'</td>
            <td>'.$this->email.'</td>
            <td>'.$this->isActive.'</td>
            
            <td><a type=""submit class="'.$style.'" href="?changestatu='.$this->id.'">'.$btn.'</a></td>

        </tr>';
    }
}
?>