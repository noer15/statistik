<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sertifikatbenih extends CI_Controller {
	private $judul = "Sertifikat Benih ";

	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')){
			redirect(base_url().'Login');
		}
	}

	public function index()
	{

		$list = $this->db->query("Select a.* from sertifikat_benih a ")->result_object();		

		$data['data']	 = $list;
		$data['page']	 ='sertifikatbenih';
		$data['subpage'] ='list';
		$data['judul']	 =$this->judul;
		$data['header']	 =$this->judul;
		$this->load->view('sertifikatbenih/index',$data);
	}	
	
	public function tambah(){

		$kab = $this->db->query("Select a.* from m_kabupaten a ")->result_object();
		
		$data['kabupaten'] 	 = $kab;
		$data['page'] 	 = 'sertifikatbenih';
		$data['subpage'] ='tambah';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Tambah '.$this->judul;
		$this->load->view('sertifikatbenih/index',$data);	
	}

	public function store(){
		$nosb = $this->input->post('nosb');
		$nama = $this->input->post('nama');
		$kabId = $this->input->post('kab');
		$tglsb = $this->input->post('tgl_sb');
		$kelas = $this->input->post('kelas');
		$jenisbenih = $this->input->post('jenisbenih');
		$jumlah = $this->input->post('jumlah');
		$luas = $this->input->post('luas');
		$satuanluas = $this->input->post('satuanluas');
		$volume = $this->input->post('volume');
		$satuanproduksi = $this->input->post('satuanproduksi');
		
		$post_data = array(
	      		'no_sb' 	=> $nosb,
	      		'tgl_sb' 	=> $tglsb,
	      		'kelas' 	=> $kelas,
	        	'nama_pemilik' => $nama,	        	
	        	'jenis_benih' => $jenisbenih,
	        	'jumlah_pohon' => $jumlah,
	        	'luas' => $luas,
	        	'satuan_luas' => $satuanluas,
	        	'volume_produksi' => $volume,
	        	'satuan_produksi' => $satuanproduksi,
	        	'kabupaten_id' => $kabId
	    		);
	    $this->db->insert('sertifikat_benih',$post_data);

		redirect(base_url().'sertifikatbenih');
	}

	public function edit($id){
		$data['data'] = $this->db->query("Select a.* from sertifikat_benih a where id='".$id."'")->result_object();
		
		$kab = $this->db->query("Select a.* from m_kabupaten a ")->result_object();
		
		$data['kabupaten'] 	 = $kab;
		$data['page'] 	 = 'sertifikatbenih';
		$data['subpage'] ='edit';		
		$data['judul']	 ='sertifikatbenih';
		$data['header']	 ='Edit '.$this->judul;
		$this->load->view('sertifikatbenih/index',$data);	
	}

	public function update(){
		$id = $this->input->post('id');
		$nosb = $this->input->post('nosb');
		$nama = $this->input->post('nama');
		$kabId = $this->input->post('kab');
		$tglsb = $this->input->post('tgl_sb');
		$kelas = $this->input->post('kelas');
		$jenisbenih = $this->input->post('jenisbenih');
		$jumlah = $this->input->post('jumlah');
		$luas = $this->input->post('luas');
		$satuanluas = $this->input->post('satuanluas');
		$volume = $this->input->post('volume');
		$satuanproduksi = $this->input->post('satuanproduksi');
		
		$post_data = array(
	      				'no_sb' 	=> $nosb,
			      		'tgl_sb' 	=> $tglsb,
			      		'kelas' 	=> $kelas,
			        	'nama_pemilik' => $nama,	        	
			        	'jenis_benih' => $jenisbenih,
			        	'jumlah_pohon' => $jumlah,
			        	'luas' => $luas,
			        	'satuan_luas' => $satuanluas,
			        	'volume_produksi' => $volume,
			        	'satuan_produksi' => $satuanproduksi,
			        	'kabupaten_id' => $kabId    	
			    		);
		$this->db->where('id',$id);
	    $this->db->update('sertifikat_benih',$post_data);

		redirect(base_url().'sertifikatbenih');
	}

	public function delete($id){
		// delete detail dasar
		$result = $this->db->delete('sertifikat_benih', array('id' => $id));
        print_r($nip);
	 }

}
