<?php
    require_once 'connection/db_connect.php';

    $q = $_GET['q'];
    $len = strlen($q);


    if($q !== "") {
        
        $popularGirlNames = "SELECT name FROM girl_names WHERE name LIKE '$q%' ORDER BY votes DESC LIMIT 3";
        $result = $db->query($popularGirlNames);
        
        
        while($row = mysqli_fetch_array($result)) {
            echo $row['name'] . ' ' . ' ' . ' ';
        }
        
    }
  
    
?>