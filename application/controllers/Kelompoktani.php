<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelompoktani extends CI_Controller {
	private $judul = "Kelompok Tani ";

	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')){
			redirect(base_url().'Login');
		}
	}

	public function lapcdk(){

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
		$data['data'] = $query->result_object();

		$this->load->view('kelompoktani/rekap/laporan_cdk',$data);
	}

	public function lapkelas($kab, $kec, $cdk){

		$role = $this->session->userdata('role_id');
		$unit_kerja = $this->session->userdata('unit_kerja_id');
		if($role == 21){
			$cdk = $unit_kerja;
		}

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
				WHERE a.kelas=1 and ".$strWhere." and a.status = 2
				) as jml_pemula,

				(
				Select count(a.id) from kelompok_tani a
				INNER JOIN m_desa b on b.id=a.desa_id
				INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
				WHERE a.kelas=2 and ".$strWhere." and a.status = 2
				) as jml_madya,

				(
				Select count(a.id) from kelompok_tani a
				INNER JOIN m_desa b on b.id=a.desa_id
				INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
				WHERE a.kelas=3 and ".$strWhere." and a.status = 2
				) as jml_utama,

				(
				Select count(a.id) from kelompok_tani a
				INNER JOIN m_desa b on b.id=a.desa_id
				INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
				WHERE ".$strWhere." and a.status = 2
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
		
		$this->load->view('kelompoktani/rekap/laporan_kelas', $data);
	}


	public function index()
	{
		$user_id = $this->session->userdata('user_id');
		$role_id = $this->session->userdata('role_id');
		$unit_kerja_id = $this->session->userdata('unit_kerja_id');

		if($role_id != 21 || $role_id != 24){
			$list = $this->db->query("SELECT a.* from kelompok_tani a where user_id = ".$user_id)->result_object();
		}else{
			if($role_id == 21){
				$list = $this->db->query("SELECT a.* from kelompok_tani a INNER JOIN tb_pegawai 
					ON a.user_id = tb_pegawai.id where unit_kerja_id = ".$unit_kerja_id." and `status` = 0")->result_object();
			}else if($role_id == 24){
				$list = $this->db->query("SELECT a.* from kelompok_tani a INNER JOIN tb_pegawai 
					ON a.user_id = tb_pegawai.id where `status` = 1")->result_object();
			}else{
				$list = $this->db->query("SELECT a.* from kelompok_tani a")->result_object();
			}
		}		

		$data['data']	 = $list;
		$data['page']	 ='kelompok_tani';
		$data['subpage'] ='list';
		$data['judul']	 =$this->judul;
		$data['header']	 =$this->judul;
		$this->load->view('kelompoktani/index',$data);
	}	
	
	public function tambah(){

		$role = $this->session->userdata('role_id');
		$kab_id = $this->session->userdata('wilayah_kab_id');
		$kec_id = $this->session->userdata('wilayah_kab_id');

		$kab = $this->db->query("SELECT a.* from m_kabupaten a ")->result_object();

		if($role != 1){
			$kec = $this->db->query("SELECT a.* from m_kecamatan a where a.kabupaten_id=".$kab_id)->result_object();
			$desa = $this->db->query("SELECT a.* from m_desa a where a.kecamatan_id=".$kec_id)->result_object();
		}else{
			$kec = $this->db->query("SELECT a.* from m_kecamatan a where a.kabupaten_id=".$kab[0]->id)->result_object();
			$desa = $this->db->query("SELECT a.* from m_desa a")->result_object();
		}

		$kategori = $this->db->query("SELECT a.* from m_kategori_kelompok a ")->result_object();
		$kelas = $this->db->query("SELECT a.* from m_kelas_kelompok a ")->result_object();

		//$noreg= "32.".$kab[0]->kode.".".$kec[0]->kode.".".$desa[0]->kode;

		//$data['noreg'] 	 = $noreg;		
		$data['kategori'] 	 = $kategori;						
		$data['kelas'] 	 = $kelas;
		
		$data['kabupaten'] 	 = $kab;
		$data['kecamatan'] 	 = $kec;
		$data['desa'] 	 = $desa;
		$data['page'] 	 = 'kelompok_tani';
		$data['subpage'] ='tambah';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Tambah '.$this->judul;
		$this->load->view('kelompoktani/index',$data);	
	}

	public function store(){
		//$noreg = $this->input->post('noreg');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$phone = $this->input->post('phone');
		$email = $this->input->post('email');
		$desaId = $this->input->post('desa');
		$kategori = $this->input->post('kategori');
		$menkumham = $this->input->post('menkumham');
		$akta = $this->input->post('akta');
		$sk = $this->input->post('sk');
		$tahun_berdiri = $this->input->post('tahun_berdiri');
		$ba = $this->input->post('ba');
		$kelas = $this->input->post('kelas');
		$lat = $this->input->post('lat');
		$long = $this->input->post('long');
		$jumlah_anggota = $this->input->post('jumlah_anggota');
		$luas = $this->input->post('luas');
		$id_satuan = $this->input->post('id_satuan');

		$role = $this->session->userdata('role_id');
		if($role != 1){
			$user_id = $this->session->userdata('user_id');
		}else{
			$user_id = null;
		}


		$desa = $this->db->query("SELECT a.* from m_desa a where a.id=".$desaId)->result_object();
		$tani = $this->db->query(" SELECT ifnull(max( substring(a.no_register, 7,4) ),0) as max, b.kodeKab 
			from kelompok_tani a
			INNER JOIN m_desa b on b.id=a.desa_id
			WHERE b.kodeKab='".$desa[0]->kodeKab."' ")->result_object();

		$no=$tani[0]->max+1;
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

		$noreg = "32.".$desa[0]->kodeKab.".".$nourut.".".$tahun_berdiri;
		
		$post_data = array(
	      		'no_register' 	=> $noreg,	        	
	      		'nama' 	=> $nama,
	      		'alamat' => $alamat,	        	
	        	'phone' => $phone,	  
	        	'email' => $email,	  
	        	'kategori' => $kategori,
	        	'sk_menkumham' => $menkumham,
	        	'akta_notaris' => $akta,
	        	'sk_berdiri' => $sk,
	        	'berita_acara' => $ba,
	        	'kelas' => $kelas,
	        	'lat' => $lat,
	        	'long' => $long,
	        	'luas' => $luas,
	        	'jumlah_anggota' => $jumlah_anggota,
	        	'id_satuan' => $id_satuan,
	        	'tahun_berdiri' => $tahun_berdiri,	        	
	        	'desa_id' => $desaId,
				'user_id' => $user_id
	    );
	    $this->db->insert('kelompok_tani',$post_data);

	    $insId = $this->db->insert_id();
	    $this->uploadFile("file_menkumham", $insId);
	    $this->uploadFile("file_akta", $insId);
	    $this->uploadFile("file_sk", $insId);
	    $this->uploadFile("file_ba", $insId);

		redirect(base_url().'Kelompoktani');			
	}

	public function edit($id){
		$dt = $this->db->query("Select a.* from kelompok_tani a where id='".$id."'")->result_object();
		
		$desa = $this->db->query("Select a.* from m_desa a where id=".$dt[0]->desa_id)->result_object();		
		$kec = $this->db->query("Select a.* from m_kecamatan a where id=".$desa[0]->kecamatan_id)->result_object();
		$kab = $this->db->query("Select a.* from m_kabupaten a where id=".$kec[0]->kabupaten_id)->result_object();
		$kategori = $this->db->query("Select a.* from m_kategori_kelompok a ")->result_object();
		$kelas = $this->db->query("Select a.* from m_kelas_kelompok a ")->result_object();
		
		$data['kategori'] 	 = $kategori;						
		$data['kelas'] 	 = $kelas;
		
		$data['data'] = $dt;
		$data['kabupaten'] 	 = $kab;
		$data['kecamatan'] 	 = $kec;
		$data['desa'] 	 = $desa;
		$data['page'] 	 = 'kelompok_tani';
		$data['subpage'] ='edit';		
		$data['judul']	 ='Kelompok Tani';
		$data['header']	 ='Edit '.$this->judul;
		$this->load->view('kelompoktani/index',$data);	
	}

	public function update(){
		$id = $this->input->post('id');
		//$noreg = $this->input->post('noreg');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$phone = $this->input->post('phone');
		$email = $this->input->post('email');
		$kategori = $this->input->post('kategori');		
		$menkumham = $this->input->post('menkumham');
		$akta = $this->input->post('akta');
		$sk = $this->input->post('sk');
		$ba = $this->input->post('ba');
		$kelas = $this->input->post('kelas');
		$tahun_berdiri = $this->input->post('tahun_berdiri');
		$status = $this->input->post('status');
		$lat = $this->input->post('lat');
		$long = $this->input->post('long');
		$jumlah_anggota = $this->input->post('jumlah_anggota');
		$luas = $this->input->post('luas');
		$id_satuan = $this->input->post('id_satuan');

		$role = $this->session->userdata('role_id');
		if($role != 1){
			$user_id = $this->session->userdata('user_id');
		}else{
			$user_id = null;
		}
		
		$post_data = array(
				//'no_register' 	=> $noreg,	        	
	      		'nama' 	=> $nama,
	        	'alamat' => $alamat,	        	
	        	'phone' => $phone,	  
	        	'kategori' => $kategori,
	        	'sk_menkumham' => $menkumham,	        	
	        	'akta_notaris' => $akta,
	        	'sk_berdiri' => $sk,
	        	'tahun_berdiri' => $tahun_berdiri,
	        	'berita_acara' => $ba,
	        	'email' => $email,
	        	'kelas' => $kelas,
				'lat' => $lat,
	        	'long' => $long,
	        	'luas' => $luas,
	        	'jumlah_anggota' => $jumlah_anggota,
	        	'id_satuan' => $id_satuan,
				'user_id' => $user_id
	    );

		if($role == 21 && $status != 0){
			$post_data = array('status' => 1);
		}

		if($role == 24 && $status != 1){
			$post_data = array('status' => 2);
		}
		
		$this->db->where('id',$id);
	    $this->db->update('kelompok_tani',$post_data);

		if($role != 21){
			if($role != 24){
				$this->uploadFile("file_menkumham", $id);
				$this->uploadFile("file_akta", $id);
				$this->uploadFile("file_sk", $id);
				$this->uploadFile("file_ba", $id);
			}
		}

		redirect(base_url().'Kelompoktani');
	}

	public function delete($id){
		$result = $this->db->delete('kelompok_tani', array('id' => $id));
    }


	public function getdata(){

		$role_id = $this->session->userdata('role_id');
		$user_id = $this->session->userdata('user_id');
		$unit_kerja_id = $this->session->userdata('unit_kerja_id');

		if($role_id != 1){
			if($role_id == 21){
				$user = 'AND unit_kerja_id = '.$unit_kerja_id.' AND `status` = 0';
				$sqlTotal = 'SELECT a.* from kelompok_tani a INNER JOIN tb_pegawai 
				ON a.user_id = tb_pegawai.id WHERE unit_kerja_id = '.$unit_kerja_id.' AND `status` = 0';
			}else if($role_id == 24){
				$user = 'AND `status` = 1';
				$sqlTotal = 'SELECT a.* from kelompok_tani a INNER JOIN tb_pegawai 
				ON a.user_id = tb_pegawai.id WHERE `status` = 1';
			}else{
				$user = 'AND user_id = '.$user_id;
				$sqlTotal = 'SELECT a.* from kelompok_tani a WHERE user_id = '.$user_id;
			}
		}else{
			$user = '';
			$sqlTotal = 'SELECT a.* from kelompok_tani a';
		}

		if($role_id == 21 || $role_id == 24){
			$sql = "SELECT a.* from kelompok_tani a INNER JOIN tb_pegawai ON a.user_id = tb_pegawai.id ";
		}else{
			$sql = "SELECT a.* from kelompok_tani a ";
		}	

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
        		$orderBy="no_register";
        		break;
        	case '1':
        		$orderBy="nama";
        		break;
        	case '2':
        		$orderBy="alamat";
        		break;
        	case '3':
        		$orderBy="phone";
        		break;

        	default:
        		$orderBy="nama";
        		break;
        }
        $orderBy = $orderBy." ".$sOrderDir;

		//$page = $this->db->query($sql." LIMIT ".$post['start'].", ".$post['length']);		

		$page = $this->db->query($sql.
				" WHERE ".
				" ( a.no_register like '%".$filter."%' ".
				" OR a.nama like '%".$filter."%' ".
				" OR a.alamat like '%".$filter."%' ".
				" ) ".
				$user.
				" ORDER BY ".$orderBy.
				" LIMIT ".$post['start'].", ".$post['length']);
        $list = $page->result_object();

		$query = $this->db->query($sqlTotal);
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

			if($role_id == 24 || $role_id == 1){
				$aksi_edit = '<li>
								<a href="#" onclick="deleteData('. $value->id.')"><i class="icon-cross2 text-danger-600"></i> Delete</a>
							</li>';
			}else{
				$aksi_edit = '';
			}

            $row = array(
     	       	'no_register'=> $value->no_register,
            	'nama'=> $value->nama,
            	'alamat'=> $value->alamat,
            	'phone'=> $value->phone,
            	'email'=> $value->email,
				'status' => $status,
            	'aksi' => '<ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="Anggotakelompoktani/index/'. $value->id.'">
									<i class="icon-list text-primary-600"></i> Rincian Anggota</a>
								</li>
								<li><a href="Kelompoktani/edit/'.$value->id.'">
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


    public function uploadFile($name, $insId){
    	$target_dir = "uploads/kelompok/";
		$target_file = $target_dir;

		print_r($_FILES[$name]["name"]);

		$path_parts = pathinfo($_FILES[$name]["name"]);
		$extension = isset($path_parts['extension']) ? $path_parts['extension'] : "";

		
		$namaFile = $name.$insId.'.'.$extension;
		$namaSementara = isset($_FILES[$name]['tmp_name']) ? $_FILES[$name]['tmp_name'] : ""; 

		// tentukan lokasi file akan dipindahkan
		$dirUpload = "uploads/kelompok/";

		// pindahkan file
		$terupload = move_uploaded_file($namaSementara, $dirUpload.$namaFile);

		if ($terupload) {
		    $update_data = array(
	      		$name 	=> $namaFile	        	
	    		);
		    $this->db->where('id',$insId);
	    	$this->db->update('kelompok_tani',$update_data);
		} else {
		    //$this->delete($insert_id);
		    //$this->tambah();		    		    
		}
    }

    public function rekap(){

    	$kab = $this->db->query("Select a.* from m_kabupaten a ")->result();
    	$cdk=$this->db->query("select t0.* from m_unit_kerja t0 where t0.id>=9 and t0.id<=17 and t0.tahun='2018'")->result_object();

    	$data['datacdk'] 	= $cdk;
		$data['kabupaten'] 	= $kab;
	 	$data['page']	 	= 'reportkelompoktani';
		$data['subpage'] 	= 'list';
		$data['judul']	 	= 'Laporan Kelompok Tani ';
		$data['header']	 	= 'Kelompok Tani ';
		$this->load->view('kelompoktani/rekap/index',$data);
	 }

	
}
