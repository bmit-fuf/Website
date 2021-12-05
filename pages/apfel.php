<?php
/*
function forletters($string){   
    if (preg_match_all('(\\d+)', $string)) {
        return true;
    } else {
        return false;
    }
}
function special_character($string)
{
    $include_special = false;
    for ($pos = 0; $pos <= strlen($string); $pos++) {
        if (ctype_punct($string[$pos])) {
            $include_special = true;
            break;
        }
    }
    return $include_special;
}
function passwordValidator($password_string){

    $len_pwd = strlen($password_string);
    $numeric = is_numeric($password_string);
    $buchstaben= forletters($password_string);
    $special = special_character($password_string);

    if($len_pwd < 8 && $numeric){
        return "<p>schlechtes Passwort</p>";
    }
    elseif($len_pwd < 8 & !$numeric){
        return "<p>Schon besseres Passwort</p>";
    }
    elseif($len_pwd >= 8 & !$numeric && $buchstaben &!$special){
        return "<p> gutes Passwort</p>";
    }
    elseif($len_pwd >= 8 & !$numeric && $buchstaben&& $special){
        return "<p>Episches Password!</p>";
    }
    return"";
}

if (isset($_POST["pwd"])) {
    echo passwordValidator($_POST["pwd"]);
}
*/



/*
$howmanytimes=0;
$names = array();
$forarray=1;
$finnally= "";
$timesforarray=0;

if (isset($_POST["Name"])) {
    $timesforarray++;
    $input=$_POST["Name"];
    addValue($_POST["Name"]);
    randomNumber();
    Winner();
    hallo();
    
}

function hallo() {
    $finnally = array_search(intval($random),$names);
    return "<p>$finnally</p>";
    unset($names[$input]);
    
}

function addValue(){
    $names=array_fill(1,1, $_POST["Name"]);
    array_fill_keys(range(0,1),$names);
}



function Winner(){
$random=(random_int(0, $howmanytimes));

}

function randomNumber(){
    foreach($names as $timesforarray){
        $howmanytimes+1;

    }
}
*/
?>

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
        <title>Fuchs Florian</title>
        <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
        <link rel="apple-touch-icon" sizes="57x57" href="images/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="images/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="images/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="images/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="images/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="images/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="images/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="images/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="images/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192" href="images/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="images/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
        <link rel="manifest" href="images/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
    </head>
    <body>
        <ul>
            <!-- Navbar -->
            <div class="topnav">
                <div class="svg-wrapper">
                    <svg height="40" width="150">
                        <rect id="shape" height="40" width="150" class="strokecolor2" />
                        <div id="text">
                            <a href="../index.php" class="active"><span class="spot"></span>Home</a>
                        </div>
                    </svg>
            </div>
                <div class="svg-wrapper">
                    <svg height="40" width="150">
                        <rect id="shape" height="40" width="150" class="strokecolor" />
                        <div id="text">
                            <a href="apfel.php"><span class="spot"></span>Second Page</a>
                        </div>
                    </svg>
                </div>
                <div class="svg-wrapper">
                    <svg height="40" width="150">
                        <rect id="shape" height="40" width="150" class="strokecolor2" />
                        <div id="text">
                            <a href="birne.php"><span class="spot"></span>Third Page</a>
                        </div>
                    </svg>
                </div>
        </ul>
         
        <form  method="post">
            <input type="text" placeholder="Password" name="pwd" required>
            <br>
            <button type="submit">Testen</button>
        </form>
        <br>
        
        <!--
        <form  method="post">
            <input type="text" placeholder="Name?" name="Name"  required>
            <br>
            <button type="submit">Testen</button>
        </form>
        -->
        
        <footer>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="birne.html">Third-Page</a></li>
            </ul>
            <p>Website created by Florian Fuchs</p>
        </footer>
    </body>
</html>