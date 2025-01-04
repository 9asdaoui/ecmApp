<?php

use Ecm\App\User;
use Ecm\App\Client;


class AuthController{

    private $fullname;
    private $email;
    private $password;
    private $confirmPassword;
 
    public function register($fullname,$email,$password,$confpassword){
             session_start();
                $this->fullname = $fullname;
                $this->email = $email;
                $this->password = $password;
                $this->confirmPassword = $confpassword;
            
                $client = new Client();
            
                $message = $client->register($this->fullname, $this->email, $this->password, $this->confirmPassword);
            
                if ($message === "Registration successful.") {

                    $this->login($this->email,$this->password);
                } else {
                    $_SESSION["error_message"] = $message;
                    header("location:../layout/sing_in.php");
                }
    }
    public function login($email,$password){
           
                $this->email = $email;
                $this->password = $password;
            
                $client = new User();
            
                $message = $client->login( $this->email, $this->password);

                if ($message === "Login successful.") {

                    $this->login($this->email,$this->password);
                } else {
                    $_SESSION["error_message"] = $message;
                    header("location:../layout/sing_in.php");
                }
    }
}



