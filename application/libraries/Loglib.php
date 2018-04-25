<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Loglib {

public function logAction($strAction, array $arrData = null) { 
		$strMessage = '';        
        $strMessage .= 'action: ' . $strAction . ' ';
		$strMessage .='ip: ' . $_SERVER['HTTP_X_FORWARDED_FOR'] . ' ';
		$strMessage .='uri: ' .$this->uri->segment(3). ' ';
 
        // add user id if any logged in
        if ($this->session->userdata('ID')) {
            $strMessage .= 'user: ' . $this->session->userdata('ID') . ' ';
        }
 
        // add data if provided
        if ($arrData) {
            $strMessage .= 'data: ' . str_replace(array("\n", "\r", "    "), '', print_r($arrData, true));
        }
 
        log_message('info', $strMessage);
    }

public function logException(Exception $oException) {
        $strMessage = '';
        $strMessage .= $oException->getMessage() . ' ';
        $strMessage .= $oException->getCode() . ' ';
        $strMessage .= $oException->getFile() . ' ';
        $strMessage .= $oException->getLine();
        $strMessage .= "\n" .  $oException->getTraceAsString();
         
        log_message('error', $strMessage);
    }
}
