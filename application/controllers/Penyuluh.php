<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penyuluh extends CI_Controller {
	private $judul = "Penyuluh ";

	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')){
			redirect(base_url().'Login');
		}
	}

	public function lapstatus($kab, $cdk){
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
		$data['data'] = $query->result_object();
		$data['kab'] = $kab;
		$data['cdk'] = $cdk;

		$this->load->view('penyuluh/rekap/laporan_status', $data);
	}

	public function lappendidikan($kab, $cdk){
		if($kab==0){
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

			$query = $this->db->query($sql);
		}

		$data['data'] = $query->result_object();
		$data['kab'] = $kab;
		$data['cdk'] = $cdk;

		$this->load->view('penyuluh/rekap/laporan_pendidikan',$data);
	}

	public function lapjabatan($kab, $cdk){

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

			$sql = $sql." from m_kecamatan  t0 
				LEFT JOIN  m_unit_kerja_wilayah t1 on t1.kabupaten_id=t0.kabupaten_id where t0.kabupaten_id=".$kab;

			if($cdk>0){
				$sql=$sql." and t1.unit_kerja_id=".$cdk;
			}
			$query = $this->db->query($sql);
		}

		$data['data'] = $query->result_object();
		$data['kab'] = $kab;
		$data['cdk'] = $cdk;

		$this->load->view('penyuluh/rekap/laporan_jabatan',$data);
	}

	public function lapjeniskelamin($kab, $cdk){
		
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
			$sql = $sql." from m_kecamatan  t0 
				LEFT JOIN  m_unit_kerja_wilayah t1 on t1.kabupaten_id=t0.kabupaten_id where t0.kabupaten_id=".$kab;

			if($cdk>0){
				$sql=$sql." and t1.unit_kerja_id=".$cdk;
			}
			$query = $this->db->query($sql);
		}

		$data['data'] = $query->result_object();
		$data['kab'] = $kab;
		$data['cdk'] = $cdk;
		
		$this->load->view('penyuluh/rekap/laporan_jk', $data);
	}

	public function lapcdk(){

		$sql="select t0.*,
			(
			Select count(a.id) from tb_pegawai a
			WHERE a.unit_kerja_id=t0.id
			) as asn

			from m_unit_kerja t0
			where t0.id>=9 and t0.id<=17 and t0.tahun='2018'";

		$query = $this->db->query($sql);
		$data['data'] = $query->result_object();

		$this->load->view('penyuluh/rekap/laporan_cdk',$data);
	}

	public function index()
	{

		$list = $this->db->query("Select a.*,b.nama as namajabatanpenyuluh from t_penyuluh a 
				inner join m_jabatan_penyuluh b on b.id=a.jabatan_penyuluh 
				left join tb_pegawai c on c.id=a.pegawai_id
				")->result_object();		

		$data['data']	 = $list;
		$data['page']	 ='penyuluh';
		$data['subpage'] ='list';
		$data['judul']	 =$this->judul;
		$data['header']	 =$this->judul;
		$this->load->view('penyuluh/index',$data);
	}	
	
	public function tambah(){

		$kab = $this->db->query("Select a.* from m_kabupaten a ")->result_object();

		$kec = $this->db->query("Select a.* from m_kecamatan a where a.kabupaten_id=".$kab[0]->id)->result_object();

		// $desa = $this->db->query("Select a.* from m_desa a where a.kecamatan_id=".$kec[0]->id)->result_object();

		$pendidikan = $this->db->query("Select a.* from m_pendidikan a ")->result_object();
		
		$jabpenyuluh = $this->db->query("Select a.* from m_jabatan a where id>=8 and id<=14")->result_object();

		$agama = $this->db->query("Select a.* from m_agama a ")->result_object();
		
		$data['agama'] 	 = $agama;
		$data['pend'] 	 = $pendidikan;
		$data['jabpenyuluh'] 	 = $jabpenyuluh;
		$data['kabupaten'] 	 = $kab;
		$data['kecamatan'] 	 = $kec;
		//$data['desa'] 	 = $desa;
		$data['page'] 	 = 'penyuluh';
		$data['subpage'] ='tambah';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Tambah '.$this->judul;
		$this->load->view('penyuluh/index',$data);	
	}

	public function store(){
		//$nip = $this->input->post('nip');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$tempat_lahir = $this->input->post('tempat_lahir');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$jk = $this->input->post('jk');
		$pendidikan = $this->input->post('pendidikan');
		$penyuluhdari = $this->input->post('penyuluhdari');
		$jabatanpenyuluh = $this->input->post('jabatanpenyuluh');		
		$phone = $this->input->post('phone');
		$email = $this->input->post('email');
		//$desaId = $this->input->post('desa');
		$kecamatanId = $this->input->post('kec');


		$penPKSM = $this->db->query(" SELECT ifnull(max( substring(a.nip, 7,4) ),0) as max from t_penyuluh a
							where kecamatan_id='".$kecamatanId."'")->result_object();
		$no=$penPKSM[0]->max+1;
		$nourut="";
		if($no<10){
			$nourut="000".$no;
		}else if($no<100){
			$nourut="00".$no;
		}else if($no<1000){
			$nourut="0".$no;
		}else if($no<10000){
			$nourut=$no;
		}

		$noreg = 'PKSM-'.$kecamatanId.$nourut;

		if($penyuluhdari=='PKSM'){
			$nip = '';
			$idPeg='';
			$pekerjaan = $this->input->post('pekerjaan');
		}else{
			$pekerjaan = 'PNS';
			$nip = $this->input->post('nip');
			$peg = $this->db->query("select * from tb_pegawai where nip='".$nip."'" );
			if ($peg->num_rows()>0){
				$pegawai = $peg->result_object();
				$idPeg = $pegawai[0]->id;
			}else{
				$idPeg='';
			}
		}
		
		$post_data = array(
	      		'nip' 	=> $noreg,
	      		'nama' 	=> $nama,
	        	'alamat' => $alamat,	        	
	        	'phone' => $phone,
	        	'email' => $email,
	        	'pekerjaan' => $pekerjaan,
	        	'tempat_lahir' => $tempat_lahir,	  
	        	'tgl_lahir' => $tgl_lahir,
	        	'jk' => $jk,	  
	        	'pendidikan' => $pendidikan,
	        	'penyuluh_dari' => $penyuluhdari,
	        	'jabatan_penyuluh' => $jabatanpenyuluh,
	        	'pegawai_id' => $idPeg,
	        	'kecamatan_id' => $kecamatanId
	    		);
	    $this->db->insert('t_penyuluh',$post_data);

		redirect(base_url().'Penyuluh');
	}

	public function edit($id){

		$dt = $this->db->query("Select a.* from t_penyuluh a where id='".$id."'")->result_object();
		
		//$desa = $this->db->query("Select a.* from m_desa a where id=".$dt[0]->desa_id)->result_object();		
		$kec = $this->db->query("Select a.* from m_kecamatan a where id=".$dt[0]->kecamatan_id)->result_object();
		$kab = $this->db->query("Select a.* from m_kabupaten a where id=".$kec[0]->kabupaten_id)->result_object();
		
		$pendidikan = $this->db->query("Select a.* from m_pendidikan a ")->result_object();
		$jabpenyuluh = $this->db->query("Select a.* from m_jabatan a where id>=8 and id<=14")->result_object();
		$agama = $this->db->query("Select a.* from m_agama a ")->result_object();
		
		$data['agama'] 	 = $agama;		
		$data['pend'] 	 = $pendidikan;
		$data['jabpenyuluh'] 	 = $jabpenyuluh;		
		$data['data'] = $dt;
		$data['kabupaten'] 	 = $kab;
		$data['kecamatan'] 	 = $kec;
		//$data['desa'] 	 = $desa;
		$data['page'] 	 = 'penyuluh';
		$data['subpage'] ='edit';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Edit '.$this->judul;
		$this->load->view('penyuluh/index',$data);	
	}

	public function update(){
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$tempat_lahir = $this->input->post('tempat_lahir');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$jk = $this->input->post('jk');
		$pendidikan = $this->input->post('pendidikan');
		$penyuluhdari = $this->input->post('penyuluhdari');
		$jabatanpenyuluh = $this->input->post('jabatanpenyuluh');		
		$phone = $this->input->post('phone');
		$email = $this->input->post('email');
		//$desaId = $this->input->post('desa');
		$kecamatanId = $this->input->post('kec');

		if($penyuluhdari=='PKSM'){
			$nip = '';
			$idPeg='';
			$pekerjaan = $this->input->post('pekerjaan');
		}else{
			$pekerjaan = 'PNS';
			$nip = $this->input->post('nip');
			$peg = $this->db->query("select * from tb_pegawai where nip='".$nip."'" );
			if ($peg->num_rows()>0){
				$pegawai = $peg->result_object();
				$idPeg = $pegawai[0]->id;
			}else{
				$idPeg='';
			}
		}
				
		$post_data = array(
	      		//'nip' 	=> $nip,
	      		'nama' 	=> $nama,
	        	'alamat' => $alamat,	   
	        	'phone' => $phone,
	        	'email' => $email,     	
	        	'pekerjaan' => $pekerjaan,
	        	'tempat_lahir' => $tempat_lahir,	  
	        	'tgl_lahir' => $tgl_lahir,
	        	'jk' => $jk,	  
	        	'pendidikan' => $pendidikan,
	        	'penyuluh_dari' => $penyuluhdari,
	        	'jabatan_penyuluh' => $jabatanpenyuluh,
	        	'pegawai_id' => $idPeg,
	        	'kecamatan_id' => $kecamatanId
	    		);
		$this->db->where('id',$id);
	    $this->db->update('t_penyuluh',$post_data);

		redirect(base_url().'Penyuluh');
	}

	public function delete($id){
		// delete detail dasar
		$result = $this->db->delete('t_penyuluh', array('id' => $id));
        print_r($nip);
	 }

	 public function rekap(){

	 	$kab = $this->db->query("Select a.* from m_kabupaten a ")->result_object();
		//$kec = $this->db->query("Select a.* from m_kecamatan a where a.kabupaten_id=".$kab[0]->id)->result_object();

		$cdk=$this->db->query("select t0.* from m_unit_kerja t0 where t0.id>=9 and t0.id<=17 and t0.tahun='2018'")->result_object();


	 	$list = $this->db->query("Select a.*,b.nama as namajabatanpenyuluh from t_penyuluh a 
				inner join m_jabatan_penyuluh b on b.id=a.jabatan_penyuluh 
				left join tb_pegawai c on c.id=a.pegawai_id
				")->result_object();		

		$data['kabupaten'] 	 = $kab;
		//$data['kecamatan'] 	 = $kec;
		$data['datacdk'] = $cdk;
		$data['data']	 = $list;
		$data['page']	 ='reportpenyuluh';
		$data['subpage'] ='list';
		$data['judul']	 ='Laporan Penyuluh ';
		$data['header']	 ='Penyuluh ';
		$this->load->view('penyuluh/rekap/index',$data);
	 }

	 public function getdata(){

		$sql = " Select a.*,b.nama as namajabatanpenyuluh from t_penyuluh a 
				left join m_jabatan b on b.id=a.jabatan_penyuluh 
				left join tb_pegawai c on c.id=a.pegawai_id ";

		$query = $this->db->query($sql);

		//String filter = params.get("search[value]")[0];
		$post['start'] = $this->input->get('start', TRUE); //$this->input->post('start'); BZ
		$post['length'] = $this->input->get('length');
        $iOffset = intval($post['start']) / intval($post['length']);        
        $filter = $this->input->get('search[value]');

        //$pegawai_id = $this->input->get('pegawai');

		$post['draw'] = $this->input->post('draw');        
        $iOrderColumn = $this->input->get("order[0][column]");
        $sOrderDir = $this->input->get("order[0][dir]");
        $orderBy="";
        switch ($iOrderColumn) {
        	case '0':
        		$orderBy="nip";
        		break;
        	case '1':
        		$orderBy="nama";
        		break;
        	case '2':
        		$orderBy="alamat";
        		break;
        		
        	default:
        		$orderBy="nama";
        		break;
        }
        $orderBy = $orderBy." ".$sOrderDir;

		//$page = $this->db->query($sql." LIMIT ".$post['start'].", ".$post['length']);
        
		$page = $this->db->query($sql.
				" WHERE a.nama like '%".$filter."%' ".
				" ORDER BY ".$orderBy.
				" LIMIT ".$post['start'].", ".$post['length']);
        $list = $page->result_object();

		$totalData = $totalFiltered = $query->num_rows();

        $data = array();
        $no = $post['start'];

        foreach ($list as $key => $value) {
        	$no++;                	       	

            $row = array(
            	'nip'=> $value->nip,
            	'nama'=> $value->nama,
            	'alamat'=> $value->alamat,
            	'penyuluh_dari'=> $value->penyuluh_dari,
            	'phone'=> $value->phone,
            	'aksi' => '<ul class="icons-list">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icon-menu9"></i>
								</a>
								<ul class="dropdown-menu dropdown-menu-right">
									<li><a href="'.base_url().'penyuluh/wilayah/'.$value->id.'?t=2">
										<i class="icon-stack2"></i> Wilayah Kerja</a>
									</li>									
									<li><a href="'.base_url().'penyuluh/edit/'. $value->id.'">
										<i class="icon-pencil5 text-primary"></i> Edit</a>
									</li>
									<li>
										<a href="#" onclick="deleteData('. $value->id.')"><i class="icon-bin text-danger-600"></i> Delete</a>
									</li>
								</ul>
							</li>
						</ul>'
            );
            $data[] = $row;
        }
 
        $json_data = array(
			"draw"            => $post['draw'] , 
			"recordsTotal"    => intval( $totalData ), 
			"recordsFiltered" => intval( $totalFiltered ), 
			"data"            => $data 
		);
		echo json_encode($json_data); 
    }

	 public function rekaplist(){

	 	$kab = intval($this->input->get("kab"));
	 	if ($kab==0){
	 		$query = $this->db->query(" SELECT t0.id,t0.kodeProp, t0.kode, t0.nama, ifnull(t1.jml,0) as jml  
	 		from m_kabupaten t0
				LEFT OUTER JOIN 
				(
				SELECT count(a.nama) as jml, c.kabupaten_id from t_penyuluh a
				INNER JOIN m_desa b on a.desa_id=b.id
				INNER JOIN m_kecamatan c on b.kecamatan_id=c.id
				) t1 on t0.id=t1.kabupaten_id
			");
	 	}else{
	 		$query = $this->db->query(" SELECT t0.id,t0.kodeKab, t0.kode, t0.nama, ifnull(t1.jml,0) as jml, t0.kabupaten_id  from m_kecamatan t0
				LEFT OUTER JOIN 
				(
				SELECT count(a.nama) as jml, b.kecamatan_id from t_penyuluh a
				INNER JOIN m_desa b on a.desa_id=b.id
				INNER JOIN m_kecamatan c on b.kecamatan_id=c.id
				) t1 on t0.id=t1.kecamatan_id
				where t0.kabupaten_id = ".$kab."

			");
	 	}

		$list = $query->result_object();

		// Datatables Variables		
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

		//$arrayList = array();
		$data = array();
		foreach ($list as $key => $value) {
			# code...
			$data[] = array(
				'kode' => ($kab==0) ? $value->kodeProp.".".$value->kode : "32.".$value->kodeKab.".".$value->kode,
				'nama' => $value->nama,
				'jml' => $value->jml
			);
			//array_push($arrayList, $data);
		}

		$output = array(
               "draw" => $draw,
               "recordsTotal" => $query->num_rows(),
               "recordsFiltered" => $query->num_rows(),
               "data" => $data
        );

	  	//$jenis	= $this->db->query("select * from m_jenis_potensi where jenis=".$id)->result_array();
	  	print_r( json_encode($output) );

	 }

	
}
