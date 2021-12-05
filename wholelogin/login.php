<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../index.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: ../index.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                    
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="de">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="logincss.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1" charset ="utf-8">	
    <link rel="apple-touch-icon" sizes="57x57" href="https://fuf.bm-it.ch/images/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="https://fuf.bm-it.ch/images/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="https://fuf.bm-it.ch/images/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="https://fuf.bm-it.ch/images/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="https://fuf.bm-it.ch/images/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="https://fuf.bm-it.ch/images/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="https://fuf.bm-it.ch/images/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="https://fuf.bm-it.ch/images/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="https://fuf.bm-it.ch/images/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="https://fuf.bm-it.ch/images/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="https://fuf.bm-it.ch/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="https://fuf.bm-it.ch/images/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://fuf.bm-it.ch/images/favicon-16x16.png">
    <link rel="manifest" href="https://fuf.bm-it.ch/images/manifest.json">
    <script src="https://kit.fontawesome.com/0f25a1a345.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/typicons.min.css"/>
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <meta name="description" content="Florian Fuchs">
    <meta name="keywords" content="Florian Fuchs">
    <meta name="author" content="Florian Fuchs">
  </head>

  

  <body>
  <!-- <div class="toggle-button-cover" style="box-sizing: unset;" >
      <div class="button-cover" style="box-sizing: unset;">
        <div class="button r" id="button-3" style="box-sizing: unset;">
          <input type="checkbox" class="checkbox" style="box-sizing: unset;">
          <div class="knobs" style="box-sizing: unset;"></div>
          <div class="layer" style="box-sizing: unset;"></div>
        </div>
      </div>
    </div> 
        -->
    <div class="overlay">
    
          <img src="../images/NewLogo.png" alt="Dont use IE" class="logo">
          <script>
          // Creare's 'Implied Consent' EU Cookie Law Banner v:2.4
// Conceived by Robert Kent, James Bavington & Tom Foyster
 
var dropCookie = true;                      // false disables the Cookie, allowing you to style the banner
var cookieDuration = 14;                    // Number of days before the cookie expires, and the banner reappears
var cookieName = 'complianceCookie';        // Name of our cookie
var cookieValue = 'on';                     // Value of cookie
 
function createDiv(){
    var bodytag = document.getElementsByTagName('body')[0];
    var div = document.createElement('div');
    div.setAttribute('id','cookie-law');
    div.innerHTML = '<p>Our website uses cookies. By continuing we assume your permission to deploy cookies, as detailed in our <a href="./privacy-cookies-policy/" rel="nofollow" title="Privacy &amp; Cookies Policy">privacy policy</a>. <a class="close-cookie-banner" href="javascript:void(0);" onclick="removeMe();"><span>X</span></a></p>';    
 // Be advised the Close Banner 'X' link requires jQuery
     
    // bodytag.appendChild(div); // Adds the Cookie Law Banner just before the closing </body> tag
    // or
    bodytag.insertBefore(div,bodytag.firstChild); // Adds the Cookie Law Banner just after the opening <body> tag
     
    document.getElementsByTagName('body')[0].className+=' cookiebanner'; //Adds a class tothe <body> tag when the banner is visible
     
    createCookie(window.cookieName,window.cookieValue, window.cookieDuration); // Create the cookie
}
 
 
function createCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000)); 
        var expires = "; expires="+date.toGMTString(); 
    }
    else var expires = "";
    if(window.dropCookie) { 
        document.cookie = name+"="+value+expires+"; path=/"; 
    }
}
 
function checkCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
 
function eraseCookie(name) {
    createCookie(name,"",-1);
}
 
window.onload = function(){
    if(checkCookie(window.cookieName) != window.cookieValue){
        createDiv(); 
    }
}

function removeMe(){
	var element = document.getElementById('cookie-law');
	element.parentNode.removeChild(element);
}




          </script>
         
          
        <div>  
            <h1 class="blockheader forallblocks">Anmelden/Login</h1>
        </div>
        
        <span class="help-block <?php if(!empty($password_err)) echo "active"; ?>"><?php echo  $password_err; ?></span>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <span class="help-block <?php if(!empty($username_err)) echo "active"; ?>"><?php echo $username_err; ?></span>

            <div class="forallblocks"  <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
                <input class="username forallblocks" type="text" placeholder="Username/Benutzername" maxlength="21" name="username" required value="<?php echo $username; ?>" style="height: 86px;">   
            </div>

            <div <?php echo  (!empty($password_err)) ? 'has-error' : ''; ?>>
                
                <input class="username forallblocks" type="password" placeholder="Password/Passwort" name="password" maxlength="21" required style="height: 86px;">
                
            </div>


            <div class="divbtn">
               <input type="submit" class="btn btn-primary" value="Login" style="text-align: center;padding: 5px;background-color:#35a5e6;font-weight: 700;color:white;border-block-color:#35a5e6;border-radius: 4px;
                        cursor: pointer;font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;box-shadow: none;width: 120px; height: 57px;">
            </div>
            <div class="divbtn">
            <a href="signup.php">
                <button type="button" class="btn btn-primary"  style="text-align: center;padding: 5px;background-color:#35a5e6;font-weight: 700;color:white;border-block-color:#35a5e6;border-radius: 4px;
                        cursor: pointer;font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;box-shadow: none;width: 120px; height: 57px;">
                        <p style="padding-top: 8px";>Sign up</p>
            </button>
                </a>
            </div>
            <p class="smolfont">Passwort vergessen?/forgot password?</p>
        </form>
        <a href="../pages/privacy-cookies-policy.html" class="">Datenschutzerklärung</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>