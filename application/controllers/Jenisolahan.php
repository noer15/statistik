<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenisolahan extends CI_Controller {
	private $judul = "Master Jenis Olahan Hasil Hutan ";

	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')){
			redirect(base_url().'Login');
		}
	}

	public function index()
	{

		$list = $this->db->query("Select a.* from m_jenis_olahan a ")->result_object();		

		$data['data']	 = $list;
		$data['page']	 ='jenisolahan';
		$data['subpage'] ='list';
		$data['judul']	 =$this->judul;
		$data['header']	 =$this->judul;
		$this->load->view('jenisolahan/index',$data);
	}	
	
	public function tambah(){
		
		$data['page'] 	 = 'jenisolahan';
		$data['subpage'] ='tambah';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Tambah '.$this->judul;
		$this->load->view('jenisolahan/index',$data);	
	}

	public function store(){
		$nama = $this->input->post('nama');
		
		$post_data = array('nama' => $nama);
	    $this->db->insert('m_jenis_olahan',$post_data);

		redirect(base_url().'Jenisolahan');
	}

	public function edit($id){
		$data['data'] = $this->db->query("Select a.* from m_jenis_olahan a where id='".$id."'")->result_object();
		
		$data['page'] 	 = 'jenisolahan';
		$data['subpage'] ='edit';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Edit '.$this->judul;
		$this->load->view('jenisolahan/index',$data);	
	}

	public function update(){
		$nama = $this->input->post('nama');
		$id = $this->input->post('id');
		
		$post_data = array('nama' => $nama);
		$this->db->where('id',$id);
	    $this->db->update('m_jenis_olahan',$post_data);

		redirect(base_url().'Jenisolahan');
	}

	public function delete($id){
		$result = $this->db->delete('m_jenis_olahan', array('id' => $id));
	 }

	public function getdata(){

		$sql = " Select a.* from m_jenis_olahan a ";

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
								<li><a href="Jenisolahan/edit/'. $value->id.'">
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
