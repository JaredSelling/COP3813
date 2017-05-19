<?php
function currencyConverter($currency_from,$currency_to,$currency_input){
        $amount = urlencode($currency_input);
        $from_Currency = urlencode($currency_from);
        $to_Currency = urlencode($currency_to);
        $get = file_get_contents("https://www.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency");
        $get = explode("<span class=bld>",$get);
        $get = explode("</span>",$get[1]);  
        $currency_output = preg_replace("/[^0-9\.]/", null, $get[0]);
        return $currency_output;
}

$display_result = false;
$currency_from = "USD";
$currency_to = "INR";
$currency_input = 100;

if (isset($_POST['currency_from']))
	$currency_from = $_POST['currency_from'];

if (isset($_POST['currency_to']))
	$currency_to = $_POST['currency_to'];

if (isset($_POST['currency_input']))
	$currency_input = $_POST['currency_input'];
 
$currency = currencyConverter($currency_from,$currency_to,$currency_input);

if(ctype_digit($currency_input)) {
    $display_result = true;
} 

?>
<html>
	<head>
		<title>Currency conversion</title>
        

        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <link rel="stylesheet" type="text/css" href="additionalStyle.css">
	</head>
    
	<body>
        <div id="main">
            <h2>Currency Conversion</h2>
            <form method="post" action="index.php">


                <div class="form-group">
                    <label>Enter amount:</label>
                    <input type="text" name="currency_input" class="form-control" />
                </div>


                <div class="form-group">
                    <label>Select currency (from):</label>
                    <select class="form-control" name="currency_from">
                        <option value="USD">US Dollar</option>
                        <option value="EUR">Euro</option>
                        <option value="INR">Indian Rupee</option>
                    </select>
                </div>


                <div class = "form-group">
                    <label>Select currency (to):</label>
                    <select class="form-control" name="currency_to">
                        <option value="USD">US Dollar</option>
                        <option value="EUR">Euro</option>
                        <option value="INR">Indian Rupee</option>
                    </select>
                </div>

                <div class="form-group"> 
                    <button type="submit" class="btn btn-default">Convert!</button>
                </div>
            </form>
            <p>
              <?php
                   if($display_result) {
                        echo $currency_input.' '.$currency_from.' = '.$currency.' '.$currency_to;
                    } 
                    else {
                        echo 'Please enter a numeric value';
                    }
                ?>
            </p>
        </div>
	</body>
</html>



