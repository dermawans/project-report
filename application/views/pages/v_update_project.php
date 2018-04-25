<section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">
            <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a> 
        </div>
        <h2 class="panel-title">Update Project</h2>
    </header>
       
	<div class="panel-body">
		<?php
		  if(isset($data_project)){
		  foreach($data_project as $dp){
		?> 
	    <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate"> 	
	        <input type="hidden" name="kd_project" class="form-control" value="<?php echo $dp->kd_project;?>" readonly="readonly"/>
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
				<label class="col-sm-4 control-label" for="textareaDefault">Project Status</label>
				<div class="col-md-6">
					<input type="text" name="status_project" class="form-control" value="<?php echo $dp->nama_status_project; ?>" readonly="readonly"/>
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
			  if(isset($projectallhistorydescription)){
			  $no=1; foreach($projectallhistorydescription as $pahd){
			 ?>
				<div class="col-md-12">
					<div class="panel-group" id="accordion">
						<div class="panel panel-accordion">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $pahd->id_history; ?>">
										<div class="row">
											<div class="col-md-6 text-left">History tanggal <?php echo date("d M Y H:i:s",strtotime($pahd->create_date)); ?> by <?php echo $pahd->creator; ?>
											<?php if ($pahd->file_project <> NULL){ ?>
												<i class="fa fa-paperclip"></i>
												<?php } ?></div>
											<div class="col-md-6 text-right"><?php echo $pahd->nama_status_project; ?></div>
										</div></a>
								</h4>
							</div>
							<div id="<?php echo $pahd->id_history; ?>" class="accordion-body collapse">
								<div class="panel-body"> 
										<textarea id="description" name="description"  class="summernote" data-plugin-summernote data-plugin-options='{ "toolbar":false,"height": 180, "codemirror": { "theme": "ambiance" } }' disabled><?php echo $pahd->description; ?></textarea>
								 <?php if ($pahd->file_project <> NULL){ ?>
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
					<?php
				    if(isset($laststatusprojecthistory)){
				    foreach($laststatusprojecthistory as $lsph){ 
						 if($this->session->userdata('ROLEID') == '2' and $lsph->status_project=='8') { ?>
			    		  <a href="#add_qt_pic" class="modal-with-form btn btn-primary">Assign QT PIC</a>
					<?php } 
						  if($this->session->userdata('ROLEID') == '1') { ?>
						  <?php if(date("Y-m-d")+1 == $lsph->st_akhir or date("Y-m-d") > $lsph->st_akhir) { ?>
						  <a href="" class="modal-with-form btn btn-primary" disabled>Update</a> 
					<?php } else { ?> 
						  <a href="#qt_update" class="modal-with-form btn btn-primary">Update</a> 
					<?php } } ?>
					<?php if($this->session->userdata('ROLEID') == '2') { ?>
						  <a href="#qt_update" class="modal-with-form btn btn-primary">Update</a> 
					<?php } ?> 
					<?php if($this->session->userdata('ROLEID') == '3' or $this->session->userdata('ROLEID') == '4') { ?>
			    	<a href="#pmo_update" class="modal-with-form btn btn-primary">Give Feedback</a> 
					<?php }
						}
					} ?> 
			        <a class="btn btn-primary" href="<?php echo site_url('project')?>">Close</a>
			    </div>
			</div>
		</div> 
			<?php 
			}
		}
		if(empty($data_project)){
		
			echo "Tidak ada data untuk ditampilkan.";
		}
		?> 
	</div>
</section> 

<?php
if(isset($laststatusprojecthistory)){
foreach($laststatusprojecthistory as $lsph){ 
	if($this->session->userdata('ROLEID') == '2' and $lsph->status_project=='8') { ?>
<!-- Modal Form Assign QT PIC-->
<div id="add_qt_pic" class="modal-block modal-block-lg mfp-hide">
<?php echo form_open_multipart('project/add_qt_pic','id="wizard" class="form-horizontal"'); ?> 

    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Assign QT PIC</h2>
        </header>
        <div class="panel-body">
		<?php
		  if(isset($data_project)){
		  foreach($data_project as $dp){
		?> 
            <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate">   
                <input type="hidden" name="kd_project" class="form-control" value="<?php echo $dp->kd_project;?>" readonly="readonly"/>
				<input type="hidden" name="id_history" class="form-control" value="<?php echo $dp->id_history;?>" readonly="readonly"/>
                <div class="form-group mt-lg">
		            <label class="col-sm-4 control-label">Project Name</label>
		            <div class="col-sm-6">
		                <input type="text" name="projectname" class="form-control" value="<?php echo $dp->projectname; ?>" readonly="readonly"/>
		            </div>
		        </div>  
		        
				<div class="form-group mt-lg">
		            <label class="col-sm-4 control-label">Project Status</label>
		            <div class="col-sm-6">
						<select data-plugin-selectTwo class="form-control populate" id="status_project" name="status_project" placeholder="Chose Status" required>   
                        	<option value="<?php echo $dp->status_project;?>"><?php echo $dp->nama_status_project;?></option> 
                        </select>   
		            </div>
		        </div>
		 
				<div class="form-group mt-lg">
			        <label class="col-sm-4 control-label">Priority</label>
			        <div class="col-sm-6"> 
						<select data-plugin-selectTwo class="form-control populate" id="priority" name="priority" placeholder="Chose Priority" required>   
                        	<option value="<?php echo $dp->priority;?>"><?php echo $dp->nama_priority_project;?></option> 
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
		                <input type="hidden" name="id_pmoname" class="form-control" value="<?php echo $dp->id_pmoname; ?>" readonly="readonly"/>
		                <input type="text" name="pmoname" class="form-control" value="<?php echo $dp->pmoname; ?>" readonly="readonly"/>
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
 
				<?php
				  if(isset($laststatusprojecthistory)){
				  foreach($laststatusprojecthistory as $lsph){
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
		

            </form>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                	<button type="submit" class="btn btn-default btn-primary">Assign</button>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
	<?php }
	}
	?> 
    </section>
<?php echo form_close(); ?> 
</div>
<!-- Modal Form Assign QT PIC-->
<?php } }}?>             


<?php
if(isset($laststatusprojecthistory)){
foreach($laststatusprojecthistory as $lsph){ 
//	if(($this->session->userdata('ROLEID') == '2' or $this->session->userdata('ROLEID') == '1') and $lsph->status_project <>'1') {
	if(($this->session->userdata('ROLEID') == '2' or $this->session->userdata('ROLEID') == '1')) { ?>
<!-- Modal Form QT UPDATE-->
<div id="qt_update" class="modal-block modal-block-lg mfp-hide">
<?php echo form_open_multipart('project/qt_update','id="wizard" class="form-horizontal"'); ?> 

    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Update History</h2>
        </header>
        <div class="panel-body">
            <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate">  
			<?php
			  if(isset($data_project)){
			  foreach($data_project as $dp){
			?> 
                <input type="hidden" name="kd_project" class="form-control" value="<?php echo $dp->kd_project;?>" readonly="readonly"/>
                <div class="form-group mt-lg">
		            <label class="col-sm-4 control-label">Project Name</label>
		            <div class="col-sm-6">
		                <input type="hidden" name="id_history" class="form-control" value="<?php echo $dp->id_history;?>" readonly="readonly"/>
		                <input type="text" name="projectname" class="form-control" value="<?php echo $dp->projectname; ?>" readonly="readonly"/>
		            </div>
		        </div>  
 
				<div class="form-group mt-lg">
		            <label class="col-sm-4 control-label">Project Status</label>
		            <div class="col-sm-6">
						<select data-plugin-selectTwo class="form-control populate" id="status_project" name="status_project" placeholder="Chose Status" required>                        	 
							<option value="<?php echo $dp->status_project; ?>"><?php echo $dp->nama_status_project; ?></option> 
						 	<?php
                            if(isset($data_status)){
                                foreach($data_status as $ds){
                                    ?>
                            <option value="<?php echo $ds->id_status_project;?>"><?php echo $ds->nama_status_project;?></option>
                                <?php
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
						 <div class="form-group"> 
							<div class="col-md-8">
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</span>
									<?php if($dp->id_qtname==''){?>
									<input type="text" class="form-control" id="st_awal" name="st_awal" value="<?php echo $dp->st_awal; ?>">
									<?php } else {?>
									<input type="text" class="form-control" id="st_awal" name="st_awal" value="<?php echo $dp->st_awal; ?>" readonly>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
                </div>	
	
				<?php if($this->session->userdata('ROLEID') == '1') { ?>
				<div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">End Date</label>
                    <div class="col-md-6">
						 <div class="form-group"> 
							<div class="col-md-8">
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
				<?php } 
				if($this->session->userdata('ROLEID') == '2') { ?>
				<div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">End Date</label>
                    <div class="col-md-6">
						 <div class="form-group"> 
							<div class="col-md-8">
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</span>
									<input type="text" data-plugin-datepicker class="form-control" id="st_akhir" name="st_akhir" value="<?php echo $dp->st_akhir; ?>">
								</div>
							</div>
						</div>
					</div>
                </div> 
				<?php } ?>
				<div class="form-group mt-lg">
					<label class="col-md-4 control-label">File Upload<br><h8><i>Hanya bisa upload file .zip<br>Max. size 10MB</i></h8></label>
					<div class="col-md-6">
		  		        <input type="file" name="fileupload" accept=".zip" onchange="ValidateSingleInput(this);"> 
					</div>
				</div>			
	
				<?php
				  if(isset($laststatusprojecthistory)){
				  foreach($laststatusprojecthistory as $lsph){
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
<?php } }}?>             


<?php if($this->session->userdata('ROLEID') == '3' or $this->session->userdata('ROLEID') == '4') { ?>			    	
<!-- Modal Form PMO UPDATE-->
<div id="pmo_update" class="modal-block modal-block-lg mfp-hide">
<?php echo form_open_multipart('project/pmo_update','id="wizard" class="form-horizontal"'); ?> 
 
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Update History</h2>
        </header>
        <div class="panel-body">
            <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate">  
	 			<?php
				  if(isset($data_project)){
				  foreach($data_project as $dp){
				?> 
                <input type="hidden" name="kd_project" class="form-control" value="<?php echo $dp->kd_project;?>" readonly="readonly"/>
                <div class="form-group mt-lg">
		            <label class="col-sm-4 control-label">Project Name</label>
		            <div class="col-sm-6">
		                <input type="text" name="projectname" class="form-control" value="<?php echo $dp->projectname; ?>" readonly="readonly"/>
		            </div>
		        </div>  
				<div class="form-group mt-lg">
		            <label class="col-sm-4 control-label">Project Status</label>
		            <div class="col-sm-6">
						<select data-plugin-selectTwo class="form-control populate" id="status_project" name="status_project" placeholder="Chose Status" required>
							
							<?php if($dp->id_qtname==''){?>							
							<option value="<?php echo $dp->status_project; ?>"><?php echo $dp->nama_status_project; ?></option> 
							<?php } else { 
                            if($dp->status_project=='1'){
							?>
                            <option value="<?php echo $dp->status_project;?>"><?php echo $dp->nama_status_project;?></option>
                            <option value="5">Pending</option>
                            <option value="9">Drop</option>
                            <option value="10">Hold</option>
                            <option value="12">Close</option>
							<?php } else { ?>							
							<?php
                            if(isset($data_status)){
                                foreach($data_status as $ds){
                                    ?>
                            <option value="<?php echo $ds->id_status_project;?>"><?php echo $ds->nama_status_project;?></option>
                                <?php
		                        	    }
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
				<select data-plugin-selectTwo class="form-control populate" id="priority" name="priority" placeholder="Chose priority" required>    
							<option value="<?php echo $dp->priority; ?>"><?php echo $dp->nama_priority_project; ?></option> 
                             <?php 
							if(isset($data_master_priority)){
                                foreach($data_master_priority as $dmp){
                                    ?>
                            <option value="<?php echo $dmp->id_priority_project;?>"><?php echo $dmp->nama_priority_project;?></option>
                                <?php
                                }
                            }
                            ?>
                        </select> 
		            </div>
		        </div> 		 
				
				<div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">PIC QT</label>
                    <div class="col-sm-6"> 
						<input type="hidden" name="id_history" class="form-control" value="<?php echo $dp->id_history;?>" readonly="readonly"/>
		                <input type="hidden" name="id_qtname" class="form-control" value="<?php echo $dp->id_qtname; ?>" readonly="readonly"/>
		                <input type="text" name="qtname" class="form-control" value="<?php echo $dp->qtname; ?>" readonly="readonly"/>  
                    </div>
                </div>	 

				<?php if($this->session->userdata('ROLEID') == '3') { ?>	
				<div class="form-group mt-lg">
		            <label class="col-sm-4 control-label">PIC PMO</label>
		            <div class="col-sm-6"> 
		                <input type="text" name="pmoname" class="form-control" value="<?php echo $dp->pmoname; ?>" readonly="readonly"/>
						<input type="hidden" name="id_pmoname" class="form-control" value="<?php echo $dp->id_pmoname; ?>" readonly="readonly"/>
		            </div>
		        </div>	
				<?php }
				if($this->session->userdata('ROLEID') == '4') { ?>
				<div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">PIC PMO</label>
                    <div class="col-sm-6">
                        <select data-plugin-selectTwo class="form-control populate" id="id_pmoname" name="id_pmoname" placeholder="Chose PMO" required>
                                    <option value="<?php echo $dp->id_pmoname;?>"><?php echo $dp->pmoname;?></option>
                            <?php
                            if(isset($data_master_pmo)){
                                foreach($data_master_pmo as $pmo){
                                    ?>
                                    <option value="<?php echo $pmo->id_name;?>"><?php echo $pmo->username;?></option>
                                <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>	
				<?php } ?> 				
				
				<div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Start Date</label>
                    <div class="col-md-6">
						 <div class="form-group"> 
							<div class="col-md-8">
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</span>
									<?php if($dp->id_qtname==''){?>
									<input type="text" data-plugin-datepicker class="form-control" id="st_awal" name="st_awal" value="<?php echo $dp->st_awal; ?>">
									<?php } else {?>
									<input type="text" class="form-control" id="st_awal" name="st_awal" value="<?php echo $dp->st_awal; ?>" readonly>
									<?php } ?>
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
									<?php if($dp->id_qtname==''){?>
									<input type="text" data-plugin-datepicker class="form-control" id="st_akhir" name="st_akhir" value="<?php echo $dp->st_akhir; ?>">
									<?php } else {?>
									<input type="text" class="form-control" id="st_akhir" name="st_akhir" value="<?php echo $dp->st_akhir; ?>" readonly>
									<?php } ?> 
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

				<?php
				  if(isset($laststatusprojecthistory)){
				  foreach($laststatusprojecthistory as $lsph){
				?>


			<div class="textarea">
                        <label class="col-sm-2 control-label">Description</label>
                        <textarea id="description" name="description" class="summernote" data-plugin-summernote data-plugin-options='{ "height": 180, "codemirror": { "theme": "ambiance" } }'></textarea>
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
<!-- Modal Form PMO UPDATE-->
<?php } ?>

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

