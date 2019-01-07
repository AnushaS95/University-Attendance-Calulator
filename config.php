<?php

session_start();
ob_start();

define('DB_NAME', 'attendance_system');
define('USER_NAME', 'root');
define('PASSWORD', '');
define('HOST', 'localhost');
define('DEBUG', true);
if (defined('DEBUG') && !DEBUG) {
    error_reporting(0);
}

define('CLASS_DIR', 'classes');
define('INC_DIR', 'includes');
define('WEBSITE_URL', 'http://localhost/upwork/rahul/anusha/');
define('SITE_URL', WEBSITE_URL);
define('UPLOADING_PATH', dirname(__FILE__) . "/uploads/");

/* Global Website Contests */
define('WEBSITE_NAME', 'Attendance System');
define('CURRENT_PAGE_NAME', ucfirst(basename($_SERVER["PHP_SELF"], '.php')));
/* End */

/** Absolute path to the directory. */
if (!defined('ABSPATH')) {
    define('ABSPATH', (dirname(__FILE__)));
}