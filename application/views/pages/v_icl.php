<section class="panel panel-dark">
    <header class="panel-heading">
        <div class="panel-actions">
            <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a> 
        </div>
        <h2 class="panel-title">ICL Production
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
		<br>  
        <div class="table-responsive">
		<a href="<?php echo site_url('icl/inactive_icl/')?>" class="btn btn-sm btn-primary"><i class="fa fa-archive"></i> View Inactive ICL</a> 
        <table class="table table-bordered table-striped table-condensed mb-none" id="datatable-tabletools" data-swf-path="<?php echo base_url(); ?>assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Project Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Project Status</th>	
                    <th>Timeline Status</th>	
                    <th>Priority</th>	
                    <th>PMO</th>
                    <th>QT</th>
                    <th>
                    <?php 
                    if ($this->session->userdata('ROLEID') == '2' or $this->session->userdata('ROLEID') == '6') { 
        			?>
					<a href="#add_icl" class="modal-with-form btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> Add ICL</a>
					<?php }
					else { 
        			?>
                    Action
					<?php } ?>
            		</th>
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
                    if ($this->session->userdata('ROLEID') <> '5') { 
        			?> 
		                <?php 
		                if ($this->session->userdata('ROLEID') == '2' or $this->session->userdata('ROLEID') == '6') { 
		    			?>
							<a class="btn btn-primary btn-sm" href="<?php echo site_url('icl/update_icl/'.$row->kd_icl)?>"><i class="fa fa-pencil"></i> Update</a>
				        <?php } else { ?>
							<?php 
				            if ($this->session->userdata('ID') == $row->id_qtname) { 
							?>
							<a class="btn btn-primary btn-sm" href="<?php echo site_url('icl/update_icl/'.$row->kd_icl)?>"><i class="fa fa-pencil"></i> Update</a>
							<?php } ?>
						<?php } ?>
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
 

<?php if ($this->session->userdata('ROLEID') == '2' or $this->session->userdata('ROLEID') == '6') { 
?>
<!-- Modal Form Add ICL-->
<div id="add_icl" class="modal-block modal-block-lg mfp-hide">
<?php echo form_open_multipart('icl/add_icl','id="wizard" class="form-horizontal"'); ?> 

    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Add ICL</h2>
        </header>
        <div class="panel-body">
            <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate">  
                        <input type="hidden" name="kd_icl" class="form-control" value="<?php echo $kd_icl;?>" readonly="readonly" required/>
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Project Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="projectname" class="form-control" placeholder="Type project name..." required/>
                    </div>
                </div>

				<div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">ICL Status</label>
                    <div class="col-sm-6"> 
						<select data-plugin-selectTwo class="form-control populate" id="status_icl" " name="status_icl" required>  
                        	<option value="3">In Progress</option> 
                        </select>
                    </div>
                </div>

				<div class="form-group mt-lg">
		            <label class="col-sm-4 control-label">Priority</label>
		            <div class="col-sm-6"> 
						<select data-plugin-selectTwo class="form-control populate" id="priority" " name="priority" required>  
                        	<option value="1">Urgent</option> 
                        </select> 
		            </div>
		        </div> 

				<div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">PIC QT</label>
                    <div class="col-sm-6">
                        <select data-plugin-selectTwo class="form-control populate" id="id_qtname" name="id_qtname" placeholder="Chose QT" required>
                        	<option value=""></option>
                            <?php
                            if(isset($data_master_qt)){
                                foreach($data_master_qt as $qt){
                                    ?>
                                    <option value="<?php echo $qt->id_name;?>"><?php echo $qt->username;?></option>
                                <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>	
                   
				<div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">PIC PMO</label>
                    <div class="col-sm-6">
                        <input type="text" name="id_pmoname" class="form-control" readonly="readonly"/> 
                    </div>
                </div>	
 
				<div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Start Date</label>
                    <div class="col-md-6">
						 <div class="form-group"> 
							<div class="col-md-8">
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</span>
									<input type="text" data-plugin-datepicker class="form-control" id="st_awal" name="st_awal">
								</div>
							</div>
						</div>
					</div>
                </div>	

				<div class="form-group mt-lg">
				            <label class="col-sm-4 control-label">End Date</label>
				            <div class="col-md-6">
					 <div class="form-group"> 
						<div class="col-md-8">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-calendar"></i>
								</span>
								<input type="text" data-plugin-datepicker class="form-control" id="st_akhir" name="st_akhir">
							</div>
						</div>
					</div>
					</div>
				        </div>
	
				<div class="form-group mt-lg">
					<label class="col-md-4 control-label">File Upload<br><h8><i>Hanya bisa upload file .zip<br>Max. size 10MB</i></h8></label>
					<div class="col-md-6">
		  		        <input type="file" name="fileupload" accept=".zip" onchange="ValidateSingleInput(this);"> 
					</div>
				</div>

                <div class="textarea">
                    <label class="col-sm-2 control-label">Description</label>
					<textarea id="description" name="description"  class="summernote" data-plugin-summernote data-plugin-options='{ "height": 180, "codemirror": { "theme": "ambiance" } }'></textarea>
                    <!--<textarea id="description" name="description" data-plugin-markdown-editor rows="10"></textarea>-->
                </div>
				       
                <div class="form-group">
                    <div class="col-md-6">
                        <input id="create_by" type="hidden"  class="form-control" name="create_by" value="<?php echo $this->session->userdata('ID') ?>" readonly="readonly">
					</div>
                </div>
            </form>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                	<button type="submit" class="btn btn-default btn-primary">Create ICL</button>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </section>

<?php echo form_close(); ?> 
</div>
<!-- Modal Form Add ICL-->
<?php
}
?>

<script type="text/javascript">
var _validFileExtensions = [".zip"];    
function ValidateSingleInput(oInput) {
    if (oInput.type == "file") {
        var sFileName = oInput.value;
         if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }
             
            if (!blnValid) {
                alert("Maaf, " + sFileName + " tipe file tersebut tidak diizinkan, tipe file yang diizinkan adalah : " + _validFileExtensions.join(", "));
                oInput.value = "";
                return false;
            }
        }
    }
    return true;
}
</script>


