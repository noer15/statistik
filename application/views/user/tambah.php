<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/pages/form_select2.js"></script>


<div class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- Basic layout-->
			<form action="<?php echo base_url();?>user/store" class="form-horizontal" method="post">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title"><?php echo $header;?></h5>
						<div class="heading-elements">
							<ul class="icons-list">
						    	<li><a data-action="collapse"></a></li>
						        <li><a data-action="reload"></a></li>
						        <li><a data-action="close"></a></li>
						    </ul>
					    </div>
					</div>		
					<div class="panel-body">
						<div class="form-group">
							<label class="col-lg-2 control-label">Nama</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" placeholder="Nama" name="name">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-lg-2 control-label">Username</label>
							<div class="col-lg-10">
								<input type="email" class="form-control" placeholder="Username" name="username">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-2 control-label">Password</label>
							<div class="col-lg-10">
								<input type="password" class="form-control" placeholder="Password" name="password">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-2 control-label">Re-Password</label>
							<div class="col-lg-10">
								<input type="password" class="form-control" placeholder="Re-Password" name="repassword">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-2 control-label">Group User</label>
							<div class="col-lg-10">
                            <select name="role_id"  id="role_id" class="select-search" required 
                                data-placeholder="Pilih Group User">
                                <option value="">Pilih Group User</option>
                                <?php foreach ($group as $key => $value) { ?>
                                    <option value="<?php echo $value->id?>">
                                    	<?php echo $value->nama?>                                    		
                                    </option>
                                <?php }  ?>
                                
                            </select>
                            </div>
						</div>

						<div class="text-left">
							<a  href="<?php echo base_url();?>user" class="btn btn-danger">Batal</a>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</div>
				</div>
			</form>
			<!-- /basic layout -->
		</div>
	</div>
</div>