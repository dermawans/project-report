<?php 

class Model_app extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    //  ================= AUTOMATIC CODE ==================
	
	// Bagian Login	=================	
	function login($username, $password) {
        //create query to connect user login database
        $this->db->select('*');
        $this->db->from('webuser');
        $this->db->where('username', $username);
        $this->db->where('pwd', MD5($password));
        $this->db->limit(1);
		
        //get query and processing
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            return $query->result(); //if data is true
        } else {
            return false; //if data is wrong
        }
    }
	// Bagian Login	=================
	
	//function update status project saat end date sama dengan hari ini
	function updateStatusproject(){ 
		$this->db->query("update projecthistory SET status_project='1' where status_project='Expired'");	
		$this->db->query("update pj_summary SET status_project='1' where status_project='Expired'");
		return true;	

	}	


	// Untuk Dipakai Semua Bagian =================
	public function getAllData($table)
    {
        return $this->db->get($table)->result();
    }
	
	public function getSelectedData($table,$data)
    {
        return $this->db->get_where($table, $data);
    }
	
	function insertData($table,$data)
    {
        $query=$this->db->insert($table,$data);
        if($query) {
            return TRUE; //if query is true
        } else {
            return FALSE; //if query is wrong
        }
	} 
	
    function updateData($table,$data,$field_key)
    {
        $query=$this->db->update($table,$data,$field_key);
        if($query) {
            return TRUE; //if query is true
        } else {
            return FALSE; //if query is wrong
        }
    }
    
	// Untuk Dipakai Semua Bagian =================
	
	// Bagian Dashboard 
		function getCountAktifProjectQT(){
			$id_user = $this->session->userdata('ID'); 
			return $this->db->query("select id_history from projecthistory where isactive=1 and status_project not in ('12','9','1','4','8') and id_qtname='".$id_user."'
			");	
		}
		function getCountAktifProjectPMO(){
			$id_user = $this->session->userdata('ID'); 
			return $this->db->query("select id_history from projecthistory where isactive=1 and status_project not in ('12','9','1','4','8') and id_pmoname='".$id_user."'
			");	
		} 
		function getCountAllAktifProject(){
			return $this->db->query("select id_history from projecthistory where isactive=1 and status_project not in('12','9','1','4','8')
			");	
		} 
		
		function getCountNewProjectQT(){
			$id_user = $this->session->userdata('ID'); 
			return $this->db->query("select id_history from projecthistory where isactive=1 and status_project='8' and id_qtname='".$id_user."'
			");	
		} 
		function getCountNewProjectPMO(){
			$id_user = $this->session->userdata('ID'); 
			return $this->db->query("select id_history from projecthistory where isactive=1 and status_project='8' and id_pmoname='".$id_user."'
			");	
		} 
		function getCountNewProjectPMOKordinator(){ 
			return $this->db->query("select id_history from projecthistory where isactive=1 and status_project='8'
			");	
		}
		function getCountNewProject(){
			return $this->db->query("select id_history from projecthistory where isactive=1 and status_project='8'
			");	
		}

		function getCountExpiredProjectQT(){
			$id_user = $this->session->userdata('ID'); 
			return $this->db->query("select id_history from projecthistory where isactive=1 and status_project='1' and id_qtname='".$id_user."'
			");	
		}
		function getCountExpiredProjectPMO(){
			$id_user = $this->session->userdata('ID'); 
			return $this->db->query("select id_history from projecthistory where isactive=1 and status_project='1' and id_pmoname='".$id_user."'
			");	
		}
		function getCountAllExpiredProject(){
			return $this->db->query("select id_history from projecthistory where isactive=1 and status_project='1'
			");	
		} 
		
		function getCountAllprojectQT(){
			$id_user = $this->session->userdata('ID'); 
			return $this->db->query("select id_history from projecthistory where isactive=1 and id_qtname='".$id_user."'
			");	
		}
		function getCountAllprojectPMO(){
			$id_user = $this->session->userdata('ID'); 
			return $this->db->query("select id_history from projecthistory where isactive=1 and id_pmoname='".$id_user."'
			");	
		}
		function getCountAllProjectKordinator(){
			return $this->db->query("select id_history from projecthistory where isactive=1 
			");	
		} 
		  

		function getCountInActiveProjectQT(){
			$id_user = $this->session->userdata('ID'); 
			return $this->db->query("select id_history from projecthistory where isactive=1 and status_project in ('12','9','4') and id_qtname='".$id_user."'
			");	
		}
		function getCountInActiveProjectPMO(){
			$id_user = $this->session->userdata('ID'); 
			return $this->db->query("select id_history from projecthistory where isactive=1 and status_project in ('12','9','4') and id_pmoname='".$id_user."'
			");	
		} 
		function getCountAllInActiveProject(){
			return $this->db->query("select id_history from projecthistory where isactive=1 and status_project in('12','9','4')
			");	
		}   
		
		function getDataGrafik(){ 
			return $this->db->query("select nama_qt,status_project,jumlah from pj_summary group by status_project,nama_qt")->result();
		} 
		
		function getDataGrafiknamaQT(){ 
			return $this->db->query("SELECT nama_qt, DATE_FORMAT(pj_summary.datecreated, '%Y-%m-%d') FROM pj_summary WHERE DATE(datecreated) = CURDATE() AND role_id in ('1','2') group by nama_qt ")->result();
		} 

		function getDataGrafiknamaPMO(){ 
			return $this->db->query("SELECT nama_qt, DATE_FORMAT(pj_summary.datecreated, '%Y-%m-%d') FROM pj_summary WHERE DATE(datecreated) = CURDATE() AND role_id in ('3','4') group by nama_qt ")->result();
		} 
		
		function getDataGrafikstatus(){ 
			return $this->db->query("SELECT a.status_project, DATE_FORMAT(a.datecreated, '%Y-%m-%d'),b.nama_status_project FROM pj_summary a left join mstatus_project b on a.status_project=b.id_status_project WHERE DATE(a.datecreated) = CURDATE() group by a.status_project ")->result();
		} 
		
		function getCountOpenIclQT(){
			$id_user = $this->session->userdata('ID'); 
			return $this->db->query("select id_icl_history from iclhistory where isactive=1 and status_icl<>'12' and id_qtname='".$id_user."'
			");	
		} 
		function getCountAllOpenIcl(){
			return $this->db->query("select id_icl_history from iclhistory where isactive=1 and status_icl<>'12'
			");	
		} 
		
		function getDataHariSudahBerjalan(){
		return $this->db->query("		
			select distinct
			a.kd_project, a.projectname,
			b.st_awal, b.st_akhir,datediff(current_date(), b.st_awal) as jumlah_hari_berjalan
				from  
				core_project a 
				left join projecthistory b on a.kd_project=b.kd_project
				left join webuser c on b.id_qtname=c.id_name
				left join webuser d on b.id_pmoname=d.id_name
				left join mpriority_project e on b.priority=e.id_priority_project
				left join mstatus_project f on b.status_project=f.id_status_project
				where b.isactive=1 and status_project not in ('12','9','4') 
				order by jumlah_hari_berjalan asc
		")->result();	
		} 
	// Bagian Dashboard
	
	//Bagian Project
	function updateViewQT(){
		$kd_project = array();
		$kd_project = $this->uri->segment(3);
		$id_qtname = $this->session->userdata('ID'); 
        return $this->db->query("
        update projecthistory set isread_by_qt=1 where kd_project='".$kd_project."' and id_qtname='".$id_qtname."'
		");
    }	

	function updateViewQTNewProject(){
		$kd_project = array();
		$kd_project = $this->uri->segment(3);
		$id_qtname = $this->session->userdata('ID'); 
        return $this->db->query("
        update projecthistory set isread_by_qt=1 where kd_project='".$kd_project."'
		");
    }	

		function updateViewPMO(){
		$kd_project = array();
		$kd_project = $this->uri->segment(3);
		$id_pmoname = $this->session->userdata('ID'); 
        return $this->db->query("
        update projecthistory set isread_by_pmo=1 where kd_project='".$kd_project."' and id_pmoname='".$id_pmoname."'
		");
    }

	function getAllDataPMO(){ 
		return $this->db->query("select * from webuser where roleid='3' or roleid='4'")->result();
    } 
	 
	function getUserDataPMO(){ 
		$id_pmo = $this->session->userdata('ID'); 
		return $this->db->query("select * from webuser where id_name='".$id_pmo."'")->result();
    } 
	
	function getAllDataQT(){ 
		return $this->db->query("select * from webuser where roleid='1' or roleid='2'")->result();
    } 
    
	public function getKDProject()
		{
		    $q = $this->db->query("select MAX(RIGHT(kd_project,9)) as kd_max from core_project");
		    $kd = "";
		    if($q->num_rows()>0)
		    {
		        foreach($q->result() as $k)
		        {
		            $tmp = ((int)$k->kd_max)+1;
		            $kd = sprintf("%09s", $tmp);
		        }
		    }
		    else
		    {
		        $kd = "000000001";
		    }
		    return "P".$kd;
		} 
	 

    function getAllDataProject(){
			return $this->db->query("
			select distinct
			a.kd_project, a.projectname, a.create_date, 
			b.id_history,b.id_qtname,b.id_pmoname,b.status_project,b.st_awal,b.st_akhir,b.description,b.file_project,b.priority,
			c.username as qtname,
			d.username as pmoname,
			e.nama_priority_project,
			f.nama_status_project
				from  
				core_project a 
				left join projecthistory b on a.kd_project=b.kd_project
				left join webuser c on b.id_qtname=c.id_name
				left join webuser d on b.id_pmoname=d.id_name
				left join mpriority_project e on b.priority=e.id_priority_project
				left join mstatus_project f on b.status_project=f.id_status_project
				where b.isactive=1 and status_project not in ('12','9','4') 
				order by a.create_date desc
		")->result();
    }

    function getAllDataProjectPerQT(){
		$id_qtname = $this->session->userdata('ID'); 
        return $this->db->query("
        select distinct
		a.kd_project, a.projectname, a.create_date, 
		b.id_history,b.id_qtname,b.id_pmoname,b.status_project,b.st_awal,b.st_akhir,b.description,b.file_project,b.priority,
		c.username as qtname,
		d.username as pmoname,
		e.nama_priority_project,
		f.nama_status_project
			from core_project a 
			left join projecthistory b on a.kd_project=b.kd_project
			left join webuser c on b.id_qtname=c.id_name
			left join webuser d on b.id_pmoname=d.id_name
			left join mpriority_project e on b.priority=e.id_priority_project
			left join mstatus_project f on b.status_project=f.id_status_project
			where b.isactive=1 and b.id_qtname= '".$id_qtname."'  and status_project not in ('12','9','4') 
			order by a.create_date desc
		")->result();
    }

	 function getAllDataProjectPerTL(){ 
		    return $this->db->query("
		    select distinct
			a.kd_project, a.projectname, a.create_date, 
			b.id_history,b.id_qtname,b.id_pmoname,b.status_project,b.st_awal,b.st_akhir,b.description,b.file_project,b.priority,
			c.username as qtname,
			d.username as pmoname,
			e.nama_priority_project,
			f.nama_status_project
				from core_project a 
				left join projecthistory b on a.kd_project=b.kd_project
				left join webuser c on b.id_qtname=c.id_name
				left join webuser d on b.id_pmoname=d.id_name
				left join mpriority_project e on b.priority=e.id_priority_project
				left join mstatus_project f on b.status_project=f.id_status_project
				where b.isactive=1 and status_project='4' 
				order by a.create_date desc
			")->result();
		}
    
    function getAllDataProjectPerQTReport(){
		$id_qtname = $this->session->userdata('ID'); 
        return $this->db->query("
        select distinct
		a.kd_project, a.projectname, a.create_date, 
		b.id_history,b.id_qtname,b.id_pmoname,b.status_project,b.st_awal,b.st_akhir,b.description,b.file_project,b.priority,
		c.username as qtname,
		d.username as pmoname,
		e.nama_priority_project,
		f.nama_status_project
			from core_project a 
			left join projecthistory b on a.kd_project=b.kd_project
			left join webuser c on b.id_qtname=c.id_name
			left join webuser d on b.id_pmoname=d.id_name
			left join mpriority_project e on b.priority=e.id_priority_project
			left join mstatus_project f on b.status_project=f.id_status_project
			where b.isactive=1 and b.id_qtname= '".$id_qtname."'  and status_project not in ('12','9') 
			order by a.create_date desc
		")->result();
    }

    function getAllDataProjectPerPMO(){
		$id_pmoname = $this->session->userdata('ID'); 
        return $this->db->query("
        select distinct
		a.kd_project, a.projectname, a.create_date, 
		b.id_history,b.id_qtname,b.id_pmoname,b.status_project,b.st_awal,b.st_akhir,b.description,b.file_project,b.priority,
		c.username as qtname,
		d.username as pmoname,
		e.nama_priority_project,
		f.nama_status_project
			from core_project a 
			left join projecthistory b on a.kd_project=b.kd_project
			left join webuser c on b.id_qtname=c.id_name
			left join webuser d on b.id_pmoname=d.id_name
			left join mpriority_project e on b.priority=e.id_priority_project
			left join mstatus_project f on b.status_project=f.id_status_project
			where b.isactive=1 and b.id_pmoname= '".$id_pmoname."'  and status_project not in ('12','9','4') 
			order by a.create_date desc
		")->result();
    }
	
	
    function getAllDataInactiveProject(){
			return $this->db->query("
			select distinct
			a.kd_project, a.projectname, a.create_date, 
			b.id_history,b.id_qtname,b.id_pmoname,b.status_project,b.st_awal,b.st_akhir,b.description,b.file_project,b.priority,
			c.username as qtname,
			d.username as pmoname,
			e.nama_priority_project,
			f.nama_status_project
				from  
				core_project a 
				left join projecthistory b on a.kd_project=b.kd_project
				left join webuser c on b.id_qtname=c.id_name
				left join webuser d on b.id_pmoname=d.id_name
				left join mpriority_project e on b.priority=e.id_priority_project
				left join mstatus_project f on b.status_project=f.id_status_project
				where b.isactive=1 and status_project in ('12','9','4') 
				order by a.create_date desc
		")->result();
    }

    function getAllDataInactiveProjectPerQT(){
		$id_qtname = $this->session->userdata('ID'); 
        return $this->db->query("
        select distinct
		a.kd_project, a.projectname, a.create_date, 
		b.id_history,b.id_qtname,b.id_pmoname,b.status_project,b.st_awal,b.st_akhir,b.description,b.file_project,b.priority,
		c.username as qtname,
		d.username as pmoname,
		e.nama_priority_project,
		f.nama_status_project
			from core_project a 
			left join projecthistory b on a.kd_project=b.kd_project
			left join webuser c on b.id_qtname=c.id_name
			left join webuser d on b.id_pmoname=d.id_name
			left join mpriority_project e on b.priority=e.id_priority_project
			left join mstatus_project f on b.status_project=f.id_status_project
			where b.isactive=1 and b.id_qtname= '".$id_qtname."' and status_project in ('12','9','4') 
			order by a.create_date desc
		")->result();
    }

    function getAllDataInactiveProjectPerPMO(){
		$id_pmoname = $this->session->userdata('ID'); 
        return $this->db->query("
        select distinct
		a.kd_project, a.projectname, a.create_date, 
		b.id_history,b.id_qtname,b.id_pmoname,b.status_project,b.st_awal,b.st_akhir,b.description,b.file_project,b.priority,
		c.username as qtname,
		d.username as pmoname,
		e.nama_priority_project,
		f.nama_status_project
			from core_project a 
			left join projecthistory b on a.kd_project=b.kd_project
			left join webuser c on b.id_qtname=c.id_name
			left join webuser d on b.id_pmoname=d.id_name
			left join mpriority_project e on b.priority=e.id_priority_project
			left join mstatus_project f on b.status_project=f.id_status_project
			where b.isactive=1 and b.id_pmoname= '".$id_pmoname."' and status_project in ('12','9','4') 
			order by a.create_date desc
		")->result();
    }

	function getDataProjectForCoordinator(){
		$kd_project = array();
		$kd_project = $this->uri->segment(3);
        return $this->db->query("
        select distinct
		a.kd_project, a.projectname, a.create_date, 
		b.id_history,b.id_qtname,b.id_pmoname,b.status_project,b.st_awal,b.st_akhir,b.description,b.file_project,b.priority,
		c.username as qtname,
		d.username as pmoname,
		e.nama_priority_project,
		f.nama_status_project
			from core_project a 
			left join projecthistory b on a.kd_project=b.kd_project
			left join webuser c on b.id_qtname=c.id_name
			left join webuser d on b.id_pmoname=d.id_name
			left join mpriority_project e on b.priority=e.id_priority_project
			left join mstatus_project f on b.status_project=f.id_status_project
			where b.isactive=1 and a.kd_project='".$kd_project."'
			order by a.create_date desc
		")->result();
    }	

	function getDataProjectForQT(){
		$kd_project = array();
		$kd_project = $this->uri->segment(3);
		$id_qtname = array();
		$id_qtname = $this->session->userdata('ID');
        return $this->db->query("
        select distinct
		a.kd_project, a.projectname, a.create_date, 
		b.id_history,b.id_qtname,b.id_pmoname,b.status_project,b.st_awal,b.st_akhir,b.description,b.file_project,b.priority,
		c.username as qtname,
		d.username as pmoname,
		e.nama_priority_project,
		f.nama_status_project
			from core_project a 
			left join projecthistory b on a.kd_project=b.kd_project
			left join webuser c on b.id_qtname=c.id_name
			left join webuser d on b.id_pmoname=d.id_name
			left join mpriority_project e on b.priority=e.id_priority_project
			left join mstatus_project f on b.status_project=f.id_status_project
			where b.isactive=1 and a.kd_project='".$kd_project."' and b.id_qtname='".$id_qtname."'
			order by a.create_date desc
		")->result();
    }
    
    function getDataProjectForPMO(){
		$kd_project = array();
		$kd_project = $this->uri->segment(3);
		$id_pmoname = array();
		$id_pmoname = $this->session->userdata('ID');
        return $this->db->query("
        select distinct
		a.kd_project, a.projectname, a.create_date, 
		b.id_history,b.id_qtname,b.id_pmoname,b.status_project,b.st_awal,b.st_akhir,b.description,b.file_project,b.priority,
		c.username as qtname,
		d.username as pmoname,
		e.nama_priority_project,
		f.nama_status_project
			from core_project a 
			left join projecthistory b on a.kd_project=b.kd_project
			left join webuser c on b.id_qtname=c.id_name
			left join webuser d on b.id_pmoname=d.id_name
			left join mpriority_project e on b.priority=e.id_priority_project
			left join mstatus_project f on b.status_project=f.id_status_project
			where b.isactive=1 and a.kd_project='".$kd_project."' and b.id_pmoname='".$id_pmoname."'
			order by a.create_date desc
		")->result();
    }

	function getDataProjectAllHistoryDescription(){
		$kd_project = array();
		$kd_project = $this->uri->segment(3);
		return $this->db->query("
			select distinct
 			a.id_history,a.status_project,a.create_date,a.description,a.file_project, a.priority,
			d.username as creator,
			e.nama_priority_project,
			f.nama_status_project
			from projecthistory a left join webuser b on a.id_pmoname=b.id_name
			left join webuser c on a.id_qtname=c.id_name
			left join webuser d on a.create_by=d.id_name
			left join mpriority_project e on a.priority=e.id_priority_project
			left join mstatus_project f on a.status_project=f.id_status_project
			where a.kd_project='".$kd_project."' order by a.id_history desc")->result();
    } 
	
	function getDataProjectAllHistoryTLDescription(){
			$kd_project = array();
			$kd_project = $this->uri->segment(3);
			return $this->db->query("
				select distinct
	 			a.id_history,a.status_project,a.create_date,a.description,a.file_project, a.priority,
				d.username as creator,
				e.nama_priority_project,
				f.nama_status_project
				from projecthistory a left join webuser b on a.id_pmoname=b.id_name
				left join webuser c on a.id_qtname=c.id_name
				left join webuser d on a.create_by=d.id_name
				left join mpriority_project e on a.priority=e.id_priority_project
				left join mstatus_project f on a.status_project=f.id_status_project
				where a.kd_project='".$kd_project."' order by a.id_history desc")->result();
		} 

	function getLastStatusProjectHistory(){
		$kd_project = array();
		$kd_project = $this->uri->segment(3);
		return $this->db->query("
		select 
		a.description,a.status_project,a.file_project,a.priority,a.st_akhir,
		b.nama_priority_project,
		c.nama_status_project 
		from projecthistory a		
		left join mpriority_project b on a.priority=b.id_priority_project
		left join mstatus_project c on a.status_project=c.id_status_project
		where kd_project='".$kd_project."' and isactive= '1'
		")->result();
    } 

	
	function getLastStatusProjectTLHistory(){
		$kd_project = array();
		$kd_project = $this->uri->segment(3);
		return $this->db->query("
		select 
		a.description,a.status_project,a.file_project,a.priority,a.st_akhir,
		b.nama_priority_project,
		c.nama_status_project 
		from projecthistory a		
		left join mpriority_project b on a.priority=b.id_priority_project
		left join mstatus_project c on a.status_project=c.id_status_project
		where kd_project='".$kd_project."' and isactive= '1'
		")->result();
    } 
 
	function getDataStatusPMO(){
		return $this->db->query("select * from mstatus_project where grup_status='02'
		")->result();	
    }
 	 
	function getDataStatusQT(){
		return $this->db->query("select * from mstatus_project where grup_status='01'
		")->result();	
    }

	//Bagian Project
	
	//Bagian Users =================
	 
	function getDataRole(){
		return $this->db->query("select * from webrole
		")->result();	
    }
	function getDataRolePMO(){
		return $this->db->query("select * from webrole where roleid in ('3','4')
		")->result();	
    }
    
	function getDataRoleQT(){
		return $this->db->query("select * from webrole where roleid in ('1','2')
		")->result();	
    }
    
	function getDataPMO(){
		return $this->db->query("
		select a.rolename,
		b.id_name,b.username,b.pwd
		from webrole a left join webuser b on a.roleid=b.roleid
		where b.roleid in('3','4')
		order by b.id_name asc
		")->result();	
    }
    
	function getDataQT(){
		return $this->db->query("
		select a.rolename,
		b.id_name,b.username,b.pwd
		from webrole a left join webuser b on a.roleid=b.roleid
		where b.roleid in('1','2')
		order by b.id_name asc
		")->result();	
    }
    
	function getDataUser(){
		$id_user = $this->session->userdata('ID'); 
		return $this->db->query("
		select a.rolename,
		b.id_name,b.username,b.pwd
		from webrole a left join webuser b on a.roleid=b.roleid
		where b.id_name = '".$id_user ."'
		")->result();	
    }
    
	function getAllDataUser(){ 
		return $this->db->query("
		select a.roleid,a.rolename,
		b.id_name,b.username,b.pwd
		from webrole a left join webuser b on a.roleid=b.roleid
		")->result();	
    }
    
    function updateDataWhereOnly($table,$data,$field_key)
    {
        $query=$this->db->update($table,$data,$field_key);
        if($query) {
            return TRUE; //if query is true
        } else {
            return FALSE; //if query is wrong
        }
    }
	//Bagian Users =================


	//Bagian ICL
	  
	public function getKDIcl()
		{
		    $q = $this->db->query("select MAX(RIGHT(kd_icl,7)) as kd_max from core_icl");
		    $kd = "";
		    if($q->num_rows()>0)
		    {
		        foreach($q->result() as $k)
		        {
		            $tmp = ((int)$k->kd_max)+1;
		            $kd = sprintf("%07s", $tmp);
		        }
		    }
		    else
		    {
		        $kd = "0000001";
		    }
		    return "ICL".$kd;
		} 
	 

    function getAllDataIcl(){
			return $this->db->query("
			select distinct
			a.kd_icl, a.projectname, a.create_date, 
			b.id_icl_history,b.id_qtname,b.id_pmoname,b.status_icl,b.st_awal,b.st_akhir,b.description,b.file_icl,b.priority,
			c.username as qtname,
			d.username as pmoname,
			e.nama_priority_project,
			f.nama_status_project
				from  
				core_icl a 
				left join iclhistory b on a.kd_icl=b.kd_icl
				left join webuser c on b.id_qtname=c.id_name
				left join webuser d on b.id_pmoname=d.id_name
				left join mpriority_project e on b.priority=e.id_priority_project
				left join mstatus_project f on b.status_icl=f.id_status_project
				where b.isactive=1 and status_icl not in ('12') 
				order by a.create_date desc
		")->result();
    }

    function getAllDataIclPerQT(){
		$id_qtname = $this->session->userdata('ID'); 
        return $this->db->query("
        select distinct
		a.kd_icl, a.projectname, a.create_date, 
		b.id_icl_history,b.id_qtname,b.id_pmoname,b.status_icl,b.st_awal,b.st_akhir,b.description,b.file_icl,b.priority,
		c.username as qtname,
		d.username as pmoname,
		e.nama_priority_project,
		f.nama_status_project
			from core_icl a 
			left join iclhistory b on a.kd_icl=b.kd_icl
			left join webuser c on b.id_qtname=c.id_name
			left join webuser d on b.id_pmoname=d.id_name
			left join mpriority_project e on b.priority=e.id_priority_project
			left join mstatus_project f on b.status_icl=f.id_status_project
			where b.isactive=1 and b.id_qtname= '".$id_qtname."'  and status_icl not in ('12') 
			order by a.create_date desc
		")->result();
    }
  
	function getDataIclForCoordinator(){
		$kd_icl = array();
		$kd_icl = $this->uri->segment(3);
        return $this->db->query("
        select distinct
		a.kd_icl, a.projectname, a.create_date, 
		b.id_icl_history,b.id_qtname,b.id_pmoname,b.status_icl,b.st_awal,b.st_akhir,b.description,b.file_icl,b.priority,
		c.username as qtname,
		d.username as pmoname,
		e.nama_priority_project,
		f.nama_status_project
			from core_icl a 
			left join iclhistory b on a.kd_icl=b.kd_icl
			left join webuser c on b.id_qtname=c.id_name
			left join webuser d on b.id_pmoname=d.id_name
			left join mpriority_project e on b.priority=e.id_priority_project
			left join mstatus_project f on b.status_icl=f.id_status_project
			where b.isactive=1 and a.kd_icl='".$kd_icl."'
			order by a.create_date desc
		")->result();
    }	

	function getDataIclForQT(){
		$kd_icl = array();
		$kd_icl = $this->uri->segment(3);
		$id_qtname = array();
		$id_qtname = $this->session->userdata('ID');
        return $this->db->query("
        select distinct
		a.kd_icl, a.projectname, a.create_date, 
		b.id_icl_history,b.id_qtname,b.id_pmoname,b.status_icl,b.st_awal,b.st_akhir,b.description,b.file_icl,b.priority,
		c.username as qtname,
		d.username as pmoname,
		e.nama_priority_project,
		f.nama_status_project
			from core_icl a 
			left join iclhistory b on a.kd_icl=b.kd_icl
			left join webuser c on b.id_qtname=c.id_name
			left join webuser d on b.id_pmoname=d.id_name
			left join mpriority_project e on b.priority=e.id_priority_project
			left join mstatus_project f on b.status_icl=f.id_status_project
			where b.isactive=1 and a.kd_icl='".$kd_icl."' and b.id_qtname='".$id_qtname."'
			order by a.create_date desc
		")->result();
    }
 
	function getDataIclAllHistoryDescription(){
		$kd_icl = array();
		$kd_icl = $this->uri->segment(3);
		return $this->db->query("
			select distinct
 			a.id_icl_history,a.status_icl,a.create_date,a.description,a.file_icl, a.priority,
			d.username as creator,
			e.nama_priority_project,
			f.nama_status_project
			from iclhistory a left join webuser b on a.id_pmoname=b.id_name
			left join webuser c on a.id_qtname=c.id_name
			left join webuser d on a.create_by=d.id_name
			left join mpriority_project e on a.priority=e.id_priority_project
			left join mstatus_project f on a.status_icl=f.id_status_project
			where a.kd_icl='".$kd_icl."' order by a.id_icl_history desc")->result();
    } 


	function getLastStatusIclHistory(){
		$kd_icl = array();
		$kd_icl = $this->uri->segment(3);
		return $this->db->query("
		select 
		a.description,a.status_icl,a.file_icl,a.priority,
		b.nama_priority_project,
		c.nama_status_project
		from iclhistory a
		left join mpriority_project b on a.priority=b.id_priority_project
		left join mstatus_project c on a.status_icl=c.id_status_project
		where kd_icl='".$kd_icl."' and isactive= '1'
		")->result();
    } 

    function getAllDataInactiveIcl(){
			return $this->db->query("
			select distinct
			a.kd_icl, a.projectname, a.create_date, 
			b.id_icl_history,b.id_qtname,b.id_pmoname,b.status_icl,b.st_awal,b.st_akhir,b.description,b.file_icl,b.priority,
			c.username as qtname,
			d.username as pmoname,
			e.nama_priority_project,
			f.nama_status_project
				from  
				core_icl a 
				left join iclhistory b on a.kd_icl=b.kd_icl
				left join webuser c on b.id_qtname=c.id_name
				left join webuser d on b.id_pmoname=d.id_name
				left join mpriority_project e on b.priority=e.id_priority_project
				left join mstatus_project f on b.status_icl=f.id_status_project
				where b.isactive=1 and status_icl in ('12') 
				order by a.create_date desc
		")->result();
    }

    function getAllDataInactiveIclPerQT(){
		$id_qtname = $this->session->userdata('ID'); 
        return $this->db->query("
        select distinct
		a.kd_icl, a.projectname, a.create_date, 
		b.id_icl_history,b.id_qtname,b.id_pmoname,b.status_icl,b.st_awal,b.st_akhir,b.description,b.file_icl,b.priority,
		c.username as qtname,
		d.username as pmoname,
		e.nama_priority_project,
		f.nama_status_project
			from core_icl a 
			left join iclhistory b on a.kd_icl=b.kd_icl
			left join webuser c on b.id_qtname=c.id_name
			left join webuser d on b.id_pmoname=d.id_name
			left join mpriority_project e on b.priority=e.id_priority_project
			left join mstatus_project f on b.status_icl=f.id_status_project
			where b.isactive=1 and b.id_qtname= '".$id_qtname."' and status_icl in ('12') 
			order by a.create_date desc
		")->result();
    }

	//Bagian ICL
}
	
	 
