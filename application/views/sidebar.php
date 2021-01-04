<!-- 

	Role Penyuluh :
	- Edit Profile
	- Penyuluh ( langsung namanya dia sendiri )
	- Kelompok Tani

 -->

 <?php 
 	$role = $this->session->userdata('role_id'); 
 	$jabatanId = $this->session->userdata('jabatan_id'); 
 ?>

<div class="sidebar-category sidebar-category-visible">
	<div class="category-content no-padding">
		<ul class="navigation navigation-main navigation-accordion">

			<!-- Main -->
			<li class="navigation-header"><span>Main Menu</span> <i class="icon-menu" title="Main pages"></i></li>
			<li <?php if($page=='home'){ ?> class="active" <?php } ?> >
				<a href="<?php echo base_url();?>home"><i class="icon-home4"></i> <span>Home</span></a>
			</li>

			<?php if($this->session->userdata('role_id')==1){ ?>

			<li <?php 
					if($page=='kabupaten' || $page=='kecamatan' || $page=='desa' 
						|| $page=='gangguan' || $page=='kawasan' || $page=='masterpotensi')
				{ ?> class="active" <?php } ?>>
				<a href="#"><i class="icon-grid"></i> <span>Master Data</span></a>
				<ul>
					<li <?php if($page=='kabupaten'){ ?> class="active" <?php } ?>>
						<a href="<?php echo base_url();?>Kabupaten">Kabupaten</a>
					</li>
					<li <?php if($page=='kecamatan'){ ?> class="active" <?php } ?>>
						<a href="<?php echo base_url();?>Kecamatan">Kecamatan</a>
					</li>
					<li <?php if($page=='desa'){ ?> class="active" <?php } ?>>
						<a href="<?php echo base_url();?>Desa">Desa</a>
					</li>										
					<li <?php if($page=='gangguan'){ ?> class="active" <?php } ?>>
						<a href="<?php echo base_url();?>Gangguanhutan">Jenis Gangguan</a>
					</li>
					<li <?php if($page=='kph'){ ?> class="active" <?php } ?>>
						<a href="<?php echo base_url();?>Kph">Unit Kerja Pengelola</a>
					</li>
					<li <?php if($page=='kawasan'){ ?> class="active" <?php } ?>>
						<a href="<?php echo base_url();?>Kawasan">Kawasan Hutan</a>
					</li>
					<li <?php if($page=='konservasi'){ ?> class="active" <?php } ?>>
						<a href="<?php echo base_url();?>Konservasi">Kawasan Konservasi</a>
					</li>
					<li <?php if($page=='peruntukanpinjampakai'){ ?> class="active" <?php }?>>
						<a href="<?php echo base_url();?>peruntukanpinjampakai"><span>Peruntukan Pinjam Pakai</span></a>
					</li>
					<li <?php if($page=='masterpotensi'){ ?> class="active" <?php } ?>>
						<a href="<?php echo base_url();?>Jenispotensi">Jenis Potensi</a>
					</li>
					<li <?php if($page=='masterkategorikel'){ ?> class="active" <?php } ?>>
						<a href="<?php echo base_url();?>Kategorikelompok">Kategori Kelompok</a>
					</li>
					<li <?php if($page=='masterkelaskel'){ ?> class="active" <?php } ?>>
						<a href="<?php echo base_url();?>Kelaskelompok">Kelas Kelompok</a>
					</li>
					<li <?php if($page=='masterjabatan'){ ?> class="active" <?php } ?>>
						<a href="<?php echo base_url();?>Jabatan">Jabatan</a>
					</li>

					<li <?php if($page=='sdmsarpras'){ ?> class="active" <?php } ?>>
						<a href="<?php echo base_url();?>Sdmsarpras">SDM dan Sarana Prasarana</a>
					</li>

					<li <?php if($page=='masteruk'){ ?> class="active" <?php } ?>>
						<a href="<?php echo base_url();?>Unitkerja">Unit Kerja</a>
					</li>

					<li <?php if($page=='mastersatuan'){ ?> class="active" <?php } ?>>
						<a href="<?php echo base_url();?>Satuan">Satuan</a>
					</li>

					<!-- <li <?php if($page=='masterjabluh'){ ?> class="active" <?php } ?>>
						<a href="<?php echo base_url();?>Jabluh">Jabatan Penyuluh</a>
					</li> -->
				</ul>
			</li>
			<?php } ?>

<!-- <?php 
					if($page=='kelompok_tani' || $page=='pemiliklahan' || $page=='penyuluh'
						|| $page=='datagangguan' || $page=='lsm' || $page=='produksikph')
				{ ?> class="active" <?php } ?> -->
				
			<li>
				<a href="#"><i class="icon-grid"></i> <span>Data</span></a>
				<ul>

				<?php if($role==18 || $role==1) { ?>

					<li <?php if($page=='pegawai'){ ?> class="active" <?php }?>>
						<a href="<?php echo base_url();?>pegawai">Data Pegawai</a>
					</li>

					<li <?php if($page=='penyuluh'){ ?> class="active" <?php }?> >
						<a href="<?php echo base_url();?>penyuluh"><span>Penyuluh PKSM</span></a>
					</li>

				<?php } ?>

				<?php if($role==3 || $role==1 ) { ?>

					<li <?php if($page=='kelompok_tani'){ ?> class="active" <?php } ?>>
						<a href="<?php echo base_url();?>Kelompoktani">Kelompok Tani</a>
					</li>
					<li <?php if($page=='pemiliklahan'){ ?> class="active" <?php }?> >
						<a href="<?php echo base_url();?>pemiliklahan"><span>Kepemilikan Lahan</span></a>
					</li>

				<?php } ?>
					
				<?php if($role==1){ ?>

					<li <?php if($page=='produksikph'){ ?> class="active" <?php }?> >
						<a href="<?php echo base_url();?>Produksikph"><span>Produksi Hasil Hutan

						<span class="label bg-danger-400">KPH</span></span>
						</a>
					</li>										
				
					<li <?php if($page=='datagangguan'){ ?> class="active" <?php }?>>
						<a href="<?php echo base_url();?>gangguan"><span>Gangguan dan Kerusakan Hutan</span></a>
					</li>

					<li <?php if($page=='luaslahan'){ ?> class="active" <?php }?>>
						<a href="<?php echo base_url();?>luaslahan"><span>Luas Kawasan Hutan</span></a>
					</li>

					<li <?php if($page=='pengukuhankh'){ ?> class="active" <?php }?>>
						<a href="<?php echo base_url();?>pengukuhankh"><span>Pengukuhan Kawasan Hutan</span></a>
					</li>

					<li <?php if($page=='pinjampakai'){ ?> class="active" <?php }?>>
						<a href="<?php echo base_url();?>pinjampakai"><span>Pinjam Pakai Kawasan Hutan</span></a>
					</li>

					<li <?php if($page=='lsm'){ ?> class="active" <?php }?>>
						<a href="<?php echo base_url();?>lsm"><span>LSM</span></a>
					</li>

					<li <?php if($page=='sertifikatbenih'){ ?> class="active" <?php }?>>
						<a href="<?php echo base_url();?>sertifikatbenih"><span>Sertifikasi Benih</span></a>
					</li>
					<li <?php if($page=='lahankritis'){ ?> class="active" <?php }?>>
						<a href="<?php echo base_url();?>lahankritis"><span>Lahan Kritis</span></a>
					</li>											

					<!-- <li >
						<a href="#"><i class="icon-copy"></i> <span>Pemasaran Hasil Hutan</span></a>
					</li>								
					
					<li >
						<a href="#"><i class="icon-copy"></i> <span>PSDH</span></a>
						<ul>
							<li><a href="#">Kayu</a></li>
							<li><a href="#">Non Kayu</a></li>
						</ul>
					</li>								
					<li >
						<a href="#"><i class="icon-copy"></i> <span>Objek Wisata</span></a>
					</li>															 -->	
					
					<!-- <li >
						<a href="#"><i class="icon-copy"></i> <span>Pembinaan MDH</span></a>
					</li> -->

				<?php } ?>

				</ul>
			</li>

			<?php if($role==1) { ?>

			<li <?php if($page=='industri') {?> class="active" <?php } ?>>
				<a href="#"><i class="icon-grid"></i> <span>Industri</span></a>
				<ul>
					<li <?php if($page=='industri'){ ?> class="active" <?php } ?>>
						<a href="<?php echo base_url();?>Industri">Industri Sektor Kehutanan</a>
					</li>
					<!-- <li <?php if($page=='industriproduk'){ ?> class="active" <?php } ?>>
						<a href="<?php echo base_url();?>Industriproduk">Produksi</a>
					</li>
					<li >
						<a href="#"><span>IUIPHHK
							<span class="label bg-danger-400">Sektor Kehutanan</span></span>
						</a>
					</li>
					<li >
						<a href="#"><span>Penerbiatan FAKO</span></a>
					</li> -->
				</ul>
			</li>			

			<?php } ?>					

			<?php if($role==1 || $role==3 || $role==18){ ?>
			
			<li>
				<a href="#"><i class="icon-puzzle2"></i> <span>Laporan</span></a>
				<ul>					
					<li <?php if($page=='reportpenyuluh'){ ?> class="active" <?php } ?> >
						 <a href="<?php echo base_url();?>penyuluh/rekap">Penyuluh</a>
					</li>
					<li <?php if($page=='reportkelompoktani'){ ?> class="active" <?php } ?>> 
						<a href="<?php echo base_url();?>Kelompoktani/rekap">Kelompok Tani</a>
					</li>
					<li> <a href="#">Luas Kawasan Hutan</a></li>
				</ul>
			</li>
			
			<?php } ?>

			
			<!-- /main -->
			<?php if($role==1){ ?>
				<!-- Appearance -->
				<li class="navigation-header"><span>Setting</span><i class="icon-menu" title="Settings"></i></li>								
				<!-- <li <?php if($page=='user'){ ?> class="active" <?php } ?>>
					<a href="<?php echo base_url();?>user"><i class="icon-grid"></i> <span>Users</span></a>
				</li> -->								
				<li <?php if($page=='role'){ ?> class="active" <?php } ?>>
					<a href="<?php echo base_url();?>role"><i class="icon-grid"></i> <span>Role</span></a>
				</li>
				<!-- /appearance -->
			<?php } ?>

			
		</ul>
	</div>
</div>