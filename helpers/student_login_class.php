<?php
ob_start();

class StudentLogin{
    private $conn;
    public function __construct()
    {
        #database Host, D-user, D-pass, D-name
        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpass = "";
        $dbname = 'school_management_system_2021';
        $this->conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
        
        if(!$this->conn){
            die("Database Connection Erroe");
        } 
    }

    public function Stdlogin($data){
        $pssword = $data['pass'];
        $user = $data['user'];
     $query = "SELECT * FROM seminar_registration WHERE username = '$user' AND pass = '$pssword'";
     
        if($action = mysqli_query($this->conn, $query)){
           $numRow = mysqli_num_rows($action);
           if($numRow > 0){
               $StdData = mysqli_fetch_assoc($action);
               session_start();
               $_SESSION['StdsessionID'] = $StdData['std_reg_id'];            
               $_SESSION['StdsessionNAME'] = $StdData['username'];
              // echo("<script>location.href = '".ADMIN_URL."/index.php?msg=$msg';</script>");
               //header("Location: dashboard.php");
               echo "<script type='text/javascript'>window.top.location='dashboard.php';</script>"; exit;
            
           } 
        }
    }


    public function stdLogout(){
        unset($_SESSION['StdsessionID']);
        unset($_SESSION['StdsessionNAME']);
        header("location: std_login.php");
    }



}
?>