<?php

/**
 * This class contains functions for easier database access
 * @author Jens Segers
 */
class DB {
    
    // connection info 
    private $hostname, $username, $password, $database, $port;

    // mysqli object
    private $dbconn;
    
    // last executed query
    private $last_query;
    
    public function __construct() {
        // load database config
        $ft = &get_instance();
        foreach ($ft->config->item("database") as $key => $value) {
            $this->{$key} = $value;
        }
        
        if ($this->port)
            $this->dbconn = new mysqli($this->hostname, $this->username, $this->password, $this->database, $this->port);
        else
            $this->dbconn = new mysqli($this->hostname, $this->username, $this->password, $this->database);
    }
    
    public function __destruct() {
        @$this->dbconn->close();
    }
    
    public function query($query, $values = null) {
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
    
    public function escape($value) {
        return $this->dbconn->real_escape_string($value);
    }
    
    public function insert_id() {
        return @mysqli_insert_id($this->conn_id);
    }
    
    public function last_query() {
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
    
    public function __construct($mysqli_result) {
        $this->result = $mysqli_result;
    }
    
    public function __destruct() {
        @$this->result->free;
    }
    
    public function __call($name, $args) {
        if (method_exists($this->result, $name))
            return call_user_func_array(array($this->result, $name), $args);
    }
    
    public function __get($name) {
        if (isset($this->result->{$name}))
            return $this->result->{$name};
    }
    
    public function num_rows() {
        return $this->result->num_rows;
    }
    
    public function result() {
        $results = array();
        while ($row = $this->row())
            $results[] = $row;
        
        return $results;
    }
    
    public function result_array() {
        return $this->result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function row() {
        return $this->result->fetch_object();
    }
    
    public function row_array() {
        return $this->result->fetch_assoc();
    }
    
    public function free_result() {
        $this->result->free_result();
    }
}