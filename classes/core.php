<?php

$errors_array = array(); /* a variable which will hold the errors ,notifications etc */

require_once ABSPATH . '/' . CLASS_DIR . '/Database.php';
require_once ABSPATH . '/' . CLASS_DIR . '/Common.php';

$db_obj = new Database(DB_NAME, USER_NAME, PASSWORD, HOST);
if (!$db_obj->connectDatabase()) {
    die("DATABASE connection error.Provide a database connection and other site settings in config.php");
} else {
    $db_connection = $db_obj->getConnection();
}


$user_obj = new Common($db_connection);
$user_obj->handleRequest();
