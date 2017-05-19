<?php
    require_once 'connection/db_connect.php';

    $sql = "SELECT * FROM girl_names ORDER BY votes DESC LIMIT 10";
    
    $res = mysqli_query($db, $sql);

    $result = array();

    while($row = mysqli_fetch_array($res)) {
        echo
        "
        <tr>
            <td>{$row['name']}</td>
            <td>{$row['votes']}</td>
        </tr>\n";
    }
?>