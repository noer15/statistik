<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wilayahpenyuluh extends CI_Controller {
	private $judul = "Wilayah Kerja Penyuluh ";

	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')){
			redirect(base_url().'Login');
		}
	}

	public function index($penyuluhId)
	{
		$type = $this->input->get('t'); // 1: pns pegawai 2 : pksm

		//print($type);

		$list = $this->db->query("Select a.*, b.nama as namakecamatan from t_penyuluh_wilayah a 
			inner join m_kecamatan b on b.id=a.kecamatan_id
			where penyuluh_id='".$penyuluhId."' and type=".$type)->result_object();	
		
		if($type==2){
			$penyuluh = $this->db->query("Select a.* from t_penyuluh a where id='".$penyuluhId."'")->result_object();	
		}else
		if($type==1){
			$penyuluh = $this->db->query("Select a.* from tb_pegawai a where id='".$penyuluhId."'")->result_object();	
		}else{
			redirect(base_url().'home');	
		}

		//print_r($penyuluh);

		$data['datapenyuluh']	 = $penyuluh;
		$data['data']	 = $list;
		$data['page']	 =$type==2 ? 'penyuluh' : 'pegawai';
		$data['subpage'] ='list';
		$data['judul']	 =$this->judul;
		$data['header']	 =$this->judul;
		$this->load->view('penyuluh/wilayah/index',$data);
		
	}	
	
	public function tambah($penyuluhId){

		$type = $this->input->get('t');
		
		if($type==2){
			$penyuluh = $this->db->query("Select a.* from t_penyuluh a where id='".$penyuluhId."'")->result_object();	
		}else
		if($type==1){
			$penyuluh = $this->db->query("Select a.* from tb_pegawai a where id='".$penyuluhId."'")->result_object();	
		}else{
			redirect(base_url().'home');	
		}

		$kab = $this->db->query("Select a.* from m_kabupaten a ")->result_object();
		
		$data['penyuluh'] 	 = $penyuluh;
		$data['kab'] 	 = $kab;
		$data['page'] 	 = 'penyuluh';
		$data['subpage'] ='tambah';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Tambah '.$this->judul;
		$this->load->view('penyuluh/wilayah/index',$data);	
	}

	public function store(){
		$type = $this->input->post('type');

		$kab = $this->input->post('kab');
		$kec = $this->input->post('kec');
		$penyuluhId = $this->input->post('penyuluh');
		
		$post_data = array(
	      		'penyuluh_id' 	=> $penyuluhId,
	        	'type' => $type,
	        	'kecamatan_id' => $kec
	    		);
	    $this->db->insert('t_penyuluh_wilayah',$post_data);

		redirect(base_url().'penyuluh/wilayah/'.$penyuluhId.'?t='.$type);
	}

	public function edit($id){
		$p = $this->db->query("Select a.*, c.id as kabupaten_id from t_penyuluh_wilayah a 
			inner join m_kecamatan b on b.id=a.kecamatan_id
			inner join m_kabupaten c on c.id=b.kabupaten_id
			where a.id='".$id."'")->result_object();

		$type = $this->input->get('t');
		
		if($type==2){
			$penyuluh = $this->db->query("Select a.* from t_penyuluh a 			
								where a.id='".$p[0]->penyuluh_id."'")->result_object();	
		}else
		if($type==1){
			$penyuluh = $this->db->query("Select a.* from tb_pegawai a 			
								where a.id='".$p[0]->penyuluh_id."'")->result_object();	
		}else{
			redirect(base_url().'home');	
		}	
		

		$kab = $this->db->query("Select a.* from m_kabupaten a ")->result_object();
		$kec = $this->db->query("Select a.* from m_kecamatan a where a.kabupaten_id='".$p[0]->kabupaten_id."'")->result_object();
		
		$data['data'] = $p;
		$data['penyuluh'] 	 = $penyuluh;
		$data['kab'] 	 = $kab;
		$data['kecamatan'] 	 = $kec;
		$data['page'] 	 = 'penyuluh';
		$data['subpage'] ='edit';		
		$data['judul']	 ='penyuluh';
		$data['header']	 ='Edit '.$this->judul;
		$this->load->view('penyuluh/wilayah/index',$data);	
	}

	public function update(){
		$id = $this->input->post('id');
		$kab = $this->input->post('kab');
		$kec = $this->input->post('kec');
		$penyuluhId = $this->input->post('penyuluh');

		$type = $this->input->post('type');
		
		$post_data = array(
	      		'penyuluh_id' 	=> $penyuluhId,
	        	'kecamatan_id' => $kec
	    		);
		$this->db->where('id',$id);
	    $this->db->update('t_penyuluh_wilayah',$post_data);

		redirect(base_url().'penyuluh/wilayah/'.$penyuluhId.'?t='.$type);
	}

	public function delete($id){
		// delete detail dasar
		$result = $this->db->delete('t_penyuluh_wilayah', array('id' => $id));
        print_r($id);
	 }

	 public function getdata(){

		
		//String filter = params.get("search[value]")[0];
		$post['start'] = $this->input->get('start', TRUE); //$this->input->post('start'); BZ
		$post['length'] = $this->input->get('length');
        $iOffset = intval($post['start']) / intval($post['length']);        
        $filter = $this->input->get('search[value]');

        $penyuluhId = $this->input->get('penyuluhId');
        $type = $this->input->get('typePenyuluh');

        $sql = " Select a.*, b.nama as namakecamatan from t_penyuluh_wilayah a 
			inner join m_kecamatan b on b.id=a.kecamatan_id
			where penyuluh_id='".$penyuluhId."' and type=".$type;

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
            	'nama'=> $value->namakecamatan,
            	'aksi' => '<ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="'.base_url().'wilayahpenyuluh/edit/'. $value->id.'?t='.$type.'">
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
