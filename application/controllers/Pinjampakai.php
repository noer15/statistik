<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pinjampakai extends CI_Controller {
	private $judul = "Data Pinjam Pakai Kawasan Hutan ";
	
	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')){
			redirect(base_url().'Login');
		}
	}

	public function index()
	{

		$data['page']	 = 'pinjampakai';
		$data['subpage'] ='list';
		$data['judul']	 =$this->judul;
		$data['header']	 =$this->judul;
		$this->load->view('pinjampakai/index',$data);
	}	
	
	public function tambah(){

		$kab = $this->db->query("Select a.* from m_kabupaten a ")->result_object();

		$kec = $this->db->query("Select a.* from m_kecamatan a where a.kabupaten_id=".$kab[0]->id)->result_object();

		$desa = $this->db->query("Select a.* from m_desa a where a.kecamatan_id=".$kec[0]->id)->result_object();

		$kawasan = $this->db->query("Select a.* from m_kawasan_hutan a ")->result_object();
		$satuan = $this->db->query("Select a.* from m_satuan a")->result_object();
		$kph = $this->db->query("Select a.* from m_kph a")->result_object();

		$peruntukan = $this->db->query("Select a.* from m_peruntukan_pinjampakai a")->result_object();
		
		
		$data['peruntukan'] 	 = $peruntukan;		
		$data['kph'] 	 = $kph;		
		$data['satuan'] 	 = $satuan;
		$data['kawasan'] 	 = $kawasan;
		$data['kabupaten'] 	 = $kab;
		$data['kecamatan'] 	 = $kec;
		$data['desa'] 	 = $desa;
		$data['page'] 	 = 'pinjampakai';
		$data['subpage'] ='tambah';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Tambah '.$this->judul;
		$this->load->view('pinjampakai/index',$data);	
	}

	public function store(){
		$desaId = $this->input->post('desa');
		$kawasan = $this->input->post('kawasan');
		$kph = $this->input->post('kph');
		$nama_perusahaan = $this->input->post('nama_perusahaan');

		$permohonan_no = $this->input->post('permohonan_no');
		$permohonan_date = $this->input->post('permohonan_date');

		$persetujuan_no = $this->input->post('persetujuan_no');
		$persetujuan_date = $this->input->post('persetujuan_date');

		$izin_no = $this->input->post('izin_no');
		$izin_date = $this->input->post('izin_date');

		$peruntukan = $this->input->post('peruntukan_id');
		$luas = $this->input->post('luas');
		$satuan = $this->input->post('satuan');
		
		$post_data = array(
	      		'desa_id' 	=> $desaId,
	      		'kawasan_id' 	=> $kawasan,
	      		'kph_id' 	=> $kph,
	      		'nama_perusahaan' => $nama_perusahaan,
	      		'permohonan_no' => $permohonan_no,
	      		'permohonan_date' => $permohonan_date,
	      		'persetujuan_no' => $persetujuan_no,
	      		'persetujuan_date' => $persetujuan_date,
	      		'izin_no' => $izin_no,
	      		'izin_date' => $izin_date,
	      		'peruntukan_id' => $peruntukan,
	      		'luas' => $luas,
	      		'satuan' => $satuan
	    		);
	    $this->db->insert('t_pinjampakai',$post_data);

		redirect(base_url().'Pinjampakai');
	}

	public function edit($id){

		$dt = $this->db->query("Select a.*, b.kecamatan_id, c.kabupaten_id from t_pinjampakai a 
							inner join m_desa b on b.id=desa_id 
							inner join m_kecamatan c on c.id=b.kecamatan_id where a.id='".$id."' ")->result_object();

		$kab = $this->db->query("Select a.* from m_kabupaten a where id=".$dt[0]->kabupaten_id)->result_object();

		$kec = $this->db->query("Select a.* from m_kecamatan a where a.kabupaten_id=".$kab[0]->id)->result_object();

		$desa = $this->db->query("Select a.* from m_desa a where a.kecamatan_id=".$kec[0]->id)->result_object();

		$kawasan = $this->db->query("Select a.* from m_kawasan_hutan a ")->result_object();
		$satuan = $this->db->query("Select a.* from m_satuan a")->result_object();
		$kph = $this->db->query("Select a.* from m_kph a")->result_object();			

		$peruntukan = $this->db->query("Select a.* from m_peruntukan_pinjampakai a")->result_object();		
		
		$data['peruntukan'] 	 = $peruntukan;		
		$data['kph'] 	 = $kph;		
		$data['satuan'] 	 = $satuan;
		$data['kawasan'] 	 = $kawasan;
		$data['kabupaten'] 	 = $kab;
		$data['kecamatan'] 	 = $kec;
		$data['desa'] 	 = $desa;
		$data['data'] = $dt;
		$data['page'] 	 = 'pinjampakai';
		$data['subpage'] ='edit';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Edit '.$this->judul;
		$this->load->view('pinjampakai/index',$data);	
	}

	public function update(){
		$id = $this->input->post('id');
		//$desaId = $this->input->post('desa');
		$kawasan = $this->input->post('kawasan');
		$kph = $this->input->post('kph');
		$nama_perusahaan = $this->input->post('nama_perusahaan');

		$permohonan_no = $this->input->post('permohonan_no');
		$permohonan_date = $this->input->post('permohonan_date');

		$persetujuan_no = $this->input->post('persetujuan_no');
		$persetujuan_date = $this->input->post('persetujuan_date');

		$izin_no = $this->input->post('izin_no');
		$izin_date = $this->input->post('izin_date');

		$peruntukan = $this->input->post('peruntukan_id');
		$luas = $this->input->post('luas');
		$satuan = $this->input->post('satuan');
		
		$post_data = array(	      		
	      		'kawasan_id' 	=> $kawasan,
	      		'kph_id' 	=> $kph,
	      		'nama_perusahaan' => $nama_perusahaan,
	      		'permohonan_no' => $permohonan_no,
	      		'permohonan_date' => $permohonan_date,
	      		'persetujuan_no' => $persetujuan_no,
	      		'persetujuan_date' => $persetujuan_date,
	      		'izin_no' => $izin_no,
	      		'izin_date' => $izin_date,
	      		'peruntukan_id' => $peruntukan,
	      		'luas' => $luas,
	      		'satuan' => $satuan	      		
	    		);
		$this->db->where('id',$id);
	    $this->db->update('t_pinjampakai',$post_data);

		redirect(base_url().'Pinjampakai');
	}

	public function delete($id){
		// delete detail dasar
		$result = $this->db->delete('t_pinjampakai', array('id' => $id));
        //print_r($nip);
	}


	 public function getdata(){

		$sql = " Select a.*, b.nama as namadesa, c.nama as namakph, d.nama as namakawasan from t_pinjampakai a
		   inner join m_desa b on b.id=a.desa_id
		   inner join m_kph c on c.id=a.kph_id 
		   inner join m_kawasan_hutan d on d.id=a.kawasan_id";

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
        		$orderBy="id";
        		break;
        		
        	default:
        		$orderBy="id";
        		break;
        }
        $orderBy = $orderBy." ".$sOrderDir;

		//$page = $this->db->query($sql." LIMIT ".$post['start'].", ".$post['length']);

		$page = $this->db->query($sql.
				" WHERE a.nama_perusahaan like '%".$filter."%' ".
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
            	'desa'=> $value->namadesa,
            	'kph'=> $value->namakph,
            	'namakawasan'=> $value->namakawasan,
            	'namaperusahaan'=> $value->nama_perusahaan,
            	'tahap_izin'=>  "Permohonan  No : ".$value->permohonan_no.", ".$value->permohonan_date." <br>"
            					."Persetujuan No : ".$value->persetujuan_no.", ".$value->persetujuan_date."<br>"
            					."Izin No : ".$value->persetujuan_no.", ".$value->izin_date,
            	'aksi' => '<ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="pinjampakai/edit/'. $value->id.'">
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
