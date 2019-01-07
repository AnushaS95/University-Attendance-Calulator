<?php

/**
 * Description of User
 *
 * @author Administrator
 */
class Common extends Database {

    public $db_connection;
    public $userID;

    /**
     * 
     * @param type $username
     * @param type $password
     * @param type $status
     */
    function __construct($db) {
        $this->db_connection = $db;
        if (isset($_SESSION["user"]["id"])) {
            $this->userID = $_SESSION["user"]["id"];
        }
    }

    /**
     * Redirect function
     * @param type $path
     */
    public function redirect($path, $time) {
        if (isset($time) && !empty($time)) {
            header("refresh:$time;url=$path");
        } else {
            header("location:$path");
            die();
        }
    }

    /**
     * To check the user login
     * @return boolean
     */
    public function userLogin($data) {
        $query = "SELECT * FROM users WHERE email = '" . trim($data["email"]) . "' AND password = '" . md5(trim($data["password"])) . "' ";
        if ($this->checkRecordExists($query)) {

            $result = $this->getRecord($query);
            if ($result["is_active"] == 0) {
                $_SESSION["errors"]["user_login"] = "This user is blocked. Please contact to administrator.";
                $this->redirect(SITE_URL . "login.php");
            } else {

                $loggedInData = $this->getRecord("SELECT * FROM users WHERE email = '" . trim($data["email"]) . "' ");
                $loggedInMetaData = $this->getRecords("SELECT * FROM users_data WHERE user_id = '" . $loggedInData["id"] . "' ");
                $_SESSION["user"] = $loggedInData;
                foreach ($loggedInMetaData as $value) {
                    $_SESSION["user"]["extra"][$value["meta_key"]] = $value["meta_value"];
                }
                $this->redirect(SITE_URL . "index.php");
            }
        } else {
            $_SESSION["errors"]["user_login"] = "Please check your credentials";
            $this->redirect(SITE_URL . "login.php");
        }
    }

    /**
     * To add new user
     */
    public function userRegister($data) {
        $query = "SELECT * FROM users WHERE email = '" . trim($data["email"]) . "'";
        if ($this->checkRecordExists($query)) {
            $_SESSION["errors"]["user_register"] = "This email is already exists. Please use different.";
            $this->redirect(SITE_URL . "register.php");
        } else {

            if (trim($data["password"]) == trim($data["confirm_password"])) {

                $userMetaData = $data["extra"];

                $userData["email"] = $data["email"];
                $userData["password"] = md5($data["password"]);
                $userData["is_active"] = 1;
                $userData["role"] = 'user';

                $this->insertRecords("users", $userData);
                $lastId = $this->getLastInsertedRecord();
                foreach ($userMetaData as $key => $value) {

                    $metaData["user_id"] = $lastId;
                    $metaData["meta_key"] = $key;
                    $metaData["meta_value"] = $value;

                    $this->insertRecords("users_data", $metaData);
                }

                $loggedInData = $this->getRecord("SELECT * FROM users WHERE id = '" . $lastId . "' ");
                $loggedInMetaData = $this->getRecords("SELECT * FROM users_data WHERE user_id = '" . $lastId . "' ");
                $_SESSION["user"] = $loggedInData;
                foreach ($loggedInMetaData as $value) {
                    $_SESSION["user"]["extra"][$value["meta_key"]] = $value["meta_value"];
                }
                $this->redirect(SITE_URL . "index.php");
            } else {
                $_SESSION["errors"]["user_register"] = "Password and confirm Password is not match.";
                $this->redirect(SITE_URL . "register.php");
            }
        }
    }

    public function mark_attendance() {
        $todayDatetime = date("Y-m-d H:i:s");
        $query = "SELECT * FROM users_attendance WHERE user_id = '" . $this->userID . "' AND date(attendance_datetime) = '" . date("Y-m-d") . "' ";

        $record = $this->getRecord($query);
        if (empty($record)) {
            if ($this->userID) {
                $insertData["user_id"] = $this->userID;
                $insertData["attendance_datetime"] = $todayDatetime;

                $this->insertRecords("users_attendance", $insertData);
                if ($this->getLastInsertedRecord()) {
                    $_SESSION["success"]["attendance"] = "Attendance added of " . date("F j, Y");
                    $this->redirect(SITE_URL . "index.php");
                }
            }
        } else {
            $_SESSION["success"]["attendance"] = "Attendance already exists of " . date("F j, Y");
            $this->redirect(SITE_URL . "index.php");
        }
    }

    public function update_profile($data) {

        if (trim($data["password"]) == trim($data["confirm_password"])) {

            $userMetaData = $data["extra"];

            $userData["password"] = md5($data["password"]);
            $this->updateRecordsArray("users", $userData, "id='" . $this->userID . "' ");

            foreach ($userMetaData as $key => $value) {
                $metaData["meta_value"] = $value;
                $this->updateRecordsArray("users_data", $metaData, "meta_key='" . $key . "' ");
            }

            $loggedInData = $this->getRecord("SELECT * FROM users WHERE id = '" . $this->userID . "' ");
            $loggedInMetaData = $this->getRecords("SELECT * FROM users_data WHERE user_id = '" . $this->userID . "' ");

            $_SESSION["user"] = $loggedInData;
            foreach ($loggedInMetaData as $value) {
                $_SESSION["user"]["extra"][$value["meta_key"]] = $value["meta_value"];
            }

            $_SESSION["success"]["user_register"] = "Profile Updated.";
            $this->redirect(SITE_URL . "profile-management.php");
        } else {
            $_SESSION["errors"]["user_register"] = "Password and confirm Password is not match.";
            $this->redirect(SITE_URL . "profile-management.php");
        }
    }

    public function check_attendance_of_today() {
        $query = "SELECT * FROM users_attendance WHERE user_id = '" . $this->userID . "' AND date(attendance_datetime) = '" . date("Y-m-d") . "' ";
        if ($this->checkRecordExists($query)) {
            return $this->getRecord($query);
        }
    }

    public function getAttendanceReport($userID = null) {
        $where = "";
        if ($userID !== '-1') {
            $where = "WHERE user_id= '" . $userID . "'";
        }
        $query = "SELECT * FROM users_attendance LEFT JOIN users ON users.id = users_attendance.user_id $where";
        if ($this->checkRecordExists($query)) {
            return $this->getRecords($query);
        }
    }

    public function getDetails($tableName, $whereClause) {
        $query = "SELECT * FROM $tableName WHERE $whereClause";
        if ($this->checkRecordExists($query)) {
            return $this->getRecord($query);
        }
    }

    public function getallStudents() {

        $query = "SELECT * FROM users WHERE role= 'user' ";
        if ($this->checkRecordExists($query)) {
            $allUsers = $this->getRecords($query);
            foreach ($allUsers as $key => $value) {
                $query1 = "SELECT * FROM users_data WHERE user_id= '" . $value["id"] . "' ";
                $usersData = $this->getRecords($query1);
                foreach ($usersData as $value1) {
                    $allUsers[$key]["extra"][$value1["meta_key"]] = $value1["meta_value"];
                }
            }
            return $allUsers;
        }
    }

    public function changeUserStatus($data) {
        $return = [];
        $query = "SELECT * FROM users WHERE id = '" . $data["userid"] . "' ";
        if ($this->checkRecordExists($query)) {
            $result = $this->getRecord($query);

            $form_data["is_active"] = ($result["is_active"] == 0) ? 1 : 0;

            $whereID = "id='" . $result["id"] . "' ";
            $this->updateRecordsArray("users", $form_data, $whereID);

            $return["success"] = 1;
            $return["message"] = "Status Changed";
            $return["html"] = ($result["is_active"] == 0) ? "fa-user-times" : "fa-user-plus";
            $return["title"] = ($result["is_active"] == 0) ? "Block User" : "Un-block User";
        } else {
            $return["success"] = 0;
            $return["message"] = "This User is not exisits";
        }
        return $return;
    }

    public function handleRequest() {
        $post = $_POST;
        if (isset($post["action"])) {
            $action = $post["action"];
            unset($post["action"]);
            switch ($action) {

                case "login":
                    $this->userLogin($post);
                    break;

                case "register":
                    $this->userRegister($post);
                    break;

                case "mark_attendance":
                    $this->mark_attendance($post);
                    break;

                case "update_profile":
                    $this->update_profile($post);
                    break;

                default:
                    break;
            }
        }
    }

}
