<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Benih extends CI_Controller {
	private $judul = "Sumber Benih";

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_jasa');
		if (!$this->session->userdata('username')){
			redirect(base_url().'Login');
		}
	}

	private function isPost()
    {
        if(!$_POST){
            redirect('benih');
        }
    }

	

		


	public function index()
	{

		$list = $this->db->query("Select a.* from benih a ")->result_object();		

		$data['data']	 = $list;
		$data['page']	 ='gangguan';
		$data['subpage'] ='list';
		$data['judul']	 =$this->judul;
		$data['header']	 =$this->judul;
		$this->load->view('benih/index',$data);
	}	
	
	public function tambah(){
		$kab = $this->db->query("Select a.* from m_kabupaten a ")->result_object();

		$data['page'] 	 = 'gangguan';
		$data['subpage'] ='tambah';	
		$data['kabupaten'] 	 = $kab;
		$data['judul']	 =$this->judul;
		$data['header']	 ='Tambah '.$this->judul;
		$this->load->view('benih/index',$data);	
	}

	public function store(){

		$this->isPost();
        $this->M_jasa->input_benih($_POST,'benih');
		redirect(base_url().'benih');
	}

	public function edit($id){
		$dat = $this->db->query("SELECT benih.*,  m_kabupaten.nama FROM benih INNER JOIN m_kabupaten ON benih.id_kab = m_kabupaten.id where benih.id='".$id."'")->row();
		$kab = $this->db->query("Select a.* from m_kabupaten a ")->result_object();
		$data['page'] 	 = 'gangguan';
		$data['subpage'] ='edit';	
		$data['data'] = $dat;		
		$data['kab'] = $kab;		
		$data['judul']	 ='Jenis Gangguan Hutan';
		$data['header']	 ='Edit '.$this->judul;
		$this->load->view('benih/index',$data);
	}

	public function update(){
		$this->isPost();
        $this->M_jasa->update_benih($_POST);
		redirect(base_url().'benih');
	}

	public function delete($id){
		// delete detail dasar
		$result = $this->db->delete('benih', array('id' => $id));
        print_r($nip);
	 }

	 public function getdata(){

		$sql = " SELECT benih.*,  m_kabupaten.nama FROM benih INNER JOIN m_kabupaten ON benih.id_kab = m_kabupaten.id";

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
        		$orderBy="id";
        		break;
        		
        	default:
        		$orderBy="id";
        		break;
        }
        $orderBy = $orderBy." ".$sOrderDir;

		//$page = $this->db->query($sql." LIMIT ".$post['start'].", ".$post['length']);
        
		$page = $this->db->query($sql.
				" WHERE nama like '%".$filter."%' ".
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
            	'nama'=> $value->nama,
            	'tbt'=> $value->tbt,
            	'tbs'=> $value->tbs,
            	'apb'=> $value->apb,
            	'tbp'=> $value->tbp,
            	'kbs'=> $value->kbs,
            	'kbk'=> $value->kbk,
            	'kp'=> $value->kp,
            	'aksi' => '<ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="benih/edit/'. $value->id.'">
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