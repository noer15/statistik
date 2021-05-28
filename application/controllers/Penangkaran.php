<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penangkaran extends CI_Controller {
	private $judul = "Data Penangkaran Tumbuhan dan Satwa Liar";
	
	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')){
			redirect(base_url().'Login');
		}
	}

	public function index()
	{

		$list = $this->db->query("Select * from penangkaran")->result_object();		

		$data['tahun']	 = date("Y");
		$data['data']	 = $list;
		$data['page']	 = 'datagangguan';
		$data['subpage'] ='list';
		$data['judul']	 =$this->judul;
		$data['header']	 =$this->judul;
		$this->load->view('penangkaran/index',$data);
	}	
	
	public function tambah(){
		$data['tahun']	 = date("Y");
		$data['page'] 	 = 'datagangguan';
		$data['subpage'] ='tambah';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Tambah '.$this->judul;
		$this->load->view('penangkaran/index',$data);	
	}

	public function store(){
		$nama = $this->input->post('nama');
		$no_tlp = $this->input->post('no_tlp');
		$kordinat = $this->input->post('kordinat');
		$no_tanggal = $this->input->post('no_tanggal');
		$masa_berlaku = $this->input->post('masa_berlaku');
		$daerah = $this->input->post('daerah');
		$nama_ilmiah = $this->input->post('nama_ilmiah');
		$indukan = $this->input->post('indukan');
		$bulan_lalu = $this->input->post('bulan_lalu');
		$bulan= $this->input->post('bulan_sekarang');
		$sampai_bulan_ini = $this->input->post('sampai_bulan_ini');
		$investasi = $this->input->post('investasi');
		$tenaga_kerja = $this->input->post('tenaga_kerja');
		
		
		$post_data = array(
	      		'nama' 	=> $nama,
	      		'no_tlp' 	=> $no_tlp,
	      		'kordinat' 	=> $kordinat,
	      		'no_tanggal' 	=> $no_tanggal,
	        	'masa_berlaku' => $masa_berlaku,	        	
	        	'daerah' => $daerah,	  
	        	'nama_ilmiah' => $nama_ilmiah,
	        	'indukan' => $indukan,
	        	'bulan_lalu' => $bulan_lalu,
	        	'bulan_sekarang' => $bulan,
	        	'sampai_bulan_ini' => $sampai_bulan_ini,
	        	'investasi' => $investasi,
	        	'tenaga_kerja' => $tenaga_kerja
	    		);
	    $this->db->insert('penangkaran',$post_data);

		redirect(base_url().'Penangkaran');
	}

	public function edit($id){
		$dt = $this->db->query("Select a.* from penangkaran a where id='".$id."'")->row();
		
		$data['tahun']	 = date("Y");		
		$data['data'] = $dt;
		$data['page'] 	 = 'datagangguan';
		$data['subpage'] ='edit';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Edit '.$this->judul;
		$this->load->view('penangkaran/index',$data);	
	}

	public function update(){
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$no_tlp = $this->input->post('no_tlp');
		$kordinat = $this->input->post('kordinat');
		$no_tanggal = $this->input->post('no_tanggal');
		$masa_berlaku = $this->input->post('masa_berlaku');
		$daerah = $this->input->post('daerah');
		$nama_ilmiah = $this->input->post('nama_ilmiah');
		$indukan = $this->input->post('indukan');
		$bulan_lalu = $this->input->post('bulan_lalu');
		$bulan= $this->input->post('bulan_sekarang');
		$sampai_bulan_ini = $this->input->post('sampai_bulan_ini');
		$investasi = $this->input->post('investasi');
		$tenaga_kerja = $this->input->post('tenaga_kerja');

		$post_data = array(
			'nama' 	=> $nama,
			'no_tlp' 	=> $no_tlp,
			'kordinat' 	=> $kordinat,
			'no_tanggal' 	=> $no_tanggal,
			'masa_berlaku' => $masa_berlaku,	        	
			'daerah' => $daerah,	  
			'nama_ilmiah' => $nama_ilmiah,
			'indukan' => $indukan,
			'bulan_lalu' => $bulan_lalu,
			'bulan_sekarang' => $bulan,
			'sampai_bulan_ini' => $sampai_bulan_ini,
			'investasi' => $investasi,
			'tenaga_kerja' => $tenaga_kerja
		);
		$this->db->where('id',$id);
	    $this->db->update('penangkaran',$post_data);

		redirect(base_url().'Penangkaran');
	}

	public function delete($id){
		// delete detail dasar
		$result = $this->db->delete('penangkaran', array('id' => $id));
        print_r($nip);
	}


	 public function getdata(){

		$sql = " Select * from penangkaran";

		$query = $this->db->query($sql);

		//String filter = params.get("search[value]")[0];
		$post['start'] = $this->input->get('start', TRUE); //$this->input->post('start'); BZ
		$post['length'] = $this->input->get('length');
        $iOffset = intval($post['start']) / intval($post['length']);        
        $filter = $this->input->get('search[value]');


		$post['draw'] = $this->input->post('draw');        
        $iOrderColumn = $this->input->get("order[0][column]");
        $sOrderDir = $this->input->get("order[0][dir]");
        $orderBy="";
        switch ($iOrderColumn) {
        	case '0':
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

        foreach ($list as $value) {
        	$no++;                	       	

            $row = array(
            	'nama'=> $value->nama,
            	'daerah'=> $value->daerah,
            	'aksi' => '<ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="Penangkaran/edit/'. $value->id.'">
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
