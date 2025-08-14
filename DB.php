<?php
require __DIR__."/csrf.php";
class DataBase{
    private $conn;

    public function __construct($namehost,$nameuser,$userpassword,$namedb)
    {
        $this->conn=new mysqli($namehost,$nameuser,$userpassword,$namedb);

        if($this->conn->connect_error){
            die("There is an error!".$this->conn->error);
        }
    }

    public function getconnection(){
        return $this->conn;
    }
}


$db= new DataBase('localhost','ahmed','','to_do_list');
$conn= $db->getconnection();
?>