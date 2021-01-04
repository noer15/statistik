<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Industri extends CI_Controller {
	private $judul = "Industri Sektor Kehutanan";

	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')){
			redirect(base_url().'Login');
		}
	}

	public function index()
	{

		$list = $this->db->query("Select a.* from t_industri a ")->result_object();		

		$data['data']	 = $list;
		$data['page']	 ='industri';
		$data['subpage'] ='list';
		$data['judul']	 =$this->judul;
		$data['header']	 =$this->judul;
		$this->load->view('industri/index',$data);
	}	
	
	public function tambah(){
		
		$kab = $this->db->query("Select a.* from m_kabupaten a ")->result_object();

		$kec = $this->db->query("Select a.* from m_kecamatan a where a.kabupaten_id=".$kab[0]->id)->result_object();
		
		$data['kabupaten'] 	 = $kab;
		$data['kecamatan'] 	 = $kec;
		$data['page'] 	 = 'industri';
		$data['subpage'] ='tambah';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Tambah '.$this->judul;
		$this->load->view('industri/index',$data);	
	}

	public function store(){
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$phone = $this->input->post('phone');
		$email = $this->input->post('email');
		$kapasitas = $this->input->post('kapasitas');
		
		$kabId = $this->input->post('kab');
		$kecId = $this->input->post('kec');
		
		$post_data = array(
	      		'nama_industri' => $nama,
	      		'alamat' => $alamat,
	      		'phone' => $phone,
	      		'email' => $email,
	      		'kapasitas_izin' => $kapasitas,
				'kabupaten_id' => $kabId,
				'kecamatan_id' => $kecId
	    		);
	    $this->db->insert('t_industri',$post_data);

		redirect(base_url().'Industri');
	}

	public function edit($id){
		$dt = $this->db->query("Select a.* from t_industri a where id='".$id."'")->result_object();
		
		//$kec = $this->db->query("Select a.* from m_kecamatan a where id=".$dt[0]->kecamatan_id)->result_object();
		//$kab = $this->db->query("Select a.* from m_kabupaten a where id=".$kec[0]->kabupaten_id)->result_object();

		$kab = $this->db->query("Select a.* from m_kabupaten a ")->result_object();
		if( $dt[0]->kabupaten_id==null ){
		  $kec = $this->db->query("Select a.* from m_kecamatan a where a.kabupaten_id=".$kab[0]->id)->result_object();
		}
		else{
			$kec = $this->db->query("Select a.* from m_kecamatan a where a.kabupaten_id=".$dt[0]->kabupaten_id)->result_object();
		}
		
		$data['kabupaten'] 	 = $kab;
		$data['kecamatan'] 	 = $kec;

		$data['kabId'] 	 = $dt[0]->kabupaten_id;
		$data['kecId'] 	 = $dt[0]->kecamatan_id;	

		$data['data'] = $dt;
		$data['page'] 	 = 'industri';
		$data['subpage'] ='edit';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Edit '.$this->judul;
		$this->load->view('industri/index',$data);	
	}

	public function update(){
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$phone = $this->input->post('phone');
		$email = $this->input->post('email');
		$kapasitas = $this->input->post('kapasitas');
		
		$kabId = $this->input->post('kab');
		$kecId = $this->input->post('kec');
		
		$post_data = array(
	      		'nama_industri' => $nama,
	      		'alamat' => $alamat,
	      		'phone' => $phone,
	      		'email' => $email,
	      		'kapasitas_izin' => $kapasitas,
				'kabupaten_id' => $kabId,
				'kecamatan_id' => $kecId	        	
	    		);
		$this->db->where('id',$id);
	    $this->db->update('t_industri',$post_data);

		redirect(base_url().'Industri');
	}
	
	public function getdata(){

		$sql = " Select a.*, b.nama as namakab from t_industri a left join m_kabupaten b on b.id=a.kabupaten_id";

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
        		$orderBy="nama_industri";
        		break;
        	case '1':
        		$orderBy="alamat";
        		break;
        	case '2':
        		$orderBy="phone";
        		break;
			case '3':
        		$orderBy="kapasitas_izin";
        		break;
        		
        	default:
        		$orderBy="nama_industri";
        		break;
        }
        $orderBy = $orderBy." ".$sOrderDir;

		//$page = $this->db->query($sql." LIMIT ".$post['start'].", ".$post['length']);
        
		$page = $this->db->query($sql.
				" WHERE a.nama_industri like '%".$filter."%' ".
				" ORDER BY ".$orderBy.
				" LIMIT ".$post['start'].", ".$post['length']);
        $list = $page->result_object();

		$totalData = $totalFiltered = $query->num_rows();

        $data = array();
        $no = $post['start'];

        foreach ($list as $key => $value) {
        	$no++;                	       	

            $row = array(
            	'nama_industri'=> $value->nama_industri,
            	'alamat'=> $value->alamat,
				'namakab'=> $value->namakab,
            	'phone'=> $value->phone,
            	'kapasitas_izin'=> $value->kapasitas_izin,
            	'aksi' => '<ul class="icons-list">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icon-menu9"></i>
								</a>
								<ul class="dropdown-menu dropdown-menu-right">																		
									<li><a href="'.base_url().'Industri/edit/'. $value->id.'">
										<i class="icon-pencil5 text-primary"></i> Edit</a>
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

	public function delete($id){
		// delete detail dasar
		$result = $this->db->delete('t_industri', array('id' => $id));
        print_r($nip);
	 }

}
