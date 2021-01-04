<?php

//import Zend\Barcode\Barcode;

defined('BASEPATH') OR exit('No direct script access allowed');
 
class Report extends CI_Controller {
	public $auto='';

	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata('username')){
			print_r($this->auto);
			//redirect(base_url().'login');
		}
    } 

	public function pdf()
	{
		$this->load->library('pdfgenerator');
 
		$data['users']=array(); 
	    $html = $this->load->view('report/table_report', $data, true);
	    
	    $this->pdfgenerator->generate($html,'contoh');
	}

	function tanggal_indo($tanggal)
	{
		$bulan = array (1 =>   'Januari',
					'Februari',
					'Maret',
					'April',
					'Mei',
					'Juni',
					'Juli',
					'Agustus',
					'September',
					'Oktober',
					'November',
					'Desember'
				);
		$split = explode('-', $tanggal);
		return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
	}

	public function lapstatus($kab,$kec,$cdk){
		$this->load->library('pdfgenerator');
		date_default_timezone_set('GMT');

		if ($kab==0){
			$sql = "Select t0.* ,
				(
				Select count(a.id) from tb_pegawai a
				inner JOIN t_penyuluh_wilayah b on b.penyuluh_id=a.id and b.type=1
				INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
				WHERE c.kabupaten_id=t0.id
				) as jml_asn,

				(
				Select count(a.id) from t_penyuluh a
				inner JOIN t_penyuluh_wilayah b on b.penyuluh_id=a.id and b.type=2
				INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
				WHERE c.kabupaten_id=t0.id
				) as jml_pksm

				from m_kabupaten t0 
				LEFT JOIN m_unit_kerja_wilayah t1 on t1.kabupaten_id=t0.id ";

			if($cdk>0){
				$sql=$sql." where t1.unit_kerja_id=".$cdk;
			}

			$query = $this->db->query($sql);
		}else{
			$sql = "Select t0.* ,
				(
				Select count(a.id) from tb_pegawai a
				inner JOIN t_penyuluh_wilayah b on b.penyuluh_id=a.id and b.type=1
				INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
				WHERE c.id=t0.id
				) as jml_asn,

				(
				Select count(a.id) from t_penyuluh a
				inner JOIN t_penyuluh_wilayah b on b.penyuluh_id=a.id and b.type=2
				INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
				WHERE c.id=t0.id
				) as jml_pksm

				from m_kecamatan t0 
				LEFT JOIN  m_unit_kerja_wilayah t1 on t1.kabupaten_id=t0.kabupaten_id 
				where t0.kabupaten_id=".$kab;

			if($cdk>0){
				$sql=$sql." and t1.unit_kerja_id=".$cdk;
			}

			$query = $this->db->query($sql);
		}		

		$list = $query->result_object();

		$kab = $this->db->query("Select a.* from m_kabupaten a where id=".$kab)->result_object();	
		$kec = $this->db->query("Select a.* from m_kecamatan a where id=".$kec)->result_object();
		$cdk = $this->db->query("Select a.* from m_unit_kerja a where id=".$cdk)->result_object();

		$data['data']	 = $list;
		$data['kab']	 = $kab;
		$data['kec']	 = $kec;
		$data['cdk']	 = $cdk;
		$html = $this->load->view('report/rekap_penyuluh_status', $data, true);			  		

		$paper = array(
					"A5" => 'A5',
					"Legal" => 'Legal',
		 			"folio" => array(0,0,612.00,936.00)
		 		);

	    $this->pdfgenerator->generate($html,'rekap_penyuluh_status',TRUE,$paper['Legal']);

	}

	public function lappendidikan($kab,$kec,$cdk){
		$this->load->library('pdfgenerator');
		date_default_timezone_set('GMT');

		if ($kab==0){
			$sql = "Select t0.* ,
				(
				Select count(a.id) from tb_pegawai a
				inner JOIN t_penyuluh_wilayah b on b.penyuluh_id=a.id and b.type=1
				INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
				INNER JOIN m_pendidikan d on d.id=a.pendidikan
				WHERE c.kabupaten_id=t0.id and d.id=1
				) as jml_asn_s3,

				(
				Select count(a.id) from tb_pegawai a
				inner JOIN t_penyuluh_wilayah b on b.penyuluh_id=a.id and b.type=1
				INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
				INNER JOIN m_pendidikan d on d.id=a.pendidikan
				WHERE c.kabupaten_id=t0.id and d.id=2
				) as jml_asn_s2,

				(
				Select count(a.id) from tb_pegawai a
				inner JOIN t_penyuluh_wilayah b on b.penyuluh_id=a.id and b.type=1
				INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
				INNER JOIN m_pendidikan d on d.id=a.pendidikan
				WHERE c.kabupaten_id=t0.id and d.id=3
				) as jml_asn_s1,

				(
				Select count(a.id) from tb_pegawai a
				inner JOIN t_penyuluh_wilayah b on b.penyuluh_id=a.id and b.type=1
				INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
				INNER JOIN m_pendidikan d on d.id=a.pendidikan
				WHERE c.kabupaten_id=t0.id and d.id=4
				) as jml_asn_sma,

				(
				Select count(a.id) from t_penyuluh a
				inner JOIN t_penyuluh_wilayah b on b.penyuluh_id=a.id and b.type=2
				INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
				INNER JOIN m_pendidikan d on d.id=a.pendidikan
				WHERE c.kabupaten_id=t0.id and d.id=1
				) as jml_pksm_s3,

				(
				Select count(a.id) from t_penyuluh a
				inner JOIN t_penyuluh_wilayah b on b.penyuluh_id=a.id and b.type=2
				INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
				INNER JOIN m_pendidikan d on d.id=a.pendidikan
				WHERE c.kabupaten_id=t0.id and d.id=2
				) as jml_pksm_s2,

				(
				Select count(a.id) from t_penyuluh a
				inner JOIN t_penyuluh_wilayah b on b.penyuluh_id=a.id and b.type=2
				INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
				INNER JOIN m_pendidikan d on d.id=a.pendidikan
				WHERE c.kabupaten_id=t0.id and d.id=3
				) as jml_pksm_s1,

				(
				Select count(a.id) from t_penyuluh a
				inner JOIN t_penyuluh_wilayah b on b.penyuluh_id=a.id and b.type=2
				INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
				INNER JOIN m_pendidikan d on d.id=a.pendidikan
				WHERE c.kabupaten_id=t0.id and d.id=4
				) as jml_pksm_sma

				from m_kabupaten t0
				LEFT JOIN m_unit_kerja_wilayah t1 on t1.kabupaten_id=t0.id ";

			if($cdk>0){
				$sql=$sql." where t1.unit_kerja_id=".$cdk;
			}

			$query = $this->db->query($sql);
		}else{
			$sql="Select t0.* ,
				(
				Select count(a.id) from tb_pegawai a
				inner JOIN t_penyuluh_wilayah b on b.penyuluh_id=a.id and b.type=1
				INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
				INNER JOIN m_pendidikan d on d.id=a.pendidikan
				WHERE c.id=t0.id and d.id=1
				) as jml_asn_s3,

				(
				Select count(a.id) from tb_pegawai a
				inner JOIN t_penyuluh_wilayah b on b.penyuluh_id=a.id and b.type=1
				INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
				INNER JOIN m_pendidikan d on d.id=a.pendidikan
				WHERE c.id=t0.id and d.id=2
				) as jml_asn_s2,

				(
				Select count(a.id) from tb_pegawai a
				inner JOIN t_penyuluh_wilayah b on b.penyuluh_id=a.id and b.type=1
				INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
				INNER JOIN m_pendidikan d on d.id=a.pendidikan
				WHERE c.id=t0.id and d.id=3
				) as jml_asn_s1,

				(
				Select count(a.id) from tb_pegawai a
				inner JOIN t_penyuluh_wilayah b on b.penyuluh_id=a.id and b.type=1
				INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
				INNER JOIN m_pendidikan d on d.id=a.pendidikan
				WHERE c.id=t0.id and d.id=4
				) as jml_asn_sma,

				(
				Select count(a.id) from t_penyuluh a
				inner JOIN t_penyuluh_wilayah b on b.penyuluh_id=a.id and b.type=2
				INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
				INNER JOIN m_pendidikan d on d.id=a.pendidikan
				WHERE c.id=t0.id and d.id=1
				) as jml_pksm_s3,

				(
				Select count(a.id) from t_penyuluh a
				inner JOIN t_penyuluh_wilayah b on b.penyuluh_id=a.id and b.type=2
				INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
				INNER JOIN m_pendidikan d on d.id=a.pendidikan
				WHERE c.id=t0.id and d.id=2
				) as jml_pksm_s2,

				(
				Select count(a.id) from t_penyuluh a
				inner JOIN t_penyuluh_wilayah b on b.penyuluh_id=a.id and b.type=2
				INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
				INNER JOIN m_pendidikan d on d.id=a.pendidikan
				WHERE c.id=t0.id and d.id=3
				) as jml_pksm_s1,

				(
				Select count(a.id) from t_penyuluh a
				inner JOIN t_penyuluh_wilayah b on b.penyuluh_id=a.id and b.type=2
				INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
				INNER JOIN m_pendidikan d on d.id=a.pendidikan
				WHERE c.id=t0.id and d.id=4
				) as jml_pksm_sma

				from m_kecamatan t0

				LEFT JOIN  m_unit_kerja_wilayah t1 on t1.kabupaten_id=t0.kabupaten_id 
				where t0.kabupaten_id=".$kab;

			if($cdk>0){
				$sql=$sql." and t1.unit_kerja_id=".$cdk;
			}

			//	where t0.kabupaten_id=".$kab;			
			$query = $this->db->query($sql);
		}		

		$list = $query->result_object();

		$kab = $this->db->query("Select a.* from m_kabupaten a where id=".$kab)->result_object();	
		$kec = $this->db->query("Select a.* from m_kecamatan a where id=".$kec)->result_object();
		$cdk = $this->db->query("Select a.* from m_unit_kerja a where id=".$cdk)->result_object();

		$data['data']	 = $list;
		$data['kab']	 = $kab;
		$data['kec']	 = $kec;
		$data['cdk']	 = $cdk;
		$html = $this->load->view('report/rekap_penyuluh_pendidikan', $data, true);			  		

		$paper = array(
					"A5" => 'A5',
					"Legal" => 'Legal',
		 			"folio" => array(0,0,612.00,936.00)
		 		);

	    $this->pdfgenerator->generate($html,'rekap_penyuluh_pend',TRUE,$paper['Legal']);

	}

	public function lapjabatan($kab,$kec, $cdk){
		$this->load->library('pdfgenerator');
		date_default_timezone_set('GMT');

		$join = $kab==0 ? " c.kabupaten_id " : "c.id";

		$sql="Select t0.* ,
					(
					Select count(a.id) from tb_pegawai a
					inner JOIN t_penyuluh_wilayah b on b.penyuluh_id=a.id and b.type=1
					INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
					WHERE ".$join."=t0.id and a.jabatan_id=8 
					) as asn_madya,

					(
					Select count(a.id) from tb_pegawai a
					inner JOIN t_penyuluh_wilayah b on b.penyuluh_id=a.id and b.type=1
					INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
					WHERE ".$join."=t0.id and a.jabatan_id=9
					) as asn_mahir,

					(
					Select count(a.id) from tb_pegawai a
					inner JOIN t_penyuluh_wilayah b on b.penyuluh_id=a.id and b.type=1
					INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
					WHERE ".$join."=t0.id and a.jabatan_id=10
					) as asn_muda,

					(
					Select count(a.id) from tb_pegawai a
					inner JOIN t_penyuluh_wilayah b on b.penyuluh_id=a.id and b.type=1
					INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
					WHERE ".$join."=t0.id and a.jabatan_id=11
					) as asn_pelaksana,

					(
					Select count(a.id) from tb_pegawai a
					inner JOIN t_penyuluh_wilayah b on b.penyuluh_id=a.id and b.type=1
					INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
					WHERE ".$join."=t0.id and a.jabatan_id=12
					) as asn_pelaksana_lanjut,

					(
					Select count(a.id) from tb_pegawai a
					inner JOIN t_penyuluh_wilayah b on b.penyuluh_id=a.id and b.type=1
					INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
					WHERE ".$join."=t0.id and a.jabatan_id=13
					) as asn_penyelia,

					(
					Select count(a.id) from tb_pegawai a
					inner JOIN t_penyuluh_wilayah b on b.penyuluh_id=a.id and b.type=1
					INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
					WHERE ".$join."=t0.id and a.jabatan_id=14
					) as asn_pertama,

					(
					Select count(a.id) from t_penyuluh a
					inner JOIN t_penyuluh_wilayah b on b.penyuluh_id=a.id and b.type=2
					INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
					WHERE ".$join."=t0.id and a.jabatan_penyuluh=8 
					) as pksm_madya,

					(
					Select count(a.id) from t_penyuluh a
					inner JOIN t_penyuluh_wilayah b on b.penyuluh_id=a.id and b.type=2
					INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
					WHERE ".$join."=t0.id and a.jabatan_penyuluh=9
					) as pksm_mahir,

					(
					Select count(a.id) from t_penyuluh a
					inner JOIN t_penyuluh_wilayah b on b.penyuluh_id=a.id and b.type=2
					INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
					WHERE ".$join."=t0.id and a.jabatan_penyuluh=10
					) as pksm_muda,

					(
					Select count(a.id) from t_penyuluh a
					inner JOIN t_penyuluh_wilayah b on b.penyuluh_id=a.id and b.type=2
					INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
					WHERE ".$join."=t0.id and a.jabatan_penyuluh=11
					) as pksm_pelaksana,

					(
					Select count(a.id) from t_penyuluh a
					inner JOIN t_penyuluh_wilayah b on b.penyuluh_id=a.id and b.type=2
					INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
					WHERE ".$join."=t0.id and a.jabatan_penyuluh=12
					) as pksm_pelaksana_lanjut,

					(
					Select count(a.id) from t_penyuluh a
					inner JOIN t_penyuluh_wilayah b on b.penyuluh_id=a.id and b.type=2
					INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
					WHERE ".$join."=t0.id and a.jabatan_penyuluh=13
					) as pksm_penyelia,

					(
					Select count(a.id) from t_penyuluh a
					inner JOIN t_penyuluh_wilayah b on b.penyuluh_id=a.id and b.type=2
					INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
					WHERE ".$join."=t0.id and a.jabatan_penyuluh=14
					) as pksm_pertama ";

					//from m_kabupaten t0 ";

		if($kab==0){
			$sql = $sql." from m_kabupaten t0 LEFT JOIN m_unit_kerja_wilayah t1 on t1.kabupaten_id=t0.id  ";			

			if($cdk>0){
				$sql=$sql." where t1.unit_kerja_id=".$cdk;
			}

			$query = $this->db->query($sql);

		}else{

			$sql = $sql." from m_kecamatan t0 
			LEFT JOIN  m_unit_kerja_wilayah t1 on t1.kabupaten_id=t0.kabupaten_id where t0.kabupaten_id=".$kab;

			if($cdk>0){
				$sql=$sql." and t1.unit_kerja_id=".$cdk;
			}

			$query = $this->db->query($sql);
		}

		$list = $query->result_object();

		//print_r($list);

		$kab = $this->db->query("Select a.* from m_kabupaten a where id=".$kab)->result_object();	
		$kec = $this->db->query("Select a.* from m_kecamatan a where id=".$kec)->result_object();

		$data['data']	 = $list;
		$data['kab']	 = $kab;
		$data['kec']	 = $kec;
		$data['cdk']	 = $cdk;

		$html = $this->load->view('report/rekap_penyuluh_jabatan', $data, true);			  		

		$paper = array(
					"A5" => 'A5',
					"Legal" => 'Legal',
		 			"folio" => array(0,0,612.00,936.00)
		 		);

	    $this->pdfgenerator->generate($html,'rekap_penyuluh_jab',TRUE,$paper['Legal']);

	}

	public function lapjeniskelamin($kab,$kec, $cdk){
		$this->load->library('pdfgenerator');
		date_default_timezone_set('GMT');
		
		$join = $kab==0 ? " c.kabupaten_id " : "c.id";

		$sql="Select t0.* ,
			(
			Select count(a.id) from tb_pegawai a
			inner JOIN t_penyuluh_wilayah b on b.penyuluh_id=a.id and b.type=1
			INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
			WHERE ".$join."=t0.id and a.sex= 'L'
			) as asn_laki,

			(
			Select count(a.id) from tb_pegawai a
			inner JOIN t_penyuluh_wilayah b on b.penyuluh_id=a.id and b.type=1
			INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
			WHERE ".$join."=t0.id and a.sex= 'P'
			) as asn_perempuan,

			(
			Select count(a.id) from t_penyuluh a
			inner JOIN t_penyuluh_wilayah b on b.penyuluh_id=a.id and b.type=2
			INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
			WHERE ".$join."=t0.id and a.jk= 'L'
			) as pksm_laki,

			(
			Select count(a.id) from t_penyuluh a
			inner JOIN t_penyuluh_wilayah b on b.penyuluh_id=a.id and b.type=2
			INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
			WHERE ".$join."=t0.id and a.jk= 'P'
			) as pksm_perempuan ";

			// from m_kabupaten t0 ";
		if($kab==0){
			//$query = $this->db->query($sql." from m_kabupaten t0 ");			
			$sql = $sql." from m_kabupaten t0 LEFT JOIN m_unit_kerja_wilayah t1 on t1.kabupaten_id=t0.id  ";			

			if($cdk>0){
				$sql=$sql." where t1.unit_kerja_id=".$cdk;
			}
			$query = $this->db->query($sql);

		}else{

			//$query = $this->db->query($sql." from m_kecamatan t0 where t0.kabupaten_id=".$kab);
			$sql = $sql." from m_kecamatan t0 
			LEFT JOIN  m_unit_kerja_wilayah t1 on t1.kabupaten_id=t0.kabupaten_id where t0.kabupaten_id=".$kab;

			if($cdk>0){
				$sql=$sql." and t1.unit_kerja_id=".$cdk;
			}

			$query = $this->db->query($sql);
		}

		$list = $query->result_object();

		//print_r($list);

		$kab = $this->db->query("Select a.* from m_kabupaten a where id=".$kab)->result_object();	
		$kec = $this->db->query("Select a.* from m_kecamatan a where id=".$kec)->result_object();

		$data['data']	 = $list;
		$data['kab']	 = $kab;
		$data['kec']	 = $kec;
		$data['cdk']	 = $cdk;

		$html = $this->load->view('report/rekap_penyuluh_jk', $data, true);			  		

		$paper = array(
					"A5" => 'A5',
					"Legal" => 'Legal',
		 			"folio" => array(0,0,612.00,936.00)
		 		);

	    $this->pdfgenerator->generate($html,'rekap_penyuluh_jk',TRUE,$paper['Legal']);
	}

	public function lapcdk(){

		$this->load->library('pdfgenerator');
		date_default_timezone_set('GMT');

		$sql="select t0.*,
			(
			Select count(a.id) from tb_pegawai a
			WHERE a.unit_kerja_id=t0.id
			) as asn

			from m_unit_kerja t0
			where t0.id>=9 and t0.id<=17 and t0.tahun='2018'";

		$query = $this->db->query($sql);
		//$data['data'] = $query->result_object();
		$list = $query->result_object();

		$data['data']	 = $list;
		$html = $this->load->view('report/rekap_penyuluh_cdk', $data, true);

		$paper = array(
					"A5" => 'A5',
					"Legal" => 'Legal',
		 			"folio" => array(0,0,612.00,936.00)
		 		);

	    $this->pdfgenerator->generate($html,'rekap_penyuluh_cdk',TRUE,$paper['Legal']);

		// $this->load->view('penyuluh/rekap/laporan_cdk',$data);
	}

	public function lapkelompokcdk(){

		$this->load->library('pdfgenerator');
		date_default_timezone_set('GMT');

		$sql="select t0.*,
			(
			select count(a.id) from kelompok_tani a
			INNER JOIN m_desa b on b.id=a.desa_id
			INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
			INNER JOIN m_kabupaten d on d.id=c.kabupaten_id
			INNER JOIN m_unit_kerja_wilayah e on e.kabupaten_id=d.id
			where e.unit_kerja_id=t0.id
			) as asn

			from m_unit_kerja t0
			where t0.id>=9 and t0.id<=17 and t0.tahun='2018'";

		$query = $this->db->query($sql);
		//$data['data'] = $query->result_object();
		$list = $query->result_object();

		$data['data']	 = $list;
		$html = $this->load->view('report/rekap_kelompok_cdk', $data, true);

		$paper = array(
					"A5" => 'A5',
					"Legal" => 'Legal',
		 			"folio" => array(0,0,612.00,936.00)
		 		);

	    $this->pdfgenerator->generate($html,'rekap_kelompok_cdk',TRUE,$paper['Legal']);

		// $this->load->view('penyuluh/rekap/laporan_cdk',$data);
	}

	public function lapkelas($kab,$kec, $cdk){
		$this->load->library('pdfgenerator');
		date_default_timezone_set('GMT');

		$strWhere = "";

		if ($kab==0){			
			$strWhere = " c.kabupaten_id=t0.id ";			
		}else{
			if($kec==0){
				$strWhere = " c.kabupaten_id=t0.kabupaten_id and b.kecamatan_id=t0.id ";
			}else{
				$strWhere = " c.kabupaten_id=t2.kabupaten_id and b.kecamatan_id=t0.kecamatan_id and b.id=t0.id ";
			}
		}

		$sql = "Select t0.* ,
				(
				Select count(a.id) from kelompok_tani a
				INNER JOIN m_desa b on b.id=a.desa_id
				INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
				WHERE a.kelas=1 and ".$strWhere."
				) as jml_pemula,

				(
				Select count(a.id) from kelompok_tani a
				INNER JOIN m_desa b on b.id=a.desa_id
				INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
				WHERE a.kelas=2 and ".$strWhere."
				) as jml_madya ,

				(
				Select count(a.id) from kelompok_tani a
				INNER JOIN m_desa b on b.id=a.desa_id
				INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
				WHERE a.kelas=3 and ".$strWhere."
				) as jml_utama,

				(
				Select count(a.id) from kelompok_tani a
				INNER JOIN m_desa b on b.id=a.desa_id
				INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
				WHERE ".$strWhere."
				) as jml

				 ";


		if ($kab==0){
			$sql = $sql." from m_kabupaten t0 
				LEFT JOIN m_unit_kerja_wilayah t1 on t1.kabupaten_id=t0.id ";

			if($cdk>0){
				$sql=$sql." where t1.unit_kerja_id=".$cdk;
			}
			$query = $this->db->query($sql);
		}else{
			// $sql = $sql." from m_kecamatan t0 
			// 	LEFT JOIN  m_unit_kerja_wilayah t1 on t1.kabupaten_id=t0.kabupaten_id 
			// 	where t0.kabupaten_id=".$kab;

			if($kec==0){
				$sql = $sql." from m_kecamatan t0 
					LEFT JOIN  m_unit_kerja_wilayah t1 on t1.kabupaten_id=t0.kabupaten_id 
					where t0.kabupaten_id=".$kab;	

				if($cdk>0){
					$sql=$sql." and t1.unit_kerja_id=".$cdk;
				}
			}else{
				$sql = $sql." from m_desa t0 
					INNER JOIN m_kecamatan t2 on t2.id=t0.kecamatan_id 
					LEFT JOIN  m_unit_kerja_wilayah t1 on t1.kabupaten_id=t2.kabupaten_id 
					where t2.kabupaten_id=".$kab." and t0.kecamatan_id=".$kec;

				if($cdk>0){
					$sql=$sql." and t1.unit_kerja_id=".$cdk;
				}
			}			
			$query = $this->db->query($sql);
		}		

		$list = $query->result_object();

		$kab = $this->db->query("Select a.* from m_kabupaten a where id=".$kab)->result_object();	
		$kec = $this->db->query("Select a.* from m_kecamatan a where id=".$kec)->result_object();
		
		$data['data']	 = $list;
		$data['kab']	 = $kab;
		$data['kec']	 = $kec;
		
		
		$html = $this->load->view('report/rekap_kelompok_kelas', $data, true);			  		

		$paper = array(
					"A5" => 'A5',
					"Legal" => 'Legal',
		 			"folio" => array(0,0,612.00,936.00)
		 		);

	    $this->pdfgenerator->generate($html,'rekap_kelompok_kelas',TRUE,$paper['Legal']);

	}

	
	public function rekappenyuluh($kab,$kec){
		
		$this->load->library('pdfgenerator');

		date_default_timezone_set('GMT');		
		
		if ($kab==0){
	 		$query = $this->db->query(" SELECT t0.id, concat(t0.kodeProp,'.',t0.kode) as kode, t0.nama, ifnull(t1.jml,0) as jml  
	 		from m_kabupaten t0
				LEFT OUTER JOIN 
				(
				SELECT count(a.nama) as jml, c.kabupaten_id from t_penyuluh a
				INNER JOIN m_desa b on a.desa_id=b.id
				INNER JOIN m_kecamatan c on b.kecamatan_id=c.id
				) t1 on t0.id=t1.kabupaten_id
			");
	 	}else{
	 		$query = $this->db->query(' SELECT t0.id,t0.kodeKab, concat("32.",t0.kodeKab,".",t0.kode) as kode, t0.nama, ifnull(t1.jml,0) as jml, t0.kabupaten_id  from m_kecamatan t0
				LEFT OUTER JOIN 
				(
				SELECT count(a.nama) as jml, b.kecamatan_id from t_penyuluh a
				INNER JOIN m_desa b on a.desa_id=b.id
				INNER JOIN m_kecamatan c on b.kecamatan_id=c.id
				) t1 on t0.id=t1.kecamatan_id
				where t0.kabupaten_id = '.$kab.' ');
	 	}

		$list = $query->result_object();

		$kab = $this->db->query("Select a.* from m_kabupaten a where id=".$kab)->result_object();	
		$kec = $this->db->query("Select a.* from m_kecamatan a where id=".$kec)->result_object();		
		
		//$path = base_url().'assets/images/logo1.png';
		//$type = pathinfo($path, PATHINFO_EXTENSION);
		//$data1 = file_get_contents($path);
		//$data['logo'] = 'data:image/' . $type . ';base64,' . base64_encode($data1);		


 
		$data['data']	 = $list;
		$data['kab']	 = $kab;
		$data['kec']	 = $kec;
		$html = $this->load->view('report/rekap_penyuluh', $data, true);			  		

		//generate($html, $filename='', $stream=TRUE, $paper = 'F4', $orientation = "portrait")
		$paper = array(
					"A5" => 'A5',
					"Legal" => 'Legal',
		 			"folio" => array(0,0,612.00,936.00)
		 		);

		//print_r($html);

	    $this->pdfgenerator->generate($html,'rekap_penyuluh',TRUE,$paper['Legal']);
	}
	
}