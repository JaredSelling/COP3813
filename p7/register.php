<?php
session_start();
$error='';


if(isset($_POST['submit']) && empty($_POST['login-submit'])) {
    if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['confirm-password'])) {
        $error = "Please fill out all fields";
    }
}
else {
    

    include('db_connect.php');
    
    
    if(isset($_POST['username'])) {
        $username=$_POST['username'];
        $password=$_POST['password'];
        $confirmPassword = $_POST['confirm-password'];
        
        $username=trim($username);
        $username=stripslashes($username);
        $username=$db->real_escape_string($username);

        $password=$db->real_escape_string($password);
        $confirmPassword = $_POST['confirm-password'];

        $db->query("insert into USERS values('$username', '$password')");

     
        
        $_SESSION['login_user'] = $username; //initializing session
        header("location: profile.php"); //redirect to other page
       
        mysqli_close($db);
    } 
    

    
}
?>