<section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">
            <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a> 
        </div>
        <h2 class="panel-title">Update ICL</h2>
    </header>
       
	<div class="panel-body">
		<?php
		  if(isset($data_icl)){
		  foreach($data_icl as $dp){
		?> 
	    <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate"> 	
	        <input type="hidden" name="kd_icl" class="form-control" value="<?php echo $dp->kd_icl;?>" readonly="readonly"/>
	        <div class="form-group mt-lg">
	            <label class="col-sm-4 control-label">Project Name</label>
	            <div class="col-sm-6">
	                <input type="text" name="projectname" class="form-control" value="<?php echo $dp->projectname; ?>" readonly="readonly"/>
	            </div>
	        </div> 
			<div class="form-group mt-lg">
	            <label class="col-sm-4 control-label">PIC QT</label>
	            <div class="col-sm-6">
	                <input type="text" name="id_qtname" class="form-control" value="<?php echo $dp->qtname; ?>"  readonly="readonly"/>
	            </div>
	        </div>
	           
			<div class="form-group mt-lg">
	            <label class="col-sm-4 control-label">PIC PMO</label>
	            <div class="col-sm-6"> 
	                <input type="text" name="id_pmoname" class="form-control" value="<?php echo $dp->pmoname; ?>" readonly="readonly"/>
	            </div>
	        </div>	

			<div class="form-group mt-lg">
				<label class="col-sm-4 control-label" for="textareaDefault">ICL Status</label>
				<div class="col-md-6">
					<input type="text" name="status_icl" class="form-control" value="<?php echo $dp->nama_status_project; ?>" readonly="readonly"/>
				</div>
			</div>
			
			<div class="form-group mt-lg">
	            <label class="col-sm-4 control-label">Priority</label>
	            <div class="col-sm-6"> 
	                <input type="text" name="priority" class="form-control" value="<?php echo $dp->nama_priority_project; ?>" readonly="readonly"/>
	            </div>
	        </div>				

							
			<div class="form-group mt-lg">
                <label class="col-sm-4 control-label">Start Date</label>
                <div class="col-md-6">
					 <div class="form-group"> 
						<div class="col-md-6">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</span>
								<input type="text" class="form-control" id="st_awal" name="st_awal" value="<?php echo $dp->st_awal; ?>" readonly>
							</div>
						</div>
					</div>
				</div>
            </div>	

			<div class="form-group mt-lg">
                <label class="col-sm-4 control-label">End Date</label>
                <div class="col-md-6">
					 <div class="form-group"> 
						<div class="col-md-6">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</span>
								<input type="text" class="form-control" id="st_akhir" name="st_akhir" value="<?php echo $dp->st_akhir; ?>" readonly>
							</div>
						</div>
					</div>
				</div>
            </div>	 		
			 <?php
			  if(isset($iclallhistorydescription)){
			  $no=1; foreach($iclallhistorydescription as $pahd){
			 ?>
				<div class="col-md-12">
					<div class="panel-group" id="accordion">
						<div class="panel panel-accordion">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $pahd->id_icl_history; ?>">
										<div class="row">
											<div class="col-md-6 text-left">History tanggal <?php echo date("d M Y H:i:s",strtotime($pahd->create_date)); ?> by <?php echo $pahd->creator; ?></div>
											<div class="col-md-6 text-right"><?php echo $pahd->nama_status_project; ?></div>
										</div></a>
								</h4>
							</div>
							<div id="<?php echo $pahd->id_icl_history; ?>" class="accordion-body collapse">
								<div class="panel-body">
										<textarea id="description" name="description"  class="summernote" data-plugin-summernote data-plugin-options='{ "toolbar":false,"height": 180, "codemirror": { "theme": "ambiance" } }' disabled><?php echo $pahd->description; ?></textarea>
								 <?php if ($pahd->file_icl <> NULL){ ?>
										<a href="<?php echo base_url(); ?>assets/file-project/<?php echo $pahd->file_project; ?>"><i class="fa fa-paperclip"></i> Download Attachment</a>
								<?php } ?>			
								</div>
							</div>
						</div>
					</div>
				</div> 
			<?php $no++; }
			}
			?>     
	    </form> 
		<div class="panel-body">
			<div class="row">
			    <div class="col-md-12 text-right"> 
		   			<a href="#icl_update" class="modal-with-form btn btn-primary">Update</a>  
			        <a class="btn btn-primary" href="<?php echo site_url('icl')?>">Close</a>
			    </div>
			</div>
		</div> 
			<?php 
			}
		}
		if(empty($data_icl)){
		
			echo "Tidak ada data untuk ditampilkan.";
		}
		?> 
	</div>
</section> 
 
<?php
if(isset($laststatusiclhistory)){
foreach($laststatusiclhistory as $lsph){ 
	if(($this->session->userdata('ROLEID') == '2' or $this->session->userdata('ROLEID') == '1' or $this->session->userdata('ROLEID') == '6')) { ?>
<!-- Modal Form QT UPDATE-->
<div id="icl_update" class="modal-block modal-block-lg mfp-hide">
<?php echo form_open_multipart('icl/icl_update','id="wizard" class="form-horizontal"'); ?> 

    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Update History</h2>
        </header>
        <div class="panel-body">
            <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate">  
			<?php
			  if(isset($data_icl)){
			  foreach($data_icl as $dp){
			?> 
                <input type="hidden" name="kd_icl" class="form-control" value="<?php echo $dp->kd_icl;?>" readonly="readonly"/>
                <div class="form-group mt-lg">
		            <label class="col-sm-4 control-label">Project Name</label>
		            <div class="col-sm-6">
		                <input type="hidden" name="id_icl_history" class="form-control" value="<?php echo $dp->id_icl_history;?>" readonly="readonly"/>
		                <input type="text" name="projectname" class="form-control" value="<?php echo $dp->projectname; ?>" readonly="readonly"/>
		            </div>
		        </div>  
 
				<div class="form-group mt-lg">
		            <label class="col-sm-4 control-label">ICL Status</label>
		            <div class="col-sm-6">
						<select data-plugin-selectTwo class="form-control populate" id="status_icl" name="status_icl" placeholder="Chose Status" required>                        	 
							<option value="<?php echo $dp->status_icl; ?>"><?php echo $dp->nama_status_project; ?></option> 
						 	<?php
							if($this->session->userdata('ROLEID') == '2' or $this->session->userdata('ROLEID') == '1' or $this->session->userdata('ROLEID') == '6') {
		                        if(isset($data_master_status)){
		                            foreach($data_master_status as $ds){
		                                ?>
		                        <option value="<?php echo $ds->id_status_project;?>"><?php echo $ds->nama_status_project;?></option>
		                            <?php
		                            }
		                        }
							}
                            ?>
                        </select> 
		            </div>
		        </div> 
				
				<div class="form-group mt-lg">
			        <label class="col-sm-4 control-label">Priority</label>
			        <div class="col-sm-6"> 
			            <select data-plugin-selectTwo class="form-control populate" id="priority" name="priority" placeholder="Chose Priority" required>                        	 
							<option value="<?php echo $dp->priority; ?>"><?php echo $dp->nama_priority_project; ?></option> 
                        </select>
			        </div>
			    </div>	

 				<?php if($this->session->userdata('ROLEID') == '1') { ?>
				<div class="form-group mt-lg">
		            <label class="col-sm-4 control-label">PIC QT</label>
		            <div class="col-sm-6"> 
		                <input type="hidden" name="id_qtname" class="form-control" value="<?php echo $dp->id_qtname; ?>" readonly="readonly"/>
		                <input type="text" name="qtname" class="form-control" value="<?php echo $dp->qtname; ?>" readonly="readonly"/>  
                   </div>
		        </div>	
		        <?php }?>
 				<?php if($this->session->userdata('ROLEID') == '2') { ?>
				<div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">PIC QT</label>
                    <div class="col-sm-6">
                        <select data-plugin-selectTwo class="form-control populate" id="id_qtname" name="id_qtname" placeholder="Chose QT" required>
                                    <option value="<?php echo $dp->id_qtname;?>"><?php echo $dp->qtname;?></option>
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
		        <?php }?>

				<div class="form-group mt-lg">
		            <label class="col-sm-4 control-label">PIC PMO</label>
		            <div class="col-sm-6"> 
		                <input type="text" name="pmoname" class="form-control" value="<?php echo $dp->pmoname; ?>" readonly="readonly"/>
						<input type="hidden" name="id_pmoname" class="form-control" value="<?php echo $dp->id_pmoname; ?>" readonly="readonly"/>
		            </div>
		        </div>	
 
				<div class="form-group mt-lg">
		            <label class="col-sm-4 control-label">Start Date</label>
		            <div class="col-md-6"> 
		                <input type="text" name="st_awal" class="form-control" value="<?php echo $dp->st_awal; ?>" readonly="readonly"/>
					</div>
		        </div>	

				<div class="form-group mt-lg">
		            <label class="col-sm-4 control-label">End Date</label>
		            <div class="col-md-6"> 
		                <input type="text" name="st_akhir" class="form-control" value="<?php echo $dp->st_akhir; ?>" readonly="readonly"/>
					</div>
		        </div>	 
				 
				<div class="form-group mt-lg">
					<label class="col-md-4 control-label">File Upload<br><h8><i>Hanya bisa upload file .zip<br>Max. size 10MB</i></h8></label>
					<div class="col-md-6">
		  		        <input type="file" name="fileupload" accept=".zip" onchange="ValidateSingleInput(this);"> 
					</div>
				</div>			
	
				<?php
				  if(isset($laststatusiclhistory)){
				  foreach($laststatusiclhistory as $lsph){
				?>
			    <div class="textarea">
		            <label class="col-sm-2 control-label">Description</label>
					<textarea id="description" name="description" class="summernote" data-plugin-summernote data-plugin-options='{ "height": 180, "codemirror": { "theme": "ambiance" } }'><?php echo $lsph->description; ?></textarea>
		        </div>
				<?php }
				}
				?>  
                <div class="form-group">
                    <div class="col-md-6">
                        <input id="create_by" type="hidden"  class="form-control" name="create_by" value="<?php echo $this->session->userdata('ID') ?>" readonly="readonly">
					</div>
                </div> 
				<footer class="panel-footer">
					<div class="row">
						<div class="col-md-12 text-right">
							<button type="submit" class="btn btn-default btn-primary">Submit</button>
							<button class="btn btn-default modal-dismiss">Cancel</button>
						</div>
					</div>
				</footer>
			<?php }
			}
			?>  
            </form>
        </div>
    </section>
<?php echo form_close(); ?> 
</div>
<!-- Modal Form QT UPDATE-->
<?php }}}?>             

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
 
