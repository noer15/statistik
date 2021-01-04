<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengukuhankh extends CI_Controller {
	private $judul = "Data Pengukuhan Kawasan Hutan ";
	
	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')){
			redirect(base_url().'Login');
		}
	}

	public function index()
	{

		$data['page']	 = 'pengukuhankh';
		$data['subpage'] ='list';
		$data['judul']	 =$this->judul;
		$data['header']	 =$this->judul;
		$this->load->view('pengukuhan/index',$data);
	}	
	
	public function tambah(){

		$kawasan = $this->db->query("Select a.* from m_kawasan_hutan a ")->result_object();
		$satuan = $this->db->query("Select a.* from m_satuan a")->result_object();
		
		$data['satuan'] 	 = $satuan;		
		$data['kawasan'] 	 = $kawasan;
		$data['page'] 	 = 'pengukuhankh';
		$data['subpage'] ='tambah';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Tambah '.$this->judul;
		$this->load->view('pengukuhan/index',$data);	
	}

	public function store(){
		$kawasan = $this->input->post('kawasan');
		$penunjukan_no  	 =  $this->input->post('penunjukan_no');
    	$penunjukan_date	 =  $this->input->post('penunjukan_date');
    	$penunjukan_pilihan =  $this->input->post('penunjukan_pilihan');
    	$penunjukan_panjang =  $this->input->post('penunjukan_panjang');
    	$penunjukan_satuan_panjang =  $this->input->post('penunjukan_satuan_panjang');
    	$penunjukan_luas		 =  $this->input->post('penunjukan_luas');
    	$penunjukan_satuan_luas =  $this->input->post('penunjukan_satuan_luas');

    	$batb_no  	 =  $this->input->post('batb_no');
    	$batb_date	 =  $this->input->post('batb_date');
    	$batb_pilihan =  $this->input->post('batb_pilihan');
    	$batb_panjang =  $this->input->post('batb_panjang');
    	$batb_satuan_panjang =  $this->input->post('batb_satuan_panjang');
    	$batb_luas		 =  $this->input->post('batb_luas');
    	$batb_satuan_luas =  $this->input->post('batb_satuan_luas');

    	$tetap_no  	 =  $this->input->post('tetap_no');
    	$tetap_date	 =  $this->input->post('tetap_date');
    	$tetap_pilihan =  $this->input->post('tetap_pilihan');
    	$tetap_panjang =  $this->input->post('tetap_panjang');
    	$tetap_satuan_panjang =  $this->input->post('tetap_satuan_panjang');
    	$tetap_luas		 =  $this->input->post('tetap_luas');
    	$tetap_satuan_luas =  $this->input->post('tetap_satuan_luas');

		$post_data = array(
	      		'kawasan_id' 	=> $kawasan,
	      		'penunjukan_no'  	 => $penunjukan_no,
	        	'penunjukan_date'	 => $penunjukan_date,	        	
	        	'penunjukan_pilihan' => $penunjukan_pilihan,	  
	        	'penunjukan_panjang' => $penunjukan_panjang,
	        	'penunjukan_satuan_panjang' => $penunjukan_satuan_panjang,
	        	'penunjukan_luas'		 => $penunjukan_luas,
	        	'penunjukan_satuan_luas' => $penunjukan_satuan_luas,

	        	'batb_no'  	 => $batb_no,
	        	'batb_date'	 => $batb_date,	        	
	        	'batb_pilihan' => $batb_pilihan,	  
	        	'batb_panjang' => $batb_panjang,
	        	'batb_satuan_panjang' => $batb_satuan_panjang,
	        	'batb_luas'		 => $batb_luas,
	        	'batb_satuan_luas' => $batb_satuan_luas,

	        	'tetap_no'  	 => $tetap_no,
	        	'tetap_date'	 => $tetap_date,	        	
	        	'tetap_pilihan' => $tetap_pilihan,	  
	        	'tetap_panjang' => $tetap_panjang,
	        	'tetap_satuan_panjang' => $tetap_satuan_panjang,
	        	'tetap_luas'		 => $tetap_luas,
	        	'tetap_satuan_luas' => $tetap_satuan_luas

	    		);
	    $this->db->insert('t_pengukuhan_kawasanhutan',$post_data);

		redirect(base_url().'Pengukuhankh');
	}

	public function edit($id){
		$dt = $this->db->query("Select a.* from t_pengukuhan_kawasanhutan a where id='".$id."'")->result_object();
		
		$kawasan = $this->db->query("Select a.* from m_kawasan_hutan a ")->result_object();
		
		$satuan = $this->db->query("Select a.* from m_satuan a")->result_object();
		
		$data['satuan'] 	 = $satuan;
		$data['kawasan'] 	 = $kawasan;		
		$data['data'] = $dt;
		$data['page'] 	 = 'pengukuhankh';
		$data['subpage'] ='edit';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Edit '.$this->judul;
		$this->load->view('pengukuhan/index',$data);	
	}

	public function update(){
		$id = $this->input->post('id');
		$kawasan = $this->input->post('kawasan');
		$penunjukan_no  	 =  $this->input->post('penunjukan_no');
    	$penunjukan_date	 =  $this->input->post('penunjukan_date');
    	$penunjukan_pilihan =  $this->input->post('penunjukan_pilihan');
    	$penunjukan_panjang =  $this->input->post('penunjukan_panjang');
    	$penunjukan_satuan_panjang =  $this->input->post('penunjukan_satuan_panjang');
    	$penunjukan_luas		 =  $this->input->post('penunjukan_luas');
    	$penunjukan_satuan_luas =  $this->input->post('penunjukan_satuan_luas');

    	$batb_no  	 =  $this->input->post('batb_no');
    	$batb_date	 =  $this->input->post('batb_date');
    	$batb_pilihan =  $this->input->post('batb_pilihan');
    	$batb_panjang =  $this->input->post('batb_panjang');
    	$batb_satuan_panjang =  $this->input->post('batb_satuan_panjang');
    	$batb_luas		 =  $this->input->post('batb_luas');
    	$batb_satuan_luas =  $this->input->post('batb_satuan_luas');

    	$tetap_no  	 =  $this->input->post('tetap_no');
    	$tetap_date	 =  $this->input->post('tetap_date');
    	$tetap_pilihan =  $this->input->post('tetap_pilihan');
    	$tetap_panjang =  $this->input->post('tetap_panjang');
    	$tetap_satuan_panjang =  $this->input->post('tetap_satuan_panjang');
    	$tetap_luas		 =  $this->input->post('tetap_luas');
    	$tetap_satuan_luas =  $this->input->post('tetap_satuan_luas');

		$post_data = array(
	      		'kawasan_id' 	=> $kawasan,
	      		'penunjukan_no'  	 => $penunjukan_no,
	        	'penunjukan_date'	 => $penunjukan_date,	        	
	        	'penunjukan_pilihan' => $penunjukan_pilihan,	  
	        	'penunjukan_panjang' => $penunjukan_panjang,
	        	'penunjukan_satuan_panjang' => $penunjukan_satuan_panjang,
	        	'penunjukan_luas'		 => $penunjukan_luas,
	        	'penunjukan_satuan_luas' => $penunjukan_satuan_luas,

	        	'batb_no'  	 => $batb_no,
	        	'batb_date'	 => $batb_date,	        	
	        	'batb_pilihan' => $batb_pilihan,	  
	        	'batb_panjang' => $batb_panjang,
	        	'batb_satuan_panjang' => $batb_satuan_panjang,
	        	'batb_luas'		 => $batb_luas,
	        	'batb_satuan_luas' => $batb_satuan_luas,

	        	'tetap_no'  	 => $tetap_no,
	        	'tetap_date'	 => $tetap_date,	        	
	        	'tetap_pilihan' => $tetap_pilihan,	  
	        	'tetap_panjang' => $tetap_panjang,
	        	'tetap_satuan_panjang' => $tetap_satuan_panjang,
	        	'tetap_luas'		 => $tetap_luas,
	        	'tetap_satuan_luas' => $tetap_satuan_luas

	    		);
		$this->db->where('id',$id);
	    $this->db->update('t_pengukuhan_kawasanhutan',$post_data);

		redirect(base_url().'pengukuhankh');
	}

	public function delete($id){
		// delete detail dasar
		$result = $this->db->delete('t_pengukuhan_kawasanhutan', array('id' => $id));
        //print_r($nip);
	}


	 public function getdata(){

		$sql = " Select a.*, b.nama as namakawasan from t_pengukuhan_kawasanhutan a
				inner join m_kawasan_hutan b on b.id=a.kawasan_id";

		$query = $this->db->query($sql);

		//String filter = params.get("search[value]")[0];
		$post['start'] = $this->input->get('start', TRUE); //$this->input->post('start'); BZ
		$post['length'] = $this->input->get('length');
        $iOffset = intval($post['start']) / intval($post['length']);        
        $filter = $this->input->get('search[value]');

        //$tahun = $this->input->get('tahun');

		$post['draw'] = $this->input->post('draw');        
        $iOrderColumn = $this->input->get("order[0][column]");
        $sOrderDir = $this->input->get("order[0][dir]");
        $orderBy="";
        switch ($iOrderColumn) {
        	case '0':
        		$orderBy="kawasan_id";
        		break;
        		
        	default:
        		$orderBy="kawasan_id";
        		break;
        }
        $orderBy = $orderBy." ".$sOrderDir;

		//$page = $this->db->query($sql." LIMIT ".$post['start'].", ".$post['length']);
        
		$page = $this->db->query($sql.
				" WHERE b.nama like '%".$filter."%' ".
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
            	'namakawasan'=> $value->namakawasan,
            	'penunjukan'=> $value->penunjukan_no,
            	'batb'=> $value->batb_no,
            	'penetapan'=> $value->tetap_no,
            	'aksi' => '<ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="pengukuhankh/edit/'. $value->id.'">
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
