<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../wholelogin/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Florian Fuchs</title>
  <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
  <script type="text/javascript" src="./js/js.js"></script>
  <link rel="apple-touch-icon" sizes="57x57" href="images/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="images/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="images/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="images/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="images/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="images/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="images/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="images/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="images/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="images/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="images/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
  <link rel="manifest" href="images/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
 </head>
 <body>
  <ul>
  <!-- Navbar -->
<div class="topnav">
  <div class="svg-wrapper">
      <svg height="40" width="150" xmlns="http://www.w3.org/2000/svg">
        <rect id="shape" height="40" width="150" class="strokecolor"/>
        <div id="text">
          <a href="index.php" class="active"><span class="spot"></span>Home</a>
        </div>
      </svg>

    </div>
   <div class="svg-wrapper">
      <svg height="40" width="150" xmlns="http://www.w3.org/2000/svg">
        <rect id="shape" height="40" width="150" class="strokecolor2" />
        <div id="text">
          <a href="pages/apfel.php"><span class="spot"></span>Second Page</a>
        </div>
      </svg>
      
    </div>
   <div class="svg-wrapper">
      <svg height="40" width="150" xmlns="http://www.w3.org/2000/svg">
        <rect id="shape" height="40" width="150"  class="strokecolor2"/>
        <div id="text">
          <a href="pages/birne.php"><span class="spot"></span>Third Page</a>
        </div>
      </svg>
   </div>
         <div class="svg-wrapper"  style="float: right;">
      <svg height="40" width="150" xmlns="http://www.w3.org/2000/svg">
        <rect id="shape" height="40" width="150"  class="strokecolor2"/>
        <div id="text">
          <a href="wholelogin/logout.php"><span class="spot"></span>Logout</a>
        </div>
      </svg>
    </div>
  <!-- PHP -->
 <!-- <form id="searchthis" action="/search" style="display:inline;" method="get">
<input id="namanyay-search-box" name="q" size="40" type="text" placeholder="Coming Soon" class="body"/>
<input id="namanyay-search-btn" value="Go" type="submit"/>
</form>
PHP -->
  </ul> 
    <h1 div class="rand">Herzlich Willkommen auf meiner Webseite</h1>
  </div>
  <h1>hello ,<b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></h1>
  <h1> </h1>
<!--Hamburger Menu-->
  <button class="hamburger--empathic is-active" type="button">
  <span class="hamburger-box">
    <span class="hamburger-inner"></span>
  </span>
</button>

<!--Hamburger Menu-->
<!-- /footer -->
    <footer>
      <ul>
        <li><a href="pages/apfel.html" >Second-Page</li></a>
        <li><a href="pages/birne.html">Third-Page</li></a>   
      </ul>
    <p> Website created by Florian Fuchs</p> 
    </footer>
<!-- /footer -->
  </body>
</html>


