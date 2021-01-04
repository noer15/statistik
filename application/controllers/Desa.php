<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Desa extends CI_Controller {
	private $judul = "Desa ";

	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')){
			redirect(base_url().'Login');
		}
	}

	public function index()
	{

		$list = $this->db->query("Select a.* from m_desa a ")->result_object();		

		$data['data']	 = $list;
		$data['page']	 ='desa';
		$data['subpage'] ='list';
		$data['judul']	 =$this->judul;
		$data['header']	 =$this->judul;
		$this->load->view('desa/index',$data);
	}	
	
	public function tambah(){

		$kab = $this->db->query("Select a.* from m_kabupaten a ")->result_object();

		$kec = $this->db->query("Select a.* from m_kecamatan a where a.kabupaten_id=".$kab[0]->id)->result_object();
		
		$data['kabupaten'] 	 = $kab;
		$data['kecamatan'] 	 = $kec;
		$data['page'] 	 = 'desa';
		$data['subpage'] ='tambah';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Tambah '.$this->judul;
		$this->load->view('desa/index',$data);	
	}

	public function store(){
		$kode = $this->input->post('kode');
		$nama = $this->input->post('nama');
		$kecId = $this->input->post('kec');
		
		$post_data = array(
	      		'kode' 	=> $kode,
	        	'nama' => $nama,	        	
	        	'kecamatan_id' => $kecId
	    		);
	    $this->db->insert('m_desa',$post_data);

		redirect(base_url().'Desa');
	}

	public function edit($id){
		$dt = $this->db->query("Select a.* from m_desa a where id='".$id."'")->result_object();
		
		$kec = $this->db->query("Select a.* from m_kecamatan a where id=".$dt[0]->kecamatan_id)->result_object();
		$kab = $this->db->query("Select a.* from m_kabupaten a where id=".$kec[0]->kabupaten_id)->result_object();
		
		$data['data'] = $dt;
		$data['kabupaten'] 	 = $kab;
		$data['kecamatan'] 	 = $kec;
		$data['page'] 	 = 'desa';
		$data['subpage'] ='edit';		
		$data['judul']	 ='Desa';
		$data['header']	 ='Edit '.$this->judul;
		$this->load->view('desa/index',$data);	
	}

	public function update(){
		$id = $this->input->post('id');
		$kode = $this->input->post('kode');
		$nama = $this->input->post('nama');
		
		$post_data = array(
	      		'nama' 	=> $nama	        	
	    		);
		$this->db->where('id',$id);
	    $this->db->update('m_desa',$post_data);

		redirect(base_url().'Desa');
	}

	public function delete($id){
		// delete detail dasar
		$result = $this->db->delete('m_desa', array('id' => $id));
        print_r($nip);
	 }

	 public function getdata(){

		$sql = " Select a.* from m_desa a ";

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
        		$orderBy="kode";
        		break;
        	case '1':
        		$orderBy="nama";
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
            	'kode'=> $value->kode,
            	'nama'=> $value->nama,
            	'aksi' => '<ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="Desa/edit/'. $value->id.'">
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

	public function getKecamatan($kabId){
	  	$kec	= $this->db->query("select * from m_kecamatan where kabupaten_id=".$kabId)->result_array();
	  	print_r( json_encode($kec) );
	}

	public function getDesa($kecId){
	  	$desa	= $this->db->query("select * from m_desa where kecamatan_id=".$kecId)->result_array();
	  	print_r( json_encode($desa) );
	}


}
