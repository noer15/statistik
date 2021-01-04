<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabluh extends CI_Controller {
	private $judul = "Master Jabatan Penyuluh ";

	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')){
			redirect(base_url().'Login');
		}
	}

	public function index()
	{

		$list = $this->db->query("Select a.* from m_jabatan_penyuluh a ")->result_object();		

		$data['data']	 = $list;
		$data['page']	 ='masterjabluh';
		$data['subpage'] ='list';
		$data['judul']	 =$this->judul;
		$data['header']	 =$this->judul;
		$this->load->view('master/jabluh/index',$data);
	}	
	
	public function tambah(){
		
		$data['page'] 	 = 'masterjabluh';
		$data['subpage'] ='tambah';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Tambah '.$this->judul;
		$this->load->view('master/jabluh/index',$data);	
	}

	public function store(){
		$nama = $this->input->post('nama');
		
		$post_data = array(
	      		'nama' => $nama	    
	    		);
	    $this->db->insert('m_jabatan_penyuluh',$post_data);

		redirect(base_url().'jabluh');
	}

	public function edit($id){
		$data['data'] = $this->db->query("Select a.* from m_jabatan_penyuluh a where id='".$id."'")->result_object();
		
		$data['page'] 	 = 'masterjabluh';
		$data['subpage'] ='edit';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Edit '.$this->judul;
		$this->load->view('master/jabluh/index',$data);	
	}

	public function update(){
		$nama = $this->input->post('nama');
		$id = $this->input->post('id');
		
		$post_data = array(
	      		'nama' => $nama
	    		);
		$this->db->where('id',$id);
	    $this->db->update('m_jabatan_penyuluh',$post_data);

		redirect(base_url().'jabluh');
	}

	public function delete($id){
		// delete detail dasar
		$result = $this->db->delete('m_jabatan_penyuluh', array('id' => $id));
        print_r($nip);
	 }

}
