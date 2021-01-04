<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lsm extends CI_Controller {
	private $judul = "Data LSM ";

	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')){
			redirect(base_url().'Login');
		}
	}

	public function index()
	{

		$list = $this->db->query("Select a.* from t_lsm a ")->result_object();		

		$data['data']	 = $list;
		$data['page']	 ='lsm';
		$data['subpage'] ='list';
		$data['judul']	 =$this->judul;
		$data['header']	 =$this->judul;
		$this->load->view('lsm/index',$data);
	}	
	
	public function tambah(){

		$kab = $this->db->query("Select a.* from m_kabupaten a ")->result_object();

		$kec = $this->db->query("Select a.* from m_kecamatan a where a.kabupaten_id=".$kab[0]->id)->result_object();

		$desa = $this->db->query("Select a.* from m_desa a where a.kecamatan_id=".$kec[0]->id)->result_object();
		
		$data['kabupaten'] 	 = $kab;
		$data['kecamatan'] 	 = $kec;
		$data['desa'] 	 = $desa;
		$data['page'] 	 = 'lsm';
		$data['subpage'] ='tambah';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Tambah '.$this->judul;
		$this->load->view('lsm/index',$data);	
	}

	public function store(){
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$phone = $this->input->post('phone');
		$email = $this->input->post('email');
		$ketua = $this->input->post('ketua');
		$status = 1;
		$jmlanggota = $this->input->post('jmlanggota');
		$desaId = $this->input->post('desa');
		
		$post_data = array(
	      		'nama_lsm' 	=> $nama,
	        	'alamat' => $alamat,	        	
	        	'phone' => $phone,	  
	        	'email' => $email,	  
	        	'ketua' => $ketua,
	        	'status' => $status,	        	
	        	'jml_anggota' => $jmlanggota,
	        	'desa_id' => $desaId
	    		);
	    $this->db->insert('t_lsm',$post_data);

		redirect(base_url().'Lsm');
	}

	public function edit($id){
		$dt = $this->db->query("Select a.* from t_lsm a where id='".$id."'")->result_object();
		
		$desa = $this->db->query("Select a.* from m_desa a where id=".$dt[0]->desa_id)->result_object();		
		$kec = $this->db->query("Select a.* from m_kecamatan a where id=".$desa[0]->kecamatan_id)->result_object();
		$kab = $this->db->query("Select a.* from m_kabupaten a where id=".$kec[0]->kabupaten_id)->result_object();
		
		$data['data'] = $dt;
		$data['kabupaten'] 	 = $kab;
		$data['kecamatan'] 	 = $kec;
		$data['desa'] 	 = $desa;
		$data['page'] 	 = 'lsm';
		$data['subpage'] ='edit';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Edit '.$this->judul;
		$this->load->view('lsm/index',$data);	
	}

	public function update(){
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$phone = $this->input->post('phone');
		$email = $this->input->post('email');
		$ketua = $this->input->post('ketua');
		$status = 1;
		$jmlanggota = $this->input->post('jmlanggota');
		
		$post_data = array(
	      		'nama_lsm' 	=> $nama,
	        	'alamat' => $alamat,	        	
	        	'phone' => $phone,	  
	        	'email' => $email,	  
	        	'ketua' => $ketua,
	        	'status' => $status,	        	
	        	'jml_anggota' => $jmlanggota
	    		);
		$this->db->where('id',$id);
	    $this->db->update('t_lsm',$post_data);

		redirect(base_url().'Lsm');
	}

	public function delete($id){
		// delete detail dasar
		$result = $this->db->delete('t_lsm', array('id' => $id));
        print_r($nip);
	 }

	
}
