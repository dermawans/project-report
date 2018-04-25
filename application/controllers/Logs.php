<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
/**
 * CodeIgniter Log Controller
 *
 * @author Mike Feng
 */
								
class Logs extends CI_Controller { 
	function __construct(){
		parent::__construct();
		if($this->session->userdata('login_status') != TRUE ){
		    $this->session->set_flashdata('notif','LOGIN GAGAL USERNAME ATAU PASSWORD ANDA SALAH !');
		    redirect('dashboard');
		};  
	} 

	/**
	 * Default route for rendering view
	 *
	 * @param String $log_date
	 */ 
		public function index($log_date = NULL)
		{ 
			$this->load->library('log_library');
			if ($log_date == NULL)
			{
				// default: today
				$log_date = date('Y-m-d');
			}
			$data['cols'] = $this->log_library->get_file('log-'. $log_date . '.txt');
			$data['log_date'] = $log_date;
			$this->load->view('log_view', $data); 
		}

		public function more()
		{  
			$this->load->library('log_library');
			$log_date = $this->uri->segment(3);
			$data['cols'] = $this->log_library->get_file('log-'. $log_date . '.txt');
			$data['log_date'] = $log_date;
			$this->load->view('log_view', $data); 
		}


}

