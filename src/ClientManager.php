<?php
// namespace Ecm\App;
// use Ecm\App\Database;
// use Ecm\App\Product;
require_once "Database.php";
require_once "Client.php";

class ClientManager
{

    public static function displayAll()
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT id,name,email,image,role, is_active
                                from users 
                                join clients on users.id=clients.user_id;");
        $stmt->execute();
        $Clients = $stmt->fetchAll();
        $data = [];
        foreach ($Clients as $client) {
            if($client['role']!="admin"){

                if($client['is_active']){$statu="active";}else{$statu="disactive";};

            $data[] = new Client($client['id'],$client['image'],$client['name'],$client['email'],$client['role'],$statu);
            }
        }
        return $data; 
    }


    public static function changestat($id)
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare(
            "SELECT * from clients WHERE user_id = :id"
        );
        $stmt->execute([
            ':id' => $id
        ]);
        $statu =  $stmt->fetchAll();
        if($statu[0]['is_active']==1){
            $statu=0;
        }else if($statu[0]['is_active']==0){
            $statu=1;
        }
        $stmt = $conn->prepare(
            "UPDATE clients SET is_active = :statu WHERE user_id = :id"
        );
        $stmt->execute([
            ':statu' => $statu,
            ':id' => $id
        ]);
    }
}