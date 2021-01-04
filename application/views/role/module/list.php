<div class="content">
	<!-- Basic datatable -->
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
			<form class="form-horizontal" id="form" action="<?php echo base_url();?>role/storeModule" method="POST">

			<div class="text-left">
				<a  href="<?php echo base_url();?>role" class="btn btn-danger">Batal</a>
				<button type="submit" class="btn btn-primary">Simpan</button>
			</div>

			<div class="form-group">
				<input type="hidden" name="id" value='<?php echo $role[0]->id?>'>
			</div>

			<div class="form-group">
				<label class="control-label col-lg-2">Nama Role</label>
				<div class="col-lg-10">
					<input type="text" 
								class="form-control" 
								name="name"
								id="name" 
								readonly
								value="<?php echo $role[0]->nama; ?>"
                            	placeholder="Nama role"
								data-validation="required"
								data-validation-error-msg="Nama role harus diisi."
					>
					<span class="help-block"></span>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-2">Keterangan</label>
				<div class="col-lg-10">
					<input type="text" 
								class="form-control" 
								name="description"
								id="description" 
								value='<?php echo $role[0]->Keterangan; ?>'
                            	placeholder="Keterangan"
					>
					<span class="help-block"></span>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-lg-2">Module</label>
				<div class="col-lg-10">
					<table id="table-modules" class="table table-bordered table-hover stripe dataTable no-footer" role="grid" aria-describedby="user_info">
						<thead>
							<tr>
								<th width="4%">No.</th>
								<th width="50%">Module</th>
								<th style="padding-right: 5px; text-align: center;">Select</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($data as $key => $value){ ?>
								<tr role="row" class="odd">
									<td><?php echo $key+1 ?></td>
									<td><?php echo $value->name;?></td>
									<td align="center">
										<input type="checkbox" 
										    <?php if($value->rolemodule_id==$value->id) { ?> checked="checked" <?php }?>
											name="select_<?php echo $value->id ?>"
										>		
									</td>
								</tr>
							<?php } ?>
							
						</tbody>
					</table>
				</div>			
			</div>			

			<div class="text-left">
				<a  href="<?php echo base_url();?>role" class="btn btn-danger">Batal</a>
				<button type="submit" class="btn btn-primary">Simpan</button>
			</div>
			
		</form>

		</div>
		<!-- /Panel Body -->

	</div>
	<!-- /basic datatable -->

	<!-- Footer -->
	<div class="footer text-muted">
		&copy; 2018 <a href="#">admin Statistik</a> 
	</div>
	<!-- /footer -->

</div>

<script type="text/javascript">
	
    $(function () {
    	var baseurl = "<?php echo base_url();?>";
    	// var table = $('#table-uk').DataTable();    	
    	
    });

</script>