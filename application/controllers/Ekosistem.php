<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ekosistem extends CI_Controller {
	private $judul = "Data Kawasan Ekosistem Esensial ";
	
	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')){
			redirect(base_url().'Login');
		}
	}

	public function index()
	{

		$list = $this->db->query("Select a.*, c.jenis_gangguan as namagangguan from t_gangguan a 			
			inner join m_jenisgangguan c on c.id=a.jenis_gangguan 
			")->result_object();		

		$data['tahun']	 = date("Y");
		$data['data']	 = $list;
		$data['page']	 = 'datagangguan';
		$data['subpage'] ='list';
		$data['judul']	 =$this->judul;
		$data['header']	 =$this->judul;
		$this->load->view('kee/index',$data);
	}	
	
	public function tambah(){

		$kab = $this->db->query("Select a.* from m_kabupaten a ")->result_object();

		$kec = $this->db->query("Select a.* from m_kecamatan a where a.kabupaten_id=".$kab[0]->id)->result_object();

		$desa = $this->db->query("Select a.* from m_desa a where a.kecamatan_id=".$kec[0]->id)->result_object();

		
		
		$data['tahun']	 = date("Y");
		$data['kabupaten'] 	 = $kab;
		$data['kecamatan'] 	 = $kec;
		$data['desa'] 	 = $desa;
		$data['page'] 	 = 'datagangguan';
		$data['subpage'] ='tambah';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Tambah '.$this->judul;
		$this->load->view('kee/index',$data);	
	}

	public function store(){
		$nama_lokasi = $this->input->post('nama_lokasi');
		$kab = $this->input->post('kab');
		$kec = $this->input->post('kec');
		$desa = $this->input->post('desa');

		$lat = $this->input->post('lat');
		$long = $this->input->post('long');
		$luas = $this->input->post('luas');
		$status_lahan = $this->input->post('status_lahan');
		$jenis = $this->input->post('jenis');
		$progres_kegiatan = $this->input->post('progres_kegiatan');
		
		$post_data = array(
	      		'nama_lokasi' 	=> $nama_lokasi,
	      		'id_kab' 	=> $kab,
	      		'id_kec' 	=> $kec,
	      		'id_desa' 	=> $desa,
	        	'lat' => $lat,	        	
	        	'long' => $long,	  
	        	'luas' => $luas,
	        	'status_lahan' => $status_lahan,
	        	'jenis' => $jenis,
	        	'progres_kegiatan' => $progres_kegiatan
	    		);
	    $this->db->insert('kawasan_ekosistem',$post_data);

		redirect(base_url().'Ekosistem');
	}

	public function edit($id){
		$dt = $this->db->query("Select a.* from kawasan_ekosistem a where id='".$id."'")->row();
		
		$data['tahun']	 = date("Y");		
		$data['data'] = $dt;
		$data['page'] 	 = 'datagangguan';
		$data['subpage'] ='edit';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Edit '.$this->judul;
		$this->load->view('kee/index',$data);	
	}

	public function update(){
		$id = $this->input->post('id');
		$nama_lokasi = $this->input->post('nama_lokasi');
		$kab = $this->input->post('kab');
		$kec = $this->input->post('kec');
		$desa = $this->input->post('desa');

		$lat = $this->input->post('lat');
		$long = $this->input->post('long');
		$luas = $this->input->post('luas');
		$status_lahan = $this->input->post('status_lahan');
		$jenis = $this->input->post('jenis');
		$progres_kegiatan = $this->input->post('progres_kegiatan');

		$post_data = array(
			'nama_lokasi' 	=> $nama_lokasi,
			'id_kab' 	=> $kab,
			'id_kec' 	=> $kec,
			'id_desa' 	=> $desa,
			'lat' => $lat,	        	
			'long' => $long,	  
			'luas' => $luas,
			'status_lahan' => $status_lahan,
			'jenis' => $jenis,
			'progres_kegiatan' => $progres_kegiatan
	    		);
		$this->db->where('id',$id);
	    $this->db->update('kawasan_ekosistem',$post_data);

		redirect(base_url().'Ekosistem');
	}

	public function delete($id){
		// delete detail dasar
		$result = $this->db->delete('kawasan_ekosistem', array('id' => $id));
        print_r($nip);
	}


	 public function getdata(){

		$sql = " Select * from kawasan_ekosistem";

		$query = $this->db->query($sql);

		//String filter = params.get("search[value]")[0];
		$post['start'] = $this->input->get('start', TRUE); //$this->input->post('start'); BZ
		$post['length'] = $this->input->get('length');
        $iOffset = intval($post['start']) / intval($post['length']);        
        $filter = $this->input->get('search[value]');


		$post['draw'] = $this->input->post('draw');        
        $iOrderColumn = $this->input->get("order[0][column]");
        $sOrderDir = $this->input->get("order[0][dir]");
        $orderBy="";
        switch ($iOrderColumn) {
        	case '0':
        		$orderBy="id";
        		break;
        		
        	default:
        		$orderBy="id";
        		break;
        }
        $orderBy = $orderBy." ".$sOrderDir;

		//$page = $this->db->query($sql." LIMIT ".$post['start'].", ".$post['length']);
        
		$page = $this->db->query($sql.
				" WHERE nama_lokasi like '%".$filter."%' ".
				" ORDER BY ".$orderBy.
				" LIMIT ".$post['start'].", ".$post['length']);
        $list = $page->result_object();

		$totalData = $totalFiltered = $query->num_rows();

        $data = array();
        $no = $post['start'];

        foreach ($list as $key => $value) {
        	$no++;                	       	

            $row = array(
            	'lokasi'=> $value->nama_lokasi,
            	'luas'=> $value->luas,
            	'aksi' => '<ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="Ekosistem/edit/'. $value->id.'">
									<i class="icon-pencil"></i> Edit</a>
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

	
}
