<section class="panel panel-dark">
    <header class="panel-heading">
        <div class="panel-actions">
            <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a> 
        </div>
        <h2 class="panel-title">Inactive ICL
        </h2>
    </header>
    
    <div class="panel-body">
		<!-- NOTIF -->
		<?php
		$message_sukses = $this->session->flashdata('notif-sukses');
		$message_upload_sukses = $this->session->flashdata('notif-upload-sukses');
		$message_email_sukses = $this->session->flashdata('notif-email-sukses');
		if($message_sukses){
			echo '<p class="alert alert-success text-center">'.$message_sukses .'</p>';
		}
		if($message_upload_sukses){
			echo '<p class="alert alert-success text-center">'.$message_upload_sukses .'</p>';
		}
		if($message_email_sukses){
			echo '<p class="alert alert-success text-center">'.$message_email_sukses .'</p>';
		}

		$message_gagal = $this->session->flashdata('notif-gagal');
		$message_upload_gagal = $this->session->flashdata('notif-upload-gagal');
		$message_email_gagal = $this->session->flashdata('notif-email-gagal');
		if($message_gagal){
			echo '<p class="alert alert-danger text-center">'.$message_gagal .'</p>';
		}
		if($message_upload_gagal){
			echo '<p class="alert alert-danger text-center">'.$message_upload_gagal .'</p>';
		}
		if($message_email_gagal){
			echo '<p class="alert alert-danger text-center">'.$message_email_gagal .'</p>';
		}
		?>   
        <div class="table-responsive">
        <table class="table table-bordered table-striped table-condensed mb-none" id="datatable-tabletools" data-swf-path="<?php echo base_url(); ?>assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Project Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>ICL Status</th>	
                    <th>Timeline Status</th>	
					<th>Priority</th>
                    <th>PMO</th>
                    <th>QT</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php 
				$no=1;
				if(isset($data_icl)){
					foreach($data_icl as $row){ 
			?>
				<tr class="gradeX">
					<th><?php echo $no++; ?></th>
					<th><?php echo $row->projectname; ?></th>
					<th><?php echo date("d M Y",strtotime($row->st_awal)); ?></th>
					<th><?php echo date("d M Y",strtotime($row->st_akhir)); ?></th>
					<th><?php echo $row->nama_status_project; ?></th>
					<th>
						<?php
						$akhir=strtotime($row->st_akhir);
						$sekarang= time();
						$sisa = $akhir-$sekarang;
						$sisahari= floor($sisa / (60 * 60 * 24)+1)." days left";
						if ($sisahari>0)
						{ if ($sisahari>0 and $sisahari<10)
							{
							echo "0".$sisahari; 
							}
						   else { echo $sisahari; }
						}
						else if ($sisahari==0)
						{ echo "00 days left"; }
						else
						{ echo "Expired"; }
						?>
					</th>
					<th><?php echo "(".$row->priority.") ".$row->nama_priority_project; ?></th>
					<th><?php echo $row->pmoname; ?></th>
					<th><?php echo $row->qtname; ?></th> 
					<th>
						<a class="btn btn-primary btn-sm" href="<?php echo site_url('icl/view_icl/'.$row->kd_icl)?>">
							<i class="fa fa-eye"></i> View</a>

					<?php 
					if ($this->session->userdata('ROLEID') == '2' or $this->session->userdata('ROLEID') == '6') { 
					?>
						<a class="btn btn-primary btn-sm" href="<?php echo site_url('icl/update_icl/'.$row->kd_icl)?>">
							<i class="fa fa-pencil"></i> Update</a>
					<?php } ?>
					</th>
				</tr>
			  <?php }
				}
			  ?>

            </tbody>
        </table> 
        </div>
    </div>
</section>





