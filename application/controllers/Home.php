<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')) {
			redirect(base_url() . 'Login');
		}
	}

	public function index()
	{
		$data['page']		= 'home';
		$data['kabupaten']	= $this->db->get('m_kabupaten')->result();
		$data['sertifikat']	= $this->db->get('m_jenis_sertifikat')->result();
		$this->load->view('home', $data);
	}

	public function laporanKelas($kab, $kec, $cdk, $tipe, $startdate, $enddate, $desa = null, $anggota = null, $export = null)
	{
		$strWhere = "";

		if ($kab == 0) {
			$strWhere = " c.kabupaten_id=t0.id ";
			$fileName = "Kabupaten";
		} else {
			if ($kec == 0) {
				$strWhere = " c.kabupaten_id=t0.kabupaten_id and b.kecamatan_id=t0.id ";
				$fileName = "Kecamatan";
			} else {
				$strWhere = " c.kabupaten_id=t2.kabupaten_id and b.kecamatan_id=t0.kecamatan_id and b.id=t0.id ";
				$fileName = "Desa";
			}
		}

		if ($startdate != 0 && $enddate != 0) {
			$sd = date('Y-m-d', strtotime($startdate)) . ' 00:00:00';
			$ed = date('Y-m-d', strtotime($enddate)) . ' 23:59:00';
			$betweenDate = "AND tanggal BETWEEN '" . $sd . "' AND '" . $ed . "'";
		} else {
			$betweenDate = "";
		}

		if ($tipe == 'total') {
			$sql = "Select t0.* ,
				(
				Select count(a.id) from kelompok_tani a
				INNER JOIN m_desa b on b.id=a.desa_id
				INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
				WHERE a.kelas=1 and " . $strWhere . " " . $betweenDate . "
				) as pemula,
				(
				Select count(a.id) from kelompok_tani a
				INNER JOIN m_desa b on b.id=a.desa_id
				INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
				WHERE a.kelas=2 and " . $strWhere . " " . $betweenDate . "
				) as madya,
				(
				Select count(a.id) from kelompok_tani a
				INNER JOIN m_desa b on b.id=a.desa_id
				INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
				WHERE a.kelas=3 and " . $strWhere . " " . $betweenDate . "
				) as utama ";
		} else
		if ($tipe == 'pemula') {
			$sql = "Select t0.* ,
				(
				Select count(a.id) from kelompok_tani a
				INNER JOIN m_desa b on b.id=a.desa_id
				INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
				WHERE a.kelas=1 and " . $strWhere . " " . $betweenDate . "
				) as jml ";
		} else
		if ($tipe == 'madya') {
			$sql = "Select t0.* ,
				(
				Select count(a.id) from kelompok_tani a
				INNER JOIN m_desa b on b.id=a.desa_id
				INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
				WHERE a.kelas=2 and " . $strWhere . " " . $betweenDate . "
				) as jml";
		} else {
			$sql = "Select t0.* ,
				(
				Select count(a.id) from kelompok_tani a
				INNER JOIN m_desa b on b.id=a.desa_id
				INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
				WHERE a.kelas=3 and " . $strWhere . " " . $betweenDate . "
				) as jml";
		}

		if ($kab == 0) {
			$sql = $sql . " from m_kabupaten t0 
				LEFT JOIN m_unit_kerja_wilayah t1 on t1.kabupaten_id=t0.id";

			if ($cdk > 0) {
				$sql = $sql . " where t1.unit_kerja_id=" . $cdk;
			}

			if ($tipe == 'total') {
				$sql .= " ORDER BY pemula DESC";
			} else {
				$sql .= " ORDER BY jml DESC";
			}

			$query = $this->db->query($sql);
		} else {
			if ($kec == 0) {
				$sql = $sql . " from m_kecamatan t0 
					LEFT JOIN  m_unit_kerja_wilayah t1 on t1.kabupaten_id=t0.kabupaten_id 
					where t0.kabupaten_id=" . $kab;

				if ($cdk > 0) {
					$sql = $sql . " and t1.unit_kerja_id=" . $cdk;
				}
			} else {
				$sql = $sql . " from m_desa t0 
					INNER JOIN m_kecamatan t2 on t2.id=t0.kecamatan_id 
					LEFT JOIN  m_unit_kerja_wilayah t1 on t1.kabupaten_id=t2.kabupaten_id 
					where t2.kabupaten_id=" . $kab . " and t0.kecamatan_id=" . $kec;

				if ($cdk > 0) {
					$sql = $sql . " and t1.unit_kerja_id=" . $cdk;
				}

				if (!empty($desa) && $desa > 0) {
					$sql = $sql . " and t0.id=" . $desa;
				}
			}

			if ($tipe == 'total') {
				$sql .= " ORDER BY pemula DESC";
			} else {
				$sql .= " ORDER BY jml DESC";
			}

			$query = $this->db->query($sql);
		}

		if ($tipe == 'total') {
			$a = '[';
			$n = 1;
			foreach ($query->result_object() as $stat) {
				if ($n > 1)
					$a .= ',';
				$a .= '{"kabupaten":"' . $stat->nama . '","pemula":' . $stat->pemula . ',"madya":' . $stat->madya . ',"utama":' . $stat->utama . '}';
				$n++;
			}
			$a .= ']';
		} else {
			$a = '[';
			$n = 1;
			foreach ($query->result_object() as $stat) {
				if ($n > 1)
					$a .= ',';
				$a .= '{"kabupaten":"' . $stat->nama . '","jumlah":' . $stat->jml . '}';
				$n++;
			}
			$a .= ']';
		}

		if ($export == 'excel') {
			$data['title'] 	= 'Tabel Kelompok Tani Per ' . $fileName . ' Tanggal ' . date('d-m-Y');
			$data['file_keltani'] = $query->result_object();
			$data['name']	= $fileName;
			$this->load->view('kelompoktani/export_file', $data);
		} else 
		if ($desa > 0) {
			$this->laporanKelasDesa($desa, $anggota, $tipe);
		} else {
			$this->output
				->set_content_type('application/json')
				->set_output(json_decode(json_encode($a)));
		}
	}

	private function laporanKelasDesa($desa, $anggota, $tipe = null)
	{
		if ($desa > 0) {
			$sql = 'SELECT count(a.id) as total, a.nama as nama, a.nama as alias_nama , 
					( SELECT count(id) FROM kelompok_tani WHERE nama = alias_nama AND desa_id=' . $desa . ' AND kelas = 1
					) as pemula, 
					( SELECT count(id) FROM kelompok_tani WHERE nama = alias_nama AND desa_id=' . $desa . ' AND kelas = 2
					) as madya, 
					( SELECT count(id) FROM kelompok_tani WHERE nama = alias_nama AND desa_id=' . $desa . ' AND kelas = 3
					) as utama
					FROM kelompok_tani a INNER JOIN m_kelas_kelompok b ON  a.kelas = b.id
					WHERE desa_id = ' . $desa . ' group by a.nama';

			$a = '[';
			$n = 1;
			foreach ($this->db->query($sql)->result_object() as $stat) {
				if ($n > 1)
					$a .= ',';

				if($tipe == 'total'){
					$a .= '{"kabupaten":"' . $stat->nama . '","pemula":' . $stat->pemula . ',"madya":' . $stat->madya . ',"utama":' . $stat->utama . '}';
				}else{
					switch ($tipe) {
						case 'pemula':
							$data = $stat->pemula; break;
						case 'madya':
							$data = $stat->madya; break;
						case 'utama':
							$data = $stat->utama; break;
						default:
							$data = $stat->pemula; break;
					}

					$a .= '{"kabupaten":"' . $stat->nama . '","jumlah":' . $data . '}';
				}

				
				$n++;
			}
			$a .= ']';
		} else if($desa > 0 && $anggota > 0) {
			$sql = 'SELECT count(a.id) AS total, a.nama, a.nama as alias_nama,
						(
							SELECT count(aa.id) FROM kelompok_tani aa
							INNER JOIN anggota_kelompok_tani ab ON aa.id=ab.kelompok_id
							WHERE kelas = 1 AND ab.id = '.$anggota.' AND ab.nama = alias_nama
						) as pemula,
						(
							SELECT count(aa.id) FROM kelompok_tani aa
							INNER JOIN anggota_kelompok_tani ab ON aa.id=ab.kelompok_id
							WHERE kelas = 2 AND ab.id = '.$anggota.' AND ab.nama = alias_nama
						) as madya,
						(
							SELECT count(aa.id) FROM kelompok_tani aa
							INNER JOIN anggota_kelompok_tani ab ON aa.id=ab.kelompok_id
							WHERE kelas = 3 AND ab.id = '.$anggota.' AND ab.nama = alias_nama
						) as utama
						
					FROM anggota_kelompok_tani a INNER JOIN kelompok_tani b ON  a.kelompok_id = b.id
						INNER JOIN m_kelas_kelompok c ON b.kelas = c.id
					WHERE a.id = '.$anggota.' GROUP BY a.nama';
		}

		return $this->output
			->set_content_type('application/json')
			->set_output(json_decode(json_encode($a)));
	}

	public function laporanKelasTahun()
	{
		$data = $this->db->select('COUNT(id) as total, SUBSTRING(ABS(tahun_berdiri),1,4) as tahun')
			->group_by('tahun_berdiri')
			->order_by('tahun', 'DESC')
			->get('kelompok_tani')->result();

		$a = '[';
		$n = 1;
		foreach ($data as $stat) {
			if ($n > 1)
				$a .= ',';
			$a .= '{"tahun":"' . $stat->tahun . '","total":' . $stat->total . '}';
			$n++;
		}
		$a .= ']';

		$this->output
			->set_content_type('application/json')
			->set_output(json_decode(json_encode($a)));
	}

	public function laporanKelasFile()
	{
		$data = $this->db->select('COUNT(file_menkumham) as menkumham, COUNT(file_sk) as sk, COUNT(file_akta) as akta, COUNT(file_ba) as ba ')
			->get('kelompok_tani')
			->row();

		$result = '[{"file": "File Menkumham", "total" : ' . $data->menkumham . '},
					{"file": "File Akta", "total" : ' . $data->akta . '},
					{"file": "File SK", "total" : ' . $data->sk . '},
					{"file": "File BA", "total" : ' . $data->ba . '}]';

		$this->output
			->set_content_type('application/json')
			->set_output(json_decode(json_encode($result)));
	}

	public function laporanKepemilikanLahan($jenis, $blok, $filter, $startdate, $enddate)
	{
		if ($startdate != 0 && $enddate != 0) {
			$sd = date('Y-m-d', strtotime($startdate)) . ' 00:00:00';
			$ed = date('Y-m-d', strtotime($enddate)) . ' 23:59:00';
			if ($jenis == 0 && $blok == 0) {
				$betweenDate = " WHERE tanggal BETWEEN '" . $sd . "' AND '" . $ed . "'";
			} else {
				$betweenDate = " AND tanggal BETWEEN '" . $sd . "' AND '" . $ed . "'";
			}
		} else {
			$betweenDate = "";
		}

		if ($jenis == 0 && $blok == 0) {
			if ($filter == 'total') {
				$orderBy = " ORDER BY jumlah DESC";
			} else {
				$orderBy = " ORDER BY luas_lahan DESC";
			}

			$sql = "SELECT count(a.id) as jumlah,b.nama AS jenis, sum(a.luas_lahan) as luas_lahan
			FROM pemilik_lahan a INNER JOIN m_jenis_sertifikat b ON b.id = a.jenis_sertifikat $betweenDate
			GROUP BY b.nama $orderBy";

			$data = $this->db->query($sql)->result_object();
			$a = '[';
			$n = 1;
			foreach ($data as $stat) {
				if ($n > 1)
					$a .= ',';
				$total = $filter == 'total' ? $stat->jumlah : $stat->luas_lahan;
				$a .= '{"jenis":"' . $stat->jenis . '","total":' . $total . '}';
				$n++;
			}
			$a .= ']';
		} else {
			if ($filter == 'total') {
				$orderBy = " ORDER BY total_data DESC";
			} else {
				$orderBy = " ORDER BY luas_lahan DESC";
			}

			$blok = urldecode($blok);
			$sql  = "SELECT a.nama_sertifikat, a.blok, b.nama AS jenis_sertifikat,
					sum(a.luas_lahan) as luas_lahan, count(a.id) as total_data
					FROM pemilik_lahan a INNER JOIN m_jenis_sertifikat b ON b.id = a.jenis_sertifikat
					WHERE a.blok = '$blok' $betweenDate 
					GROUP BY a.nama_sertifikat,b.nama,a.blok $orderBy";
			$data = $this->db->query($sql)->result_object();
			$a = '[';
			$n = 1;
			foreach ($data as $stat) {
				if ($n > 1)
					$a .= ',';
				$total = $filter == 'total' ? $stat->total_data : $stat->luas_lahan;
				$a .= '{"jenis":"' . $stat->nama_sertifikat . '","total":' . $total . '}';
				$n++;
			}
			$a .= ']';
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_decode(json_encode($a)));
	}

	public function getBlokLahan($jenis)
	{
		if ($jenis == 0) {
			$data = $this->db->query('SELECT a.blok FROM pemilik_lahan a
					GROUP BY a.blok')->result_object();
		} else {
			$data = $this->db->query('SELECT a.blok FROM pemilik_lahan a 	
					WHERE a.jenis_sertifikat = ' . $jenis . '
					GROUP BY a.blok')->result_object();
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
	}

	public function laporanAnggotaKelompok($filter)
	{
		if ($filter == 'umur') {
			$data = $this->db->query('SELECT count(id) as total, 
			( SELECT count(id) FROM anggota_kelompok_tani WHERE umur <= 17 || umur is null) as umur_17,
			( SELECT count(id) FROM anggota_kelompok_tani WHERE umur > 17 AND umur <= 35 ) as umur_35,
			( SELECT count(id) FROM anggota_kelompok_tani WHERE umur > 35 AND umur <= 50 ) as umur_50,
			( SELECT count(id) FROM anggota_kelompok_tani WHERE umur > 50 ) as umur_51
			FROM anggota_kelompok_tani')->row_object();
		} else
		if ($filter == 'jk') {
			$data = $this->db->select('COUNT(id) as total, jk as name')->group_by('jk')
				->get('anggota_kelompok_tani')
				->result();
		} else {
			$data = $this->db->select('COUNT(anggota_kelompok_tani.id) as total, m_pendidikan.nama as name')
				->join('m_pendidikan', 'pendidikan=m_pendidikan.id', 'LEFT')
				->group_by('pendidikan')
				->get('anggota_kelompok_tani')
				->result();
		}

		if ($filter == 'umur') {
			$a = '[{"name" : "Umur 0 - 17thn","total": ' . $data->umur_17 . '},{"name" : "Umur 18 - 35thn","total": ' . $data->umur_35 . '},{"name" : "Umur 36 - 50thn","total": ' . $data->umur_50 . '},{"name" : "Umur 51th+","total": ' . $data->umur_51 . '}]';
		} else 
		if ($filter == 'jk') {
			$a = '[';
			$n = 1;
			foreach ($data as $stat) {
				if ($n > 1)
					$a .= ',';
				if ($stat->name == 'P') {
					$jk = 'Perempuan';
				} else
				if ($stat->name == 'L') {
					$jk = 'Laki-laki';
				} else {
					$jk = 'Kosong';
				}

				$a .= '{"name":"' . $jk . '","total":' . $stat->total . '}';
				$n++;
			}
			$a .= ']';
		} else {
			$a = '[';
			$n = 1;
			foreach ($data as $stat) {
				if ($n > 1)
					$a .= ',';
				$a .= '{"name":"' . $stat->name . '","total":' . $stat->total . '}';
				$n++;
			}
			$a .= ']';
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_decode(json_encode($a)));
	}

	public function laporanPrint($kab, $kec, $cdk, $tipe, $startdate, $enddate)
	{
		$strWhere = "";

		if ($kab == 0) {
			$strWhere = " c.kabupaten_id=t0.id ";
		} else {
			if ($kec == 0) {
				$strWhere = " c.kabupaten_id=t0.kabupaten_id and b.kecamatan_id=t0.id ";
			} else {
				$strWhere = " c.kabupaten_id=t2.kabupaten_id and b.kecamatan_id=t0.kecamatan_id and b.id=t0.id ";
			}
		}

		if ($tipe == 'total') {
			$sql = "Select t0.* ,
				(
				Select count(a.id) from kelompok_tani a
				INNER JOIN m_desa b on b.id=a.desa_id
				INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
				WHERE a.kelas=1 and " . $strWhere . "
				) as pemula,
				(
				Select count(a.id) from kelompok_tani a
				INNER JOIN m_desa b on b.id=a.desa_id
				INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
				WHERE a.kelas=2 and " . $strWhere . "
				) as madya,
				(
				Select count(a.id) from kelompok_tani a
				INNER JOIN m_desa b on b.id=a.desa_id
				INNER JOIN m_kecamatan c on c.id=b.kecamatan_id
				WHERE a.kelas=3 and " . $strWhere . "
				) as utama ";
		}

		if ($kab == 0) {
			$sql = $sql . " from m_kabupaten t0 
				LEFT JOIN m_unit_kerja_wilayah t1 on t1.kabupaten_id=t0.id";

			$sql .= " ORDER BY pemula DESC";
			$query = $this->db->query($sql);
		}

		$a = '[';
		$n = 1;
		foreach ($query->result_object() as $stat) {
			if ($n > 1)
				$a .= ',';
			$a .= '{"kabupaten":"' . $stat->nama . '","pemula":' . $stat->pemula . ',"madya":' . $stat->madya . ',"utama":' . $stat->utama . '}';
			$n++;
		}
		$a .= ']';

		return $query->result_object();
	}

	public function laporanPinjamPakai($kab, $kec, $jenis)
	{
		if($jenis == 'kph'){
			$sql = 'SELECT count(a.id) as total, b.nama as nama FROM t_pinjampakai a 
					INNER JOIN m_kph b ON a.kph_id = b.id GROUP BY a.kph_id ORDER BY total DESC';
		}else
		if($jenis == 'kawasan'){
			$sql = 'SELECT count(a.id) as total, b.nama as nama FROM t_pinjampakai a
					INNER JOIN m_kawasan_hutan b ON a.kawasan_id = b.id
					GROUP BY a.kawasan_id ORDER BY total DESC';
		}else{
			$sql = 'SELECT count(a.id) as total, b.nama as nama FROM t_pinjampakai a
					INNER JOIN m_peruntukan_pinjampakai b ON a.peruntukan_id = b.id
					GROUP BY a.peruntukan_id ORDER BY total DESC';
		}

		$a = '[';
		$n = 1;
		foreach ($this->db->query($sql)->result_object() as $stat) {
			if ($n > 1)
				$a .= ',';
			$a .= '{"nama":"' . $stat->nama . '","total":' . $stat->total . '}';
			$n++;
		}
		$a .= ']';

		$this->output
			->set_content_type('application/json')
			->set_output(json_decode(json_encode($a)));
	}
}
