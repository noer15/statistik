<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Potensi extends CI_Controller {
	private $judul = "Potensi Hasil Lahan ";

	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')){
			redirect(base_url().'Login');
		}
	}

	public function index($pId)
	{
		$pemilik = $this->db->query("Select a.* from pemilik_lahan a where id=".$pId)->result_object();

		$list = $this->db->query("Select a.* from potensi_pemilik_lahan a where a.pemilik_lahan_id=".$pId)->result_object();		


		$data['data']	 = $list;
		$data['pemilik'] 	 = $pemilik;		
		$data['page']	 ='pemiliklahan';
		$data['subpage'] ='list';
		$data['judul']	 =$this->judul;
		$data['header']	 =$this->judul;
		$this->load->view('pemiliklahan/potensi/index',$data);
	}	
	
	public function tambah($pId){

		$potensi = $this->input->get('p');
		$diameter = $this->input->get('d');

		$pemilik = $this->db->query("Select a.* from pemilik_lahan a where id=".$pId)->result_object();
		$jenis = $this->db->query("Select a.* from m_jenis_potensi a where jenis=2")->result_object();
		$satuan = $this->db->query("Select a.* from m_satuan a")->result_object();
		
		$data['satuan'] 	 = $satuan;
		$data['pemilik'] 	 = $pemilik;
		$data['jenis'] 	 = $jenis;
		$data['page'] 	 = 'pemiliklahan';
		$data['subpage'] ='tambah';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Tambah '.$this->judul;
		$this->load->view('pemiliklahan/potensi/index',$data);	
	}

	public function store(){
		$type_jenis = $this->input->post('type_jenis');

		$jenis = $this->input->post('jenis');
		$pemilikId = $this->input->post('pemilikId');

		// if ($type_jenis==1){
			$type_diameter = $this->input->post('type_diameter');	
			$tahun_tanam = $this->input->post('tahun_tanam');		
			$diameter = $this->input->post('diameter');		
			$jml_pohon = $this->input->post('jml_pohon');
			$tinggi_pohon = $this->input->post('tinggi_pohon');
			
		// }else{
			$tahun = $this->input->post('tahun');
			$jml_budidaya = $this->input->post('jml_budidaya');
			$jml_produksi = $this->input->post('jml_produksi');
		// }

			$satuan_diameter = $this->input->post('satuan_diameter');
			$satuan_jml_pohon = $this->input->post('satuan_jml_pohon');
			$satuan_tinggi_pohon = $this->input->post('satuan_tinggi_pohon');
			$satuan_budidaya = $this->input->post('satuan_budidaya');
			$satuan_produksi = $this->input->post('satuan_produksi');
		
		$post_data = array(
	      		'type_jenis' => $type_jenis,
	      		'type_diameter' => $type_diameter,
	      		'jenis_potensi' => $jenis,
	      		'diameter' 	=> $diameter,
	      		'jml_pohon' 	=> $jml_pohon,
	      		'tahun_tanam' 	=> $tahun_tanam,
	      		'tinggi_pohon' 	=> $tinggi_pohon,
	      		'tahun' 	=> $tahun,
	      		'jml_budidaya' 	=> $jml_budidaya,
	      		'jml_produksi' 	=> $jml_produksi,
	        	'pemilik_lahan_id' => $pemilikId,
	        	'satuan_diameter' => $satuan_diameter,
	        	'satuan_jml_pohon' => $satuan_jml_pohon,
	        	'satuan_tinggi_pohon' => $satuan_tinggi_pohon,
	        	'satuan_budidaya' => $satuan_budidaya,
	        	'satuan_produksi' => $satuan_produksi
	    		);
	    $this->db->insert('potensi_pemilik_lahan',$post_data);

		redirect(base_url().'Potensi/index/'.$pemilikId);
	}

	public function edit($id){
		$dt = $this->db->query("Select a.* from potensi_pemilik_lahan a where id='".$id."'")->result_object();		

		$pemilik = $this->db->query("Select a.* from pemilik_lahan a where id=".$dt[0]->pemilik_lahan_id)->result_object();
		
		$potensi = $this->db->query("Select a.* from m_jenis_potensi a where id=".$dt[0]->jenis_potensi)->result_object();	

		$jenis = $this->db->query("Select a.* from m_jenis_potensi a where jenis=".$potensi[0]->jenis)->result_object();
		
		$satuan = $this->db->query("Select a.* from m_satuan a")->result_object();
		
		$data['satuan'] 	 = $satuan;
		$data['potensi'] 	 = $potensi[0]->jenis;		
		$data['jenis'] 	 = $jenis;		
		$data['data'] = $dt;
		$data['pemilik'] = $pemilik;
		$data['page'] 	 = 'kelompok_tani';
		$data['subpage'] ='edit';		
		$data['judul']	 ='Potensi Lahan ';
		$data['header']	 ='Edit '.$this->judul;
		$this->load->view('pemiliklahan/potensi/index',$data);	
	}

	public function update(){
		$id = $this->input->post('id');
		$type_jenis = $this->input->post('type_jenis');

		$jenis = $this->input->post('jenis');
		$pemilikId = $this->input->post('pemilikId');

		// if ($type_jenis==1){
			$type_diameter = $this->input->post('type_diameter');	
			$tahun_tanam = $this->input->post('tahun_tanam');		
			$diameter = $this->input->post('diameter');		
			$jml_pohon = $this->input->post('jml_pohon');
			$tinggi_pohon = $this->input->post('tinggi_pohon');
		// }else{
			$tahun = $this->input->post('tahun');
			$jml_budidaya = $this->input->post('jml_budidaya');
			$jml_produksi = $this->input->post('jml_produksi');
		// }

			$satuan_diameter = $this->input->post('satuan_diameter');
			$satuan_jml_pohon = $this->input->post('satuan_jml_pohon');
			$satuan_tinggi_pohon = $this->input->post('satuan_tinggi_pohon');
			$satuan_budidaya = $this->input->post('satuan_budidaya');
			$satuan_produksi = $this->input->post('satuan_produksi');
		
		$post_data = array(
	      		'type_jenis' => $type_jenis,
	      		'type_diameter' => $type_diameter,
	      		'jenis_potensi' => $jenis,
	      		'diameter' 	=> $diameter,
	      		'jml_pohon' 	=> $jml_pohon,
	      		'tahun_tanam' 	=> $tahun_tanam,
	      		'tinggi_pohon' 	=> $tinggi_pohon,
	      		'tahun' 	=> $tahun,
	      		'jml_budidaya' 	=> $jml_budidaya,
	      		'jml_produksi' 	=> $jml_produksi,
	        	'pemilik_lahan_id' => $pemilikId,
	        	'satuan_diameter' => $satuan_diameter,
	        	'satuan_jml_pohon' => $satuan_jml_pohon,
	        	'satuan_tinggi_pohon' => $satuan_tinggi_pohon,
	        	'satuan_budidaya' => $satuan_budidaya,
	        	'satuan_produksi' => $satuan_produksi
	    		);
		
		$this->db->where('id',$id);
	    $this->db->update('potensi_pemilik_lahan',$post_data);

		redirect(base_url().'Potensi/index/'.$pemilikId);
	}

	public function delete($id){
		// delete detail dasar
		$result = $this->db->delete('potensi_pemilik_lahan', array('id' => $id));
        print_r($nip);
	 }

	public function getJenis($id){
	  	$jenis	= $this->db->query("select * from m_jenis_potensi where jenis=".$id)->result_array();
	  	print_r( json_encode($jenis) );
	}

	public function getList($pId){

		$typeJenis = intval($this->input->get("potensi"));
		$typeDiameter = intval($this->input->get("diameter"));

		$pemilik = $this->db->query("Select a.* from pemilik_lahan a where id=".$pId)->result_object();

		if ($typeJenis==1){
			$query = $this->db->query("Select a.*, b.nama as nama_jenis_potensi from potensi_pemilik_lahan a 
				left join m_jenis_potensi b on b.id=a.jenis_potensi 
				where a.pemilik_lahan_id=".$pId." and type_jenis=".$typeJenis." and type_diameter=".$typeDiameter);	
		}else{
			 $query = $this->db->query("Select a.*, b.nama as nama_jenis_potensi from potensi_pemilik_lahan a 
			 	left join m_jenis_potensi b on b.id=a.jenis_potensi 
			 	where a.pemilik_lahan_id=".$pId." and type_jenis=".$typeJenis);
		}

		// print_r("Select a.*, b.nama as nama_jenis_potensi from potensi_pemilik_lahan a 
		// 		left join m_jenis_potensi b on b.id=a.jenis_potensi 
		// 		where a.pemilik_lahan_id=".$pId." and type_jenis=".$typeJenis." and type_diameter=".$typeDiameter);
		
		$list = $query->result_object();

		// Datatables Variables
		
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

		//$arrayList = array();
		$data = array();
		  //$a=array("red","green");
		//array_push($a,"blue","yellow");

		foreach ($list as $key => $value) {
			# code...
			$data[] = array(
				'no' => $key+1,
				'jenis_potensi' => $value->nama_jenis_potensi,
				'tahun_tanam' => $value->tahun_tanam,
				'jml_pohon' => ($typeDiameter==1) ? $value->diameter : $value->jml_pohon,
				'tinggi_pohon' => $value->tinggi_pohon,
				'tahun' => $value->tahun,
				'jml_budidaya' => $value->jml_budidaya,
				'jml_produksi' => $value->jml_produksi,
				'aksi'	=> '
				<td class="text-center">
					<ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="'.base_url().'/Potensi/edit/'.$value->id.'?p='.$value->type_jenis.'&d='.$value->type_diameter.'">
									<i class="icon-pencil"></i> Edit</a>
								</li>
								<li>
									<a href="#" onclick="deleteData('.$value->id.')"><i class="icon-cross2 text-danger-600"></i> Delete</a>
								</li>
							</ul>
						</li>
					</ul>
				</td>
				',
				'5' =>''
			);
			//array_push($arrayList, $data);
		}

		$output = array(
               "draw" => $draw,
               "recordsTotal" => $query->num_rows(),
               "recordsFiltered" => $query->num_rows(),
               "data" => $data
        );

	  	//$jenis	= $this->db->query("select * from m_jenis_potensi where jenis=".$id)->result_array();
	  	print_r( json_encode($output) );
	}

	
}
