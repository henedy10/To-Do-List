<?php
session_start();
require __DIR__."/../DB.php";

class UpdateStatusTask{
    private $conn;
    public function __construct($conn)
    {
        $this->conn=$conn;
    }

    public function UpdateStatus($TaskId,$Status){
        $sql_update_status="UPDATE tasks SET complete=? WHERE id=?";
        $stmt=$this->conn->prepare($sql_update_status);
        $stmt->bind_param("ii",$Status,$TaskId);
        $stmt->execute();
        $stmt->close();
    }

    public function __destruct()
    {
        $this->conn->close();
    }
}

if($_SERVER['REQUEST_METHOD']=="POST"){

    $TaskId=intval($_POST['TaskId']);
    $Status=isset($_POST['status'])?1:0;

    $db=new DataBase('localhost','ahmed','','to_do_list');
    $conn=$db->getconnection();

    $UpdateStatus=new UpdateStatusTask($conn);
    $UpdateStatus->UpdateStatus($TaskId,$Status);

    header("Location: ../home.php");
    exit;
}



?>