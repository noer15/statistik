<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')){
			redirect(base_url().'Login');
		}
	}

	public function index()
	{
		$data['page']		= 'home';
		$data['kabupaten']	= $this->db->get('m_kabupaten')->result();
		$data['sertifikat']	= $this->db->get('m_jenis_sertifikat')->result();
		$this->load->view('home',$data);
	}

	public function laporanKelas($kab,$kec,$cdk,$tipe,$startdate,$enddate)
	{
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

		if($startdate != 0 && $enddate != 0){
			$sd = date('Y-m-d', strtotime($startdate)).' 00:00:00';
			$ed = date('Y-m-d', strtotime($enddate)). ' 23:59:00';
			$betweenDate = "AND tanggal BETWEEN '".$sd."' AND '".$ed."'";
		}else{
			$betweenDate = "";
		}

		if($tipe == 'total'){
			$sql = "Select t0.* ,
				(
				Select count(a.id) from kelompok_tani a
				INNER JOIN m_desa b on b.id=a.desa_id
				INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
				WHERE ".$strWhere." ".$betweenDate."
				) as jml ";
		}else
		if($tipe == 'pemula'){
			$sql = "Select t0.* ,
				(
				Select count(a.id) from kelompok_tani a
				INNER JOIN m_desa b on b.id=a.desa_id
				INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
				WHERE a.kelas=1 and ".$strWhere." ".$betweenDate."
				) as jml ";
		}else
		if($tipe == 'madya'){
			$sql = "Select t0.* ,
				(
				Select count(a.id) from kelompok_tani a
				INNER JOIN m_desa b on b.id=a.desa_id
				INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
				WHERE a.kelas=2 and ".$strWhere." ".$betweenDate."
				) as jml";
		}else{
			$sql = "Select t0.* ,
				(
				Select count(a.id) from kelompok_tani a
				INNER JOIN m_desa b on b.id=a.desa_id
				INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
				WHERE a.kelas=3 and ".$strWhere." ".$betweenDate."
				) as jml";
		}

		if ($kab==0){
			$sql = $sql." from m_kabupaten t0 
				LEFT JOIN m_unit_kerja_wilayah t1 on t1.kabupaten_id=t0.id";

			if($cdk>0){
				$sql=$sql." where t1.unit_kerja_id=".$cdk;
			}
			$sql .= " ORDER BY jml DESC";
			$query = $this->db->query($sql);
		}else{			
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
			$sql .= " ORDER BY jml DESC";
			$query = $this->db->query($sql);
		}

		$a = '['; $n=1;
		foreach($query->result_object() as $stat){
			if($n>1)
			$a .= ',';
			$a .= '{"country":"'.$stat->nama.'","visits":'.$stat->jml.'}';
			$n++;
		}
		$a .= ']';

		$this->output
			 ->set_content_type('application/json')
			 ->set_output(json_decode(json_encode($a)));
	}

	public function laporanKepemilikanLahan($jenis,$blok,$filter,$startdate,$enddate)
	{
		if($startdate != 0 && $enddate != 0){
			$sd = date('Y-m-d', strtotime($startdate)).' 00:00:00';
			$ed = date('Y-m-d', strtotime($enddate)). ' 23:59:00';
			if($jenis == 0 && $blok == 0){
				$betweenDate = " WHERE tanggal BETWEEN '".$sd."' AND '".$ed."'";
			}else{
				$betweenDate = " AND tanggal BETWEEN '".$sd."' AND '".$ed."'";
			}
		}else{
			$betweenDate = "";
		}

		if($jenis == 0 && $blok == 0){
			if($filter == 'total'){
				$orderBy = " ORDER BY jumlah DESC";
			}else{
				$orderBy = " ORDER BY luas_lahan DESC";
			}

			$sql = "SELECT count(a.id) as jumlah,b.nama AS jenis, sum(a.luas_lahan) as luas_lahan
			FROM pemilik_lahan a INNER JOIN m_jenis_sertifikat b ON b.id = a.jenis_sertifikat $betweenDate
			GROUP BY b.nama $orderBy";

			$data = $this->db->query($sql)->result_object();
			$a = '['; $n=1;
			foreach($data as $stat){
				if($n>1)
				$a .= ',';
				$total = $filter == 'total' ? $stat->jumlah : $stat->luas_lahan;
				$a .= '{"jenis":"'.$stat->jenis.'","total":'.$total.'}';
				$n++;
			}
			$a .= ']';

		}else{
			if($filter == 'total'){
				$orderBy = " ORDER BY total_data DESC";
			}else{
				$orderBy = " ORDER BY luas_lahan DESC";
			}

			$blok = urldecode($blok);
			$sql  = "SELECT a.nama_sertifikat, a.blok, b.nama AS jenis_sertifikat,
					sum(a.luas_lahan) as luas_lahan, count(a.id) as total_data
					FROM pemilik_lahan a INNER JOIN m_jenis_sertifikat b ON b.id = a.jenis_sertifikat
					WHERE a.blok = '$blok' $betweenDate 
					GROUP BY a.nama_sertifikat,b.nama,a.blok $orderBy";
			$data = $this->db->query($sql)->result_object();
			$a = '['; $n=1;
			foreach($data as $stat){
				if($n>1)
				$a .= ',';
				$total = $filter == 'total' ? $stat->total_data : $stat->luas_lahan;
				$a .= '{"jenis":"'.$stat->nama_sertifikat.'","total":'. $total.'}';
				$n++;
			}
			$a .= ']';
		}
		
		$this->output
		->set_content_type('application/json')
		->set_output(json_decode(json_encode($a)));

	}

	public function getBlokLahan($jenis)
	{
		if($jenis == 0){
			$data = $this->db->query('SELECT a.blok FROM pemilik_lahan a
					GROUP BY a.blok')->result_object();
		}else{
			$data = $this->db->query('SELECT a.blok FROM pemilik_lahan a 	
					WHERE a.jenis_sertifikat = '.$jenis.'
					GROUP BY a.blok')->result_object();
		}

		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($data));
	}

}
