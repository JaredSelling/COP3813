<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Baby Names</title>
  
  <!-- Bootstrap -->
  <link rel="stylesheet" type="text/css" href="bootstrap/assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="bootstrap/assets/css/jasny-bootstrap.min.css">
  <!-- Main Style -->
  <link rel="stylesheet" type="text/css" href="bootstrap/assets/css/main.css">
  
  <!-- Responsive Style -->
  <link rel="stylesheet" type="text/css" href="bootstrap/assets/css/responsive.css">
  
  <!--Fonts-->
  <link rel="stylesheet" media="screen" href="bootstrap/assets/fonts/font-awesome/font-awesome.min.css">

  <!-- Extras -->
  <link rel="stylesheet" type="text/css" href="bootstrap/assets/extras/animate.css">
  <link rel="stylesheet" type="text/css" href="bootstrap/assets/extras/lightbox.css">
  <link rel="stylesheet" type="text/css" href="bootstrap/assets/extras/owl/owl.carousel.css">
  <link rel="stylesheet" type="text/css" href="bootstrap/assets/extras/owl/owl.theme.css">
  <link rel="stylesheet" type="text/css" href="bootstrap/assets/extras/owl/owl.transitions.css">
  <link rel="stylesheet" type="text/css" href="css/additionalStyle.css"
>  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
              <![endif]-->
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    
<script> 

//VALIDATES FORM FIELDS
function validate() {
if(document.getElementById('girl_name').value == "" || document.getElementById('boy_name').value == "") {
    document.getElementById('error').innerHTML = "Please fill out all fields";
    return false;
}

if(/[^a-zA-Z]+$/.test(document.getElementById('girl_name').value) || /[^a-zA-Z]+$/.test(document.getElementById('boy_name').value)) {
    document.getElementById('error').innerHTML = "* Only letters allowed";
    return false;
    
}

return true;
}
    
    
  //-----------AJAX AUTOSUGGEST--------------  
 function showGirlHint(str) {
    if(str.length == 0) {
        document.getElementById("girlHint").innerHTML = "";
        return;
    } else {
        if(window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.onreadystatechange = function() {
            if(this.readyState == 4 && this.status == 200) {
                document.getElementById("girlHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "helperFiles/getGirlHints.php?q="+str, true);
        xmlhttp.send();
    }

}


function showBoyHint(str) {
    if(str.length == 0) {
        document.getElementById("boyHint").innerHTML = "";
        return;
    } else {
        if(window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.onreadystatechange = function() {
            if(this.readyState == 4 && this.status == 200) {
                document.getElementById("boyHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "helperFiles/getBoyHints.php?q="+str, true);
        xmlhttp.send();
    }

}
    
    
//---------------AJAX READ FROM DATABASE AND DISPLAY--------------  


 //AJAX SENDS FORM DATA TO SERVER FOR PROCESSING    
$(document).ready(function() {
    
   $('form').on('submit', function(e) {
      e.preventDefault(); 
      var girl = $('#girl_name').val();
      var boy = $('#boy_name').val();
       
       if(validate()) {
              document.getElementById('error').innerHTML = "Your vote has been submitted";
               $.post('helperFiles/updateDB.php', {
               girl1: girl,
               boy1: boy
           }, function(data) {
               //--------AJAX RESET FORM AND DISPLAY DATA FROM DATABASE
               $('form')[0].reset();
               $('#girlNames').load('helperFiles/getGirlNames.php');
               $('#boyNames').load('helperFiles/getBoyNames.php');
           });
       }
       
   }); 
    //-----------AJAX DISPLAY DATA FROM DATABASE----------------
    $('#viewResults').on('click', function(e) {
       e.preventDefault();
       $('#girlNames').load('helperFiles/getGirlNames.php');
       $('#boyNames').load('helperFiles/getBoyNames.php');
        
    }); 
    
}); 



</script>
    

</head>
<body>

  <!-- Header Section Start -->
  <div id="header">
    <div class="container">
      <div class="col-md-12 top-header">
        
        </div>
        
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="banner text-center">
            <h1 class="wow fadeInDown animated" data-wow-delay=".3s">Baby Names</h1>
            <h2 class="wow fadeInDown animated" data-wow-delay=".3s">Vote For Your Favorite Names or View Popular Ones</h2>
            <a href="#feedback" class="btn btn-border lg wow fadeInLeft animated" data-wow-delay=".3s">Vote</a>
            <a href="#works" class="btn btn-common lg wow fadeInRight animated" data-wow-delay=".3s" id="viewResults">View results</a>
            <div class="scroll">
              <a href="#works"><i class="fa fa-angle-down wow fadeInUp animated" data-wow-delay=".3"></i></a>
          </div>
        </div>
        </div>
      </div>
    </div>

  <!-- Header Section End -->
    
    
<!-- Feedback Section Start -->
  <section id="feedback">
    <div class="container">
      <div class="row">
        <h1 class="section-title wow fadeInLeft animated" data-wow-delay=".3s"><span>Vote</span><br>For Your Favorite <br> Baby Names</h1>
        <div class="col-sm-12  wow fadeInLeft animated" data-wow-delay=".3s" id="form-content">
          <form method="post" onsubmit="return validate();" name="contact" id="babyNamesForm">
            <div class="input-group">
              <span class="input-group-addon" id="girlIcon"><i class="fa fa-female"></i></span>
              <input type="text" onkeyup="showGirlHint(this.value)" name="girl_name" class="form-control" id="girl_name" placeholder="Enter a girl name"/>
            </div>
              <p class="suggestions">Suggestions: <span id="girlHint"></span></p>
            <div class="input-group">
              <span class="input-group-addon" id="boyIcon"><i class="fa fa-male"></i></span>
              <input type="text" onkeyup="showBoyHint(this.value)" name="boy_name" class="form-control" id="boy_name" placeholder="Enter a boy name"/>
            </div>
              <p class="suggestions">Suggestions: <span id="boyHint"></span></p>

            <button type="submit" class="btn btn-green"><i class="fa fa-envelope-o"  id="submit"></i>Submit</button>
              
              <span class="error"> <p id="error"></p> </span>
              
              

            
          </form>
        </div>
        <div class="col-sm-4 col-md-4 col-md-offset-2 wow fadeInRight animated" data-wow-delay=".3s">

        </div>
      </div>
    </div>
  </section>

  <!-- Work Section Start -->
  <section id="works">
    <div class="container">
      <div class="row">

        <div class="col-md-6  wow fadeInLeft animated" data-wow-delay=".3s">
            
            <h2 class="section-title wow fadeInLeft animated" data-wow-delay=".3s">Popular <span>Girl</span> Names</h2>

            <table id="popularGirlNamesTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Votes</th>
                                </tr>
                            </thead>
                            
                            <tbody id="girlNames">

                            </tbody>
                </table>
            
        </div>
          
          <div class="col-md-6  wow fadeInLeft animated" data-wow-delay=".3s">
            
            <h2 class="section-title wow fadeInLeft animated" data-wow-delay=".3s">Popular <span>Boy</span> Names</h2>
              
            <table id="popularBoyNamesTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Votes</th>
                    </tr>
                </thead>

                <tbody id="boyNames">

                </tbody>
            </table>
            
        </div>
 
      </div>
    </div>
  </section>





  <!-- Feedback Section End -->

  <!-- Footer section Start -->
  <footer id="footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
          <div class="copyright wow fadeInUp animated" data-wow-delay=".3s">
            <p>Copyright &copy; 2016 Jared Selling | All rights reserved.</p>
          </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
          <div class="scroll-top text-center wow fadeInUp animated" data-wow-delay=".3s">
            <a href="#header"><i class="fa fa-chevron-circle-up fa-2x"></i></a>
          </div>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
          <p class="text-center wow fadeInUp animated" data-wow-delay=".3s">Theme By <a href="http://graygrids.com">GrayGrids</a></p>
        </div>
      </div>
    </div>
  </footer>
  <!-- Footer section End -->

  <!-- jQuery Load -->
  
  <script src="bootstrap/assets/js/jquery-min.js"></script>
  <!-- Bootstrap JS -->
  <script src="bootstrap/assets/js/bootstrap.min.js"></script>
  <!-- WOW JS plugin for animation -->
  <script src="bootstrap/assets/js/wow.js"></script>
  <!-- All JS plugin Triggers -->
  <script src="bootstrap/assets/js/main.js"></script>
  <!-- Smooth scroll -->
  <script src="bootstrap/assets/js/smooth-scroll.js"></script>
  <!--  -->
  <script src="bootstrap/assets/js/jasny-bootstrap.min.js"></script>
  <!-- Counterup -->
  <script src="bootstrap/assets/js/jquery.counterup.min.js"></script>
  <!-- waypoints -->
  <script src="bootstrap/assets/js/waypoints.min.js"></script>
  <!-- circle progress -->
  <script src="bootstrap/assets/js/circle-progress.js"></script>
  <!-- owl carousel -->
  <script src="bootstrap/assets/js/owl.carousel.js"></script>
  <!-- lightbox -->
  <script src="bootstrap/assets/js/lightbox.min.js"></script>


</body>
</html>