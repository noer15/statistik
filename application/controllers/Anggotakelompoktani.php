<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggotakelompoktani extends CI_Controller {
	private $judul = "Anggota Kelompok Tani ";

	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')){
			redirect(base_url().'Login');
		}
	}

	public function index($kelompokId)
	{
		$kelompok = $this->db->query("Select a.* from kelompok_tani a where id=".$kelompokId)->result_object();

		$list = $this->db->query("Select a.*, b.nama as namajabatan from anggota_kelompok_tani a inner join m_jabatan_kelompok b on b.id=a.jabatan 
			where kelompok_id="
			.$kelompokId)->result_object();		


		$data['data']	 = $list;
		$data['kelompok'] 	 = $kelompok;		
		$data['page']	 ='kelompok_tani';
		$data['subpage'] ='list';
		$data['judul']	 =$this->judul;
		$data['header']	 =$this->judul;
		$this->load->view('kelompoktani/anggota/index',$data);
	}	
	
	public function tambah($kelompokId){

		$kelompok = $this->db->query("Select a.* from kelompok_tani a where id=".$kelompokId)->result_object();
		$pend = $this->db->query("Select a.* from m_pendidikan a ")->result_object();
		$jabatan = $this->db->query("Select a.* from m_jabatan_kelompok a ")->result_object();

		$data['kelompok'] 	 = $kelompok;
		$data['pend'] 	 = $pend;
		$data['jabatan'] 	 = $jabatan;
		$data['page'] 	 = 'kelompok_tani';
		$data['subpage'] ='tambah';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Tambah '.$this->judul;
		$this->load->view('kelompoktani/anggota/index',$data);	
	}

	public function store(){
		$nik = $this->input->post('nik');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$umur = $this->input->post('umur');
		$jk = $this->input->post('jk');
		$pendidikan = $this->input->post('pendidikan');
		$jabatan = $this->input->post('jabatan');
		$kelompokId = $this->input->post('kelompokId');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$dt =explode("/", $tgl_lahir);
		$tgl = $dt[2]."-".$dt[1]."-".$dt[0];		
		
		$post_data = array(
	      		'nik' 	=> $nik,
	      		'nama' 	=> $nama,
	        	'alamat' => $alamat,	        	
	        	'tgl_lahir' => $tgl,	  
	        	'umur' => $umur,	  
	        	'jk' => $jk,	  
	        	'pendidikan' => $pendidikan,	  
	        	'jabatan' => $jabatan,	  
	        	'kelompok_id' => $kelompokId
	    		);
	    $this->db->insert('anggota_kelompok_tani',$post_data);

		redirect(base_url().'Anggotakelompoktani/index/'.$kelompokId);
		
	}

	public function edit($id){
		$dt = $this->db->query("Select a.* from anggota_kelompok_tani a where id='".$id."'")->result_object();		

		$kelompok = $this->db->query("Select a.* from kelompok_tani a where id=".$dt[0]->kelompok_id)->result_object();
		$pend = $this->db->query("Select a.* from m_pendidikan a ")->result_object();
		$jabatan = $this->db->query("Select a.* from m_jabatan_kelompok a ")->result_object();
		
		$data['data'] = $dt;
		$data['kelompok'] = $kelompok;
		$data['pend'] 	 = $pend;
		$data['jabatan'] 	 = $jabatan;		
		$data['page'] 	 = 'kelompok_tani';
		$data['subpage'] ='edit';		
		$data['judul']	 ='Anggota Kelompok Tani';
		$data['header']	 ='Edit '.$this->judul;
		$this->load->view('kelompoktani/anggota/index',$data);	
	}

	public function update(){
		$id = $this->input->post('id');
		$nik = $this->input->post('nik');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$umur = $this->input->post('umur');
		$jk = $this->input->post('jk');
		$pendidikan = $this->input->post('pendidikan');
		$jabatan = $this->input->post('jabatan');
		$kelompokId = $this->input->post('kelompokId');
		
		$post_data = array(
				'nik' 	=> $nik,
	      		'nama' 	=> $nama,
	        	'alamat' => $alamat,	        	
	        	'umur' => $umur,	  
	        	'jk' => $jk,	  
	        	'pendidikan' => $pendidikan,	  
	        	'jabatan' => $jabatan	  	        	
	    		);
		$this->db->where('id',$id);
	    $this->db->update('anggota_kelompok_tani',$post_data);

		redirect(base_url().'Anggotakelompoktani/index/'.$kelompokId);
	}

	public function delete($id){
		// delete detail dasar
		$result = $this->db->delete('anggota_kelompok_tani', array('id' => $id));
        print_r($nip);
	 }


	 public function getdata(){

		
		//String filter = params.get("search[value]")[0];
		$post['start'] = $this->input->get('start', TRUE); //$this->input->post('start'); BZ
		$post['length'] = $this->input->get('length');
        $iOffset = intval($post['start']) / intval($post['length']);        
        $filter = $this->input->get('search[value]');

        $kelompok_id = $this->input->get('kelompok_id');

        $sql = "Select a.*, b.nama as namajabatan from anggota_kelompok_tani a inner join m_jabatan_kelompok b on b.id=a.jabatan 
			where kelompok_id=".$kelompok_id;		

		$query = $this->db->query($sql);


		$post['draw'] = $this->input->post('draw');        
        $iOrderColumn = $this->input->get("order[0][column]");
        $sOrderDir = $this->input->get("order[0][dir]");
        $orderBy="";
        switch ($iOrderColumn) {
        	case '1':
        		$orderBy="Nama";
        		break;
        	case '2':
        		$orderBy="alamat";
        		break;

        	default:
        		$orderBy="nama";
        		break;
        }
        $orderBy = $orderBy." ".$sOrderDir;

		//$page = $this->db->query($sql." LIMIT ".$post['start'].", ".$post['length']);		

		$page = $this->db->query($sql.
				" and ".
				" ( a.nama like '%".$filter."%' ".
				" OR a.alamat like '%".$filter."%' ".
				" ) ". 
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
            	'alamat'=> $value->alamat,
            	'jabatan'=> $value->namajabatan,
            	'aksi' => '<ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">								
								<li><a href="'.base_url().'Anggotakelompoktani/edit/'.$value->id.'">
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
