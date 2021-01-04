<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Luaslahan extends CI_Controller {
	private $judul = "Luas Kawasan Hutan ";

	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')){
			redirect(base_url().'Login');
		}
	}

	public function index()
	{
		$list = $this->db->query("Select a.*, b.nama as namakph, c.nama as fungsikh from luas_kawasan_hutan a 
			inner join m_kph b on b.id=a.kph_id 
			inner join m_fungsi_kawasan_hutan c on c.id=a.fungsi_kawasan
			")->result_object();				

		$tahun = $this->db->query("Select a.tahun from luas_kawasan_hutan a group by a.tahun")->result_object(); 

		$data['tahun']	 = date("Y");
		$data['data']	 = $list;
		$data['page']	 ='luaslahan';
		$data['subpage'] ='list';
		$data['judul']	 =$this->judul;
		$data['header']	 =$this->judul;
		$this->load->view('luaslahan/index',$data);
	}	
	
	public function tambah(){

		$kph = $this->db->query("Select a.* from m_kph a ")->result_object();
		$kawasanhutan = $this->db->query("Select a.* from m_kawasan_hutan a ")->result_object();
		$fungsikawasan = $this->db->query("Select a.* from m_fungsi_kawasan_hutan a ")->result_object();

		$satuan = $this->db->query("Select a.* from m_satuan a")->result_object();
		
		$data['satuan'] 	 = $satuan;
		$data['kawasanhutan'] 	 = $kawasanhutan;
		$data['fungsikawasan'] 	 = $fungsikawasan;
		$data['tahun']	 = date("Y");
		$data['kph'] 	 = $kph;
		$data['page'] 	 = 'luaslahan';
		$data['subpage'] ='tambah';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Tambah '.$this->judul;
		$this->load->view('luaslahan/index',$data);	
	}

	public function store(){
		$tahun = $this->input->post('tahun');
		$luas = $this->input->post('luas');
		$satuan = $this->input->post('satuan');
		$kawasanhutan = $this->input->post('kawasanhutan');
		$fungsikawasan = $this->input->post('fungsikawasan');
		$kphId = $this->input->post('kph');
		
		$post_data = array(
	      		'tahun' 	=> $tahun,
	      		'luas' 	=> $luas,
	        	'satuan' => $satuan,	        	
	        	'kawasan_hutan_id' => $kawasanhutan,
	        	'fungsi_kawasan' => $fungsikawasan,	  
	        	'kph_id' => $kphId
	    		);
	    $this->db->insert('luas_kawasan_hutan',$post_data);

		redirect(base_url().'luaslahan');
	}

	public function edit($id){
		$dt = $this->db->query("Select a.* from luas_kawasan_hutan a where id='".$id."'")->result_object();		
		$kph = $this->db->query("Select a.* from m_kph a where id=".$dt[0]->kph_id)->result_object();		

		$kawasanhutan = $this->db->query("Select a.* from m_kawasan_hutan a ")->result_object();
		$kawasan = $this->db->query("Select a.* from m_fungsi_kawasan_hutan a ")->result_object();

		$satuan = $this->db->query("Select a.* from m_satuan a")->result_object();
		
		$data['satuan'] 	 = $satuan;
		$data['kawasanhutan'] 	 = $kawasanhutan;		
		$data['kawasan'] 	 = $kawasan;
		$data['data'] = $dt;
		$data['kph'] 	 = $kph;
		$data['page'] 	 = 'luaslahan';
		$data['subpage'] ='edit';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Edit '.$this->judul;
		$this->load->view('luaslahan/index',$data);	
	}

	public function update(){
		$id = $this->input->post('id');
		$tahun = $this->input->post('tahun');
		$luas = $this->input->post('luas');
		$satuan = $this->input->post('satuan');
		$kawasanhutan = $this->input->post('kawasanhutan');
		$fungsikawasan = $this->input->post('fungsikawasan');
		$kphId = $this->input->post('kph');
		
		$post_data = array(
				'tahun' 	=> $tahun,
	      		'luas' 	=> $luas,
	        	'satuan' => $satuan,	        	
	        	'kawasan_hutan_id' => $kawasanhutan,
	        	'fungsi_kawasan' => $fungsikawasan
	    		);
		$this->db->where('id',$id);
	    $this->db->update('luas_kawasan_hutan',$post_data);

		redirect(base_url().'luaslahan');
	}

	public function delete($id){
		// delete detail dasar
		$result = $this->db->delete('luas_kawasan_hutan', array('id' => $id));
        print_r($nip);
	 }

	 public function getdata(){

		$sql = " Select a.*, b.nama as namakph, c1.nama as namakawasan, c.nama as fungsikh, d.nama as namasatuan from luas_kawasan_hutan a 
				inner join m_kph b on b.id=a.kph_id
				inner join m_fungsi_kawasan_hutan c on c.id=a.fungsi_kawasan 
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
        		$orderBy="id";
        		break;
        	case '1':
        		$orderBy="nama";
        		break;
        		
        	default:
        		$orderBy="id";
        		break;
        }
        $orderBy = $orderBy." ".$sOrderDir;

		//$page = $this->db->query($sql." LIMIT ".$post['start'].", ".$post['length']);
        
		$page = $this->db->query($sql.
				" WHERE a.tahun=".$tahun." and b.nama like '%".$filter."%' ".
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
            	'namakph'=> $value->namakph,
            	'namakawasan' => $value->namakawasan,
            	'fungsikh'=> $value->fungsikh,
            	'luas'=> $value->luas,
            	'satuan'=> $value->namasatuan,
            	'aksi' => '<ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="luaslahan/edit/'. $value->id.'">
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
