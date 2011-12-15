<?php

class Turtles {
    
    // TODO: rename class?
    
    private $ft;
    
    function __construct() {
        $this->ft = &get_instance();
    }
    
    function infoscreen($infoscreenid) {
        $query = $this->ft->db->query("SELECT * FROM infoscreens WHERE id = ?", array($infoscreenid));
        $infoscreen = $query->row();
        $query->free_result();
        return $infoscreen;
    }
    
    function infoscreens($customer) {
        $query = $this->ft->db->query("SELECT * FROM infoscreens WHERE customerid = ?", array($customer));
        $infoscreens = $query->result();
        $query->free_result();
        return $infoscreens;
    }
    
    function customer($username, $password) {
        $query = $this->ft->db->query("SELECT id, username FROM customers WHERE username = ? AND password = ?", array($username, $password));
        $customer = $query->row();
        $query->free_result();
        return $customer;
    }
    
    function settings($infoscreenid) {
        $query = $this->ft->db->query("SELECT * FROM settings WHERE infoscreenid = ?", array($infoscreenid));
        $settings = $query->result();
        $query->free_result();
        return $settings;
    }

}