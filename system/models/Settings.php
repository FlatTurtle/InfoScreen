<?php

class Settings extends Model {
	
    function get_settings($infoscreenid) {
        return $this->db->query("SELECT * FROM settings WHERE infoscreenid = ?", array($infoscreenid))->result();
    }
    
}