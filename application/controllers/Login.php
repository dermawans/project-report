<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('model_app');
		$this->load->library('Recaptcha');   
    }

    function index(){ 
		// Send captcha image to view
        $data=array(
            'title'=>'Login Page', 
			'captcha' => $this->recaptcha->getWidget(), // menampilkan recaptcha
            'script_captcha' => $this->recaptcha->getScriptTag(), // javascript recaptcha ditaruh di head
        );
 
		
		// Load the view  
		$this->model_app->updateStatusproject();
        $this->load->view('pages/v_login',$data);
    }
 

    function cek_login() {  
	
        $recaptcha = $this->input->post('g-recaptcha-response');
        $response = $this->recaptcha->verifyResponse($recaptcha);

        if (!isset($response['success']) || $response['success'] <> true) 
		{
            //if form validate false
            $this->session->set_flashdata('notif','CAPTCHA SALAH !');  
			 	//buatlog
	  			$info='applog';
				$data = array(
				'username'=>$this->input->post('username'),
				'berita'=>'gagal login, salah captcha');
       			$this->model_log->logAction($info,$data); 
				//buatlog
				redirect('login');
				return FALSE; 
        } 
		else 
		{
            //Field validation succeeded.  Validate against database
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			//query the database
			$result = $this->model_app->login($username, $password);
			if($result) 
			{
				$sess_array = array();
				foreach($result as $row) 
				{
				    //create the session
				    $sess_array = array(
				        'ID' => $row->id_name,
				        'USERNAME' => $row->username,   
				        'ROLEID' => $row->roleid,
				        'login_status'=>true,
				    ); 
				    //set session with value from database
				    $this->session->set_userdata($sess_array);
 
					//buatlog
		  			$info='applog';
					$data = array(
					'username'=>$this->session->userdata('USERNAME'),
					'berita'=>'berhasil login');
		   			$this->model_log->logAction($info,$data); 
					//buatlog

				    redirect('dashboard','refresh');
				}
					return TRUE;
			} 
			else 
			{
				//if form validate false 
				//buatlog
	  			$info='applog';
				$data = array(
				'username'=>$this->input->post('username'),
				'berita'=>'gagal login salah username atau password');
       			$this->model_log->logAction($info,$data); 
				//buatlog
				redirect('dashboard','refresh');
				return FALSE;
			} 
        }			
			
        
    }

    function logout() {
		
		//buatlog
		$info='applog';
		$data = array(
		'username'=>$this->session->userdata('USERNAME'),
		'berita'=>'berhasil logout');
		$this->model_log->logAction($info,$data); 
		//buatlog

        $this->session->unset_userdata('ID');
        $this->session->unset_userdata('USERNAME');
        $this->session->unset_userdata('PASS');
        $this->session->unset_userdata('ROLEID');
        $this->session->unset_userdata('login_status');
        $this->session->set_flashdata('notif','THANK YOU');
        redirect('login');
    }
}
