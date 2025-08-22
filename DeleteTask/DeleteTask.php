<?php
session_start();
require __DIR__."/../DB.php";

class DeleteTask{
    private $conn;
    public $errors=[];
    public $SuccessMsg;

    public function __construct($conn)
    {
        $this->conn=$conn;
    }

    public function DeleteTask($TaskId){
        $sql_delete_task="DELETE FROM tasks WHERE id=?";
        $stmt_delete_task=$this->conn->prepare($sql_delete_task);
        $stmt_delete_task->bind_param('i',$TaskId);
        if(!$stmt_delete_task->execute()){
            $this->errors['DeleteErr']="There is an error ".$stmt_delete_task->error;
        }else{
            $this->SuccessMsg="Your task is deleted successfully";
        }
        $stmt_delete_task->close();
    }

    public function haserrors(){
        if(!empty($this->errors)){
            return true;
        }
    }

    public function geterrors(){
        return $this->errors;
    }

    public function __destruct()
    {
        $this->conn->close();
    }

}

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $TaskId=$_POST['TaskId'];

    $db= new DataBase('localhost','ahmed','','to_do_list');
    $conn= $db->getconnection();

    $DeleteTask= new DeleteTask($conn);
    $DeleteTask->DeleteTask($TaskId);
    if($DeleteTask->haserrors()){
        $_SESSION['Err']=$DeleteTask->geterrors();
    }else{
        $_SESSION['SuccessMsg']=$DeleteTask->SuccessMsg;
    }

    header("Location: ../home.php");
    exit;
}
?>