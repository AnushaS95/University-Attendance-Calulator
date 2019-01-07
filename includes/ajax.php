<?php

include_once '../config.php';
include_once '../classes/core.php';

if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
    unset($_REQUEST["action"]);
    $data = $_REQUEST;
    switch ($action) {
        case "changeUserStatus":
            $response = $user_obj->changeUserStatus($data);
            break;

        default:
            break;
    }
}
$callback = (isset($_REQUEST["callback"])) ? $_REQUEST["callback"] : "";
echo $callback . json_encode($response);
exit;