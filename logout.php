<?php

include_once 'config.php';
include_once 'classes/core.php';

session_destroy();
$user_obj->redirect(SITE_URL . "login.php");
