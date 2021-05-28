<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai_kementrian extends CI_Controller {
	private $judul = "Pegawai_kementrian";

	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')){
			redirect(base_url().'Login');
		}
	}

	public function index()
	{

		$role_id = $this->session->userdata('role_id');
		$user_id = $this->session->userdata('user_id');
		if ($role_id==1)
			$list = $this->db->query("Select a.* from tb_pegawai a  ")->result_object();				
		else
			$list = $this->db->query("Select a.* from tb_pegawai a  where id=".$user_id)->result_object();

		$data['data']	 = $list;
		$data['page']	 ='pegawai kementrian';
		$data['subpage'] ='list';
		$data['judul']	 =$this->judul;
		$data['header']	 =$this->judul;
		$this->load->view('pegawai_kementrian/index',$data);
	}	
	
	public function tambah(){
		$data['golongans'] = $this->db->query("select a.* from m_pangkat_golongan a")->result_object();
		$data['units'] = $this->db->query("select a.* from m_unit_kerja a")->result_object();
		$data['jabatans'] = $this->db->query("select a.* from m_jabatan a")->result_object();

		$pendidikan = $this->db->query("Select a.* from m_pendidikan a ")->result_object();

		$data['pend'] 	 = $pendidikan;
		$data['page'] 	 = 'pegawai';
		$data['subpage'] ='tambah';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Tambah '.$this->judul;
		$this->load->view('pegawai_kementrian/index',$data);	
	}

	public function store(){
		try{
			$nip = $this->input->post('nip');
			$status = $this->input->post('status');
			$nama = $this->input->post('nama');
			$alamat = $this->input->post('alamat');
			$sex = $this->input->post('sex');
			$tempat_lahir = $this->input->post('tempat_lahir');
			$tgl_lahir = $this->input->post('tgl_lahir');
			$gol_pangkat = $this->input->post('gol_pangkat');
			$unit_kerja = $this->input->post('unit_kerja');
			$jabatan = $this->input->post('jabatan');
			$pendidikan = $this->input->post('pendidikan');
			$password = '123456789'; // default created
			$kode = '2';

			$role_id = $this->input->post('role');
			
			$post_data = array(
		      		'nip' 	=> $nip,
		      		'status' 	=> $status,
		        	'nama' => $nama,
		        	'alamat' => $alamat,
		        	'sex' => $sex,
		        	'tempat_lahir' => $tempat_lahir,
		        	'tgl_lahir' => $tgl_lahir,
		        	'pangkat_gol_id' => $gol_pangkat,
		        	'unit_kerja_id' => $unit_kerja,
		        	'jabatan_id' => $jabatan,
		        	'password'=> $password,
		        	'role_id' => $role_id,
		        	'pendidikan' => $pendidikan,
		        	'kode' => $kode,
		    );
		    $this->db->insert('tb_pegawai',$post_data);

		    $newId = $this->db->insert_id();

		    $this->session->set_flashdata('success', 'Data Berhasil Disimpan');
		 	redirect(base_url().'pegawai_kementrian');
		}catch(Exception $e){
			$this->session->set_flashdata('error', 'Data Gagal Disimpan');			
			redirect(base_url().'pegawai_kementrian/tambah');
		}
	}

	public function edit($id){
		$data['data'] = $this->db->query("Select a.* from tb_pegawai a where id='".$id."'")->result_object();

		$data['golongans'] = $this->db->query("select a.* from m_pangkat_golongan a")->result_object();
		$data['units'] = $this->db->query("select a.* from m_unit_kerja a")->result_object();
		$data['jabatans'] = $this->db->query("select a.* from m_jabatan a")->result_object();

		$pendidikan = $this->db->query("Select a.* from m_pendidikan a ")->result_object();

		$data['role_id'] = $this->session->userdata('role_id');
		
		$data['pend'] 	 = $pendidikan;
		$data['page'] 	 = 'pegawai';
		$data['subpage'] ='edit';		
		$data['judul']	 ='Pegawai';
		$data['header']	 ='Edit '.$this->judul;
		$this->load->view('pegawai_kementrian/index',$data);	
	}

	public function editprofile($id){
		$user_id = $this->session->userdata('user_id');
		$data['data'] = $this->db->query("Select a.* from tb_pegawai a where id='".$user_id."'")->result_object();
		$data['golongans'] = $this->db->query("select a.* from m_pangkat_golongan a")->result_object();
		$data['units'] = $this->db->query("select a.* from m_unit_kerja a")->result_object();
		$data['jabatans'] = $this->db->query("select a.* from m_jabatan a")->result_object();
		$data['wilayah'] = $this->db->query("SELECT CONCAT(c.nama,' - Kec. ',b.nama) as nama FROM
											t_penyuluh_wilayah a INNER JOIN m_kecamatan b ON a.kecamatan_id = b.id
											INNER JOIN m_kabupaten c ON b.kabupaten_id = c.id
											WHERE a.penyuluh_id = 6")->row_object();

		$pendidikan = $this->db->query("Select a.* from m_pendidikan a ")->result_object();

		$data['role_id'] = $this->session->userdata('role_id');
		
		$data['pend'] 	 = $pendidikan;
		$data['page'] 	 = 'pegawai';
		$data['subpage'] ='editprofile';		
		$data['judul']	 ='Pegawai';
		$data['header']	 ='Edit '.$this->judul;
		$this->load->view('pegawai_kementrian/index',$data);	
	}

	public function update(){
		$id = $this->input->post('id');
		$nip = $this->input->post('nip');
		$status = $this->input->post('status');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$sex = $this->input->post('sex');
		$tempat_lahir = $this->input->post('tempat_lahir');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$gol_pangkat = $this->input->post('gol_pangkat');
		$unit_kerja = $this->input->post('unit_kerja');
		$jabatan = $this->input->post('jabatan');
		$pendidikan = $this->input->post('pendidikan');
		$kode = '2';


		$role_id = $this->input->post('role');

		$post_data = array(
	      		'nip' 	=> $nip,
	      		'status' 	=> $status,
	        	'nama' => $nama,
	        	'alamat' => $alamat,
	        	'sex' => $sex,
	        	'tempat_lahir' => $tempat_lahir,
	        	'tgl_lahir' => $tgl_lahir,
	        	'pangkat_gol_id' => $gol_pangkat,
	        	'unit_kerja_id' => $unit_kerja,
	        	'jabatan_id' => $jabatan,
	        	'role_id' => $role_id,
	        	'pendidikan' => $pendidikan,
	        	'kode' => $kode,
	    		);
		$this->db->where('id',$id);
	    $this->db->update('tb_pegawai',$post_data);

		//$this->index();
		redirect(base_url().'pegawai_kementrian');
	}


	public function updateprofile(){
		$id = $this->input->post('id');
		$nip = $this->input->post('nip');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$sex = $this->input->post('sex');
		$tempat_lahir = $this->input->post('tempat_lahir');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$gol_pangkat = $this->input->post('gol_pangkat');
		//$unit_kerja = $this->input->post('unit_kerja');
		//$jabatan = $this->input->post('jabatan');
		$pendidikan = $this->input->post('pendidikan');

		$post_data = array(
	      		'nip' 	=> $nip,
	        	'nama' => $nama,
	        	'alamat' => $alamat,
	        	'sex' => $sex,
	        	'tempat_lahir' => $tempat_lahir,
	        	'tgl_lahir' => $tgl_lahir,
	        	'pangkat_gol_id' => $gol_pangkat,	        	
	        	'pendidikan' => $pendidikan
	    		);
		$this->db->where('id',$id);
	    $this->db->update('tb_pegawai',$post_data);

		//$this->index();
		redirect(base_url().'pegawai_kementrian');
	}
	
	public function delete($id){
		// delete detail dasar
		$role_id = $this->session->userdata('role_id');
		if ($role_id==1 || $role_id==18) {
			$result = $this->db->delete('tb_pegawai', array('id' => $id));
			print_r($result);
		}else{
			redirect(base_url().'pegawai_kementrian');
		}
        
	}

	public function getdata(){

		$role_id = $this->session->userdata('role_id');
		$user_id = $this->session->userdata('user_id');
		
		$sql = "Select a.*, CONCAT(b.pangkat, ', ', b.golongan, '/', LOWER(b.ruang) ) as pangkat,
				c.nama as unit_kerja , d.nama as jabatan 
			from tb_pegawai a 
				LEFT JOIN m_pangkat_golongan b ON a.pangkat_gol_id = b.id 
				LEFT JOIN m_unit_kerja c on c.id=a.unit_kerja_id 
				LEFT JOIN m_jabatan d on d.id=a.jabatan_id ";		

		$wherepeg = "";
		if ($role_id==1 || $role_id==18) {
			$wherepeg="";
		}else{
			$wherepeg = " where a.id=".$user_id;
		}

		$query = $this->db->query($sql.$wherepeg);

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
        		$orderBy="nip";
        		break;
        	case '1':
        		$orderBy="nama";
        		break;
        	case '2':
        		$orderBy="pangkat";
        		break;
        	case '3':
        		$orderBy="phone";
        		break;
        	case '4':
        		$orderBy="unit_kerja";
        		break;

        	default:
        		$orderBy="nama";
        		break;
        }
        $orderBy = $orderBy." ".$sOrderDir;

		//$page = $this->db->query($sql." LIMIT ".$post['start'].", ".$post['length']);
		$where_pegawai = "";
		if ($role_id==1 || $role_id==18) {
			$where_pegawai="";
		}else{
			$where_pegawai = " a.id=".$user_id." and ";
		}
        
		$page = $this->db->query($sql.
				" WHERE ".
				$where_pegawai.
				" ( a.nama like '%".$filter."%' ".
				" OR d.nama like '%".$filter."%' ".
				" OR c.nama like '%".$filter."%' ".
				" ) ". 
				" ORDER BY ".$orderBy.
				" LIMIT ".$post['start'].", ".$post['length']);
        $list = $page->result_object();

		$totalData = $totalFiltered = $query->num_rows();

        $data = array();
        $no = $post['start'];

        foreach ($list as $key => $value) {
        	$no++;                	

			$aksiWilayah = "";
        	if ($value->jabatan_id>=8 && $value->jabatan_id<=14) {
        		$aksiWilayah = '<li><a href="'.base_url().'penyuluh/wilayah/'.$value->id.'?t=1">
										<i class="icon-stack2"></i> Wilayah Kerja</a>
									</li>';
				// $aksiWilayah = '<li>
				// 	<a href="'.base_url().'penyuluh/wilayah/'.$value->id.'?t=1" 
				// 		data-toggle="tooltip" title="Wilayah Kerja" >
				// 		<i class="icon-stack2"></i>
				// 	</a>
				// </li>';
			}       	

			$aksiDelete = "";
        	if ($role_id==1 || $role_id==18) {
        		$aksiDelete = '<li>
									<a href="#" onclick="deleteData('. $value->id.')"><i class="icon-bin text-danger-600"></i> Delete</a>
								</li>';
				// $aksiDelete = '<li>
				// 	<a href="#" onclick="deleteData('.$value->id.')" data-toggle="tooltip" title="Delete" >
				// 		<i class="icon-bin text-danger"></i>
				// 	</a>
				// </li>';
			}

            $row = array(
            	'nip'=> $value->nip,
            	'nama'=> $value->nama,
            	'pangkat'=> $value->pangkat,
            	'jabatan'=> $value->jabatan,
            	'unit_kerja'=> $value->unit_kerja,
            	'aksi' => '<ul class="icons-list">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icon-menu9"></i>
								</a>
								<ul class="dropdown-menu dropdown-menu-right">
									'.$aksiWilayah.'									
									<li><a href="'.base_url().'pegawai_kementrian/edit/'. $value->id.'">
										<i class="icon-pencil5 text-primary"></i> Edit</a>
									</li>
									'.$aksiDelete.'
								</ul>
							</li>
						</ul>'
      //       	'aksi' => '<ul class="icons-list">
						// 	<li class="dropdown">							
						// 		<ul class="icons-list">'.$aksiWilayah.'
						// 			<li><a class="" data-toggle="tooltip" title="Edit" 
						// 					href="'.base_url().'pegawai/edit/'.$value->id.'" >
						// 				<i class="icon-pencil5 text-primary"></i>
						// 				</a>
						// 			</li> '
						// 			.$aksiDelete
						// 		.'</ul>
						// 	</li>
						// </ul>'
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
