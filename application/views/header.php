<div class="navbar navbar-inverse ">
		<div class="navbar-header">
			
			
			<ul class="nav navbar-nav navbar-left">				
			
				<li class="dropdown dropdown-user">
					<a class="dropdown-toggle">
						<img src="<?php echo base_url();?>assets/images/logo1.png" alt="">
						<span style="font-size: 12pt;">Statistik - Dishut Jabar</span>
						
					</a>
					
				</li>
			</ul>

			
			<ul class="nav navbar-nav visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
				<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav">
				<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>				
			</ul>
			
			<ul class="nav navbar-nav navbar-right">				
			
				<li class="dropdown dropdown-user">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<img src="<?php echo base_url();?>assets/limitless/assets/images/placeholder.jpg" alt="">
						<span><?php echo $this->session->userdata('nama'); ?></span>
						<i class="caret"></i>
					</a>

					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="<?php echo base_url();?>pegawai/editprofile/<?php echo $this->session->userdata('user_id');?>"><i class="icon-user-plus"></i> My profile</a></li>						
						<li><a href="<?php echo base_url()?>Login/doLogout"><i class="icon-switch2"></i> Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>