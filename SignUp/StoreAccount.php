<?php 
session_start();
require __DIR__."\..\DB.php";

class Validator{
    public $errors=[];

    public function ValidateUsername($name){
        if(empty($name)){
            $this->errors['NameErr']="Your name is required!";
        }else if(!preg_match("/^[a-zA-Z]{1}+[a-zA-Z0-9\s]*$/",$name)){
            $this->errors['NameErr']="Your name is invalid!";
        }
    }

    public function ValidateEmail($email){
        if(empty($email)){
            $this->errors['EamilErr']="Your Email is required!";
        }else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $this->errors['EmailErr']="Your email is invalid!";
        }
    }

    public function ValidatePassword($password,$confirmpassword){
        if(empty($password)){
            $this->errors['PasswordErr']="Your Password is required!";
        }else if(strlen($password)<8){
            $this->errors['PasswordErr']="Your Password must be 8 characters at least!";
        }else if($password!=$confirmpassword){
            $this->errors['PasswordErr']="Password doesn't match!";
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

class StoreAccount extends Validator{

    private $conn;
    public $SuccessMsg;

    public function __construct($conn)
    {
        $this->conn=$conn;
    }

    public function CheckExistEmail($email){
        $SqlCheckExistEmail="SELECT email FROM users WHERE email=?";
        $stmt=$this->conn->prepare($SqlCheckExistEmail);
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $result=$stmt->get_result();
        if($result->num_rows>0){
            $this->errors['ExistEmailErr']="This email is exist already!";
        }
        $stmt->close();
    }

    public function StoreAccount($name,$email,$password){
        $SqlStoreAccount="INSERT INTO users (username,email,`password`) VALUES (?,?,?)";
        $stmtstore=$this->conn->prepare($SqlStoreAccount);
        $stmtstore->bind_param("sss",$name,$email,$password);
        if($stmtstore->execute()){
            $this->SuccessMsg="Your account is created successfully";
        }else{
            $this->errors['FailMsg']="There is an error ".$stmtstore->error;
        }
        $stmtstore->close();
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
    
    $name=htmlspecialchars($_POST['name'])??"";
    $email=htmlspecialchars($_POST['email'])??"";
    $password=$_POST['password']??"";
    $confirmpassword=$_POST['confirmpassword']??"";

    $db=new DataBase('localhost','ahmed','','to_do_list');
    $conn=$db->getconnection();
    
    $validator=new Validator;
    $validator->ValidateUsername($name);
    $validator->ValidateEmail($email);
    $validator->ValidatePassword($password,$confirmpassword);

    if($validator->haserrors()){
        $_SESSION['CreateAccountErr']=$validator->geterrors();
        header("Location: ./CreateAccount.php");
        exit;
    }else{
        $CreateAccount= new StoreAccount($conn);
        $CreateAccount->CheckExistEmail($email);

        if($CreateAccount->haserrors()){
            $_SESSION['CreateAccountErr']=$CreateAccount->geterrors();
            header("Location: ./CreateAccount.php");
            exit;            
        }else{
            $hashpass=password_hash($password,PASSWORD_DEFAULT);
            $CreateAccount->StoreAccount($name,$email,$hashpass);

            if($CreateAccount->haserrors()){
                $_SESSION['CreateAccountErr']=$CreateAccount->geterrors();
                header("Location: ./CreateAccount.php");
                exit;    
            }else{
                $_SESSION['SuccessMsg']=$CreateAccount->SuccessMsg;
                header("Location: ../index.php");
                exit;    
            }
        }
    }
}
?>