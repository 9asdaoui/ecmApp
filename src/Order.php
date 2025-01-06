<?php
// namespace Ecm\App;
// use src\Database;

class Order
{
    private $id;
    private $userId;
    private $username;
    private $statu;
    private $date;
    private $totalprice;

    public function __construct($id=null, $userId=null, $username=null, $statu=null, $date=null,$totalprice=null)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->username = $username;
        $this->statu = $statu;
        $this->date = $date;
        $this->totalprice = $totalprice;
    }
    public function rendreRow()
    {         
        if($this->statu=="pending"){
            $class = "badge-pending";
        }else if ($this->statu=="completed"){
            $class = "badge-success";
        }else{
            $class = "badge-trashed";
        }
    
        return
        '<tr style="font-size: large;">
            <td >'.$this->id.'</td>
            <td>'.$this->username.'</td>
            <td>'.$this->date.'</td>
            <td ><a style="text-decoration: none;
                            border: solid;
                            border-radius: 23px;
                            padding: 5px;" class= "'.$class.'" >'.$this->statu.'</a></td>
            <td>'.$this->totalprice.'</td>
            <td><a style="text-decoration:none;" type="submit" class="" href="ordersdet.php?order_id='.$this->id.'">see order here ⇗</a></td>

        </tr>';
    }


}
?>