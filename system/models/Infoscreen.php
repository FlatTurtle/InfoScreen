<?php

class Infoscreen extends Model {
	
    function getInfoscreen($infoscreenid) {
        return $this->db->query("SELECT * FROM infoscreens WHERE id = ?", array($infoscreenid))->row();
    }
    
    function getInfoscreens($customer) {
        return $this->db->query("SELECT * FROM infoscreens WHERE customerid = ?", array($customer))->result();
    }
    
}