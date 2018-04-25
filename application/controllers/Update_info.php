<?php
class Update_info extends CI_Controller{
    function __construct(){
        parent::__construct();
        if($this->session->userdata('login_status') != TRUE ){
            $this->session->set_flashdata('notif','LOGIN GAGAL USERNAME ATAU PASSWORD ANDA SALAH !');
            redirect(''); 
        };
        $this->load->model('model_app');    
    }

    function index(){ 
		if($this->session->userdata('ID') == '3') {  
			$data=array(  
            'data_master_info'=>$this->model_app->getAllData('tbl_minfo')
			);
		} 
		$data_header=array(
            'title'=>'Update Info',
            'active_update_info'=>'active',
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
            'jumlah_inactive_qt' => $this->model_app->getCountInActiveProjectQT()->num_rows(),
            'jumlah_inactive_pmo' => $this->model_app->getCountInActiveProjectPMO()->num_rows(),
            'jumlah_inactive_kordinator' => $this->model_app->getCountAllInActiveProject()->num_rows(),
            'jumlah_all_icl_open' => $this->model_app->getCountAllOpenIcl()->num_rows(),
            'jumlah_icl_open_qt' => $this->model_app->getCountOpenIclQT()->num_rows(),
            'data_master_info'=>$this->model_app->getSelectedData('tbl_minfo',array('isactive'=>1))->result()
			 );  
			 
	 	//buatlog
		$info='applog';
		$datalog = array(
		'username'=>$this->session->userdata('USERNAME'),
		'berita'=>'masuk ke halaman update info update sistem');
		$this->model_log->logAction($info,$datalog); 
		//buatlog		

        $this->load->view('element/v_header',$data_header);
        $this->load->view('pages/v_update_info',$data);
        $this->load->view('element/v_footer');
  
	}  
	    
	//INSERT NEW UPDATE INFO
    function add_info(){
		if ($this->session->userdata('ID') == '3') { 
		 
			$data['isi_info'] = $this->input->post('isi_info');
			$data['isactive'] = 1; 
			$data['create_date'] = date('Y-m-d H:i:s');
			$table="tbl_minfo";
			$proses=$this->model_app->insertData($table,$data);
   
			if ($proses == TRUE)
			{	
				//buatlog
				$info='applog'; 
				$datalog = array(
				'username'=>$this->session->userdata('USERNAME'),
				'berita'=>'data info berhasil ditambahkan',  
				);  
				$dlog=array_merge($datalog,$data);
				$this->model_log->logAction($info,$dlog); 
				//buatlog

				$this->session->set_flashdata('notif-sukses','Data berhasil ditambahkan');
				redirect('update_info');
			}
			else
			{
				//buatlog
				$info='applog'; 
				$datalog = array(
				'username'=>$this->session->userdata('USERNAME'),
				'berita'=>'data info gagal ditambahkan',  
				);  
				$dlog=array_merge($datalog,$data);
				$this->model_log->logAction($info,$dlog); 
				//buatlog

				$this->session->set_flashdata('notif-gagal','Data gagal ditambahkan');
				redirect('update_info');
			}
		}
	}
    
	//UPDATE INFO
    function update_info(){
		if ($this->session->userdata('ID') == '3') {   
			$field_key['id_info'] = $this->input->post('id_info'); 
			$data['isi_info'] = $this->input->post('isi_info'); 
			$data['isactive'] = $this->input->post('isactive');
			$data['edit_date'] = date('Y-m-d H:i:s');   
			$table="tbl_minfo";
			$proses=$this->model_app->updateData($table,$data,$field_key);
			if ($proses == TRUE)
			{	
				//buatlog
				$info='applog'; 
				$datalog = array(
				'username'=>$this->session->userdata('USERNAME'),
				'berita'=>'data info berhasil dirubah',  
				);  
				$dlog=array_merge($datalog,$data);
				$this->model_log->logAction($info,$dlog); 
				//buatlog

				$this->session->set_flashdata('notif-sukses','Data berhasil dirubah');
				redirect('update_info');
			}
			else
			{
				//buatlog
				$info='applog'; 
				$datalog = array(
				'username'=>$this->session->userdata('USERNAME'),
				'berita'=>'data info gagal dirubah',  
				);  
				$dlog=array_merge($datalog,$data);
				$this->model_log->logAction($info,$dlog); 
				//buatlog

				$this->session->set_flashdata('notif-gagal','Data gagal dirubah');
				redirect('update_info');
			}
		}
	}

}
