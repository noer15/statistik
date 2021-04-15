<!-- 
	Role Penyuluh :
	- Edit Profile
	- Penyuluh ( langsung namanya dia sendiri )
	- Kelompok Tani
 -->

 <?php
 	$role = $this->session->userdata('role_id');
 	$jabatanId = $this->session->userdata('jabatan_id');
	$uri = $this->uri->segment(1);

	$input = $this->db->query('SELECT b.sub1 FROM role_module_asignment a INNER JOIN module b
								ON a.module_id = b.id WHERE a.role_id = '.$role.' AND module = "Input" AND b.sub1 IS NOT NULL AND b.sub1 != ""
								GROUP BY b.sub1')->result_object();	

	$inputSub = $this->db->query('SELECT b.sub2 FROM role_module_asignment a INNER JOIN module b
									ON a.module_id = b.id WHERE a.role_id = '.$role.' AND module = "Input" AND b.sub2 IS NOT NULL AND b.sub2 != ""
									GROUP BY b.sub2')->result_object();

	$menu = $this->db->query('SELECT b.module FROM role_module_asignment AS a INNER JOIN module AS b
								ON a.module_id = b.id WHERE a.role_id = '.$role.' GROUP BY b.module')->result_object();
 ?>

<div class="sidebar-category sidebar-category-visible">
	<div class="category-content no-padding">
		<ul class="navigation navigation-main navigation-accordion">

			<!-- Main -->
			<li class="navigation-header"><span>Main Menu</span> <i class="icon-menu" title="Main pages"></i></li>
			<li <?php if($page=='home'){ ?> class="active" <?php } ?> >
				<a href="<?php echo base_url();?>home"><i class="icon-home4"></i> <span>Home</span></a>
			</li>


			<?php foreach($menu as $menu): ?>
				<li>
					<a href="#"><i class="icon-grid"></i> <span><?=$menu->module?> Data</span></a>
					<ul>
						<?php 
							$list = $this->db->query('SELECT b.* FROM role_module_asignment a INNER JOIN module b 
									ON a.module_id = b.id WHERE a.role_id = '.$role.' AND b.module = "'.$menu->module.'"')->result_object();
							$oldSub1 = ''; $oldSub2 = '';
							foreach($list as $list): ?>
								<?php if($menu->module == 'Input'): ?>
									<?php if($list->sub1) :?>
											<?php if($list->sub1 != $oldSub1): ?>
											<li>
												<a href="#"><?=$list->sub1?></a>
												<ul>
													<?php 
														$list2 = $this->db->query('SELECT b.* FROM role_module_asignment a INNER JOIN module b 
														ON a.module_id = b.id WHERE a.role_id = '.$role.' AND b.sub1 = "'.$list->sub1.'"')->result_object();

														foreach($list2 as $sub1): ?>
														<?php if($sub1->sub2): ?>
															<?php if($sub1->sub2 != $oldSub2): ?>
															<li>
																<a href="#"><?=$sub1->sub2?></a>
																<ul>
																	<?php 
																		$list3 = $this->db->query('SELECT b.* FROM role_module_asignment a INNER JOIN module b 
																		ON a.module_id = b.id WHERE a.role_id = '.$role.' AND b.sub2 = "'.$sub1->sub2.'"')->result_object();
																		foreach($list3 as $sub2): ?>
																	<li>
																		<a href="<?=base_url(''.$sub2->controller);?>"><?=$sub2->name?></a>
																	</li>
																	<?php endforeach; ?>
																</ul>
															</li>
															<?php endif; ?>
														<?php
															$oldSub2 = $sub1->sub2;
															 else: ?>
														<li>
															<a href="<?=base_url(''.$sub1->controller);?>"><?=$sub1->name?></a>
														</li>
														<?php endif; ?>
													<?php endforeach; ?>
												</ul>
											</li>
											<?php endif; ?>
									<?php else: ?>
										<li>
											<a href="<?=base_url(''.$list->controller);?>"><?=$list->name?></a>
										</li>
									<?php endif; ?>
								<!-- end menu input --->

								 <!-- menu laporan -->
								<?php else: if($menu->module == 'Laporan'): ?>
									<?php if($list->sub1): ?>
										<?php if($list->sub1 != $oldSub1): ?>
											<li>
												<a href="#"><?=$list->sub1?></a>
												<ul>
													<?php 
														$list2 = $this->db->query('SELECT b.* FROM role_module_asignment a INNER JOIN module b 
														ON a.module_id = b.id WHERE a.role_id = '.$role.' AND b.sub1 = "'.$list->sub1.'"')->result_object();

														foreach($list2 as $sub1): ?>
														<?php if($sub1->sub2): ?>
															<?php if($sub1->sub2 != $oldSub2): ?>
															<li>
																<a href="#"><?=$sub1->sub2?></a>
																<ul>
																	<?php 
																		$list3 = $this->db->query('SELECT b.* FROM role_module_asignment a INNER JOIN module b 
																		ON a.module_id = b.id WHERE a.role_id = '.$role.' AND b.sub2 = "'.$sub1->sub2.'"')->result_object();
																		foreach($list3 as $sub2): ?>
																	<li>
																		<a href="<?=base_url(''.$sub2->controller);?>/rekap"><?=$sub2->name?></a>
																	</li>
																	<?php endforeach; ?>
																</ul>
															</li>
															<?php endif; ?>
														<?php 
															$oldSub2 = $sub1->sub2;
															else: ?>
														<li>
															<a href="<?=base_url(''.$sub1->controller);?>/rekap"><?=$sub1->name?></a>
														</li>
														<?php endif; ?>
													<?php endforeach; ?>
												</ul>
											</li>
										<?php endif; ?>

									<?php else: ?>
									<li>
										<a href="<?=base_url(''.$list->controller);?>/rekap"><?=$list->name?></a>
									</li>
									<?php endif; ?>
									<!-- end list menu laporan -->
									
									<?php else: ?>
										<!-- list menu master -->
										<li>
											<a href="<?=base_url(''.$list->controller);?>"><?=$list->name?></a>
										</li>
									<?php endif; ?>
								<?php endif; ?>
								<?php $oldSub1 = $list->sub1; ?>
						<?php 
							endforeach; ?>
					</ul>
				</li>
			<?php endforeach; ?>

			<?php if($role==1){ ?>
				<li class="navigation-header"><span>Setting</span><i class="icon-menu" title="Settings"></i></li>								
				<!-- <li <?php if($page=='user'){ ?> class="active" <?php } ?>>
					<a href="<?php echo base_url();?>user"><i class="icon-grid"></i> <span>Users</span></a>
				</li> -->
				<li <?php if($page=='module'){ ?> class="active" <?php } ?>>
					<a href="<?php echo base_url();?>module"><i class="icon-grid"></i> <span>Modul</span></a>
				</li>								
				<li <?php if($page=='role'){ ?> class="active" <?php } ?>>
					<a href="<?php echo base_url();?>role"><i class="icon-grid"></i> <span>Role User</span></a>
				</li>
			<?php } ?>

			
		</ul>
	</div>
</div>