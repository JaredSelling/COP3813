<?php
    require_once 'connection/db_connect.php';

    $q = $_GET['q'];
    $len = strlen($q);


    if($q !== "") {

        $popularBoyNames = "SELECT name FROM boy_names WHERE name LIKE '$q%' ORDER BY votes DESC LIMIT 3";
        $result = $db->query($popularBoyNames);
        
        
        while($row = mysqli_fetch_array($result)) {
            echo $row['name'] . ' ' . ' ' . ' ';
        }
    }
  
    
?>