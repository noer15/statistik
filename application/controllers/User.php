<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	private $judul = "User";

	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')){
			redirect(base_url().'Login');
		}
	}

	public function index()
	{
		$str="";
		if($this->session->userdata('role_id')==1){
			$str="";
		}else{
			$str=" and id=".$this->session->userdata('user_id');
		}

		$list = $this->db->query("Select a.* from users a where id<>1 and suspend<>1 ".$str)->result_object();		

		$data['data']	 = $list;
		$data['page']	 ='user';
		$data['subpage'] ='list';
		$data['judul']	 =$this->judul;
		$data['header']	 =$this->judul;
		$this->load->view('user/index',$data);
	}	
	
	public function tambah(){
		//$data['pegawai'] = $this->db->query("Select a.* from tb_pegawai a ")->result_object();
		$data['group'] = $this->db->query("Select a.* from role a ")->result_object();

		$data['page'] 	 = 'user';
		$data['subpage'] ='tambah';		
		$data['judul']	 ='User';
		$data['header']	 ='Tambah '.$this->judul;
		$this->load->view('user/index',$data);	
	}

	public function store(){
		try{
			$name = $this->input->post('name');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			//$pegawai_id = $this->input->post('pegawai_id');
			$role_id = $this->input->post('role_id');
			$tgl = date('Y-m-d H:i:s');
			
			$post_data = array(
		      		'name' 	=> $name,
		        	'username' => $username,
		        	'password' => $password,
		        	'role_id' => $role_id,
		        	'suspend' => 0,
		        	'created_at' => $tgl,
		        	'updated_at' => $tgl
		    		);
		    $this->db->insert('users',$post_data);
		}catch(Exception $e){
			$this->session->set_flashdata('error', 'Duplicate Username, please try again...');
			//log_message('error',$e->getMessage());
		}

		redirect(base_url().'user');
	}

	public function edit($id){
		$data['data'] = $this->db->query("Select a.* from users a where id=".$id)->result_object();
		//$data['pegawai'] = $this->db->query("Select a.* from tb_pegawai a ")->result_object();
		$data['group'] = $this->db->query("Select a.* from m_role a ")->result_object();

		$data['page'] 	 = 'user';
		$data['subpage'] ='edit';		
		$data['judul']	 ='User';
		$data['header']	 ='Edit '.$this->judul;
		$this->load->view('user/index',$data);	
	}

	public function update(){
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		//$pegawai_id = $this->input->post('pegawai_id');
		$role_id = $this->input->post('role_id');
		$tgl = date('Y-m-d H:i:s');

		$post_data = array(
	      		'name' 	=> $name,
	        	'username' => $username,
	        	'password' => $password,
	        	'role_id' => $role_id,
	        	'updated_at' => $tgl
	    		);
		$this->db->where('id',$id);
	    $this->db->update('users',$post_data);

		//$this->index();
		redirect(base_url().'user');
	}

	public function delete($id){
		// delete detail dasar
		$result = $this->db->delete('users', array('id' => $id));
        print_r($id);
	 }

}
