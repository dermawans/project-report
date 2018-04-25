<?php 

class Model_log extends CI_Model
{

	public function logAction($info,$data) {  
        if(isset($_SERVER['HTTP_CLIENT_IP']))
                $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
                $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
                $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
                $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
                $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
                $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
                $ipaddress = 'UNKNOWN'; 
 
		$strMessage = '';       
		$strMessage .='<b>IP:</b>'.$ipaddress.'<br>';
		$strMessage .='<b>Browser:</b>'.$this->agent->agent_string().'<br>';
		$strMessage .='<b>URI:</b>';
		if ($this->uri->segment(1)) 
		{
		$strMessage .= $this->uri->segment(1).'/';
		} 
		if ($this->uri->segment(2)) 
		{
		$strMessage .= $this->uri->segment(2).'/';
		} 
		if ($this->uri->segment(3)) 
		{
		$strMessage .= $this->uri->segment(3).'/';
		} 
		if ($this->uri->segment(4)) 
		{
		$strMessage .= $this->uri->segment(4).'/';
		} 
		if ($this->uri->segment(5)) 
		{
		$strMessage .= $this->uri->segment(5).'/';
		}  
		$strMessage .='<br>';
 
        // add user id if any logged in
        if ($this->session->userdata('ID')) {
            $strMessage .= '<b>User ID:</b>'.$this->session->userdata('ID').'<br>';
            $strMessage .= '<b>Username:</b>'.$this->session->userdata('USERNAME').'<br>';
            $strMessage .= '<b>Role ID:</b>'.$this->session->userdata('ROLEID').'<br>';
        }
 		 
		$strMessage .='<b>Data:</b>';
        // add data if provided
        foreach ($data as $d) {
            $strMessage .= $d.'|';
        }
		
        log_message($info, $strMessage);
    }
 
}
