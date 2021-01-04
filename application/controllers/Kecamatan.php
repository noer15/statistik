<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kecamatan extends CI_Controller {
	private $judul = "Kecamatan ";

	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')){
			redirect(base_url().'Login');
		}
	}

	public function index()
	{

		$list = $this->db->query("Select a.* from m_kecamatan a ")->result_object();		

		$data['data']	 = $list;
		$data['page']	 ='kecamatan';
		$data['subpage'] ='list';
		$data['judul']	 =$this->judul;
		$data['header']	 =$this->judul;
		$this->load->view('kecamatan/index',$data);
	}	
	
	public function tambah(){

		$kab = $this->db->query("Select a.* from m_kabupaten a ")->result_object();
		
		$data['kabupaten'] 	 = $kab;
		$data['page'] 	 = 'kecamatan';
		$data['subpage'] ='tambah';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Tambah '.$this->judul;
		$this->load->view('kecamatan/index',$data);	
	}

	public function store(){
		$kode = $this->input->post('kode');
		$nama = $this->input->post('nama');
		$kabId = $this->input->post('kab');
		
		$post_data = array(
	      		'kode' 	=> $kode,
	        	'nama' => $nama,	        	
	        	'kabupaten_id' => $kabId
	    		);
	    $this->db->insert('m_kecamatan',$post_data);

		redirect(base_url().'Kecamatan');
	}

	public function edit($id){
		$data['data'] = $this->db->query("Select a.* from m_kecamatan a where id='".$id."'")->result_object();
		
		$kab = $this->db->query("Select a.* from m_kabupaten a ")->result_object();
		
		$data['kabupaten'] 	 = $kab;
		$data['page'] 	 = 'kecamatan';
		$data['subpage'] ='edit';		
		$data['judul']	 ='Kecamatan';
		$data['header']	 ='Edit '.$this->judul;

		$this->load->view('kecamatan/index',$data);	
	}

	public function update(){
		$id = $this->input->post('id');
		$kode = $this->input->post('kode');
		$nama = $this->input->post('nama');
		
		$post_data = array(
	      		'nama' 	=> $nama	        	
	    		);
		$this->db->where('id',$id);
	    $this->db->update('m_kecamatan',$post_data);

		redirect(base_url().'Kecamatan');
	}

	public function delete($id){
		// delete detail dasar
		$result = $this->db->delete('m_kecamatan', array('id' => $id));
        print_r($nip);
	 }

	 public function getdata(){

		$sql = " Select a.* from m_kecamatan a ";

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
								<li><a href="Kecamatan/edit/'. $value->id.'">
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
