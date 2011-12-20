<?php

class Customer extends Model {
    
    function get_customer($username, $password) {
        return $this->db->query("SELECT id, username FROM customers WHERE username = ? AND password = ?", array($username, $password))->row();
    }
    
}