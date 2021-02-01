<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produksiolahan extends CI_Controller {
	private $judul = "Produksi Olahan Hasil Hutan";

	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')){
			redirect(base_url().'Login');
		}
	}

	public function index()
	{
		$data['data']	 = $this->db->query('SELECT a.*, b.nama_industri as perusahaan, c.nama as jenis_olahan
							FROM produksi_olahan a INNER JOIN t_industri b ON a.industri_id = b.id
							INNER JOIN m_jenis_olahan c ON a.jenis_olahan_id = c.id')->result_object();	;
		$data['page']	 ='produksiolahan';
		$data['subpage'] ='list';
		$data['judul']	 =$this->judul;
		$data['header']	 =$this->judul;
		$this->load->view('produksiolahan/index',$data);
	}	
	
	public function tambah(){
		$data['list']	 = $this->db->query('SELECT a.*, b.nama_industri as perusahaan, c.nama as jenis_olahan
							FROM produksi_olahan a INNER JOIN t_industri b ON a.industri_id = b.id
							INNER JOIN m_jenis_olahan c ON a.jenis_olahan_id = c.id WHERE tanggal = "'.date('Y-m-d').'"')->result_object();
		$data['page'] 	 = 'produksiolahan';
		$data['subpage'] ='tambah';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Tambah '.$this->judul;
		$this->load->view('produksiolahan/index',$data);	
	}

	public function store(){
		$_POST['tanggal'] = date('y-m-d');
	    $this->db->insert('produksi_olahan',$_POST);
		redirect(base_url().'Produksiolahan/tambah');
	}

	public function edit($id){

		$data['data'] = $this->db->query("Select a.* from produksi_olahan a where id='".$id."'")->result_object();
		$data['page'] 	 = 'produksiolahan';
		$data['subpage'] ='edit';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Edit '.$this->judul;
		$this->load->view('produksiolahan/index',$data);	
	}

	public function update(){
		$id = $this->input->post('id');
		$this->db->where('id',$id);
	    $this->db->update('produksi_olahan',$_POST);

		redirect(base_url().'Produksiolahan');
	}

	public function delete($id){
		$result = $this->db->delete('produksi_olahan', array('id' => $id));
	 }

	public function getdata(){

		$sql = " Select a.* from produksi_olahan a ";

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
            	'no'=> $no,
            	'nama'=> $value->nama, 
            	'aksi' => '<ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="Produksiolahan/edit/'. $value->id.'">
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
