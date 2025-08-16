<?php 
session_start();
require __DIR__."/DB.php";

class Validator{
    public $errors = [];

    public function emailvalidate($email){
        if(empty($email)){
            $this->errors['EmailErr']="Your email is required!";
        }else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $this->errors['EmailErr']="Your email is invalid!";
        }
    }

    public function passwordvalidate($password){
        if(empty($password)){
            $this->errors['PasswordErr']="Your password is required!";
        }
    }

    public function geterrors(){
        return $this->errors;
    }
}

class UserAuthentication extends Validator{

    public $info;
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function check_account($email,$password){
        $sql_check_account="SELECT id,email,`password` FROM users WHERE email=?";
        $stmt=$this->conn->prepare($sql_check_account);
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $result=$stmt->get_result();
        if($result->num_rows<=0){
            $this->errors['ExistErr']="This account is not exist!!";
        }else{
            $row = $result->fetch_assoc();
            if(!password_verify($password,$row['password'])){
                $this->errors['passwordErr']="Password doesn't match!";                
            }
            $stmt->close;
        }
    }

    public function __destruct()
    {
        $this->conn->close;
    }

}

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $CsrfToken=htmlspecialchars(strip_tags(GenerateToken()));
    if(!hash_equals($_POST['CSRF_Token'],$CsrfToken)||!isset($_POST['CSRF_Token'])){
        die("CSRF Token is invalid!");
    }

    $email=htmlspecialchars(strip_tags($_POST['email']))??"";
    $password=$_POST['password']??"";

    $validator= new Validator;
    $validator->emailvalidate($email);
    $validator->passwordvalidate($password);

    if(!empty($validator->geterrors())){
        $_SESSION['LoginErr']=$validator->geterrors();
        header("Location: ./index.php");
        exit;
    }

    $db= new DataBase('localhost','ahmed','','to_do_list');
    $auth= new UserAuthentication($db->getconnection());
    $auth->check_account($email,$password);

    if(!empty($auth->geterrors())){
        $_SESSION['LoginErr']=$auth->geterrors();
        header("Location: ./index.php");
        exit;
    }else{
        header("Location: ./home.php");
        exit;
    }
}

?>