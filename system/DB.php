<?php

/**
 * This class contains functions for easier database access
 * @author Jens Segers
 */
class DB {
    
    var $hostname;
    var $username;
    var $password;
    var $database;
    var $port;
    
    private $dbconn;
    private $last_query;
    
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
            if (!is_array($values))
                $values = array($values);

            foreach ($values as $value) {
                $value = $this->escape($value);
                $pos = strpos($query, "?");
                if ($pos !== false)
                    $query = substr_replace($query, "'" . $value . "'", $pos, 1);
            }
        }
        $this->last_query = $query;
        
        return new DB_result($this->dbconn->query($query));
    }
    
    function escape($value) {
        return $this->dbconn->real_escape_string($value);
    }
    
    function insert_id() {
        return @mysqli_insert_id($this->conn_id);
    }
    
    function last_query() {
        return $this->last_query;
    }
}

/**
 * This is a wrapper class for the regular mysqli result. It adds a few user-friendly 
 * functions and still allows you to access the regular methods and properties.
 * @author Jens Segers
 */
class DB_result {
    
    private $result;
    
    function __construct($mysqli_result) {
        $this->result = $mysqli_result;
    }
    
    function __destruct() {
        @$this->result->free;
    }
    
    function __call($name, $args) {
        if (method_exists($this->result, $name))
            return call_user_func_array(array($this->result, $name), $args);
    }
    
    function __get($name) {
        if (isset($this->result->{$name}))
            return $this->result->{$name};
    }
    
    function num_rows() {
        return $this->result->num_rows;
    }
    
    function result() {
        $results = array();
        while ($row = $this->row())
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
    
    function free_result() {
        $this->result->free_result();
    }
}