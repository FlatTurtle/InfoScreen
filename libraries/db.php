<?php

class db {
    
    // fetched from config
    var $hostname;
    var $username;
    var $password;
    var $database;
    var $port;
    
    private $dbconn;
    
    function __construct() {
        // load database config
        $ft = & get_instance();
        foreach ($ft->config->item("database") as $key => $value) {
            $this->{$key} = $value;
        }
        
        if ($this->port)
            $this->dbconn = new mysqli($this->hostname, $this->username, $this->password, $this->database, $this->port);
        else
            $this->dbconn = new mysqli($this->hostname, $this->username, $this->password, $this->database);
    }
    
    function __destruct() {
        @$this->dbconn->close();
    }
    
    function query($query, $values = null) {
        if ($values != null) {
            // not yet using statements
            foreach ($values as $value) {
                $value = $this->escape($value);
                $count = 1; // fix for: Only variables can be passed by reference
                $query = str_replace("?", $value, $query, $count);
            }
        }
        
        return new db_result($this->dbconn->query($query));
    }
    
    function escape($value) {
        return $this->dbconn->real_escape_string($value);
    }
    
    function insert_id() {
        return @mysqli_insert_id($this->conn_id);
    }
}

/*
 * This is a wrapper class for the regular mysqli result. It adds a few user-friendly 
 * functions and still allows you to access the regular methods and properties.
 */
class db_result {
    
    private $result;
    
    function __construct($mysqli_result) {
        $this->result = $mysqli_result;
    }
    
    function __call($name, $args) {
        return call_user_func(array($this->result, $name), $args);
    }
    
    function __get($name) {
        if(isset($this->result->{$name}))
            return $this->result->{$name};
    }
    
    function num_rows() {
        return $this->result->num_rows;
    }
    
    function result() {
        $results = array();
        while($row = $this->row())
            $results[] = $row;
            
        return $results;
    }
    
    function result_array() {
        return $this->result->fetch_all(MYSQLI_ASSOC);
    }
    
    function row() {
        return $this->result->fetch_object();
    }
    
    function row_array() {
        return $this->result->fetch_assoc();
    }
}