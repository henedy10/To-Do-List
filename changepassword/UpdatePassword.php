<?php
session_start();
require __DIR__."\..\DB.php";

class Validator{
    public $errors=[];

    public function emailvalidate($email){
        if(empty($email)){
            $this->errors['EmailErr']="Your email is required!";
        }else if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $this->errors['EmailErr']="Your email is invalid!";
        }
    }
    

    public function passwordvalidate($password,$confirmpassword){
        if(empty($password)){
            $this->errors['PasswordErr']="Your password is required!";
        }else if(strlen($password)<8){
            $this->errors['PasswordErr']="Your password must be 8 characters at least";
        }else if (empty($confirmpassword)||$password!=$confirmpassword){
            $this->errors['ConfirmPassErr']="Password doesn't match!";
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

class EditPassword extends Validator{

    private $conn;
    public $SuccessMsg;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function CheckExistEmail($email){

            $sql_check_email="SELECT email FROM users WHERE email=?";
            $stmt=$this->conn->prepare($sql_check_email);
            $stmt->bind_param("s",$email);
            $stmt->execute();
            $result=$stmt->get_result();
            if($result->num_rows<=0){
                $this->errors['EmailExistErr']="This email is not exist";
            }
            $stmt->close();

    }

    public function UpdatePassword($email,$password){
        if(empty($this->errors)){
            $sql_update_password="UPDATE users SET `password`=? WHERE email=?";
            $stmt=$this->conn->prepare($sql_update_password);
            $stmt->bind_param("ss",$password,$email);
            if($stmt->execute()){
                $this->SuccessMsg="Your updated is done successfully";
            }else{
                $this->errors['FailMsg']="There is an error".$stmt->error;
            }
            $stmt->close();
        }
    }

}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $email=htmlspecialchars(strip_tags($_POST['email']))??"";
    $password=$_POST['newpassword']??"";
    $confirmpassword=$_POST['confirmpassword']??"";

    $db= new DataBase('localhost','ahmed','','to_do_list');
    $conn=$db->getconnection();

    $validator = new Validator();
    $validator->emailvalidate($email);
    $validator->passwordvalidate($password,$confirmpassword);

    if($validator->haserrors()){
        $_SESSION['EditPasswordErr']=$validator->geterrors();
        header("Location: ./EditPassword.php");
        exit;
    }else{
        $EditPassword= new EditPassword($conn);
        $EditPassword->CheckExistEmail($email);
        if($EditPassword->haserrors()){
            $_SESSION['EditPasswordErr']=$EditPassword->geterrors();
            header("Location: ./EditPassword.php");
            exit;
        }else{
            $hashpass=password_hash($password,PASSWORD_DEFAULT);
            $EditPassword->UpdatePassword($email,$hashpass);

            if($EditPassword->haserrors()){
                $_SESSION['EditPasswordErr']=$EditPassword->geterrors();
                header("Location: ./EditPassword.php");
                exit;                
            }else{
                $_SESSION['SuccessMsg']=$EditPassword->SuccessMsg;
                header("Location: ../index.php");
                exit; 
            }
        }

    }
}
?>