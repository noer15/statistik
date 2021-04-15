<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Module extends CI_Controller {
	private $judul = "Modul User";

	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')){
			redirect(base_url().'Login');
		}
	}

	public function index()
	{
		$list = $this->db->get('module')->result();	
		$input = $this->db->query('SELECT sub1 FROM module WHERE module = "Input" GROUP BY sub1')->result_object();	
		$inputSub = $this->db->query('SELECT sub2 FROM module WHERE module = "Input" AND sub2 IS NOT NULL GROUP BY sub2')->result_object();

		$data['data']	 = $list;
		$data['input']	 = $input;
		$data['inputSub']= $inputSub;
		$data['page']	 ='module';
		$data['subpage'] ='list';
		$data['judul']	 =$this->judul;
		$data['header']	 =$this->judul;
		$this->load->view('module/index',$data);
	}	
	
	public function tambah(){
		
		$data['page'] 	 = 'module';
		$data['subpage'] ='tambah';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Tambah '.$this->judul;
		$this->load->view('module/index',$data);	
	}

	public function store(){
	    $this->db->insert('module',$_POST);
		redirect(base_url().'module');
	}

	public function edit($id){
		$data['data'] = $this->db->query("Select a.* from module a where id='".$id."'")->row_object();
		
		$data['page'] 	 = 'modul';
		$data['subpage'] ='edit';		
		$data['judul']	 ='Edit Modul';
		$data['header']	 ='Edit '.$this->judul;
		$this->load->view('module/index',$data);	
	}

	public function update(){
		$id = $this->input->post('id');
		$this->db->where('id',$id);
		unset($_POST['id']);
	    $this->db->update('module', $_POST);

		redirect(base_url().'module');
	}

	public function delete($id){
		$result = $this->db->delete('module', array('id' => $id));
	 }

}
