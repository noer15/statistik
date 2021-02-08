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

		$list = $this->db->query("Select a.*, b.nama as nama_jenis from pemilik_lahan a 
			INNER JOIN m_jenis_sertifikat b on b.id=a.jenis_sertifikat")->result_object();		

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
		
		$post_data = array(
	      		'nama_sertifikat' 	=> $nama,
	        	'jenis_sertifikat' => $jenis,	        	
	        	'no_sppt' => $nosppt,
	        	//'no_sertifikat' => $no,
	        	'blok' => $blok,
	        	'no_blok' => $noblok,
	        	'no_bidang' => $nobidang,
	        	'luas_lahan' => $luaslahan,
	        	'anggota_id' => $anggotaId
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

		$post_data = array(
	      		'nama_sertifikat' 	=> $nama,
	        	'jenis_sertifikat' => $jenis,	        	
	        	//'no_sertifikat' => $no,
	        	'no_sppt' => $nosppt,
	        	'blok' => $blok,
	        	'no_blok' => $noblok,
	        	'no_bidang' => $nobidang,
	        	'luas_lahan' => $luaslahan 	
	    		);
		$this->db->where('id',$id);
	    $this->db->update('pemilik_lahan',$post_data);

		redirect(base_url().'Pemiliklahan');
	}

	public function delete($id){
		// delete detail dasar
		$result = $this->db->delete('pemilik_lahan', array('id' => $id));
        print_r($nip);
	 }

	public function getAnggota($id){
	  	$anggota	= $this->db->query("select * from anggota_kelompok_tani where kelompok_id=".$id)->result_array();
	  	print_r( json_encode($anggota) );
	}

	public function getdata(){

		$sql = " Select a.*, b.nama as nama_jenis from pemilik_lahan a 
			INNER JOIN m_jenis_sertifikat b on b.id=a.jenis_sertifikat ";

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
				" ORDER BY ".$orderBy.
				" LIMIT ".$post['start'].", ".$post['length']);
        $list = $page->result_object();

		$totalData = $totalFiltered = $query->num_rows();

        $data = array();
        $no = $post['start'];

        foreach ($list as $key => $value) {
        	$no++;                	       	

            $row = array(
            	'nama_sertifikat'=> $value->nama_sertifikat,
            	'nama_jenis'=> $value->nama_jenis,
            	'blok'=> $value->blok,
            	'luas_lahan'=> $value->luas_lahan,
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
									<i class="icon-pencil"></i> Edit</a>
								</li>
								<li>
									<a href="#" onclick="deleteData('.$value->id.')"><i class="icon-cross2 text-danger-600"></i> Delete</a>
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

	public function rekap()
	{
		$list = $this->db->query('SELECT b.nama, count(a.id) as persil, ROUND(sum(a.luas_lahan)/1000, 2) as luas_lahan, (SELECT count(id) FROM pemilik_lahan ) as total
				FROM pemilik_lahan a INNER JOIN m_jenis_sertifikat b ON a.jenis_sertifikat = b.id GROUP BY b.nama')->result_object();
		
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

		$list = $this->db->query('SELECT b.nama, count(a.id) as persil, ROUND(sum(a.luas_lahan)/1000, 2) as luas_lahan, (SELECT count(id) FROM pemilik_lahan ) as total
		FROM pemilik_lahan a INNER JOIN m_jenis_sertifikat b ON a.jenis_sertifikat = b.id GROUP BY b.nama')->result_object();	

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
