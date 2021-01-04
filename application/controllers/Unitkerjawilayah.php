<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unitkerjawilayah extends CI_Controller {
	private $judul = "Wilayah Unit Kerja ";

	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')){
			redirect(base_url().'Login');
		}
	}

	public function index($uk)
	{
		$type = $this->input->get('t'); // 1: pns pegawai 2 : pksm

		//print($type);

		$list = $this->db->query("Select a.*, b.nama as namakab from m_unit_kerja_wilayah a 
			inner join m_kabupaten b on b.id=a.kabupaten_id
			where unit_kerja_id=".$uk)->result_object();	
		
		$unitkerja = $this->db->query("Select a.* from m_unit_kerja a where id='".$uk."'")->result_object();	
		
		$data['datauk']	 = $unitkerja;
		$data['data']	 = $list;
		$data['page']	 ='masteruk';
		$data['subpage'] ='list';
		$data['judul']	 =$this->judul;
		$data['header']	 =$this->judul;
		$this->load->view('unitkerja/wilayah/index',$data);
		
	}	
	
	public function tambah($uk){

		
		$unitkerja = $this->db->query("Select a.* from m_unit_kerja a where id='".$uk."'")->result_object();	
		
		$kab = $this->db->query("Select a.* from m_kabupaten a ")->result_object();
		
		$data['unitkerja'] 	 = $unitkerja;
		$data['kab'] 	 = $kab;
		$data['page'] 	 = 'masteruk';
		$data['subpage'] ='tambah';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Tambah '.$this->judul;
		$this->load->view('unitkerja/wilayah/index',$data);	
	}

	public function store(){
		try {
		
			$kab = $this->input->post('kab');
			$unit_kerja_id = $this->input->post('unit_kerja_id');
			
			$post_data = array(
		      		'unit_kerja_id' 	=> $unit_kerja_id,
		        	'kabupaten_id' => $kab
		    		);
		    $this->db->insert('m_unit_kerja_wilayah',$post_data);

			redirect(base_url().'unitkerja/wilayah/'.$unit_kerja_id);

		} catch (Exception $e) {
			redirect(base_url().'unitkerja/wilayah/'.$unit_kerja_id);		  	
		}
	}

	public function edit($id){
		$p = $this->db->query("Select a.*, b.id as kabupaten_id from m_unit_kerja_wilayah a 
			inner join m_kabupaten b on b.id=a.kabupaten_id
			where a.id='".$id."'")->result_object();

		$unitkerja = $this->db->query("Select a.* from m_unit_kerja a 			
								where a.id='".$p[0]->unit_kerja_id."'")->result_object();			

		$kab = $this->db->query("Select a.* from m_kabupaten a ")->result_object();
		
		$data['data'] = $p;
		$data['unitkerja'] 	 = $unitkerja;
		$data['kab'] 	 = $kab;
		$data['page'] 	 = 'masteruk';
		$data['subpage'] ='edit';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Edit '.$this->judul;
		$this->load->view('unitkerja/wilayah/index',$data);	
	}

	public function update(){
		$id = $this->input->post('id');
		$kab = $this->input->post('kab');
		$unit_kerja_id = $this->input->post('unit_kerja_id');

		$post_data = array(
	      		'unit_kerja_id' => $unit_kerja_id,
	        	'kabupaten_id' => $kab
	    		);
		$this->db->where('id',$id);
	    $this->db->update('m_unit_kerja_wilayah',$post_data);

		redirect(base_url().'unitkerja/wilayah/'.$unit_kerja_id);
	}

	public function delete($id){
		// delete detail dasar
		$result = $this->db->delete('m_unit_kerja_wilayah', array('id' => $id));
        print_r($id);
	 }

	 public function getdata(){

		
		//String filter = params.get("search[value]")[0];
		$post['start'] = $this->input->get('start', TRUE); //$this->input->post('start'); BZ
		$post['length'] = $this->input->get('length');
        $iOffset = intval($post['start']) / intval($post['length']);        
        $filter = $this->input->get('search[value]');

        $uk = $this->input->get('unitkerjaId');

        $sql = " Select a.*, b.nama as namakab from m_unit_kerja_wilayah a 
			inner join m_kabupaten b on b.id=a.kabupaten_id
			where unit_kerja_id=".$uk;

		$query = $this->db->query($sql);


		$post['draw'] = $this->input->post('draw');        
        $iOrderColumn = $this->input->get("order[0][column]");
        $sOrderDir = $this->input->get("order[0][dir]");
        $orderBy="";
        switch ($iOrderColumn) {
        	case '0':
        		$orderBy="nama";
        		
        	default:
        		$orderBy="nama";
        		break;
        }
        $orderBy = $orderBy." ".$sOrderDir;

		//$page = $this->db->query($sql." LIMIT ".$post['start'].", ".$post['length']);
        
		$page = $this->db->query($sql.
				" and b.nama like '%".$filter."%' ".
				" ORDER BY ".$orderBy.
				" LIMIT ".$post['start'].", ".$post['length']);
        $list = $page->result_object();

		$totalData = $totalFiltered = $query->num_rows();

        $data = array();
        $no = $post['start'];

        foreach ($list as $key => $value) {
        	$no++;                	       	

            $row = array(
            	'kode'=> $no,
            	'nama'=> $value->namakab,
            	'aksi' => '<ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="'.base_url().'Unitkerjawilayah/edit/'. $value->id.'">
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
