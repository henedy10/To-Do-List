<?php
session_start();
require __DIR__."/../DB.php";

class Validator{
    public $errors=[];

    public function ValidateTitleTask($title){
        if(empty($title)){
            $this->errors['TitleErr']="Title task is required!";
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


class StoreTask extends Validator {
    private $conn;
    public $SuccessMsg;

    public function __construct($conn)
    {
        $this->conn=$conn;
    }
    

    public function StoreTask($title){
        $sql_store_task = "INSERT INTO tasks (user_id,title) VALUES (?,?)";
        $stmt_store_task=$this->conn->prepare($sql_store_task);
        $stmt_store_task->bind_param("is",$_SESSION['user_id'],$title);
        if(!$stmt_store_task->execute()){
            $this->errors['TitleErr']="There is an error ".$stmt_store_task->error;
        }
    }

    public function __destruct()
    {
        $this->conn->close();
    }
}

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $CsrfToken=htmlspecialchars(strip_tags(GenerateToken()));
    if(!hash_equals($_POST['CSRF_Token'],$CsrfToken)||!isset($_POST['CSRF_Token'])){
        die("CSRF Token is invalid!");
    }

    $TaskTitle=htmlspecialchars($_POST['tasktitle'])??"";

    $db= new DataBase('localhost','ahmed','','to_do_list');
    $conn=$db->getconnection();

    $validator=new Validator;
    $validator->ValidateTitleTask($TaskTitle);
    
    if($validator->haserrors()){
        $_SESSION['Err']=$validator->geterrors();
        header("Location: ../home.php");
        exit;
    }else{
        $StoreTask= new StoreTask($conn);
        $StoreTask->StoreTask($TaskTitle);
        $_SESSION['Err']=$StoreTask->geterrors();
        header("Location: ../home.php");
        exit;
    }
}

?>