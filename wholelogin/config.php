<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'fuf_db_adm');
define('DB_PASSWORD', 'Espas(8049).db.fuf');
define('DB_NAME', 'fuf_db');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($link === false){
    die("ERROR: Could not connect.". mysqli_connect_error());
}

?>


