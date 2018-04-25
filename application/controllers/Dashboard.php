<?php
class Dashboard extends CI_Controller{
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
		$data_header=array(
            'title'=>'Dashboard',
            'active_dashboard'=>'active', 
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
            'jumlah_icl_open_qt' => $this->model_app->getCountOpenIclQT()->num_rows()
        ); 
		
		$data=array(
            'data_grafiknamaQT'=>$this->model_app->getDataGrafiknamaQT(),
			'data_grafiknamaPMO'=>$this->model_app->getDataGrafiknamaPMO(),
			'data_grafikstatus'=>$this->model_app->getDataGrafikstatus(),
			'data_grafik'=>$this->model_app->getDataGrafik()
		);

		$data_footer=array( 
			'data_grafikstatus'=>$this->model_app->getDataGrafikstatus(),
			'data_hari_sudah_berjalan'=>$this->model_app->getDataHariSudahBerjalan()
		);
		 
	 	//buatlog
		$info='applog';
		$datalog = array(
		'username'=>$this->session->userdata('USERNAME'),
		'berita'=>'masuk ke halaman dashboard');
		$this->model_log->logAction($info,$datalog); 
		//buatlog			
		
        $this->load->view('element/v_header',$data_header);
        $this->load->view('pages/v_dashboard',$data);
        $this->load->view('element/v_footer',$data_footer);
    	
		 
	}
		
}
