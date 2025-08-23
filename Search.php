<?php
session_start();
require __DIR__."/DB.php";

class SearchTask{
    private $conn;

    public function __construct($conn)
    {
        $this->conn=$conn;
    }
    

    public function SearchTask($searchword){
        if(!empty($searchword)){
            
            $sql_search="SELECT * FROM tasks WHERE title LIKE ? ";
            $stmt=$this->conn->prepare($sql_search);
            $search="%".$searchword."%";
            $stmt->bind_param('s',$search);
            $stmt->execute();
            $result=$stmt->get_result();
            $row=$result->fetch_all(MYSQLI_ASSOC);
    
            return $row;
        }
    }


    public function __destruct()
    {
        $this->conn->close();
    }
}

if($_SERVER['REQUEST_METHOD']=="POST"){
    $searchword=htmlspecialchars(trim($_POST['search']));
    $db=new DataBase('localhost','ahmed','','to_do_list');
    $conn=$db->getconnection();

    $search=new SearchTask($conn);
    $_SESSION['tasks']=$search->SearchTask($searchword);
    if(isset($_SESSION['tasks'])){
        header("Location: ./ShowSearch.php?search=$searchword");
        exit;
    }else{
        header("Location: ./home.php");
        exit;
    }
}
?>