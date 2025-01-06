<?php
require_once __DIR__ . '/../src/ClientManager.php';
require_once __DIR__ . '/../src/Client.php';



class ClientsController{


    
    public function displayAll()
    {
        $Clients = ClientManager::displayAll();
        
        $tableRows = "";

        foreach ($Clients as $Client) {
            $tableRows .= $Client->rendreRow();
        }
        return $tableRows ;
    }

 

    // public function updateClient($ClientId,$name,$description,$price,$quantity,$category,$image)
    // {
    //     $Clientobj = new Client($ClientId,$name,$description,$price,$quantity,$category,$image);
    //     ClientManager::update($Clientobj);
    //     session_start();
    //     $meesage = "Client updated successfully.";
    //     $_SESSION["succesMessage"] = $meesage;
    //     header("location:../layout/admin/Client.php");
    // }

    // public function viewClient($ClientId)
    // {
    //     return $Client = ClientManager::getClient($ClientId);
    // }
}

