<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jasa_lingkungan extends CI_Controller {
	private $judul = "Pemanfaatan Jasa Lingkungan";

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
            redirect('jasa_lingkungan');
        }
    }

	

		


	public function index()
	{

		$list = $this->db->query("Select a.* from m_jenisgangguan a ")->result_object();		

		$data['data']	 = $list;
		$data['page']	 ='gangguan';
		$data['subpage'] ='list';
		$data['judul']	 =$this->judul;
		$data['header']	 =$this->judul;
		$this->load->view('lingkungan/index',$data);
	}	
	
	public function tambah(){
		$kab = $this->db->query("Select a.* from m_kabupaten a ")->result_object();

		$kec = $this->db->query("Select a.* from m_kecamatan a where a.kabupaten_id=".$kab[0]->id)->result_object();

		$desa = $this->db->query("Select a.* from m_desa a where a.kecamatan_id=".$kec[0]->id)->result_object();
		
		$data['page'] 	 = 'gangguan';
		$data['subpage'] ='tambah';	
		$data['kabupaten'] 	 = $kab;
		$data['kecamatan'] 	 = $kec;
		$data['desa'] 	 = $desa;	
		$data['judul']	 =$this->judul;
		$data['header']	 ='Tambah '.$this->judul;
		$this->load->view('lingkungan/index',$data);	
	}

	public function store(){

		$this->isPost();
        $this->M_jasa->input_data($_POST,'jasa_lingkungan');
		redirect(base_url().'jasa_lingkungan');
	}

	public function edit($id){
		$dat = $this->db->query("Select * from jasa_lingkungan where id='".$id."'")->row();
		
		$kab = $this->db->query("Select a.* from m_kabupaten a ")->result_object();

		$kec = $this->db->query("Select a.* from m_kecamatan a where a.kabupaten_id=".$kab[0]->id)->result_object();

		$desa = $this->db->query("Select a.* from m_desa a where a.kecamatan_id=".$kec[0]->id)->result_object();
		
		$data['page'] 	 = 'gangguan';
		$data['subpage'] ='edit';	
		$data['datae'] = $dat;	
		$data['kabupaten'] 	 = $kab;
		$data['kecamatan'] 	 = $kec;
		$data['desa'] 	 = $desa;	
		$data['judul']	 ='Jenis Gangguan Hutan';
		$data['header']	 ='Edit '.$this->judul;
		$this->load->view('lingkungan/index',$data);
	}

	public function update(){
		$this->isPost();
        $this->M_jasa->update($_POST);
		redirect(base_url().'jasa_lingkungan');
	}

	public function delete($id){
		// delete detail dasar
		$result = $this->db->delete('jasa_lingkungan', array('id' => $id));
        print_r($nip);
	 }

	 public function getdata(){

		$sql = " Select * from jasa_lingkungan";

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
				" WHERE nama_lingkungan like '%".$filter."%' ".
				" ORDER BY ".$orderBy.
				" LIMIT ".$post['start'].", ".$post['length']);
        $list = $page->result_object();

		$totalData = $totalFiltered = $query->num_rows();

        $data = array();
        $no = $post['start'];

        foreach ($list as $key => $value) {
        	$no++;                	       	

            $row = array(
            	'nama'=> $value->nama_lingkungan,
            	'perjanjian'=> $value->no_perjanjian,
            	'batas'=> $value->batas_akhir,
            	'luas'=> $value->luas,
            	'aksi' => '<ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="jasa_lingkungan/edit/'. $value->id.'">
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
