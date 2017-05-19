<?php
include('db_connect.php');

if(!isset($_SESSION)) 
{ 
    session_start(); 
    $user_check = $_SESSION['login_user'];
    $ses_sql = $db->query("select username from USERS where username = '$user_check'");
    $row = mysqli_fetch_assoc($ses_sql);
    $login_session = $row['username'];
    if(!isset($login_session)) {
        mysqli_close($db);
        header('Location: index.php');
    }
} 


/*if (isset($login_session))
  {
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];

    echo "Welcome back $username";
  } */

?>