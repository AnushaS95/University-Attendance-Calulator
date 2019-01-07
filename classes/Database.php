<?php

/**
 * Description of Database
 *
 * @author Administrator
 */
class Database {

    /**
     *
     * @var type 
     */
    private $db;
    private $user;
    private $password;
    private $host;
    protected $db_connection;

    /**
     * 
     * @param type $db
     * @param type $user
     * @param type $password
     * @param type $host
     */
    function __construct($db, $user, $password, $host) {
        $this->db = $db;
        $this->user = $user;
        $this->password = $password;
        $this->host = $host;
    }

    /**
     * 
     * @return boolean
     */
    public function connectDatabase() {
        $db_connection = mysqli_connect($this->host, $this->user, $this->password, $this->db);

        if ($db_connection) {
            $this->db_connection = $db_connection;
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * To get the DB connection 
     */
    public function getConnection() {
        return $this->db_connection;
    }

    /**
     * check a record exists or not 
     * @param type $query
     * @return boolean
     */
    public function checkRecordExists($query) {
        mysqli_query($this->getConnection(), $query);
        if (mysqli_affected_rows($this->getConnection()) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * 
     * @param type Select $query
     * @return type
     */
    public function getRecords($query) {
        $data = array();
        $result = mysqli_query($this->getConnection(), $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * 
     * @param type Select $query
     * @return type
     */
    public function getRecord($query) {
        $data = array();
        $result = mysqli_query($this->getConnection(), $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $data = $row;
        }
        return $data;
    }

    /**
     * 
     * @param type Update $query
     * @return boolean
     */
    public function updateRecords($query) {
        mysqli_query($this->getConnection(), $query);
        if (mysqli_affected_rows($this->getConnection()) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * 
     * @param type Delete $query
     * @return boolean
     */
    public function deleteRecords($query) {
        mysqli_query($this->getConnection(), $query);
        if (mysqli_affected_rows($this->getConnection()) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * To insert the data 
     * @param type $table_name
     * @param type $form_data
     * @return type
     */
    public function updateRecordsArray($table_name, $form_data, $whereID) {
        $valueSets = array();

        foreach ($form_data as $key => $value) {
            $valueSets[] = $key . "='" . $value . "'";
        }

        $query = "UPDATE $table_name SET " . join(",", $valueSets) . " WHERE " . $whereID;
//        echo $query . "</br>";
        return mysqli_query($this->getConnection(), $query);
    }

    public function insertRecords($table_name, $form_data) {
        // retrieve the keys of the array (column titles)
        $fields = array_keys($form_data);

        // build the query
        $sql = "INSERT INTO " . trim($table_name) . "
            (`" . trim(implode('`,`', $fields)) . "`)
            VALUES('" . trim(implode("','", $form_data)) . "')";

        // run and return the query result resource
        return mysqli_query($this->getConnection(), $sql);
    }

    public function getLastInsertedRecord() {
        return mysqli_insert_id($this->getConnection());
    }

    public function getAffectedRecords() {
        return mysqli_affected_rows($this->getConnection());
    }

    public function getNumRows($query) {
        $result = mysqli_query($this->getConnection(), $query);
        return mysqli_num_rows($result);
    }

    public function getOptionValue($option_name) {
        $data = '';
        $data = $this->getRecords("select option_value from bsh_options where option_name='$option_name'");
        if (!empty($data[0]) && isset($data[0])) {
            $data = $data[0]['option_value'];
        }
        return $data;
    }

    public function executeQuery($sql) {
        return mysqli_query($this->getConnection(), $sql);
    }

    public function addMetaInfo($table, $key, $value) {
        if (mysqli_query($this->getConnection(), "insert into $table ($key) values ('$value')")) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
