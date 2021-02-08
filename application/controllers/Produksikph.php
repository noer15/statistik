<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produksikph extends CI_Controller {
	private $judul = "Produksi Hasil Hutan per KPH ";

	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')){
			redirect(base_url().'Login');
		}
	}

	public function index()
	{

		$list = $this->db->query("Select a.*, b.nama as namakph, c.nama as namapotensi from produksi_kph a 
			inner join m_kph b on b.id=a.kph_id 
			inner join m_jenis_potensi c on c.id=a.jenis_potensi
			")->result_object();				

		$data['data']	 = $list;
		$data['page']	 ='produksikph';
		$data['subpage'] ='list';
		$data['judul']	 =$this->judul;
		$data['header']	 =$this->judul;
		$this->load->view('produksikph/index',$data);
	}	
	
	public function tambah(){

		$kph = $this->db->query("Select a.* from m_kph a ")->result_object();
		$jenis = $this->db->query("Select a.* from m_jenis_potensi a where jenis=2")->result_object();
		$list = $this->db->query("Select a.*, b.nama as namakph, c.nama as namapotensi from produksi_kph a 
			inner join m_kph b on b.id=a.kph_id inner join m_jenis_potensi c on c.id=a.jenis_potensi
			WHERE tanggal = '".date('y-m-d')."'")->result_object();
		
		$data['list']	 = $list;
		$data['jenis'] 	 = $jenis;
		$data['kph'] 	 = $kph;
		$data['page'] 	 = 'produksikph';
		$data['subpage'] ='tambah';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Tambah '.$this->judul;
		$this->load->view('produksikph/index',$data);	
	}

	public function store(){
		$jml_produksi = $this->input->post('jml_produksi');
		$satuan = $this->input->post('satuan');
		$jenis = $this->input->post('jenis');
		$kphId = $this->input->post('kph');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$luas  = $this->input->post('luas_produksi');
		$lsatuan = $this->input->post('luas_satuan');  
		
		$post_data = array(
	      		'jml_produksi' 	=> $jml_produksi,
				'satuan' => $satuan,
				'luas_produksi' => $luas,
				'luas_satuan' => $lsatuan,	        	
	        	'jenis_potensi' => $jenis,	  
				'kph_id' => $kphId,
				'bulan'	=> $bulan,
				'tahun' => $tahun,
				'tanggal' => date('y-m-d')
	    	);
	    $this->db->insert('produksi_kph',$post_data);

		redirect(base_url().'Produksikph/tambah');
	}

	public function edit($id){
		$dt = $this->db->query("Select a.* from produksi_kph a where id='".$id."'")->result_object();
		$kph = $this->db->query("Select a.* from m_kph a where id=".$dt[0]->kph_id)->result_object();
		$potensi = $this->db->query("Select a.* from m_jenis_potensi a where id=".$dt[0]->jenis_potensi)->result_object();
		$jenis = $this->db->query("Select a.* from m_jenis_potensi a where jenis=".$potensi[0]->jenis)->result_object();
		$data['jenis'] 	 = $jenis;		
		$data['data'] = $dt;
		$data['kph'] 	 = $kph;
		$data['potensi'] 	 = $potensi[0]->jenis;
		$data['page'] 	 = 'produksikph';
		$data['subpage'] ='edit';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Edit '.$this->judul;
		$this->load->view('produksikph/index',$data);	
	}

	public function update(){
		$id = $this->input->post('id');
		$jml_produksi = $this->input->post('jml_produksi');
		$satuan = $this->input->post('satuan');
		$jenis = $this->input->post('jenis');
		$kphId = $this->input->post('kph');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$luas  = $this->input->post('luas_produksi');
		$lsatuan = $this->input->post('luas_satuan'); 
		
		$post_data = array(
	      		'jml_produksi' 	=> $jml_produksi,
	        	'satuan' => $satuan,	        	
				'jenis_potensi' => $jenis,
				'luas_produksi' => $luas,
				'luas_satuan' => $lsatuan,
				'bulan' => $bulan,
				'tahun' => $tahun
	    		);
		$this->db->where('id',$id);
	    $this->db->update('produksi_kph',$post_data);

		redirect(base_url().'Produksikph');
	}

	public function delete($id){
		// delete detail dasar
		$result = $this->db->delete('produksi_kph', array('id' => $id));
        // print_r($nip);
	 }

	
}
