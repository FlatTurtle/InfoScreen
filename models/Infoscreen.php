<?php

class Infoscreen extends Model {
	
    function get_infoscreen($infoscreenid) {
        return $this->db->query("SELECT * FROM infoscreens WHERE id = ?", array($infoscreenid))->row();
    }
    
    function get_infoscreens($customer) {
        return $this->db->query("SELECT * FROM infoscreens WHERE customerid = ?", array($customer))->result();
    }
    
}