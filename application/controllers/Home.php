<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$data['page']		= 'home';
		$data['kabupaten']	= $this->db->get('m_kabupaten')->result();
		$data['kecamatan']	= $this->db->get_where('m_kecamatan',['kodekab'=>01])->result();
		$data['statistik']	= $this->laporanKelas(0,0,0);
		$this->load->view('home',$data);
	}

	public function laporanKelas($kab,$kec,$cdk)
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
				) as jml_madya,

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
		$data['data'] = $query->result_object();
		$data['kab'] = $kab;
		$data['kec'] = $kec;
		$data['cdk'] = $cdk;
		
		return $data['data'];
	}

}
