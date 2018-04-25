<?php
class Users extends CI_Controller{
    function __construct(){
        parent::__construct();
        if($this->session->userdata('login_status') != TRUE ){
            $this->session->set_flashdata('notif','LOGIN GAGAL USERNAME ATAU PASSWORD ANDA SALAH !');
            redirect('');
        };
        $this->load->model('model_app');
		$data=array(); 
    }

    function index(){
		 $data=array(
            'title'=>'Users',
            'active_users'=>'active', 
            'data_pmo'=>$this->model_app->getDataPMO(),
            'data_qt'=>$this->model_app->getDataQT(),
            'data_user'=>$this->model_app->getDataUser(),
            'data_master_role'=> $this->model_app->getDataRole(),
            'data_master_role_pmo'=> $this->model_app->getDataRolePMO(),
            'data_master_role_qt'=> $this->model_app->getDataRoleQT(),
            'data_all_user'=> $this->model_app->getAllDataUser(),
            'jumlah_project_aktif_qt' => $this->model_app->getCountAktifProjectQT()->num_rows(),
            'jumlah_project_aktif_pmo' => $this->model_app->getCountAktifProjectPMO()->num_rows(),
            'jumlah_all_project_aktif' => $this->model_app->getCountAllAktifProject()->num_rows(), 
            'jumlah_new_project_qt' => $this->model_app->getCountNewProjectQT()->num_rows(),
            'jumlah_new_project_pmo' => $this->model_app->getCountNewProjectPMO()->num_rows(),
            'jumlah_new_project_pmo_kordinator' => $this->model_app->getCountNewProjectPMOKordinator()->num_rows(),
            'jumlah_new_project' => $this->model_app->getCountNewProject()->num_rows(),
            'jumlah_project_expired_qt' => $this->model_app->getCountExpiredProjectQT()->num_rows(),
            'jumlah_project_expired_pmo' => $this->model_app->getCountExpiredProjectPMO()->num_rows(),
            'jumlah_all_project_expired' => $this->model_app->getCountAllExpiredProject()->num_rows(),
            'jumlah_allproject_qt' => $this->model_app->getCountAllprojectQT()->num_rows(),
            'jumlah_allproject_pmo' => $this->model_app->getCountAllprojectPMO()->num_rows(),
            'jumlah_allproject_kordinator' => $this->model_app->getCountAllProjectKordinator()->num_rows(),
            
            'data_master_info'=>$this->model_app->getSelectedData('tbl_minfo',array('isactive'=>1))->result()
        ); 

        //buatlog
		$info='applog'; 
		$datalog = array(
		'username'=>$this->session->userdata('USERNAME'),
		'berita'=>'masuk ke halaman user', 
		);   
		$this->model_log->logAction($info,$datalog); 
		//buatlog

        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_users_data');
        $this->load->view('element/v_footer');
    }
	
	//    INSERT DATA USER
    function add_user(){
		if ($this->session->userdata('ROLEID') == '4' or $this->session->userdata('ROLEID') == '2'  or $this->session->userdata('ROLEID') == '5') {  
		
			$data['username'] = $this->input->post('username');
			$data['pwd'] = md5($this->input->post('password')); 
			$data['roleid'] = $this->input->post('roleid');
			$data['rolegroup'] = $this->input->post('roleid');
			$table="webuser";
			$proses=$this->model_app->insertData($table,$data);
			if ($proses == TRUE)
			{
				//buatlog
				$info='applog'; 
				$datalog = array(
				'username'=>$this->session->userdata('USERNAME'),
				'berita'=>'user berhasil ditambah', 
				);  
				$dlog=array_merge($datalog,$data);
				$this->model_log->logAction($info,$dlog); 
				//buatlog

				$this->session->set_flashdata('notif-sukses','User berhasil ditambah');
				redirect('users');
			}
			else
			{
				//buatlog
				$info='applog'; 
				$datalog = array(
				'username'=>$this->session->userdata('USERNAME'),
				'berita'=>'user gagal ditambahkan', 
				);  
				$dlog=array_merge($datalog,$data);
				$this->model_log->logAction($info,$dlog); 
				//buatlog

				$this->session->set_flashdata('notif-gagal','User gagal ditambah');
				redirect('users');
			}
			 
		}
	}
	
	//    UPDATE DATA USER
    function save_user(){
			
			$field_key['id_name']= $this->input->post('id_name'); 
			$data['username'] = $this->input->post('username');  
			$data['roleid'] = $this->input->post('roleid');  
			$data['rolegroup'] = $this->input->post('roleid');  
			$table="webuser";
			$proses=$this->model_app->updateDataWhereOnly($table,$data,$field_key);
			
			if ($proses == TRUE)
			{
				//buatlog
				$info='applog'; 
				$datalog = array(
				'username'=>$this->session->userdata('USERNAME'),
				'berita'=>'user berhasil diupdate', 
				);  
				$dlog=array_merge($datalog,$data);
				$this->model_log->logAction($info,$dlog); 
				//buatlog

				$this->session->set_flashdata('notif-sukses','Data Berhasil dirubah');
				redirect('users');
			}
			else
			{
				//buatlog
				$info='applog'; 
				$datalog = array(
				'username'=>$this->session->userdata('USERNAME'),
				'berita'=>'user gagal diupdate', 
				);  
				$dlog=array_merge($datalog,$data);
				$this->model_log->logAction($info,$dlog); 
				//buatlog

				$this->session->set_flashdata('notif-gagal','Data gagal dirubah');
				redirect('users');
			}
	}
	
	//    UPDATE DATA PASSWORD USER
    function change_password(){
			
			$field_key['id_name']= $this->input->post('id_name');
			$data['pwd'] = md5($this->input->post('password'));
			$table="webuser";
			$proses=$this->model_app->updateDataWhereOnly($table,$data,$field_key);
			
			if ($proses == TRUE)
			{
				//buatlog
				$info='applog'; 
				$datalog = array(
				'username'=>$this->session->userdata('USERNAME'),
				'berita'=>'password berhasil dirubah', 
				);  
				$dlog=array_merge($datalog,$data);
				$this->model_log->logAction($info,$dlog); 
				//buatlog

				$this->session->set_flashdata('notif-sukses','Password Berhasil dirubah');
				redirect('users');
			}
			else
			{
				//buatlog
				$info='applog'; 
				$datalog = array(
				'username'=>$this->session->userdata('USERNAME'),
				'berita'=>'password gagal dirubah', 
				);  
				$dlog=array_merge($datalog,$data);
				$this->model_log->logAction($info,$dlog); 
				//buatlog

				$this->session->set_flashdata('notif-gagal','Password gagal dirubah');
				redirect('users');
			}	
	 }
	
}
