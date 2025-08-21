<?php
session_start();
require __DIR__."/../DB.php";

class Validator{
    public $errors=[];

    public function ValidateTitle($title){
        if(empty($title)){
            $this->errors['TitleErr']="Title Task is required!";
        }
    }

    public function haserrors(){
        if(!empty($this->errors)){
            return true;
        }
    }

    public function geterrors(){
        return $this->errors;
    }
}

class UpdateTask extends Validator{
    private $conn;
    public $SuccessMsg;

    public function __construct($conn)
    {
        $this->conn=$conn;
    }

    public function StoreTask($title,$TaskId){
        $sql_store_task="UPDATE tasks SET title=? WHERE id=?";
        $stmt_store_task=$this->conn->prepare($sql_store_task);
        $stmt_store_task->bind_param("si",$title,$TaskId);
        if(!$stmt_store_task->execute()){
            $this->errors['TitleErr']="There is an error ".$stmt_store_task->error;
        }else{
            $this->SuccessMsg="Your task is updated successfully";
        }
        $stmt_store_task->close();
    }

    public function __destruct()
    {
        $this->conn->close();
    }
}

if($_SERVER['REQUEST_METHOD']=="POST"){

    $TaskId=$_POST['TaskId'];
    $title=$_POST['task_title'];

    $db=new DataBase('localhost','ahmed','','to_do_list');
    $conn=$db->getconnection();

    $validator=new Validator;
    $validator->ValidateTitle($title);
    if($validator->haserrors()){
        $_SESSION['TitleErr']=$validator->geterrors();
        header("Location: ./EditTask.php");
        exit;
    }else{
        $StoreTask=new UpdateTask($conn);
        $StoreTask->StoreTask($title,$TaskId);
        if($StoreTask->haserrors()){
            $_SESSION['TitleErr']=$StoreTask->geterrors();
            header("Location: ./EditTask.php");
            exit;            
        }else{
            $_SESSION['SuccessMsg']=$StoreTask->SuccessMsg;
            header("Location: ../home.php");
            exit;            
        }
    }
}

?>