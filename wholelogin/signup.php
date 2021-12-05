<?php

require_once "config.php";


// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
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
    <title>Registration/Sign up</title>
    <link rel="stylesheet" type="text/css" href="signupcss.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" charset ="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
    <meta name="msapplication-TileColor" content="#ffffff">
    <link rel="stylesheet" href="../css/typicons.min.css"/>
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <meta name="description" content="Florian Fuchs">
    <meta name="keywords" content="Florian Fuchs">
    <meta name="author" content="Florian Fuchs">
  </head>
  <body>
    <div class="overlay">
          <img src="logo.png" alt="Dont use IE" class="logo">
          <script>
              function showPassword(){
                  alert("bruh");
              }


              function toggler(e) {
  if( e.innerHTML == 'Show' ) {
      e.innerHTML = 'Hide'
      document.getElementById('password').type="text";
  } else {
      e.innerHTML = 'Show'
      document.getElementById('password').type="password";
  }
}
          </script>
        <div>  
            <h1 class="blockheader forallblocks">Registration/Sign Up</h1>
        </div>
          
          <div>
          <span class="help-block <?php if(!empty($password_err)) echo "active"; ?>"><?php echo  $password_err; ?></span>
          </div>
          <div>
          <span class="help-block"><?php echo $confirm_password_err;  ?></span>
          </div>
          <div>
          <span class="help-block"><?php echo $username_err; ?></span>
          </div>

          <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">


        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          
          <div class="forallblocks">
            
            <input class="username forallblocks" type="text" placeholder="Username/Benutzername" name="username" maxlength="21" value="<?php echo $username; ?>" style="height: 86px;" required>
            
          </div>

          <div class="forallblocks" <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>>
          <i class="typcn typcn-eye" id="eye" style="right: 25px;" onclick="showPassword"></i>
            <input class="username forallblocks" id="PwInput" type="password" placeholder="Password/Passwort" name="password" maxlength="21" value="<?php echo $password; ?>" style="height: 86px; margin-right: 25px; " required>
            
          </div>

          <div class="forallblocks <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
          
            <input class="username forallblocks" id="PwInput" type="password" placeholder="Password/Passwort" maxlength="21" name="confirm_password" value="<?php echo $confirm_password; ?>" style="height: 86px; " required>
            
          </div>


          <div class="divbtn">
          <input type="submit" class="btn btn-primary" value="Submit" style="text-align: center;padding: 5px;background-color:#35a5e6;font-weight: 700;color:white;border-block-color:#35a5e6;border-radius: 4px;
                        cursor: pointer;font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;box-shadow: none;width: 120px; height: 57px;">
        
          </div>
          <div class="divbtn">
          <input type="reset" class="btn btn-default" value="Reset" style="text-align: center;padding: 5px;background-color:#35a5e6;font-weight: 700;color:white;border-block-color:#35a5e6;border-radius: 4px;
                        cursor: pointer;font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;box-shadow: none;width: 120px; height: 57px;">
          </div>
          <p class="smolfont">Passwort vergessen?/forgot password?</p>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>