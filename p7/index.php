<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="script.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">


<script>
    function validateLogin() {
        if(document.getElementById('username').value === '' || document.getElementById('password').value === '') {
            document.getElementById('loginError').innerHTML = "*Please fill out all fields";
            return false;
        }
    }
    function validateRegistration() {
        if(document.getElementById('register-username').value === '' || document.getElementById('register-password').value === '' || document.getElementById('register-confirm-password').value === '') {
            document.getElementById('registrationError').innerHTML = "*Please fill out all fields";
            return false;
        }
        if(document.getElementById('register-confirm-password').value != document.getElementById('register-password').value) {
            document.getElementById('registrationError').innerHTML = "*Passwords do not match";
            return false;
        }
    }
</script>


<?php 
include('login.php');
?>


<div class="container">
   <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-login">
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">
              <form id="login-form" onsubmit="return validateLogin()" action="#" method="post" role="form" style="display: block;">
                <h2>LOGIN</h2>
                  <div class="form-group">
                    <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                  </div>
                  <div class="col-xs-6 form-group pull-left checkbox">
                    <input id="checkbox1" type="checkbox" name="remember">
                    <label for="checkbox1">Remember Me</label>   
                  </div>
                  <div class="col-xs-6 form-group pull-right">     
                        <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                  </div>
                  <div class="col-xs-12 text-center">
                    <span><p id="loginError"></p><?php echo $loginerror; echo $registrationMsg; ?></span>
                  </div>
              </form>
              <form id="register-form" onsubmit="return validateRegistration()" action="#" method="post" role="form" style="display: none;">
                <h2>REGISTER</h2>
                  <div class="form-group">
                    <input type="text" name="register-username" id="register-username" tabindex="1" class="form-control" placeholder="Username" value="">
                  </div>

                  <div class="form-group">
                    <input type="password" name="register-password" id="register-password" tabindex="2" class="form-control" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <input type="password" name="register-confirm-password" id="register-confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
                      </div>
                       
                        <div class="col-xs-12 text-center">
                            <span><p id="registrationError"></p><?php echo $registererror; ?></span>
                        </div>
                        
                    </div>
                  </div>
              </form>
            </div>
          </div>
        </div>
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-6 tabs">
              <a href="#" class="active" id="login-form-link"><div class="login">LOGIN</div></a>
            </div>
            <div class="col-xs-6 tabs">
              <a href="#" id="register-form-link"><div class="register">REGISTER</div></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<footer>

</footer>

