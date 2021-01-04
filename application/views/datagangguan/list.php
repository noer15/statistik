<!-- Theme JS files -->
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/tables/datatables/datatables.min.js"></script>	
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/tables/datatables/extensions/responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/pages/datatables_responsive.js"></script>


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
			<a href="<?php echo base_url();?>Gangguan/tambah" class="btn btn-primary">Tambah</a>			
			<br><br>
			<table>
				<tr>
					<td><label class="col-lg-1 control-label">Tahun</label></td>
					<td width="100%">
						<div class="col-lg-10">
			                <select name="tahun"  id="tahun" class="form-control" 
			                    data-placeholder="Pilih Tahun">
			                    	<option value="2013" <?php if($tahun==2013){ echo "selected"; } ?> >2013</option>
			                    	<option value="2014" <?php if($tahun==2014){ echo "selected"; } ?> >2014</option>
			                    	<option value="2015" <?php if($tahun==2015){ echo "selected"; } ?> >2015</option>
			                    	<option value="2016" <?php if($tahun==2016){ echo "selected"; } ?> >2016</option>
			                    	<option value="2017" <?php if($tahun==2017){ echo "selected"; } ?> >2017</option>
			                    	<option value="2018" <?php if($tahun==2018){ echo "selected"; } ?> >2018</option>
									<option value="2019" <?php if($tahun==2019){ echo "selected"; } ?> >2019</option>
									<option value="2020" <?php if($tahun==2020){ echo "selected"; } ?> >2020</option>
									<option value="2021" <?php if($tahun==2021){ echo "selected"; } ?> >2021</option>
									<option value="2022" <?php if($tahun==2022){ echo "selected"; } ?> >2022</option>			                    
			                </select>
		                </div>
					</td>
				</tr>
			</table>
		

		<table class="table datatable-basic table-hover table-bordered striped" id="table-gangguan">
		<thead>
			<tr class="bg-teal-400">
				<th>Nama Desa</th>
				<th>Nama Kawasan Hutan</th>
				<th>Jenis Gangguan dan Kerusakan Hutan</th>
				<th>Jumlah</th>
				<th>Satuan</th>
				<th class="text-center">Aksi</th>
			</tr>
		</thead>
		<!-- <tbody>
		<?php foreach($data as $key => $value){ ?>
			<tr>
				<td><?php echo $value->desa_id; ?></td>
				<td><?php echo $value->namagangguan; ?></td>
				<td><?php echo $value->jumlah; ?></td>
				<td><?php echo $value->satuan; ?></td>
				<td class="text-center">
					<ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="<?php echo base_url();?>Gangguan/edit/<?php echo $value->id;?>">
									<i class="icon-pencil"></i> Edit</a>
								</li>
								<li>
									<a href="#" onclick="deleteData(<?php echo $value->id;?>)"><i class="icon-cross2 text-danger-600"></i> Delete</a>
								</li>
							</ul>
						</li>
					</ul>
				</td>
			</tr>
		<?php } ?>			
		</tbody> -->
		</table>
		</div>
	</div>
	<!-- /basic datatable -->

	<!-- Footer -->
	<div class="footer text-muted">
		&copy; 2018 <a href="#">admin Statistik</a> 
	</div>
	<!-- /footer -->

</div>

<script type="text/javascript">
	var table;
    $(function () {
    	var baseurl = "<?php echo base_url();?>";
    	table = $('#table-gangguan').DataTable({
            autoWidth: false,
            serverSide: true,
            processing: true,
            bFilter: false,
            bInfo: false,
            bLengthChange: false,
            ajax: {
            	data:function(d){
            		d.tahun = $('#tahun').val()
            	},
                url: baseurl+'Gangguan/getdata'                
            },
            columns: [
                {data: "desa"},
                {data: "namakawasan", width: "20%"},
                {data: "namagangguan", width: "20%"},
                {data: "jumlah"},
                {data: "satuan"},
                {data: "aksi", orderable: false, searchable: false, width: "100px"}
            ],            
            order: []
        });
    	
    	$('body').on('click', ".submit", function () {
            var id = $("#data-id").val();
            var requestBody = {
                            "id": $('#data-id').val()
                        };
            $.ajax({
            	url: baseurl+'Gangguan/delete/'+id,
                type: 'DELETE',
                contentType: 'application/json',
                data: JSON.stringify(requestBody),
                beforeSend: function () {
                    $('#modal-delete').modal('hide');
                },
                error: function (data) {
                    resp = JSON.parse(data.responseText);
                    //swal('Terjadi Kesalahan!', resp.message, 'error');
                },
                success: function (resp) {
                    //swal('Sukses!', resp.message, 'success');
                    //table.ajax.reload();
                    location.reload();

                },
                complete: function (xhr) {}
            });
        });

        $('#tahun').change(function(){
            var tahun  = $(this).val(); 
            table.ajax.reload();
        });

    });

    function deleteData($id) {
        $('#modal-delete').modal('show');
        $("#data-id").val($id);
        return true;
    }
    
</script>