<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pemiliklahan extends CI_Controller {
	private $judul = "Kepemilikan Lahan ";

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

		if($role_id != 21 || $role_id != 24){
			$list = $this->db->query("SELECT a.*, b.nama as nama_jenis from pemilik_lahan a 
			INNER JOIN m_jenis_sertifikat b on b.id=a.jenis_sertifikat WHERE user_id = $user_id")->result_object();
		}else{
			if($role_id == 21){
				$list = $this->db->query("SELECT a.*, b.nama as nama_jenis from pemilik_lahan a 
				INNER JOIN m_jenis_sertifikat b on b.id=a.jenis_sertifikat INNER JOIN tb_pegawai 
					ON a.user_id = tb_pegawai.id where unit_kerja_id = $unit_kerja_id AND `status` = 0")->result_object();
			}else{
				$list = $this->db->query("SELECT a.*, b.nama as nama_jenis from pemilik_lahan a 
				INNER JOIN m_jenis_sertifikat b on b.id=a.jenis_sertifikat WHERE `status` = 1")->result_object();
			}
		}		

		$data['data']	 = $list;
		$data['page']	 ='pemiliklahan';
		$data['subpage'] ='list';
		$data['judul']	 =$this->judul;
		$data['header']	 =$this->judul;
		$this->load->view('pemiliklahan/index',$data);
	}	
	
	public function tambah(){

		$kelompok = $this->db->query("Select a.* from kelompok_tani a ")->result_object();

		$anggota = $this->db->query("Select a.* from anggota_kelompok_tani a where a.kelompok_id=".$kelompok[0]->id)->result_object();
		$jenis = $this->db->query("Select a.* from m_jenis_sertifikat a ")->result_object();
		
		$data['kelompok'] 	 = $kelompok;
		$data['anggota'] 	 = $anggota;
		$data['jenis'] 	 = $jenis;
		$data['page'] 	 = 'pemiliklahan';
		$data['subpage'] ='tambah';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Tambah '.$this->judul;
		$this->load->view('pemiliklahan/index',$data);	
	}

	public function store(){
		$nama = $this->input->post('nama');
		$jenis = $this->input->post('jenis');
		//$no = $this->input->post('no');
		$nosppt = $this->input->post('nosppt');
		$blok = $this->input->post('blok');
		$noblok = $this->input->post('noblok');
		$nobidang = $this->input->post('nobidang');
		$luaslahan = $this->input->post('luaslahan');
		$anggotaId = $this->input->post('anggota');
		
		if($this->session->userdata('role_id') != 1){
			$user_id = $this->session->userdata('user_id');
		}else{
			$user_id = null;
		}
		
		$post_data = array(
	      		'nama_sertifikat' 	=> $nama,
	        	'jenis_sertifikat' => $jenis,	        	
	        	'no_sppt' => $nosppt,
	        	//'no_sertifikat' => $no,
	        	'blok' => $blok,
	        	'no_blok' => $noblok,
	        	'no_bidang' => $nobidang,
	        	'luas_lahan' => $luaslahan,
	        	'anggota_id' => $anggotaId,
				'user_id' => $user_id
	    		);
	    $this->db->insert('pemilik_lahan',$post_data);

		redirect(base_url().'Pemiliklahan');
	}

	public function edit($id){
		$dt = $this->db->query("Select a.* from pemilik_lahan a where id='".$id."'")->result_object();
		
		$anggota = $this->db->query("Select a.* from anggota_kelompok_tani a where id=".$dt[0]->anggota_id)->result_object();
		$kelompok = $this->db->query("Select a.* from kelompok_tani a where id=".$anggota[0]->kelompok_id)->result_object();
		$jenis = $this->db->query("Select a.* from m_jenis_sertifikat a ")->result_object();
		
		
		$data['data'] = $dt;
		$data['kelompok'] 	 = $kelompok;
		$data['anggota'] 	 = $anggota;
		$data['jenis'] 	 = $jenis;
		$data['page'] 	 = 'pemiliklahan';
		$data['subpage'] ='edit';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Edit '.$this->judul;
		$this->load->view('pemiliklahan/index',$data);	
	}

	public function update(){

		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$jenis = $this->input->post('jenis');
		//$no = $this->input->post('no');
		$nosppt = $this->input->post('nosppt');
		$blok = $this->input->post('blok');
		$noblok = $this->input->post('noblok');
		$nobidang = $this->input->post('nobidang');
		$luaslahan = $this->input->post('luaslahan');		
		$nosppt = $this->input->post('nosppt');
		$status = $this->input->post('status');

		$role = $this->session->userdata('role_id');
		if($role != 1){
			$user_id = $this->session->userdata('user_id');
		}else{
			$user_id = null;
		}

		$post_data = array(
	      		'nama_sertifikat' 	=> $nama,
	        	'jenis_sertifikat' => $jenis,	        	
	        	//'no_sertifikat' => $no,
	        	'no_sppt' => $nosppt,
	        	'blok' => $blok,
	        	'no_blok' => $noblok,
	        	'no_bidang' => $nobidang,
	        	'luas_lahan' => $luaslahan,
				'user_id' => $user_id
	    		);
		
		if($role == 21 && $status != 0){
			$post_data = array('status' => 1);
		}

		if($role == 24 && $status != 1){
			$post_data = array('status' => 2);
		}

		$this->db->where('id',$id);
	    $this->db->update('pemilik_lahan',$post_data);

		redirect(base_url().'Pemiliklahan');
	}

	public function delete($id){
		// delete detail dasar
		$result = $this->db->delete('pemilik_lahan', array('id' => $id));
	 }

	public function getAnggota($id){
	  	$anggota	= $this->db->query("select * from anggota_kelompok_tani where kelompok_id=".$id)->result_array();
	  	print_r( json_encode($anggota) );
	}

	public function getdata(){

		$role = $this->session->userdata('role_id');
		$user_id = $this->session->userdata('user_id');
		$unit_kerja_id = $this->session->userdata('unit_kerja_id');

		if($role != 1){
			if($role == 21){
				$sqls = " SELECT a.*, b.nama as nama_jenis from pemilik_lahan a 
				INNER JOIN m_jenis_sertifikat b on b.id=a.jenis_sertifikat INNER JOIN tb_pegawai 
				ON a.user_id = tb_pegawai.id where unit_kerja_id = $unit_kerja_id AND `status` = 0";

				$user = " AND unit_kerja_id = $unit_kerja_id AND `status` = 0";
			}else if ($role == 24){
				$sqls = " SELECT a.*, b.nama as nama_jenis from pemilik_lahan a 
				INNER JOIN m_jenis_sertifikat b on b.id=a.jenis_sertifikat INNER JOIN tb_pegawai 
				ON a.user_id = tb_pegawai.id where `status` = 1";

				$user = " AND `status` = 1";
			}else{
				$sqls = " Select a.*, b.nama as nama_jenis from pemilik_lahan a 
				INNER JOIN m_jenis_sertifikat b on b.id=a.jenis_sertifikat where user_id = ".$user_id;
				$user = " AND user_id = ".$user_id;
			}
		}else{
			$sqls = " SELECT a.*, b.nama as nama_jenis from pemilik_lahan a 
			INNER JOIN m_jenis_sertifikat b on b.id=a.jenis_sertifikat ";
			$user = "";
		}

		if($role == 21 || $role == 24){
			$sql = " SELECT a.*, b.nama as nama_jenis from pemilik_lahan a 
			INNER JOIN m_jenis_sertifikat b on b.id=a.jenis_sertifikat INNER JOIN tb_pegawai 
				ON a.user_id = tb_pegawai.id ";
		}else{
			$sql = " SELECT a.*, b.nama as nama_jenis from pemilik_lahan a 
			INNER JOIN m_jenis_sertifikat b on b.id=a.jenis_sertifikat ";
		}
		
		$query = $this->db->query($sqls);

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
        		$orderBy="nama_sertifikat";
        		break;
        	case '1':
        		$orderBy="nama_jenis";
        		break;
        	case '2':
        		$orderBy="blok";
        		break;
        		
        	default:
        		$orderBy="nama_sertifikat";
        		break;
        }
        $orderBy = $orderBy." ".$sOrderDir;

		//$page = $this->db->query($sql." LIMIT ".$post['start'].", ".$post['length']);
        
		$page = $this->db->query($sql.
				" WHERE a.nama_sertifikat like '%".$filter."%' ".
				$user.
				" ORDER BY ".$orderBy.
				" LIMIT ".$post['start'].", ".$post['length']);
        $list = $page->result_object();

		$totalData = $totalFiltered = $query->num_rows();

        $data = array();
        $no = $post['start'];

        foreach ($list as $key => $value) {
        	$no++;                	       	

			switch ($value->status) {
				case 	0: $status = 'Menunggu Persetujuan Kepala Seksi PDAS PM'; break;
				case 	1: $status = 'Menunggu Persetujuan Kabid BUPM'; break;
				case 	2: $status = 'Data Telah Disetujui'; break;
				default	 : $status = 'Menunggu Persetujuan'; break;
			}

			if($role == 24 || $role == 1){
				$aksi_edit = '<li>
								<a href="#" onclick="deleteData('. $value->id.')"><i class="icon-cross2 text-danger-600"></i> Delete</a>
							</li>';
			}else{
				$aksi_edit = '';
			}

            $row = array(
            	'nama_sertifikat'=> $value->nama_sertifikat,
            	'nama_jenis'=> $value->nama_jenis,
            	'blok'=> $value->blok,
            	'luas_lahan'=> $value->luas_lahan,
				'status' => $status,
            	'aksi' => '<ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="'.base_url().'Potensi/index/'. $value->id.'">
									<i class="icon-list text-primary-600"></i> Potensi </a>
								</li>
								<li><a href="'.base_url().'Pemiliklahan/edit/'.$value->id.'">
									<i class="icon-pencil"></i> Edit/Lihat</a>
								</li>
								'.$aksi_edit.'
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

	public function rekap()
	{
		$role = $this->session->userdata('role_id');
		$unit_kerja = $this->session->userdata('unit_kerja_id');

		$wilayah = '';
		if($role == 21){
			$wilayah = ' INNER JOIN tb_pegawai c ON a.user_id = c.id WHERE c.unit_kerja_id = '.$unit_kerja.' AND a.`status` = 2';
		}

		$list = $this->db->query('SELECT b.nama, count(a.id) as persil, ROUND(sum(a.luas_lahan)/1000, 2) as luas_lahan, 
								(SELECT count(a.id) FROM pemilik_lahan a '.$wilayah.') as total
								FROM pemilik_lahan a 
								INNER JOIN m_jenis_sertifikat b ON a.jenis_sertifikat = b.id 
								'.$wilayah.'
								GROUP BY b.nama')->result_object();
		
		$data['data'] 	 = $list;
		$data['page']	 = 'reportkepemilikan';
		$data['subpage'] = 'rekap';
		$data['judul']	 =$this->judul;
		$data['header']	 =$this->judul;

		$this->load->view('pemiliklahan/index',$data);
	}

	public function print(){
		
		$this->load->library('pdfgenerator');
		date_default_timezone_set('GMT');

		$role = $this->session->userdata('role_id');
		$unit_kerja = $this->session->userdata('unit_kerja_id');

		$wilayah = ''; $kondisi = '';
		if($role == 21){
			$wilayah = ' INNER JOIN tb_pegawai c ON pl.user_id = c.id ';
			$kondisi = ' AND c.unit_kerja_id = '.$unit_kerja.' AND pl.`status` = 2';
		}

		$list = $this->db->query("SELECT
									kab.id AS kabId,
									kab.nama AS kabupaten,
									(
									SELECT
										count( distinct pl.anggota_id ) 
									FROM
										pemilik_lahan AS pl
										INNER JOIN anggota_kelompok_tani AS akt ON pl.anggota_id = akt.id
										INNER JOIN kelompok_tani AS kt ON akt.kelompok_id = kt.id
										INNER JOIN m_desa AS ds ON kt.desa_id = ds.id
										INNER JOIN m_kecamatan AS kc ON ds.kecamatan_id = kc.id
										RIGHT JOIN m_kabupaten AS kb ON kc.kabupaten_id = kb.id 
										$wilayah
									WHERE
										kb.id = kabId 
										$kondisi
									) AS pemilik_lahan,
									(
									SELECT
										count( pl.id ) 
									FROM
										pemilik_lahan AS pl
										INNER JOIN anggota_kelompok_tani AS akt ON pl.anggota_id = akt.id
										INNER JOIN kelompok_tani AS kt ON akt.kelompok_id = kt.id
										INNER JOIN m_desa AS ds ON kt.desa_id = ds.id
										INNER JOIN m_kecamatan AS kc ON ds.kecamatan_id = kc.id
										RIGHT JOIN m_kabupaten AS kb ON kc.kabupaten_id = kb.id 
										$wilayah
									WHERE
										pl.jenis_sertifikat = 3 
										AND kb.id = kabId 
										$kondisi
									) AS persil_c,
									(
									SELECT
										ROUND( SUM( pl.luas_lahan ) / 10000, 2 ) 
									FROM
										pemilik_lahan AS pl
										INNER JOIN anggota_kelompok_tani AS akt ON pl.anggota_id = akt.id
										INNER JOIN kelompok_tani AS kt ON akt.kelompok_id = kt.id
										INNER JOIN m_desa AS ds ON kt.desa_id = ds.id
										INNER JOIN m_kecamatan AS kc ON ds.kecamatan_id = kc.id
										RIGHT JOIN m_kabupaten AS kb ON kc.kabupaten_id = kb.id 
										$wilayah
									WHERE
										pl.jenis_sertifikat = 3 
										AND kb.id = kabId 
										$kondisi
									) AS luas_c,
									(
									SELECT
										count( pl.id ) 
									FROM
										pemilik_lahan AS pl
										INNER JOIN anggota_kelompok_tani AS akt ON pl.anggota_id = akt.id
										INNER JOIN kelompok_tani AS kt ON akt.kelompok_id = kt.id
										INNER JOIN m_desa AS ds ON kt.desa_id = ds.id
										INNER JOIN m_kecamatan AS kc ON ds.kecamatan_id = kc.id
										RIGHT JOIN m_kabupaten AS kb ON kc.kabupaten_id = kb.id 
										$wilayah
									WHERE
										pl.jenis_sertifikat = 2 
										AND kb.id = kabId 
										$kondisi
									) AS persil_ajb,
									(
									SELECT
										ROUND( SUM( pl.luas_lahan ) / 10000, 2 ) 
									FROM
										pemilik_lahan AS pl
										INNER JOIN anggota_kelompok_tani AS akt ON pl.anggota_id = akt.id
										INNER JOIN kelompok_tani AS kt ON akt.kelompok_id = kt.id
										INNER JOIN m_desa AS ds ON kt.desa_id = ds.id
										INNER JOIN m_kecamatan AS kc ON ds.kecamatan_id = kc.id
										RIGHT JOIN m_kabupaten AS kb ON kc.kabupaten_id = kb.id 
										$wilayah
									WHERE
										pl.jenis_sertifikat = 2 
										AND kb.id = kabId 
										$kondisi
									) AS luas_ajb,
									(
									SELECT
										count( pl.id ) 
									FROM
										pemilik_lahan AS pl
										INNER JOIN anggota_kelompok_tani AS akt ON pl.anggota_id = akt.id
										INNER JOIN kelompok_tani AS kt ON akt.kelompok_id = kt.id
										INNER JOIN m_desa AS ds ON kt.desa_id = ds.id
										INNER JOIN m_kecamatan AS kc ON ds.kecamatan_id = kc.id
										RIGHT JOIN m_kabupaten AS kb ON kc.kabupaten_id = kb.id 
										$wilayah
									WHERE
										pl.jenis_sertifikat = 1 
										AND kb.id = kabId 
										$kondisi
									) AS persil_sertifikat,
									(
									SELECT
										ROUND( SUM( pl.luas_lahan ) / 10000, 2 ) 
									FROM
										pemilik_lahan AS pl
										INNER JOIN anggota_kelompok_tani AS akt ON pl.anggota_id = akt.id
										INNER JOIN kelompok_tani AS kt ON akt.kelompok_id = kt.id
										INNER JOIN m_desa AS ds ON kt.desa_id = ds.id
										INNER JOIN m_kecamatan AS kc ON ds.kecamatan_id = kc.id
										RIGHT JOIN m_kabupaten AS kb ON kc.kabupaten_id = kb.id 
										$wilayah
									WHERE
										pl.jenis_sertifikat = 1 
										AND kb.id = kabId 
										$kondisi
									) AS luas_sertifikat
								FROM
									m_kabupaten kab")->result_object();	

		$data['list'] = $list;

		$html = $this->load->view('pemiliklahan/print', $data, true);		  		

		$paper = array(
					"A5" => 'A5',
					"Legal" => 'Legal',
		 			"folio" => array(0,0,612.00,936.00)
		 		);

	    $this->pdfgenerator->generate($html,'rekap_kepemilikan_lahan',TRUE,$paper['Legal']);
	}
}
