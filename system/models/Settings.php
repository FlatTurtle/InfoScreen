<?php

class Settings extends Model {
	
    function getSettings($infoscreenid) {
        return $this->db->query("SELECT * FROM settings WHERE infoscreenid = ?", array($infoscreenid))->result();
    }
    
}