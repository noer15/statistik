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
	 }

	 public function rekap($thn = null,$bln = null)
	 {
		 $list = $this->db->query('SELECT a.nama, SUM(b.jml_produksi) as jumlah_produksi, SUM(b.luas_produksi) as luas_produksi
	 								FROM m_kph a LEFT JOIN produksi_kph b ON a.id = b.kph_id
	 								WHERE a.nama LIKE "%KPH%" GROUP BY a.nama')->result_object();
		 
		 $data['data'] 	 = $list;
		 $data['page']	 = 'reportproduksikph';
		 $data['subpage'] = 'rekap';
		 $data['judul']	 =$this->judul;
		 $data['header']	 =$this->judul;
 
		 $this->load->view('produksikph/index',$data);
	 }
 
	 public function print(){
		 
		 $this->load->library('pdfgenerator');
		 date_default_timezone_set('GMT');

		 $jenisId = $_POST['jenis'];
		 $dataJenis = $this->db->query('SELECT DISTINCT a.id, a.nama FROM m_jenis_potensi a
		 								INNER JOIN produksi_kph b ON a.id = b.jenis_potensi 
	 									WHERE a.jenis = '.$jenisId)->result_object();
		 $jenis = '';
		 $totalJenis = '';

		 foreach($dataJenis as $a){
			 $jenis .= ',( SELECT SUM(jml_produksi) FROM produksi_kph WHERE jenis_potensi = '.$a->id.' AND kph_id = kphId ) AS "jml_produksi_'.strtolower($a->nama).'",
						 ( SELECT SUM(luas_produksi) FROM produksi_kph WHERE jenis_potensi = '.$a->id.' AND kph_id = kphId ) AS "luas_produksi_'.strtolower($a->nama).'"';

			$totalJenis .= ',( SELECT SUM(jml_produksi) FROM produksi_kph WHERE jenis_potensi = '.$a->id.') AS "jml_produksi_'.strtolower($a->nama).'",
						 ( SELECT SUM(luas_produksi) FROM produksi_kph WHERE jenis_potensi = '.$a->id.') AS "luas_produksi_'.strtolower($a->nama).'"';
		 }
 
		 $list = $this->db->query('SELECT a.id AS kphId, a.nama AS unit_kerja '.$jenis.' FROM
		 							m_kph a LEFT JOIN produksi_kph b ON a.id = b.kph_id
	 								WHERE a.nama LIKE "%KPH%" GROUP BY a.id, a.nama
									 ORDER BY a.id ASC')->result_object();

		$totalList = $this->db->query('SELECT count(a.id) AS kphId '.$totalJenis.' FROM
									m_kph a LEFT JOIN produksi_kph b ON a.id = b.kph_id 
									WHERE a.nama LIKE "%KPH%" ORDER BY a.id ASC')->result_object();
 
		 $data['list'] = $list;
		 $data['totalList'] = $totalList;
		 $data['jenis'] = $dataJenis;
		 $data['listjenis'] = $dataJenis;
		 $data['jenisProduksi'] = $jenisId;
 
		//  $this->load->view('produksikph/print', $data);

		 $html = $this->load->view('produksikph/print', $data, true);		  		
 
		 $paper = array(
					 "A5" => 'A5',
					 "Legal" => 'Legal',
					  "folio" => array(0,0,612.00,936.00),
					  "ukuran" => $_POST['kertas']
				  );
				  
		 $this->pdfgenerator->generate($html,'rekap_produksi_olahan_kayu_per_kph',TRUE,$paper['Legal'], $paper['ukuran']);
	 }
	
}
