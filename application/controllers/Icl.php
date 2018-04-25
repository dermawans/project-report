<?php
class Icl extends CI_Controller{
    function __construct(){
        parent::__construct();
        if($this->session->userdata('login_status') != TRUE ){
            $this->session->set_flashdata('notif','LOGIN GAGAL USERNAME ATAU PASSWORD ANDA SALAH !');
            redirect(''); 
        };
        $this->load->model('model_app');   
		$this->load->library('email');
		
		if($this->session->userdata('ROLEID') == '3') {  
	
			redirect('dashboard');
		}
    }


    function index(){
		if($this->session->userdata('ROLEID') == '2' or $this->session->userdata('ROLEID') == '4' or $this->session->userdata('ROLEID') == '5'  or $this->session->userdata('ROLEID') == '6') {  
			$data=array(
			'data_icl'=>$this->model_app->getAllDataIcl() ,
            'kd_icl'=>$this->model_app->getKDIcl(),
            'data_master_pmo'=>$this->model_app->getAllDataPMO(),
            'data_master_qt'=>$this->model_app->getAllDataQT(),
            'data_user_pmo'=>$this->model_app->getAllDataPMO()
			);
		}
		if($this->session->userdata('ROLEID') == '1') {  
			$data=array(
			'data_icl'=>$this->model_app->getAllDataIclPerQT(),
            'kd_icl'=>$this->model_app->getKDIcl()
			);
		}   
		  
		$data_header=array(
            'title'=>'ICL Production',
            'active_icl'=>'active',
			'data_grafikstatus'=>$this->model_app->getDataGrafikstatus(),
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
            'jumlah_allproject_kordinator' => $this->model_app->getCountAllProjectKordinator()->num_rows()
			 );  
			 
		//buatlog
		$info='applog'; 
		$datalog = array(
		'username'=>$this->session->userdata('USERNAME'),
		'berita'=>'masuk halaman icl', 
		);   
		$this->model_log->logAction($info,$datalog); 
		//buatlog

        $this->load->view('element/v_header',$data_header);
        $this->load->view('pages/v_icl',$data);
        $this->load->view('element/v_footer');

        $this->session->unset_userdata('limit_add_cart');
        $this->cart->destroy();
		
	}  
	
	//INSERT NEW DATA ICL
    function add_icl(){
		if ($this->session->userdata('ROLEID') == '2' or $this->session->userdata('ROLEID') == '6') { 
		
			$core_icl['kd_icl'] = $this->input->post('kd_icl');
			$core_icl['projectname'] = $this->input->post('projectname');
			$core_icl['create_by'] = $this->input->post('create_by');
			$core_icl['create_date'] = date('Y-m-d H:i:s');
			$table="core_icl";
			$this->model_app->insertData($table,$core_icl);
			   
			$data['kd_icl'] = $this->input->post('kd_icl');
			$data['id_pmoname'] = $this->input->post('id_pmoname');
			$data['id_qtname'] = $this->input->post('id_qtname');
			$data['status_icl'] = $this->input->post('status_icl'); 
			$data['priority'] = $this->input->post('priority');
			$data['st_awal'] = $this->input->post('st_awal');
			$data['st_akhir'] = $this->input->post('st_akhir');
			$data['description'] = $this->input->post('description');
			$data['isactive'] = '1'; 
			$data['create_by'] = $this->input->post('create_by');
			$data['create_date'] = date('Y-m-d H:i:s');
			
			//fungsi upload file 
			
			$nmfile = $this->input->post('kd_icl')."-".$this->input->post('projectname')."-ICL-".date('Y-m-d H:i:s');  
			$config['upload_path'] = 'assets/file-project/'; 
			$config['allowed_types'] = 'zip'; 
			$config['max_size'] = 10024;  
	 		$config['file_name'] = $nmfile; 
	 		 
			$this->upload->initialize($config);
 
			if ($_FILES['fileupload']['size'] > 0)
			{

				if ($this->upload->do_upload('fileupload'))
				{  
					//buatlog
					$info='applog'; 
					$datalog = array(
					'username'=>$this->session->userdata('USERNAME'),
					'berita'=>'upload file berhasil', 
					);  
					$dlog=array_merge($datalog,$data);
					$this->model_log->logAction($info,$dlog); 
					//buatlog

					$fileicl = $this->upload->data();
					$data['file_icl'] = $fileicl['file_name'];;
					$this->session->set_flashdata('notif-upload-sukses','File sukses diupload'); 
				}
				else
				{
					//buatlog
					$info='applog'; 
					$datalog = array(
					'username'=>$this->session->userdata('USERNAME'),
					'berita'=>'upload file gagal', 
					);  
					$dlog=array_merge($datalog,$data);
					$this->model_log->logAction($info,$dlog); 
					//buatlog

					$data['file_icl'] = NULL;
					$this->session->set_flashdata('notif-upload-gagal','File gagal diupload'); 
				}					
				
			}
			else
			{
				$data['file_icl'] = NULL;
			}
       		//fungsi upload file
			
			$table="iclhistory";
			$proses=$this->model_app->insertData($table,$data);
  
			if ($proses == TRUE)
			{
				//buatlog
				$info='applog'; 
				$datalog = array(
				'username'=>$this->session->userdata('USERNAME'),
				'berita'=>'icl berhasil ditambah', 
				);  
				$dlog=array_merge($datalog,$data);
				$this->model_log->logAction($info,$dlog); 
				//buatlog

				$this->session->set_flashdata('notif-sukses','Data berhasil ditambahkan');
				redirect('icl');
			}
			else
			{
				//buatlog
				$info='applog'; 
				$datalog = array(
				'username'=>$this->session->userdata('USERNAME'),
				'berita'=>'icl gagal ditambah', 
				);  
				$dlog=array_merge($datalog,$data);
				$this->model_log->logAction($info,$dlog); 
				//buatlog

				$this->session->set_flashdata('notif-gagal','Data gagal ditambahkan');
				redirect('icl');
			}
		}
	}
  
	
	//VIEW ICL
    function view_icl(){  
		if($this->session->userdata('ROLEID') == '2' or $this->session->userdata('ROLEID') == '4' or $this->session->userdata('ROLEID') == '5' or $this->session->userdata('ROLEID') == '6') {  
			$data=array(
			'data_icl'=>$this->model_app->getDataIclForCoordinator(),  
            'iclallhistorydescription'=>$this->model_app->getDataIclAllHistoryDescription() 
			);
		}
		if($this->session->userdata('ROLEID') == '1') {  
			$data=array(
			'data_icl'=>$this->model_app->getDataIclForQT() ,
            'iclallhistorydescription'=>$this->model_app->getDataIclAllHistoryDescription()
			);
		} 
		$data_header=array(
            'title'=>'ICL Production',
            'active_icl'=>'active',
			'data_grafikstatus'=>$this->model_app->getDataGrafikstatus(),
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
            'jumlah_allproject_kordinator' => $this->model_app->getCountAllProjectKordinator()->num_rows()
			 ); 
		  
		//buatlog
		$info='applog'; 
		$datalog = array(
		'username'=>$this->session->userdata('USERNAME'),
		'berita'=>'masuk halaman view icl', 
		);   
		$this->model_log->logAction($info,$datalog); 
		//buatlog

        $this->load->view('element/v_header',$data_header);
        $this->load->view('pages/v_view_icl',$data);
        $this->load->view('element/v_footer');
 
    }

	
	//UPDATE ICL
    function update_icl(){   
		if($this->session->userdata('ROLEID') == '2' or $this->session->userdata('ROLEID') == '6') {  
			$data=array(
			'data_icl'=>$this->model_app->getDataIclForCoordinator(),  
            'iclallhistorydescription'=>$this->model_app->getDataIclAllHistoryDescription(),
            'laststatusiclhistory'=>$this->model_app->getLastStatusIclHistory(),
            'data_master_qt'=>$this->model_app->getAllDataQT(),
            'data_master_pmo'=>$this->model_app->getAllDataPMO(),
            'data_user_pmo'=>$this->model_app->getUserDataPMO(),
            'data_master_status'=>$this->model_app->getAllData('mstatus_project'),
			);
		}
		if($this->session->userdata('ROLEID') == '1') {  
			$data=array(
			'data_icl'=>$this->model_app->getDataIclForQT() ,
            'iclallhistorydescription'=>$this->model_app->getDataIclAllHistoryDescription(),
            'laststatusiclhistory'=>$this->model_app->getLastStatusIclHistory(),
            'data_master_status'=>$this->model_app->getAllData('mstatus_project'),
			);
		} 
		
		$data_header=array(
            'title'=>'ICL Production',
            'active_icl'=>'active',
			'data_grafikstatus'=>$this->model_app->getDataGrafikstatus(),
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
            'jumlah_allproject_kordinator' => $this->model_app->getCountAllProjectKordinator()->num_rows()
			 ); 
			 
		//buatlog
		$info='applog'; 
		$datalog = array(
		'username'=>$this->session->userdata('USERNAME'),
		'berita'=>'masuk halaman update icl', 
		);   
		$this->model_log->logAction($info,$datalog); 
		//buatlog

        $this->load->view('element/v_header',$data_header);
        $this->load->view('pages/v_update_icl',$data);
        $this->load->view('element/v_footer');
 
    }

	
	//INSERT QT UPDATE ICL
    function icl_update(){
		if ($this->session->userdata('ROLEID') == '2' or $this->session->userdata('ROLEID') == '1'  or $this->session->userdata('ROLEID') == '6') {  
 
			$updatehistory['isactive'] = '0'; 
			$this->db->where('id_icl_history',$this->input->post('id_icl_history'));
			$this->db->update('iclhistory', $updatehistory);
			  
			$data['kd_icl'] = $this->input->post('kd_icl');
			$data['id_qtname'] = $this->input->post('id_qtname');
			$data['id_pmoname'] = $this->input->post('id_pmoname');
			$data['status_icl'] = $this->input->post('status_icl'); 
			$data['priority'] = $this->input->post('priority');
			$data['st_awal'] = $this->input->post('st_awal');
			$data['st_akhir'] = $this->input->post('st_akhir');
			$data['description'] = $this->input->post('description'); 
			$data['isactive'] = '1';
			$data['create_date'] = date('Y-m-d H:i:s'); 
			$data['create_by'] = $this->input->post('create_by');
			//fungsi upload file 
			 
			$nmfileQT = $this->input->post('kd_icl')."-".$this->input->post('projectname')."-Feedback_QT_ICL-".date('Y-m-d H:i:s');  
			$configQT['allowed_types'] = 'zip';  
			$configQT['max_size'] = 10024; 
			$configQT['upload_path'] = 'assets/file-project/'; 
			$configQT['file_name'] = $nmfileQT; 
	 		   
			$this->upload->initialize($configQT);
			if ($_FILES['fileupload']['size'] > 0)
			{

				if ($this->upload->do_upload('fileupload'))
				{  
					//buatlog
					$info='applog'; 
					$datalog = array(
					'username'=>$this->session->userdata('USERNAME'),
					'berita'=>'upload file sukses', 
					);  
					$dlog=array_merge($datalog,$data);
					$this->model_log->logAction($info,$dlog); 
					//buatlog

					$fileicl= $this->upload->data();
					$data['file_icl'] = $fileicl['file_name'];;
					$this->session->set_flashdata('notif-upload-sukses','File sukses diupload'); 
				}
				else
				{
					//buatlog
					$info='applog'; 
					$datalog = array(
					'username'=>$this->session->userdata('USERNAME'),
					'berita'=>'upload file gagal', 
					);  
					$dlog=array_merge($datalog,$data);
					$this->model_log->logAction($info,$dlog); 
					//buatlog

					$data['file_icl'] = NULL;
					$this->session->set_flashdata('notif-upload-gagal','File gagal diupload'); 
				}					
				
			}
			else
			{
				$data['file_icl'] = NULL;
			}
       		//fungsi upload file
			$table="iclhistory";
			$proses=$this->model_app->insertData($table,$data);
			if ($proses == TRUE)
			{
				//buatlog
				$info='applog'; 
				$datalog = array(
				'username'=>$this->session->userdata('USERNAME'),
				'berita'=>'icl berhasil diupdate', 
				);  
				$dlog=array_merge($datalog,$data);
				$this->model_log->logAction($info,$dlog); 
				//buatlog

				$this->session->set_flashdata('notif-sukses','Update berhasil ditambahkan');
				redirect('icl');
			}
			else
			{
				//buatlog
				$info='applog'; 
				$datalog = array(
				'username'=>$this->session->userdata('USERNAME'),
				'berita'=>'icl gagal diupdate', 
				);  
				$dlog=array_merge($datalog,$data);
				$this->model_log->logAction($info,$dlog); 
				//buatlog

				$this->session->set_flashdata('notif-gagal','Update gagal ditambahkan');
				redirect('icl');
			}
		}
	}


	//INACTIVE ICL 
    function inactive_icl(){
		if($this->session->userdata('ROLEID') == '2' or $this->session->userdata('ROLEID') == '4' or $this->session->userdata('ROLEID') == '5'  or $this->session->userdata('ROLEID') == '6') {  
			$data=array(
			'data_icl'=>$this->model_app->getAllDataInactiveIcl() , 
            'data_master_pmo'=>$this->model_app->getAllDataPMO(),
            'data_user_pmo'=>$this->model_app->getAllDataPMO()
			);
		}
		if($this->session->userdata('ROLEID') == '1') {  
			$data=array(
			'data_icl'=>$this->model_app->getAllDataInactiveIclPerQT()
			);
		} 
		  
		$data_header=array(
            'title'=>'ICL Project',
            'active_icl'=>'active',
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
            'jumlah_allproject_kordinator' => $this->model_app->getCountAllProjectKordinator()->num_rows()
			 ); 
 
		 //buatlog
		$info='applog'; 
		$datalog = array(
		'username'=>$this->session->userdata('USERNAME'),
		'berita'=>'masuk halaman view inactive icl', 
		);   
		$this->model_log->logAction($info,$datalog); 
		//buatlog

        $this->load->view('element/v_header',$data_header);
        $this->load->view('pages/v_inactive_icl',$data);
        $this->load->view('element/v_footer');

        $this->session->unset_userdata('limit_add_cart');
        $this->cart->destroy();
		
	}  
	//INACTIVE ICL
	


}
