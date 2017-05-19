<?php

            require_once 'connection/db_connect.php';
                
                function test_input($data) {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    $data = strtolower($data);
                    $data = ucfirst($data);
                    return $data;
                }
                
             $girl_name = $_POST['girl1'];

             $boy_name = $_POST['boy1'];
            
            echo 'You sent: ' . $girl_name . ' and ' . $boy_name;
            
            $girl_name = test_input($girl_name);
            $boy_name = test_input($boy_name);

            $girl_name = $db->real_escape_string($girl_name);
            $boy_name = $db->real_escape_string($boy_name);


           
           $checkGirlDB = "SELECT votes FROM girl_names WHERE name='$girl_name'";
      
            if(mysqli_num_rows($db->query($checkGirlDB)) == 0) {
                $addGirl = "INSERT INTO girl_names (id, name, votes) VALUES (NULL, '$girl_name', 1)";
                
                $queryGirl = $db->query($addGirl);
               
                echo "added girl entry";
            }
            else {
                $incGirlVotes = "UPDATE girl_names SET votes = votes + 1 WHERE name = '$girl_name'";
                $db->query($incGirlVotes);
                echo "incrementing girl votes";
            }
                
                
                
                
                
                
                
            $checkBoyDB = "SELECT votes FROM boy_names WHERE name='$boy_name'";
      
            if(mysqli_num_rows($db->query($checkBoyDB)) == 0) {
                $addBoy = "INSERT INTO boy_names (id, name, votes) VALUES (NULL, '$boy_name', 1)";
                
                $queryBoy = $db->query($addBoy);
               
                echo "added boy entry";
            }
            else {
                $incBoyVotes = "UPDATE boy_names SET votes = votes + 1 WHERE name = '$boy_name'";
                $db->query($incBoyVotes);
                echo "incrementing boy votes";
            }
        

    $db->close();
?>