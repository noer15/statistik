<script type="text/javascript">
    $(function () {
        var baseurl = "<?php echo base_url();?>"
        $('#potensi').change(function(){
            var potensi  = $(this).val();     
            $("#jenis").empty();                        
            $.ajax({                            
                url: baseurl+'/Potensi/getJenis/'+potensi,
                type:'GET',
                contentType: 'application/json',
                success: function (resp) { 
                    var dataArray = JSON.parse(resp);            
                    for (var i in dataArray) {
                        console.log(dataArray[i]);
                        $('#jenis').append($("<option></option>")
                            .attr("value",dataArray[i].id)
                            .text(dataArray[i].nama));
                    }
                },
            });  
        });

        $('#kab').change(function(){
            var kab = $(this).val();
            $("#kec").empty();                        
            $.ajax({                            
                url: baseurl+'/Produksiluarkph/getKec/'+kab,
                type:'GET',
                contentType: 'application/json',
                success: function (resp) {   
                    $('#kec').html('<option value="0"> Pilih Kecamatan</option>');        
                    var dataArray = JSON.parse(resp);            
                    for (var i in dataArray) {
                        $('#kec').append($("<option></option>")
                            .attr("value",dataArray[i].kode)
                            .text(dataArray[i].nama));
                    }
                },
            });  
        })

        $('#kec').change(function(){
            var kab = $(this).val();
            $("#desa").empty();                        
            $.ajax({                            
                url: baseurl+'/Produksiluarkph/getDesa/'+kab,
                type:'GET',
                contentType: 'application/json',
                success: function (resp) {   
                    $('#desa').html('<option value="0"> Pilih Desa</option>');        
                    var dataArray = JSON.parse(resp);            
                    for (var i in dataArray) {
                        $('#desa').append($("<option></option>")
                            .attr("value",dataArray[i].id)
                            .text(dataArray[i].nama));
                    }
                },
            });  
        })
    });
</script>
<div class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- Basic layout-->
			<form action="<?php echo base_url();?>Produksiluarkph/store" class="form-horizontal" method="post">
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
						<div class="panel-body">
						    <div class="form-group">
                                <label class="col-lg-2 control-label">Kabupaten</label>
                                <div class="col-lg-10">
                                <select name="kab" id="kab" class="form-control" required
                                    data-placeholder="Pilih Kabupaten">
                                    <option value="0">Pilih Kabupaten</option>
                                    <?php foreach ($this->db->get('m_kabupaten')->result() as $key => $value) { ?>
                                        <option value="<?php echo $value->kode?>">
                                            <?php echo $value->nama?>                                    		
                                        </option>
                                    <?php }  ?>
                                </select>
                                </div>
					        </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Kecamatan</label>
                                <div class="col-lg-10">
                                <select name="kec"  id="kec" class="form-control" required
                                    data-placeholder="Pilih Kecamatan">
                                    <option value="0"> Pilih Kecamatan</option>
                                </select>
                                </div>
					        </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Desa</label>
                                <div class="col-lg-10">
                                <select name="desa" id="desa" class="form-control" required
                                    data-placeholder="Pilih Desa">
                                    <option value="0"> Pilih Desa</option>
                                </select>
                                </div>
					        </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Potensi</label>
                                <div class="col-lg-10">
                                    <select name="potensi"  id="potensi" class="form-control" required
                                        data-placeholder="Pilih Potensi">
                                            <option value="2">Non Kayu</option>
                                            <option value="1">Kayu</option>                                
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                    <label class="col-lg-2 control-label">Jenis Produksi</label>
                                <div class="col-lg-10">
                                    <select name="jenis"  id="jenis" class="form-control" required
                                        data-placeholder="Pilih Jenis Potensi">
                                        <?php foreach ($jenis as $key => $value) { ?>
                                            <option value="<?php echo $value->id?>">
                                                <?php echo $value->nama?>                                           
                                            </option>
                                        <?php }  ?>
                                        
                                    </select>
                                </div>
                            </div>


						<div class="form-group">
							<label class="col-lg-2 control-label">Jml Produksi</label>
							<div class="col-lg-10">
								<input type="number" class="form-control" placeholder="Jumlah Produksi" name="jml_produksi">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-2 control-label">Satuan</label>
							<div class="col-lg-10">
                            <select name="satuan" id="" class="form-control">
                                <?php foreach($this->db->get('m_satuan')->result() as $satuan): ?>
                                    <option value="<?=$satuan->nama?>"><?=$satuan->nama?></option>
                                <?php endforeach; ?>
                                </select>
							</div>
						</div>
                        <div class="form-group">
                            <div id="vtahun">
                                <label for="" class="col-lg-2 control-label">Tahun</label>
                                <div class="col-lg-4">
                                    <select name="tahun" id="tahun" class="form-control">
                                        <option value="2020">2017</option>
                                        <option value="2020">2018</option>
                                        <option value="2020">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021" selected>2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                    </select>
                                </div>
                            </div>
                            <div id="vbulan">
                                <label for="" class="col-lg-2 control-label">Bulan</label>
                                <div class="col-lg-4">
                                    <input type="hidden" name="bulan" id="bulanValue" value="01">
                                    <select id="bulan" class="form-control">
                                        <option value="01" selected>January</option>
                                        <option value="02">Februari</option>
                                        <option value="03">Maret</option>
                                        <option value="04">April</option>
                                        <option value="05">Mei</option>
                                        <option value="06">Juni</option>
                                        <option value="07">Juli</option>
                                        <option value="08">Agustus</option>
                                        <option value="09">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                            </div>
                            <script>
                                $('#tahun').change(function(){
                                    let thn = $(this).val();
                                    if(thn == '2020'){
                                        $('#vbulan').hide();
                                        $('#bulanValue').val("");
                                    }else{
                                        $('#vbulan').show();
                                        $('#bulanValue').val($('#bulan').val());
                                    }
                                });

                                $('#bulan').change(function(){
                                    let bln = $(this).val();
                                    $('#bulanValue').val(bln);
                                })
                            </script>
                        </div>
						<div class="text-left">
							<a  href="<?php echo base_url();?>Produksikph" class="btn btn-danger">Batal</a>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</div>
				</div>
			</form>
			<!-- /basic layout -->
		</div>
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Data Produksi Hasil Hutan Hari Ini</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">
                    <table class="table table-hover table-bordered striped" id="table-penyuluh">
                    <thead>
                        <tr class="bg-teal-400">
                            <th>Nama Kabupaten</th>
                            <th>Kecamatan</th>
                            <th>Desa</th>
                            <th>Jenis Produksi</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($list as $key => $value){ ?>
                        <tr>
                            <td><?php echo $value->nama_kab; ?></td>
                            <td><?php echo $value->nama_kec; ?></td>
                            <td><?php echo $value->nama_desa; ?></td>
                            <th><?php echo $value->potensi; ?></th>
                            <th><?php echo $value->jml_produksi; ?></th>
                            <td><?php echo $value->satuan; ?></td>
                            <td class="text-center">
                                <ul class="icons-list">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="icon-menu9"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="<?php echo base_url();?>Produksiluarkph/edit/<?php echo $value->id;?>">
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
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
	</div>
</div>