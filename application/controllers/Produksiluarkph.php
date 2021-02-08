<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produksiluarkph extends CI_Controller {

	private $judul = "Produksi Hasil Hutan Luar Kawasan Hutan ";

	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')){
			redirect(base_url().'Login');
		}
	}

	public function index()
	{

		$list = $this->db->query("SELECT a.*, b.nama AS nama_desa, c.nama AS nama_kec, d.nama AS nama_kab, e.nama AS potensi, f.nama as nama_kec_2, g.nama as nama_kab_2
		FROM produksi_luar_kph AS a LEFT JOIN m_desa AS b ON a.desa_id = b.id LEFT JOIN m_kecamatan AS c ON b.kecamatan_id = c.id
		LEFT JOIN m_kabupaten AS d ON c.kabupaten_id = d.id LEFT JOIN m_jenis_potensi AS e ON a.jenis_potensi_id = e.id
		LEFT JOIN m_kecamatan AS f ON a.kec_id = f.id LEFT JOIN m_kabupaten AS g ON a.kab_id = g.id ")->result_object();				

		$data['data']	 = $list;
		$data['page']	 ='produksiluarkph';
		$data['subpage'] ='list';
		$data['judul']	 =$this->judul;
		$data['header']	 =$this->judul;
		$this->load->view('produksiluarkph/index',$data);
	}	
	
	public function tambah(){

		$jenis = $this->db->query("Select a.* from m_jenis_potensi a where jenis=2")->result_object();
		$list = $this->db->query("SELECT a.*, b.nama AS nama_desa, c.nama AS nama_kec, d.nama AS nama_kab, e.nama AS potensi, f.nama as nama_kec_2, g.nama as nama_kab_2
								FROM produksi_luar_kph AS a LEFT JOIN m_desa AS b ON a.desa_id = b.id LEFT JOIN m_kecamatan AS c ON b.kecamatan_id = c.id
								LEFT JOIN m_kabupaten AS d ON c.kabupaten_id = d.id LEFT JOIN m_jenis_potensi AS e ON a.jenis_potensi_id = e.id
								LEFT JOIN m_kecamatan AS f ON a.kec_id = f.id LEFT JOIN m_kabupaten AS g ON a.kab_id = g.id 
								WHERE tanggal = '".date("y-m-d")."'")
		->result_object();
		
		$data['list']	 = $list;
		$data['jenis'] 	 = $jenis;
		$data['page'] 	 = 'produksiluarkph';
		$data['subpage'] = 'tambah';		
		$data['judul']	 = $this->judul;
		$data['header']	 = 'Tambah '.$this->judul;
		$this->load->view('produksiluarkph/index',$data);	
	}

	public function store(){
		$kab = $this->input->post('kab');
		$kec = $this->input->post('kec');
		$desa = $this->input->post('desa');
		$jml_produksi = $this->input->post('jml_produksi');
		$satuan = $this->input->post('satuan');
		$jenis = $this->input->post('jenis');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$luas = $this->input->post('luas_produksi');
		$lsatuan = $this->input->post('luas_satuan');
		
		$post_data = array(
				'kab_id' => $kab,
				'kec_id' => $kec,
				'desa_id' => $desa,
				'jenis_potensi_id' => $jenis,
	      		'jml_produksi' 	=> $jml_produksi,
				'satuan' => $satuan,
				'luas_produksi' => $luas,
				'luas_satuan' => $lsatuan,
				'bulan'	=> $bulan,
				'tahun' => $tahun,
				'tanggal' => date('y-m-d')
	    	);
	    $this->db->insert('produksi_luar_kph',$post_data);

		redirect(base_url().'Produksiluarkph/tambah');
	}

	public function edit($id){
		$data = $this->db->query("SELECT a.*, a.kec_id AS kec_id, a.kab_id AS kab_id
				FROM produksi_luar_kph AS a where a.id='".$id."'")->result_object();

		// print_r($data); exit;
		
		$potensi = $this->db->query("Select a.* from m_jenis_potensi a where id=".$data[0]->jenis_potensi_id)->result_object();
		$jenis = $this->db->query("Select a.* from m_jenis_potensi a where jenis=".$potensi[0]->jenis)->result_object();
		$data['jenis'] 	 = $jenis;
		$data['data'] = $data;
		$data['potensi'] = $potensi;
		$data['page'] 	 = 'produksiluarkph';
		$data['subpage'] ='edit';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Edit '.$this->judul;
		$this->load->view('produksiluarkph/index',$data);	
	}

	public function update(){
		$id = $this->input->post('id');
		$desa = $this->input->post('desa');
		$jml_produksi = $this->input->post('jml_produksi');
		$satuan = $this->input->post('satuan');
		$jenis = $this->input->post('jenis');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$luas = $this->input->post('luas_produksi');
		$lsatuan = $this->input->post('luas_satuan');
		
		$post_data = array(
			'desa_id' => $desa,
			'jenis_potensi_id' => $jenis,
			'jml_produksi' 	=> $jml_produksi,
			'satuan' => $satuan,
			'bulan'	=> $bulan,
			'tahun' => $tahun,	
			'luas_produksi' => $luas,
			'luas_satuan' => $lsatuan,
		);
				
		$this->db->where('id',$id);
	    $this->db->update('produksi_luar_kph',$post_data);

		redirect(base_url().'Produksiluarkph');
	}

	public function delete($id){
		// delete detail dasar
		$result = $this->db->delete('produksi_luar_kph', array('id' => $id));
	 }

	 public function getKec($kode)
	 {
		 $data = $this->db->get_where('m_kecamatan', ['kodeKab' => $kode])->result();
		 $this->output
		 ->set_content_type('appluication/json')
		 ->set_output(json_encode(json_encode($data)));
	 }
	
	 public function getDesa($kode)
	 {
		 $data = $this->db->get_where('m_desa', ['kodeKec' => $kode])->result();
		 $this->output
		 ->set_content_type('appluication/json')
		 ->set_output(json_encode(json_encode($data)));
	 }
}
