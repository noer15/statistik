<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produksiolahan extends CI_Controller {
	private $judul = "Produksi Olahan Hasil Hutan";

	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')){
			redirect(base_url().'Login');
		}
	}

	public function index()
	{
		$data['data']	 = $this->db->query('SELECT a.*, b.nama_industri as perusahaan, c.nama as jenis_olahan
							FROM produksi_olahan a INNER JOIN t_industri b ON a.industri_id = b.id
							INNER JOIN m_jenis_olahan c ON a.jenis_olahan_id = c.id')->result_object();	;
		$data['page']	 ='produksiolahan';
		$data['subpage'] ='list';
		$data['judul']	 =$this->judul;
		$data['header']	 =$this->judul;
		$this->load->view('produksiolahan/index',$data);
	}	
	
	public function tambah(){
		$data['list']	 = $this->db->query('SELECT a.*, b.nama_industri as perusahaan, c.nama as jenis_olahan
							FROM produksi_olahan a INNER JOIN t_industri b ON a.industri_id = b.id
							INNER JOIN m_jenis_olahan c ON a.jenis_olahan_id = c.id WHERE tanggal = "'.date('Y-m-d').'"')->result_object();
		$data['page'] 	 = 'produksiolahan';
		$data['subpage'] ='tambah';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Tambah '.$this->judul;
		$this->load->view('produksiolahan/index',$data);	
	}

	public function store(){
		$_POST['tanggal'] = date('y-m-d');
	    $this->db->insert('produksi_olahan',$_POST);
		redirect(base_url().'Produksiolahan/tambah');
	}

	public function edit($id){

		$data['data'] = $this->db->query("Select a.* from produksi_olahan a where id='".$id."'")->result_object();
		$data['page'] 	 = 'produksiolahan';
		$data['subpage'] ='edit';		
		$data['judul']	 =$this->judul;
		$data['header']	 ='Edit '.$this->judul;
		$this->load->view('produksiolahan/index',$data);	
	}

	public function update(){
		$id = $this->input->post('id');
		$this->db->where('id',$id);
	    $this->db->update('produksi_olahan',$_POST);

		redirect(base_url().'Produksiolahan');
	}

	public function delete($id){
		$result = $this->db->delete('produksi_olahan', array('id' => $id));
	 }

	public function getdata(){

		$sql = " Select a.* from produksi_olahan a ";

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
        		$orderBy="nama";
        		break;
        		
        	default:
        		$orderBy="id";
        		break;
        }
        $orderBy = $orderBy." ".$sOrderDir;

		//$page = $this->db->query($sql." LIMIT ".$post['start'].", ".$post['length']);
        
		$page = $this->db->query($sql.
				" WHERE a.nama like '%".$filter."%' ".
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
            	'aksi' => '<ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="Produksiolahan/edit/'. $value->id.'">
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
	
	public function rekap($thn = null,$bln = null)
	{
		if($thn && $thn > 0 && empty($bln)){
			$tgl = ' WHERE a.tahun='.$thn;
		}else if($thn && $thn > 0 && $bln > 0){
			$tgl = ' WHERE a.tahun='.$thn.' AND a.bulan='.$bln;
		}else{
			$tgl = '';
		}

		$list = $this->db->query('SELECT c.nama_industri as industri, b.nama as olahan, SUM(a.jml_produksi) as jumlah, a.satuan,a.bulan,a.tahun
				FROM produksi_olahan a INNER JOIN m_jenis_olahan b ON a.jenis_olahan_id = b.id
				INNER JOIN t_industri c ON a.industri_id = c.id '.$tgl.'
				GROUP BY industri,olahan, a.satuan, a.bulan, a.tahun')->result_object();
		
		$data['data'] 	 = $list;
		$data['page']	 = 'reportproduksiolahan';
		$data['subpage'] = 'rekap';
		$data['tahun']	 = $thn;
		$data['bulan']	 = $bln;
		$data['judul']	 =$this->judul;
		$data['header']	 =$this->judul;

		$this->load->view('produksiolahan/index',$data);
	}

	public function print(){
		
		$this->load->library('pdfgenerator');
		date_default_timezone_set('GMT');

		$olahan = ''; $no=1;
		foreach($this->db->get('m_jenis_olahan')->result() as $result){
			$olahan .= ',(
							SELECT
								count( aa'.$no.'.id ) 
							FROM
								produksi_olahan aa'.$no.'
								INNER JOIN t_industri bb'.$no.' ON aa'.$no.'.industri_id = bb'.$no.'.id
								INNER JOIN m_jenis_olahan cc'.$no.' ON aa'.$no.'.jenis_olahan_id = cc'.$no.'.id
								RIGHT JOIN m_kabupaten AS dd'.$no.' ON bb'.$no.'.kabupaten_id = dd'.$no.'.id
							WHERE
								aa'.$no.'.jenis_olahan_id = '.$result->id.' AND dd'.$no.'.id = idkab
							) AS unit_'.$no.',
							
							(
							SELECT
								sum( aa'.$no.'.jml_produksi )
							FROM
								produksi_olahan aa'.$no.'
								INNER JOIN t_industri bb'.$no.' ON aa'.$no.'.industri_id = bb'.$no.'.id
								INNER JOIN m_jenis_olahan cc'.$no.' ON aa'.$no.'.jenis_olahan_id = cc'.$no.'.id
								RIGHT JOIN m_kabupaten AS dd'.$no.' ON bb'.$no.'.kabupaten_id = dd'.$no.'.id
							WHERE
								aa'.$no.'.jenis_olahan_id = '.$result->id.' AND dd'.$no.'.id = idkab
							) AS jumlah_'.$no; 
			$no++;
		}

		$query = 'SELECT b.id as idkab, b.nama as namakab '.$olahan.' FROM produksi_olahan AS a INNER JOIN t_industri
					ON a.industri_id = t_industri.id RIGHT JOIN m_kabupaten AS b ON t_industri.kabupaten_id = b.id';

		$list = $this->db->query($query)->result_object();
		$data['list'] = $list;
		$data['jenis'] = $this->db->get('m_jenis_olahan')->result();
		$data['total'] = $this->db->query('SELECT b.nama, count(a.id) as industri, sum(a.jml_produksi) as jumlah
											FROM produksi_olahan a RIGHT JOIN m_jenis_olahan b
											ON a.jenis_olahan_id = b.id GROUP BY b.nama')->result_object();
		$html = $this->load->view('produksiolahan/print', $data, true);
		$paper = array(
					"A5" => 'A5',
					"Legal" => 'Legal',
		 			"folio" => array(0,0,612.00,936.00)
				 );
	    $this->pdfgenerator->generate($html,'rekap_produksi_olahan_hasil_hutan',TRUE,$paper['Legal'],'landscape');
	}

}
