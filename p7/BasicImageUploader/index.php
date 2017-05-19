<?php
require_once "php/db_connect.php";
require_once "php/functions.php";
include('../session.php');


if(isset($_POST['title']) && isset($_POST['text']) && isset($_POST['filter']))
{   
    $name = sanitizeString($db, $login_session);
    $title = sanitizeString($db, $_POST['title']);
    $text = sanitizeString($db, $_POST['text']);
    $filter = sanitizeString($db, $_POST['filter']);
    
    $time = $_SERVER['REQUEST_TIME'];
	$file_name = $time . '.jpg';

    if ($_FILES)
    {

        $tmp_name = $_FILES['upload']['name'];
        $dstFolder = 'images';
        move_uploaded_file($_FILES['upload']['tmp_name'], $dstFolder . DIRECTORY_SEPARATOR . $file_name);
        //echo "Uploaded image '$file_name'<br /><img src='$dstFolder/$file_name'/>";
    }

    SavePostToDB($db, $name, $text, $title, $file_name, $filter, $time);
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	
	<title>Image uploader</title>
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="css/bootstrap-theme.min.css">
    
    <link rel="stylesheet" href="css/style.css">
	
	<link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body onload="initialize();">
    
    
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

      <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">Welcome : <i><?php echo $login_session; ?></i></a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                  <li><a href="../logout.php">Logout</a></li>
              </ul>
          </div>
      </div>

  </nav>

    
    
    <div class="container"> 
    
	   
		<div class="row">
            <div class="col-sm-12 text-center">
                <button data-toggle="collapse" data-target="#form" class="btn btn-primary" id="addPhotoBtn">Add a New Photo</button>
            </div>
        </div>
        
        <br><br>
                
        <div class="row">
				<form id="form" class="form-horizontal collapse" method="POST" onsubmit="return validate();" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                    
                    
                    <div class="form-group">
                        <label for="title" class="control-label col-xs-2">Title</label>
                        <div class="col-xs-8">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-header fa-fw"></span></span>
                                <input type="text" class="form-control" id="title" name="title" 
                            maxlength="20" size="20" value="" required placeholder="Summer Vacation" autofocus>
                            </div>
                        </div>
                    </div>
                      
                    <div class="form-group">
                        <label for="text" class="control-label col-xs-2">Text</label>
                        <div class="col-xs-8">
                            <textarea class="form-control" id="text" name="text" maxlength="140" placeholder="140 characters" required></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-xs-2 col-xs-offset-2">
                            <label class="sr-only" for="image">Original Image</label>
                            <img id="image" name="image" src="/" width="100%">
                            <input type="file" id="upload" name="upload" accept="image/*">
                        </div>
                    </div>
                    
                    <!--
                    <div class="form-group">
                        <h3>Filter Photo</h3>
                        <div class="checkbox-inline">
                            <label for="myNostalgia">My Nostalgia</label>
                            <input type="radio" name="filter" id="myNostalgia" value="myNostalgia" onclick="applyMyNostalgiaFilter();">
                        </div>
                        <div class="checkbox-inline">
                            <label for="grayscale">Grayscale</label>
                            <input type="radio" name="filter" id="grayscale" value="grayscale" onclick="applyGrayscaleFilter();">
                        </div>
                        <div class="checkbox-inline">
                            <label for="original">Revert to Original</label>
                            <input type="radio" name="filter" id="lomo" value="lomo" onclick="revertToOriginal();">
                        </div>
                    </div>                
                    -->
                    <div class="form-group">
                        <div class="col-xs-10 col-xs-offset-2">
                            <h3>Select a Filter</h3>
                            <div class="checkbox-inline">
                                <label for="myNostalgia">My Nostalgia</label>
                                <input type="radio" name="filter" id="saturate(40%) grayscale(100%) contrast(45%) sepia(100%)" value="saturate(40%) grayscale(100%) contrast(45%) sepia(100%)" onclick="applyMyNostalgiaFilter();">
                            </div>

                            <div class="checkbox-inline">
                                <label for="grayscale">Grayscale</label>
                                <input type="radio" name="filter" id="grayscale(100%)" value="grayscale(100%)" onclick="applyGrayscaleFilter();">
                            </div>

                            <div class="checkbox-inline">
                              <label for="original">No filter</label>
                              <input type="radio" name="filter" id="lomo" value="lomo" onclick="revertToOriginal();">
                            </div>
                        </div>
                    </div>
                    
                    <p id="error"></p>
                    
                    <div class="col-xs-12 text-center">
                        <input type="submit" value="Upload!" class="btn btn-primary" id="uploadBtn">
                    </div>
                    
                    
				</form>
        </div>
        
        
        <div class="row">
            <h1>The Feed</h1>
            <hr>    
        </div>
        
        <div class="row">
             <?php echo getPostcards($db); ?>
        </div>
		
	</div>

	<!-- JavaScript placed at bottom for faster page loadtimes. -->
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	
	<!-- Latest compiled and minified JavaScript -->
	<script src="js/bootstrap.min.js"></script>
	
	<script src="functions.js"></script>
    
    <script src="js/jquery.js"></script>

</body>
</html>
<?php $db->close(); ?>