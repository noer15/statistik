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
		$user_id = $this->session->userdata('user_id');
		$role_id = $this->session->userdata('role_id');
		$unit_kerja_id = $this->session->userdata('unit_kerja_id');

		if($role_id != 1){
			if($role_id == 22){
				$user = " LEFT JOIN tb_pegawai ON a.user_id = tb_pegawai.id WHERE unit_kerja_id = $unit_kerja_id 
				AND `status` = 0";
			}else if($role_id == 24){
				$user = " LEFT JOIN tb_pegawai ON a.user_id = tb_pegawai.id WHERE `status` = 1";
			}else{
				$user = " WHERE user_id = $user_id";
			}
		}else{
			$user = null;
		}

		$list = $this->db->query("SELECT a.*, b.nama AS nama_desa, c.nama AS nama_kec, d.nama AS nama_kab, e.nama AS potensi, f.nama as nama_kec_2, g.nama as nama_kab_2
		FROM produksi_luar_kph AS a LEFT JOIN m_desa AS b ON a.desa_id = b.id LEFT JOIN m_kecamatan AS c ON b.kecamatan_id = c.id
		LEFT JOIN m_kabupaten AS d ON c.kabupaten_id = d.id LEFT JOIN m_jenis_potensi AS e ON a.jenis_potensi_id = e.id
		LEFT JOIN m_kecamatan AS f ON a.kec_id = f.id LEFT JOIN m_kabupaten AS g ON a.kab_id = g.id $user")->result_object();				

		$data['data']	 = $list;
		$data['page']	 ='produksiluarkph';
		$data['subpage'] ='list';
		$data['judul']	 =$this->judul;
		$data['header']	 =$this->judul;
		$this->load->view('produksiluarkph/index',$data);
	}	
	
	public function tambah(){

		$role = $this->session->userdata('role_id');
		$user_id = $this->session->userdata('user_id');
		$kab_id = $this->session->userdata('wilayah_kab_id');
		$kec_id = $this->session->userdata('wilayah_kab_id');
		$kab = $this->db->query("Select a.* from m_kabupaten a ")->result_object();

		if($role != 1){
			$kec = $this->db->query("Select a.* from m_kecamatan a where a.kabupaten_id=".$kab_id)->result_object();
			$desa = $this->db->query("Select a.* from m_desa a where a.kecamatan_id=".$kec_id)->result_object();
		}else{
			$kec = $this->db->query("Select a.* from m_kecamatan a where a.kabupaten_id=".$kab[0]->id)->result_object();
			$desa = $this->db->query("SELECT a.* from m_desa a")->result_object();
		}

		$jenis = $this->db->query("Select a.* from m_jenis_potensi a where jenis=2")->result_object();
		$list = $this->db->query("SELECT a.*, b.nama AS nama_desa, c.nama AS nama_kec, d.nama AS nama_kab, e.nama AS potensi, f.nama as nama_kec_2, g.nama as nama_kab_2
								FROM produksi_luar_kph AS a LEFT JOIN m_desa AS b ON a.desa_id = b.id LEFT JOIN m_kecamatan AS c ON b.kecamatan_id = c.id
								LEFT JOIN m_kabupaten AS d ON c.kabupaten_id = d.id LEFT JOIN m_jenis_potensi AS e ON a.jenis_potensi_id = e.id
								LEFT JOIN m_kecamatan AS f ON a.kec_id = f.id LEFT JOIN m_kabupaten AS g ON a.kab_id = g.id 
								WHERE tanggal = '".date("Y-m-d")."' AND user_id = $user_id")->result_object();
		
		$data['list']	 = $list;
		$data['jenis'] 	 = $jenis;
		$data['kabupaten'] 	 = $kab;
		$data['kecamatan'] 	 = $kec;
		$data['desa'] 	 = $desa;
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

		if($role = $this->session->userdata('role_id') != 1){
			$user_id = $this->session->userdata('user_id');
		}else{
			$user_id = null;
		}

		if($tahun > 2020 && empty($kec) || empty($kab)){
			redirect(base_url().'Produksiluarkph/tambah');
			exit;
		}

		
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
			'tanggal' => date('y-m-d'),
			'user_id' => $user_id
		);
		
	    $this->db->insert('produksi_luar_kph',$post_data);

		redirect(base_url().'Produksiluarkph/tambah');
	}

	public function edit($id){
		$user_id = $this->session->userdata('user_id');
		$role = $this->session->userdata('role_id');
		$unit_kerja_id = $this->session->userdata('unit_kerja_id');
		$kab_id = $this->session->userdata('wilayah_kab_id');
		$kec_id = $this->session->userdata('wilayah_kab_id');
		$kab = $this->db->query("Select a.* from m_kabupaten a ")->result_object();

		if($role != 1){
			if($role == 22 || $role == 24){
				$kec = $this->db->query("Select a.* from m_kecamatan a where a.kabupaten_id=".$kab[0]->id)->result_object();
				$desa = $this->db->query("Select a.* from m_desa a where a.kecamatan_id=".$kec[0]->id)->result_object();
			}else{
				$kec = $this->db->query("Select a.* from m_kecamatan a where a.kabupaten_id=".$kab_id)->result_object();
				$desa = $this->db->query("Select a.* from m_desa a where a.kecamatan_id=".$kec_id)->result_object();
			}
		}else{
			$kec = $this->db->query("Select a.* from m_kecamatan a where a.kabupaten_id=".$kab[0]->id)->result_object();
			$desa = $this->db->query("SELECT a.* from m_desa a")->result_object();
		}

		$data = $this->db->query("SELECT a.*, a.kec_id AS kec_id, a.kab_id AS kab_id
				FROM produksi_luar_kph AS a where a.id=$id")->result_object();
		
		$potensi = $this->db->query("Select a.* from m_jenis_potensi a where id=".$data[0]->jenis_potensi_id)->result_object();
		$jenis = $this->db->query("Select a.* from m_jenis_potensi a where jenis=".$potensi[0]->jenis)->result_object();
		$data['jenis'] 	 = $jenis;
		$data['data'] = $data;
		$data['potensi'] = $potensi;
		$data['kabupaten'] 	 = $kab;
		$data['kecamatan'] 	 = $kec;
		$data['desa'] 	 = $desa;
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
		$status = $this->input->post('status');

		if($role = $this->session->userdata('role_id') != 1){
			$user_id = $this->session->userdata('user_id');
		}else{
			$user_id = null;
		}
		
		if($role == 22){
			$post_data = array(
				'status' => $status
			);
		}

		if($role == 24){
			$post_data = array(
				'jenis_potensi_id' => $jenis,
				'jml_produksi' 	=> $jml_produksi,
				'satuan' => $satuan,
				'bulan'	=> $bulan,
				'tahun' => $tahun,	
				'luas_produksi' => $luas,
				'luas_satuan' => $lsatuan,
				'status' => $status
			);
		}else{
			$post_data = array(
				'jenis_potensi_id' => $jenis,
				'jml_produksi' 	=> $jml_produksi,
				'satuan' => $satuan,
				'bulan'	=> $bulan,
				'tahun' => $tahun,	
				'luas_produksi' => $luas,
				'luas_satuan' => $lsatuan,
				'user_id' => $user_id
			);
		}
				
		$this->db->where('id',$id);
	    $this->db->update('produksi_luar_kph',$post_data);

		redirect(base_url().'Produksiluarkph');
	}

	public function delete($id){
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

	 public function rekap($thn = null,$bln = null)
	 {
		$role = $this->session->userdata('role_id');
		$unit_kerja = $this->session->userdata('unit_kerja_id');

		$wilayah = '';
		if($role == 22 || $role == 1){
			$wilayah = ' INNER JOIN tb_pegawai c ON b.user_id = c.id WHERE c.unit_kerja_id = '.$unit_kerja;
		}

		$list = $this->db->query('SELECT a.nama, SUM(b.jml_produksi) as jumlah_produksi, SUM(b.luas_produksi) as luas_produksi
	 								FROM m_kabupaten a LEFT JOIN produksi_luar_kph b
		 							ON a.id = b.kab_id '.$wilayah.' GROUP BY a.nama')->result_object();
		
		$data['data'] 	 = $list;
		$data['page']	 = 'reportproduksikph';
		$data['subpage'] = 'rekap';
		$data['judul']	 =$this->judul;
		$data['header']	 =$this->judul;
 
		$this->load->view('produksiluarkph/index',$data);
	 }
 
	 public function print()
	 {
		
		$role = $this->session->userdata('role_id');
		$unit_kerja = $this->session->userdata('unit_kerja_id');

		$wilayah = ''; $kondisi = '';
		if($role == 22 || $role == 1){
			$wilayah = ' INNER JOIN tb_pegawai c ON b.user_id = c.id ';
			$kondisi = ' AND c.unit_kerja_id = '.$unit_kerja;
		}

		 $this->load->library('pdfgenerator');
		 date_default_timezone_set('GMT');

		 $jenisId = $_POST['jenis'];
		 $dataJenis = $this->db->query('SELECT DISTINCT a.id, a.nama FROM m_jenis_potensi a
		 								INNER JOIN produksi_luar_kph b ON a.id = b.jenis_potensi_id 
										'.$wilayah.' WHERE a.jenis = '.$jenisId.' '.$kondisi)->result_object();
		 $jenis = '';
		 $totalJenis = '';

		 foreach($dataJenis as $a){
			 $jenis .= ',( SELECT SUM(b.jml_produksi) FROM produksi_luar_kph b '.$wilayah.' WHERE b.jenis_potensi_id = '.$a->id.' AND b.kab_id = kabId '.$kondisi.' ) AS "jml_produksi_'.strtolower($a->nama).'",
						 ( SELECT SUM(b.luas_produksi) FROM produksi_luar_kph b '.$wilayah.' WHERE b.jenis_potensi_id = '.$a->id.' AND b.kab_id = kabId '.$kondisi.' ) AS "luas_produksi_'.strtolower($a->nama).'"';

			$totalJenis .= ',( SELECT SUM(b.jml_produksi) FROM produksi_luar_kph b '.$wilayah.' WHERE b.jenis_potensi_id = '.$a->id.' '.$kondisi.') AS "jml_produksi_'.strtolower($a->nama).'",
						 ( SELECT SUM(b.luas_produksi) FROM produksi_luar_kph b '.$wilayah.' WHERE b.jenis_potensi_id = '.$a->id.' '.$kondisi.') AS "luas_produksi_'.strtolower($a->nama).'"';
		 }
 
		 $list = $this->db->query('SELECT a.id AS kabId, a.nama AS kab '.$jenis.' FROM
									m_kabupaten a LEFT JOIN produksi_luar_kph b ON a.id = b.kab_id 
									'.$wilayah.' WHERE a.id IS NOT NULL
									'.$kondisi.'
									GROUP BY a.id, a.nama ORDER BY a.id ASC')->result_object();

		$totalList = $this->db->query('SELECT count(a.id) AS kabId '.$totalJenis.' FROM
									m_kabupaten a LEFT JOIN produksi_luar_kph b ON a.id = b.kab_id 
									'.$wilayah.' WHERE a.id IS NOT NULL
									'.$kondisi.'
									ORDER BY a.id ASC')->result_object();
 
		 $data['list'] = $list;
		 $data['totalList'] = $totalList;
		 $data['jenis'] = $dataJenis;
		 $data['listjenis'] = $dataJenis;
		 $data['jenisProduksi'] = $jenisId;
		 
		if($_POST['alokasi'] == 'kab'){
			$html = $this->load->view('produksiluarkph/print', $data, true);	
		}else{
			$html = $this->load->view('produksiluarkph/print_cdk', $data, true);	
		}
		
		$paper = array(
					"A5" => 'A5',
					"Legal" => 'Legal',
					"folio" => array(0,0,612.00,936.00),
					"ukuran" => $_POST['kertas']
				);
				  
		 $this->pdfgenerator->generate($html,'rekap_produksi_olahan_kayu_luar_kawasan',TRUE,$paper['Legal'], $paper['ukuran']);
	 }
}
