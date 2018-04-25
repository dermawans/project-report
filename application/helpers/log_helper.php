<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log_helper {

public function logAction($strAction, array $arrData = null) { 
		$strMessage = '';        
        $strMessage .= 'action: ' . $strAction . ' ';
		$strMessage .='ip: ' . $this->CI->input->ip_address() . ' ';
		$strMessage .='uri: ' . $this->uri->segment(1).'/' .$this->uri->segment(2).'/'.$this->uri->segment(3). ' ';
 
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
