<?php

/**
 * This class contains functions for easier database access
 * @author Jens Segers
 */
class DB {
    
    private $hostname, $username, $password, $database, $port;
    private $dbconn;
    private $last_query = "";
    
    /**
     * Constructor, loads the database config and opens a database connection using mysqli
     */
    public function __construct() {
        $ft = &getInstance();
        foreach ($ft->config->item("database") as $key => $value) {
            $this->{$key} = $value;
        }
        
        if ($this->port) {
            $this->dbconn = new mysqli($this->hostname, $this->username, $this->password, $this->database, $this->port);
        } else {
            $this->dbconn = new mysqli($this->hostname, $this->username, $this->password, $this->database);
        }
    }
    
    /**
     * Destructor, closes the database connection
     */
    public function __destruct() {
        @$this->dbconn->close();
    }
    
    /**
     * Perform a query on the database, returns a DBResult object
     * This method allows value binding by using '?' in your query and providing an array with the values to this function
     * @param string $query
     * @param array $values
     * @return DBResult
     */
    public function query($query, $values = null) {
        // replace all '?' with the corresponding value
        if ($values != null) {
            if (!is_array($values)) {
                $values = array($values);
            }
            
            foreach ($values as $value) {
                $value = $this->escape($value);
                $pos = strpos($query, "?");
                if ($pos !== FALSE) {
                    $query = substr_replace($query, "'" . $value . "'", $pos, 1);
                }
            }
        }
        $this->last_query = $query;
        
        // query failed
        if (!$mysqli_result = $this->dbconn->query($query)) {
            $this->displayError();
        }
        
        return new DBResult($mysqli_result);
    }
    
    /**
     * Determines the data type so that it can escape only string data. It also automatically adds single quotes around the data so you don't have to
     * @param mixed $value
     * @return string
     */
    public function escape($value) {
        if (is_bool($value)) {
            return ($value === FALSE) ? 0 : 1;
        } elseif (is_null($value)) {
            return "NULL";
        } else {
            return $this->dbconn->real_escape_string($value);
        }
    }
    
    /**
     * Returns the insert id number when performing database inserts
     * @return int
     */
    public function insertId() {
        return @mysqli_insert_id($this->conn_id);
    }
    
    /**
     * Returns the last query that was run (the query string, not the result)
     * @return string
     */
    public function lastQuery() {
        return $this->last_query;
    }
    
    /**
     * Display an appropriate error message when a query has failed
     * @param string $error
     */
    private function displayError($error = "") {
        if (!$error)
            $error = $this->dbconn->error;
        
        $ft = &getInstance();
        $ft->load->system("Exceptions");
        echo $ft->exceptions->showError("A Database Error Occurred", $error);
        exit();
    }
}

/**
 * This is a wrapper class for the regular mysqli result. It adds a few user-friendly functions and still allows you to access the regular methods and properties
 * @author Jens Segers
 */
class DBResult {
    
    private $result;
    
    /**
     * Constructor, wrap uniform methods arround a mysqli result
     * @param mysqli_result $mysqli_result
     */
    public function __construct($mysqli_result) {
        $this->result = $mysqli_result;
    }
    
    /**
     * Destructor, automatically frees the memory associated with the mysqli_result
     */
    public function __destruct() {
        @$this->result->free;
    }
    
    /**
     * Allows you to access the original methods of the mysqli_result
     * @param string $name
     * @param mixed $args
     * @return void
     */
    public function __call($name, $args) {
        if (method_exists($this->result, $name)) {
            return call_user_func_array(array($this->result, $name), $args);
        }
    }
    
    /**
     * Allows you to access the original properties of the mysqli_result
     * @param string $name
     * @return mixed
     */
    public function __get($name) {
        if (isset($this->result->$name)) {
            return $this->result->$name;
        }
    }
    
    /**
     * The number of rows returned by the query
     * @return int
     */
    public function numRows() {
        return $this->result->num_rows;
    }
    
    /**
     * Returns the query result as an array of objects, or an empty array on failure
     * @return array
     */
    public function result() {
        $results = array();
        while ($row = $this->row()) {
            $results[] = $row;
        }
        
        return $results;
    }
    
    /**
     * Returns the query result as a pure array, or an empty array when no result is produced
     * @return array
     */
    public function resultArray() {
        return $this->result->fetch_all(MYSQLI_ASSOC);
    }
    
    /**
     * Returns a single result row. If your query has more than one row, it returns only the first row
     * @return object
     */
    public function row() {
        return $this->result->fetch_object();
    }
    
    /**
     * Identical to the above row() function, except it returns an array
     * @return array
     */
    public function rowArray() {
        return $this->result->fetch_assoc();
    }
    
    /**
     * Frees the memory associated with a result
     */
    public function freeResult() {
        $this->result->free_result();
    }
}