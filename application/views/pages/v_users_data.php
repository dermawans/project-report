<!--========================= Content Wrapper ==============================-->

<!-- start: page -->
<div class="row">
    <section class="panel panel-dark">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action" data-panel-toggle></a> 
            </div>
            <h2 class="panel-title">Users Data</h2>
        </header>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="tabs">
                    <ul class="nav nav-tabs"> 
                        <li class="active">
                            <a href="#user" data-toggle="tab">User</a>
                        </li> 
                    </ul>
                    <div class="tab-content">
						<!-- NOTIF -->
						<?php
						$message_sukses = $this->session->flashdata('notif-sukses');
						if($message_sukses){
							echo '<p class="alert alert-success text-center">'.$message_sukses .'</p>';
						}
						$message_gagal = $this->session->flashdata('notif-gagal');
						if($message_gagal)
						{
							echo '<p class="alert alert-danger text-center">'.$message_gagal .'</p>';
						}
						?>   
                        <!--awal tab user-->
                        <div id="user" class="tab-pane active">
                            <!--user-->
                            <section class="panel">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-condensed mb-none" id="datatable-tabletools">
                                        <thead>
                                            <tr>
                                                <th>No</th> 
                                                <th>Username</th>
                                                <th>
                                                 <?php if ($this->session->userdata('ROLEID') == '2' or $this->session->userdata('ROLEID') == '4' or $this->session->userdata('ROLEID') == '5') 
												 { ?>
                                                <a href="#add_user" class="modal-with-form btn btn-sm btn-dark"><i class="fa fa-plus-circle"></i> Add User</a>									 
                                                <?php } else {?>
												<?php
														echo "Action"; }
												?>
                                                </th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        if ($this->session->userdata('ROLEID') == '5') { 
                                            $no=1;
                                            if(isset($data_all_user)){
                                                foreach($data_all_user as $user){
                                        ?>
                                                <tr class="gradeX">
                                                    <th><?php echo $no++; ?></th> 
                                                    <th><?php echo $user->username; ?></th>
                                                    <th><a href="#edit_user<?php echo $user->id_name; ?>" class="modal-with-form btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Edit</a></th>
                                                </tr>
                                       <?php }}}  
											if ($this->session->userdata('ROLEID') == '4') { 
                                            $no=1;
                                            if(isset($data_pmo)){
                                                foreach($data_pmo as $pmo){
                                        ?>
                                                <tr class="gradeX">
                                                    <th><?php echo $no++; ?></th> 
                                                    <th><?php echo $pmo->username; ?></th>
                                                    <th><a href="#edit_user<?php echo $pmo->id_name; ?>" class="modal-with-form btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Edit</a></th>
                                                </tr>
                                       <?php }}} 
                                            if ($this->session->userdata('ROLEID') == '2') { 
                                            $no=1;
                                            if(isset($data_qt)){
                                                foreach($data_qt as $qt){
                                        ?>
                                                <tr class="gradeX">
                                                    <th><?php echo $no++; ?></th> 
                                                    <th><?php echo $qt->username; ?></th>
                                                    <th><a href="#edit_user<?php echo $qt->id_name; ?>" class="modal-with-form btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Edit</a></th>
                                                </tr>
                                        <?php }}
                                            }
                                            if ($this->session->userdata('ROLEID') == '1' OR $this->session->userdata('ROLEID') == '3' or $this->session->userdata('ROLEID') == '6') { ?>
                                        <?php
                                            $no=1;
                                            if(isset($data_user)){
                                                foreach($data_user as $user){
                                        ?>
                                                <tr class="gradeX">
                                                    <th><?php echo $no++; ?></th>
                                                    <th><?php echo $user->username; ?></th>
                                                    <th><a href="#edit_user<?php echo $user->id_name; ?>" class="modal-with-form btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Edit</a></th>
                                                </tr>
                                                <?php }
                                            }
                                            ?>                                             
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </section>
                            <!--user-->
                        </div>
                        <!--akhir tab user-->
                	</div>
                </div>
            </div>
        </div>
    </section>
</div> 
<!-- end: page -->


<!-- Modal Form Add User-->
<div id="add_user" class="modal-block modal-block-primary mfp-hide">
<?php echo form_open('users/add_user','id="wizard" class="form-horizontal"'); ?> 

    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Add User</h2>
        </header>
        <div class="panel-body">
            <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate">
                 <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Role ID</label>
                    <div class="col-sm-6">
                        <select data-plugin-selectTwo class="form-control populate" id="roleid" name="roleid" placeholder="Chose Role ID">
                    				<option value=""></option>
                            <?php
                            if ($this->session->userdata('ROLEID') == '5'){
								if(isset($data_master_role)){
									foreach($data_master_role as $role_master){
										?>
										<option value="<?php echo $role_master->roleid;?>"><?php echo $role_master->rolename;?></option>
									<?php
									}
								}
							}
                            if ($this->session->userdata('ROLEID') == '4'){
								if(isset($data_master_role_pmo)){
									foreach($data_master_role_pmo as $role_pmo){
										?>
										<option value="<?php echo $role_pmo->roleid;?>"><?php echo $role_pmo->rolename;?></option>
									<?php
									}
								}
							}
							if ($this->session->userdata('ROLEID') == '2'){
								if(isset($data_master_role_qt)){
									foreach($data_master_role_qt as $role_qt){
										?>
										<option value="<?php echo $role_qt->roleid;?>"><?php echo $role_qt->rolename;?></option>
									<?php
									}
								}
							}
                            ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Username</label>
                    <div class="col-sm-6">
                        <input type="text" name="username" class="form-control" placeholder="Type username..." required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Password</label>
                    <div class="col-sm-6">
                        <input type="password" name="password" class="form-control" required minimumInputLength="6"/>
                    </div>
                </div>
            </form>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                	<button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
<?php echo form_close(); ?> 
</div>
<!-- Modal Form Add User-->


<!-- Modal Form Edit User-->
<?php 
	if(isset($data_all_user)){
		foreach($data_all_user as $row1){
?>

<div id="edit_user<?php echo $row1->id_name; ?>" class="modal-block modal-block-primary mfp-hide">
<?php echo form_open('users/save_user','id="wizard" class="form-horizontal"'); ?> 

    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Edit User</h2>
        </header>
        <div class="panel-body">
            
            <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate">
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">ID User</label>
                    <div class="col-sm-6">
                        <input type="text" name="id_name" class="form-control" value="<?php echo $row1->id_name;?>" readonly="readonly" required/>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Role</label>
                    <div class="col-sm-4">
						 <?php
                            if ($this->session->userdata('ROLEID') == '5'){
							?>							
				            	<select data-plugin-selectTwo class="form-control populate" id="roleid" name="roleid" placeholder="Chose Role ID" required>
				        			<option value=""></option>
						<?php		if(isset($data_master_role)){
									foreach($data_master_role as $role_master){
										?>
										<option value="<?php echo $role_master->roleid;?>"><?php echo $role_master->rolename;?></option>
									<?php
									}
								} ?>
                    			</select>
						<?php }
						else  { ?>
                        <input type="hidden" name="roleid" class="form-control"  value="<?php echo $row1->roleid;?>" readonly="readonly"  required/>
                        <input type="text" name="rolename" class="form-control"  value="<?php echo $row1->rolename;?>" readonly="readonly"  required/>
						<?php } ?>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Username</label>
                    <div class="col-sm-6"> 
						<?php
                        	if ($this->session->userdata('ROLEID') == '1' or $this->session->userdata('ROLEID') == '3'){
						?>							
                        <input type="text" name="username" class="form-control"  value="<?php echo $row1->username;?>" readonly="readonly" required/>
						<?php } else {
						?>
                        <input type="text" name="username" class="form-control"  value="<?php echo $row1->username;?>" required/>
						<?php } ?>
                    </div>
                </div>
                
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Password</label>
                    <div class="col-sm-6">
                        <a href="#edit_password<?php echo $row1->id_name; ?>" class="modal-with-form btn btn-sm btn-primary">Change</a>
                    </div>
                </div>
            </form>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                	<button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
<?php echo form_close(); ?> 
</div>
    <?php }} ?>
<!-- Modal Form Edit User-->


<!-- Modal Form Change Password-->
<?php 
	if(isset($data_all_user)){
		foreach($data_all_user as $row1){
?>

<div id="edit_password<?php echo $row1->id_name; ?>" class="modal-block modal-block-primary mfp-hide">
<?php echo form_open('users/change_password','id="wizard" class="form-horizontal"'); ?> 

    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Change Password</h2>
        </header>
        <div class="panel-body">
            <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate">
                <div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">New Password</label>
                    <div class="col-sm-6">
                        <input type="password" name="password" class="form-control" required/>
                    </div>
                </div>
                
                <div class="form-group">
                        <div class="col-md-6">
                            <input id="inputer" class="form-control" name="id_name" value="<?php echo $row1->id_name; ?>" type="hidden" readonly>
                        </div>
                </div>
                
            </form>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                	<button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
<?php echo form_close(); ?> 
</div>
<?php }} ?>

<!-- Modal Form Change Password-->

