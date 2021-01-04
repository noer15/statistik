<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends CI_Controller {
	private $judul = "Role User";

	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')){
			redirect(base_url().'Login');
		}
	}

	public function index()
	{

		$list = $this->db->query("Select a.* , 
			( select count(b.module_id) from role_module_asignment b where b.role_id=a.id) as jml
		 from role a ")->result_object();		

		$data['data']	 = $list;
		$data['page']	 ='role';
		$data['subpage'] ='list';
		$data['judul']	 =$this->judul;
		$data['header']	 =$this->judul;
		$this->load->view('role/index',$data);
	}	
	
	public function tambah(){
		
		$data['page'] 	 = 'role';
		$data['subpage'] ='tambah';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Tambah '.$this->judul;
		$this->load->view('role/index',$data);	
	}

	public function store(){
		$nama = $this->input->post('nama');
		$keterangan = $this->input->post('keterangan');
		
		$post_data = array(
	      		'nama' => $nama,
	      		'Keterangan' => $keterangan
	    		);
	    $this->db->insert('role',$post_data);

		redirect(base_url().'role');
	}

	public function edit($id){
		$data['data'] = $this->db->query("Select a.* from role a where id='".$id."'")->result_object();
		
		$data['page'] 	 = 'role';
		$data['subpage'] ='edit';		
		$data['judul']	 ='role';
		$data['header']	 ='Edit '.$this->judul;
		$this->load->view('role/index',$data);	
	}

	public function update(){
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$keterangan = $this->input->post('keterangan');
		
		$post_data = array(
	      		'nama' 	=> $nama,
	      		'Keterangan' => $keterangan       	
	    		);
		$this->db->where('id',$id);
	    $this->db->update('role',$post_data);

		redirect(base_url().'role');
	}

	public function delete($id){
		// delete detail dasar
		$result = $this->db->delete('role', array('id' => $id));
        print_r($nip);
	 }

	 public function module($id){

	 	$role = $this->db->query("Select a.* from role a where id=".$id)->result_object();		
	 	$list = $this->db->query("Select a.*,
	 		(Select b.module_id from role_module_asignment b where b.role_id=".$id." and b.module_id=a.id ) as rolemodule_id
	 	 from module a ")->result_object();
	 	
		$data['role']	 = $role;
		$data['data']	 = $list;
		$data['page']	 ='rolemodule';
		$data['subpage'] ='list';
		$data['judul']	 ='Role Module User';
		$data['header']	 ='Role Module User';
		$this->load->view('role/module/index',$data);
	 }

	public function storeModule(){
		// Role
		$roleId = $this->input->post('id');
		//$nama = $this->input->post('nama'); nama role

		$keterangan = $this->input->post('keterangan');		
		$post_data = array(
	      		'Keterangan' => $keterangan
	    		);
		$this->db->where('id',$roleId);
	    $this->db->update('role',$post_data);
	    // Role-module-ass

	    $list = $this->db->query("Select a.* from module a ")->result_object();
	    foreach ($list as $key => $value) {
	    	# code...
	    	$ch = $this->input->post('select_'.$value->id);
	    	if ($ch=="on"){
	    		$result = $this->db->delete('role_module_asignment', 
	    						array('role_id' => $roleId, 'module_id' => $value->id));
	    		$insert = $this->db->insert('role_module_asignment', array(
	    											'role_id' => $roleId, 
	    											'module_id' => $value->id)
	    								);	    	
	    	}	    	
	    }

		redirect(base_url().'role');
	}

}
