<?php
define('DB_NAME', 'login_db');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_HOST', 'localhost');

// if (!$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) )
//    {
//       die("failed to connect");
//    }

$connectionString = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
if (!$connection = new PDO($connectionString,DB_USER,DB_PASS) )
   {
      die("failed to connect");
   }

