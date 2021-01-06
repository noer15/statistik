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
		$data['kecamatan']	= $this->db->get_where('m_kecamatan',['kodekab'=>01])->result();
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
				LEFT JOIN m_unit_kerja_wilayah t1 on t1.kabupaten_id=t0.id ";

			if($cdk>0){
				$sql=$sql." where t1.unit_kerja_id=".$cdk;
			}

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

}
