<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gangguan extends CI_Controller {
	private $judul = "Data Gangguan dan Kerusakan Hutan ";
	
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
		$this->load->view('datagangguan/index',$data);
	}	
	
	public function tambah(){

		$kab = $this->db->query("Select a.* from m_kabupaten a ")->result_object();

		$kec = $this->db->query("Select a.* from m_kecamatan a where a.kabupaten_id=".$kab[0]->id)->result_object();

		$desa = $this->db->query("Select a.* from m_desa a where a.kecamatan_id=".$kec[0]->id)->result_object();

		$jenis = $this->db->query("Select a.* from m_jenisgangguan a ")->result_object();
		$kawasan = $this->db->query("Select a.* from m_kawasan_hutan a ")->result_object();
		$satuan = $this->db->query("Select a.* from m_satuan a")->result_object();
		
		$data['tahun']	 = date("Y");
		$data['satuan'] 	 = $satuan;		
		$data['jenis'] 	 = $jenis;
		$data['kawasan'] 	 = $kawasan;
		$data['kabupaten'] 	 = $kab;
		$data['kecamatan'] 	 = $kec;
		$data['desa'] 	 = $desa;
		$data['page'] 	 = 'datagangguan';
		$data['subpage'] ='tambah';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Tambah '.$this->judul;
		$this->load->view('datagangguan/index',$data);	
	}

	public function store(){
		$tahun = $this->input->post('tahun');
		$jumlah = $this->input->post('jumlah');
		$satuan = $this->input->post('satuan');
		$kawasan = $this->input->post('kawasan');
		$jenis = $this->input->post('jenis');
		$desaId = $this->input->post('desa');
		
		$post_data = array(
	      		'tahun' 	=> $tahun,
	      		'jumlah' 	=> $jumlah,
	        	'satuan' => $satuan,	        	
	        	'jenis_gangguan' => $jenis,	  
	        	'kawasan_hutan_id' => $kawasan,
	        	'desa_id' => $desaId
	    		);
	    $this->db->insert('t_gangguan',$post_data);

		redirect(base_url().'Gangguan');
	}

	public function edit($id){
		$dt = $this->db->query("Select a.* from t_gangguan a where id='".$id."'")->result_object();
		
		$desa = $this->db->query("Select a.* from m_desa a where id=".$dt[0]->desa_id)->result_object();		
		$kec = $this->db->query("Select a.* from m_kecamatan a where id=".$desa[0]->kecamatan_id)->result_object();
		$kab = $this->db->query("Select a.* from m_kabupaten a where id=".$kec[0]->kabupaten_id)->result_object();

		$jenis = $this->db->query("Select a.* from m_jenisgangguan a ")->result_object();
		$kawasan = $this->db->query("Select a.* from m_kawasan_hutan a ")->result_object();
		
		$satuan = $this->db->query("Select a.* from m_satuan a")->result_object();
		
		$data['tahun']	 = date("Y");
		$data['satuan'] 	 = $satuan;
		$data['jenis'] 	 = $jenis;
		$data['kawasan'] 	 = $kawasan;		
		$data['data'] = $dt;
		$data['kabupaten'] 	 = $kab;
		$data['kecamatan'] 	 = $kec;
		$data['desa'] 	 = $desa;
		$data['page'] 	 = 'datagangguan';
		$data['subpage'] ='edit';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Edit '.$this->judul;
		$this->load->view('datagangguan/index',$data);	
	}

	public function update(){
		$id = $this->input->post('id');
		$tahun = $this->input->post('tahun');
		$jumlah = $this->input->post('jumlah');
		$satuan = $this->input->post('satuan');
		$kawasan = $this->input->post('kawasan');
		$jenis = $this->input->post('jenis');

		$post_data = array(
	      		'tahun' 	=> $tahun,
	      		'jumlah' 	=> $jumlah,
	        	'satuan' => $satuan,	        	
	        	'jenis_gangguan' => $jenis,
	        	'kawasan_hutan_id' => $kawasan
	    		);
		$this->db->where('id',$id);
	    $this->db->update('t_gangguan',$post_data);

		redirect(base_url().'Gangguan');
	}

	public function delete($id){
		// delete detail dasar
		$result = $this->db->delete('t_gangguan', array('id' => $id));
        print_r($nip);
	}


	 public function getdata(){

		$sql = " Select a.*, c.jenis_gangguan as namagangguan, c1.nama as namakawasan, d.nama as namasatuan, b.nama as namadesa from t_gangguan a 	
					inner join m_desa b on b.id=a.desa_id
					inner join m_jenisgangguan c on c.id=a.jenis_gangguan
					inner join m_kawasan_hutan c1 on c1.id=a.kawasan_hutan_id 
					left join m_satuan d on d.id=a.satuan";

		$query = $this->db->query($sql);

		//String filter = params.get("search[value]")[0];
		$post['start'] = $this->input->get('start', TRUE); //$this->input->post('start'); BZ
		$post['length'] = $this->input->get('length');
        $iOffset = intval($post['start']) / intval($post['length']);        
        $filter = $this->input->get('search[value]');

        $tahun = $this->input->get('tahun');

		$post['draw'] = $this->input->post('draw');        
        $iOrderColumn = $this->input->get("order[0][column]");
        $sOrderDir = $this->input->get("order[0][dir]");
        $orderBy="";
        switch ($iOrderColumn) {
        	case '0':
        		$orderBy="desa_id";
        		break;
        		
        	default:
        		$orderBy="desa_id";
        		break;
        }
        $orderBy = $orderBy." ".$sOrderDir;

		//$page = $this->db->query($sql." LIMIT ".$post['start'].", ".$post['length']);
        
		$page = $this->db->query($sql.
				" WHERE a.tahun=".$tahun." and c.jenis_gangguan like '%".$filter."%' ".
				" ORDER BY ".$orderBy.
				" LIMIT ".$post['start'].", ".$post['length']);
        $list = $page->result_object();

		$totalData = $totalFiltered = $query->num_rows();

        $data = array();
        $no = $post['start'];

        foreach ($list as $key => $value) {
        	$no++;                	       	

            $row = array(
            	'id'=> $value->id,
            	'desa'=> $value->namadesa,
            	'namakawasan'=> $value->namakawasan,
            	'namagangguan'=> $value->namagangguan,
            	'jumlah'=> $value->jumlah,
            	'satuan'=> $value->namasatuan,
            	'aksi' => '<ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="Gangguan/edit/'. $value->id.'">
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
