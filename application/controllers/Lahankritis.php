<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lahankritis extends CI_Controller {
	private $judul = "Lahan Kritis ";

	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')){
			redirect(base_url().'Login');
		}
	}

	public function index()
	{

		$list = $this->db->query("Select a.*, b.nama as namakab from lahan_kritis a 
			inner join m_kabupaten b on b.id=a.kabupaten_id ")->result_object();		

		$data['data']	 = $list;
		$data['page']	 ='lahankritis';
		$data['subpage'] ='list';
		$data['judul']	 =$this->judul;
		$data['header']	 =$this->judul;
		$this->load->view('lahankritis/index',$data);
	}	
	
	public function tambah(){

		$kab = $this->db->query("Select a.* from m_kabupaten a ")->result_object();
		
		$data['kabupaten'] 	 = $kab;
		$data['page'] 	 = 'lahankritis';
		$data['subpage'] ='tambah';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Tambah '.$this->judul;
		$this->load->view('lahankritis/index',$data);	
	}

	public function store(){
		$kategori = $this->input->post('kategori');
		$luas = $this->input->post('luas');
		$satuan = $this->input->post('satuan');
		$kabId = $this->input->post('kab');
		
		$post_data = array(
	      		'kategori' 	=> $kategori,
	        	'luas' => $luas,
	        	'satuan' => $satuan,
	        	'kabupaten_id' => $kabId
	    		);
	    $this->db->insert('lahan_kritis',$post_data);

		redirect(base_url().'lahankritis');
	}

	public function edit($id){
		$data['data'] = $this->db->query("Select a.* from lahan_kritis a where id='".$id."'")->result_object();
		
		$kab = $this->db->query("Select a.* from m_kabupaten a ")->result_object();
		
		$data['kabupaten'] 	 = $kab;
		$data['page'] 	 = 'lahankritis';
		$data['subpage'] ='edit';		
		$data['judul']	 ='lahankritis';
		$data['header']	 ='Edit '.$this->judul;
		$this->load->view('lahankritis/index',$data);	
	}

	public function update(){
		$id = $this->input->post('id');
		$kategori = $this->input->post('kategori');
		$luas = $this->input->post('luas');
		$satuan = $this->input->post('satuan');
		$kabId = $this->input->post('kab');
		
		$post_data = array(
	      		'kategori' => $kategori,
	        	'luas' => $luas,
	        	'satuan' => $satuan,
	        	'kabupaten_id' => $kabId	    
	    		);
		$this->db->where('id',$id);
	    $this->db->update('lahan_kritis',$post_data);

		redirect(base_url().'lahankritis');
	}

	public function delete($id){
		// delete detail dasar
		$result = $this->db->delete('lahan_kritis', array('id' => $id));
        print_r($nip);
	 }

}
