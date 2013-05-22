<?php
/**
 * ExternalCalendars
 * Generado el 22/2/2012
 * 
 */
class ExternalCalendars extends BaseExternalCalendars {
    
    function findByExtCalUserId($user) {
            return ExternalCalendars::findAll(array('conditions' => array('`ext_cal_user_id` = ?', $user)));
    }
} 
?>