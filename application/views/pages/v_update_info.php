<section class="panel panel-dark">
    <header class="panel-heading">
        <div class="panel-actions">
            <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a> 
        </div>
        <h2 class="panel-title">Update Info
        </h2>
    </header>
    
    <div class="panel-body">
		<!-- NOTIF -->
		<?php
		$message_sukses = $this->session->flashdata('notif-sukses');
		 	if($message_sukses){
			echo '<p class="alert alert-success text-center">'.$message_sukses .'</p>';
		}
		
		$message_gagal = $this->session->flashdata('notif-gagal');
		if($message_gagal){
			echo '<p class="alert alert-danger text-center">'.$message_gagal .'</p>';
		}
		?>           
		<br> 
		<br>
        <div class="table-responsive"> 
        <table class="table table-bordered table-striped table-condensed mb-none" id="datatable-tabletools" data-swf-path="<?php echo base_url(); ?>assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Isi Info</th>
                    <th>is Active</th>
                    <th>
                    <?php 
                    if ($this->session->userdata('ID') == '3') { 
        			?>
					<a href="#add_info" class="modal-with-form btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> Add Info</a> 
					<?php } ?>
            		</th>
                </tr>
            </thead>
            <tbody>
            <?php 
				$no=1;
				if(isset($data_master_info)){
					foreach($data_master_info as $row){ 
			?>
				<tr class="gradeX">
					<th><?php echo $no++; ?></th>
					<th><p><?php echo $row->isi_info; ?></p></th> 
					<th><?php echo $row->isactive; ?></th>   
					<th>  
                    <?php if ($this->session->userdata('ID') == '3') { ?>   
						<a href="#update_info<?php echo $row->id_info; ?>" class="modal-with-form btn btn-sm btn-primary"><i class="fa fa-pencil-circle"></i> Update Info</a> 
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


<?php if ($this->session->userdata('ID') == '3') { ?>
<!-- Modal Form Add Info-->
<div id="add_info" class="modal-block modal-block-lg mfp-hide">
<?php echo form_open_multipart('update_info/add_info','id="wizard" class="form-horizontal"'); ?> 

    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Add Info</h2>
        </header>
        <div class="panel-body">
            <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate">    
                <div class="textarea">
                    <label class="col-sm-2 control-label">Isi Info</label>
					<textarea id="isi_info" name="isi_info"  class="summernote" data-plugin-summernote data-plugin-options='{ "height": 180, "codemirror": { "theme": "ambiance" } }'></textarea>
                </div> 
            </form>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                	<button type="submit" class="btn btn-default btn-primary">Create Info</button>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </section>

<?php echo form_close(); ?> 
</div>
<!-- Modal Form Add Project-->
<?php } ?>


<?php if ($this->session->userdata('ID') == '3') { ?>
<?php
if(isset($data_master_info)){
	foreach($data_master_info as $info){  
?>
<!-- Modal Form UPDATE INFO-->
<div id="update_info<?php echo $info->id_info;?>" class="modal-block modal-block-lg mfp-hide">
<?php echo form_open_multipart('update_info/update_info','id="wizard" class="form-horizontal"'); ?> 

    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Update Info</h2>
        </header>
        <div class="panel-body">
            <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate">   
                <input type="hidden" name="id_info" class="form-control" value="<?php echo $info->id_info;?>" readonly="readonly"/>
                 
				<div class="form-group mt-lg">
		            <label class="col-sm-4 control-label">Is Active</label>
		            <div class="col-sm-6">
						<select data-plugin-selectTwo class="form-control populate" id="isactive" name="isactive" placeholder="Chose Status" required>                        	 
							<option value="<?php echo $info->isactive; ?>"><?php echo $info->isactive; ?></option>                                      	 
							<option value="1">1</option>                                      	 
							<option value="0">0</option>                
                        </select> 
		            </div>
		        </div> 

			    <div class="textarea">
		            <label class="col-sm-2 control-label">Isi Info</label>
					<textarea id="isi_info" name="isi_info" class="summernote" data-plugin-summernote data-plugin-options='{ "height": 180, "codemirror": { "theme": "ambiance" } }'><?php echo $info->isi_info; ?></textarea>
		        </div> 
				 
				<footer class="panel-footer">
					<div class="row">
						<div class="col-md-12 text-right">
							<button type="submit" class="btn btn-default btn-primary">Submit</button>
							<button class="btn btn-default modal-dismiss">Cancel</button>
						</div>
					</div>
				</footer> 
            </form>
        </div>
    </section>
<?php echo form_close(); ?> 
</div>
<!-- Modal Form UPDATE INFO-->
<?php }}}?>             



