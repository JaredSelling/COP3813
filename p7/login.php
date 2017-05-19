<?php
session_start();
$loginerror='';
$registererror = '';
$registrationMsg = '';

if(isset($_POST['submit']) && empty($_POST['register-submit'])) {
    if(empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Username or Password is invalid";
    }
}
else {
    

    include('db_connect.php');
    
    
    if(isset($_POST['username'])) {
        $username=$_POST['username'];
        $password=$_POST['password'];
        
        $username=trim($username);
        $username=stripslashes($username);
        $username=$db->real_escape_string($username);

        $password=$db->real_escape_string($password);

        $query = $db->query("select * from USERS where password='$password' AND username='$username'");

        $rows = mysqli_num_rows($query);
        if($rows == 1) {
            $_SESSION['login_user'] = $username; //initializing session
            header("location: BasicImageUploader/index.php"); //redirect to other page
        } else {
            $loginerror = "Username or Password is invalid";
            
        } 
        mysqli_close($db);
    } 
    
    if(isset($_POST['register-username'])) {
        $username=$_POST['register-username'];
        $password=$_POST['register-password'];
        $confirmPassword = $_POST['register-confirm-password'];
        
        $username=trim($username);
        $username=stripslashes($username);
        $username=$db->real_escape_string($username);

        $password=$db->real_escape_string($password);
        $confirmPassword = $_POST['register-confirm-password'];
        
        $checkDB = $db->query("select * from USERS where username = '$username'");
        
        
        
        $rows = mysqli_num_rows($checkDB);
        if($rows == 1) {
            $registererror = "Username is already taken";
        } else {
            $db->query("insert into USERS values(NULL, '$username', '$password')");
            $registrationMsg = "Account created.  Please log in now.";
            /*$_SESSION['login_user'] = $username; //initializing session
            header("location: index.php"); */ //redirect to other page
       
            
        }
   
            mysqli_close($db);
     
            
        

        

     
        
        
    }
    

    
}
?>