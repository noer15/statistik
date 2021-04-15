<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
defined('BASEPATH') OR exit('No direct access allowed');

class Api extends CI_Controller{

    public function dashboardpanel()
    {
        $kelompoktani = $this->db->get('kelompok_tani')->num_rows();
        $kelompoktanimonth = $this->db->query('SELECT count(id) as total FROM kelompok_tani WHERE MONTH(tanggal) = MONTH("'.date('Y-m-d').'") ')->row_object();

        $pemiliklahan = $this->db->get('pemilik_lahan')->num_rows();
        $pemiliklahanmonth = $this->db->query('SELECT count(id) as total FROM pemilik_lahan WHERE MONTH(tanggal) = MONTH("'.date('Y-m-d').'") ')->row_object();

        $produksiKph = $this->db->get('produksi_kph')->num_rows();
        $produksiNonKph = $this->db->get('produksi_luar_kph')->num_rows();
        $produksiKphmonth = $this->db->query('SELECT count(id) as total FROM produksi_kph WHERE MONTH(tanggal) = MONTH("'.date('Y-m-d').'") ')->row_object();
        $produksiNonKphmonth = $this->db->query('SELECT count(id) as total FROM produksi_luar_kph WHERE MONTH(tanggal) = MONTH("'.date('Y-m-d').'") ')->row_object();

        $industri = $this->db->get('t_industri')->num_rows();
        $industrimonth = $this->db->query('SELECT count(id) as total FROM t_industri WHERE MONTH(tanggal) = MONTH(CURRENT_DATE) ')->row_object();

        $result = array(
            'status' => 200,
            'message' => 'Berhasil ambil data',
            'data' => array(
                array(
                    'name' => 'KELOMPOK TANI HUTAN',
                    'data' => array(
                        'total' => number_format($kelompoktani,0,'.','.'),
                        'bulan' => number_format($kelompoktanimonth->total,0,'.','.')
                    )
                ),
                array(
                    'name' => 'KEPEMILIKAN LAHAN',
                    'data' => array(
                        'total' => number_format($pemiliklahan,0,'.','.'),
                        'bulan' => number_format($pemiliklahanmonth->total,0,'.','.')
                    )
                ),
                array(
                    'name' => 'PRODUKSI HASIL HUTAN',
                    'data' => array(
                        'total' => number_format($produksiKph+$produksiNonKph,0,'.','.'),
                        'bulan' => number_format($produksiKphmonth->total+$produksiNonKphmonth->total,0,'.','.')
                    )
                ),
                array(
                    'name' => 'LAHAN INDUSTRI',
                    'data' => array(
                        'total' => number_format($industri,0,'.','.'),
                        'bulan' => number_format($industrimonth->total,0,'.','.')
                    )
                )
            )
        );

        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }

    // Geojson kelompoktani
    public function kelompoktani(){
        $kab    = $_GET['kab_id']; 
        $kec    = $_GET['kec_id'];

        $isKab = false;
        $kabId = false;
        $kecId = false;
        if($kab > 0 && $kec > 0){
            // semua desa
            $data = $this->db->query('SELECT a.id as id, a.id AS desaId, a.nama, 
                    CONCAT(a.longitude,",",a.latitude) AS geolocation,  
                    CONCAT("Point") AS geotype, 
                    (SELECT count( aa.id ) FROM kelompok_tani aa
                    WHERE aa.desa_id = desaId ) AS total FROM m_desa AS a
                    WHERE kecamatan_id = '.$kec.' HAVING total > 0')->result_object();
        }else
        if($kab > 0 && empty($kec)){
            // semua kecamatan
            $isKab = true; $kabId = true; $kecId = true;
            $data = $this->db->query('SELECT a.id as id, a.id AS kecId, a.nama, a.geolocation, a.geotype,
                    ( SELECT count( aa.id ) FROM kelompok_tani aa INNER JOIN m_desa bb ON aa.desa_id = bb.id
                    WHERE bb.kecamatan_id = kecId) AS total 
                    FROM m_kecamatan a WHERE a.geotype IS NOT NULL AND kabupaten_id = '.$kab.' HAVING total > 0')->result_object();

        }else{
            // semua kabupaten
            $data = $this->db->query('SELECT a.id as id, a.id as kabId, a.nama, a.geolocation, a.geotype,
                    (SELECT count(aa.id) FROM kelompok_tani aa
                    INNER JOIN m_desa bb ON aa.desa_id = bb.id
                    INNER JOIN m_kecamatan cc ON bb.kecamatan_id = cc.id
                    WHERE cc.kabupaten_id = kabId
                    ) as total FROM m_kabupaten a HAVING total > 0')->result_object();
            $kabId = true; $kecId = false;
        }

        $geoFeatures = '';
        $no = 1; $dot = ''; $color = '';
        foreach($data as $d){

            if($d->total < 100){
                $color = '#95d5b2';
            }else if($d->total > 100 && $d->total < 200){
                $color = '#52b788';
            }else if($d->total > 200 && $d->total < 300){
                $color = '#2d6a4f';
            }else if($d->total > 300){
                $color = '#081c15';
            }else{
                $color = '#d8f3dc';
            };

            if($no++>1) $dot = ',';

            if($isKab){
                $coordinate = $d->geolocation;
            }else{
                $coordinate = '['.$d->geolocation.']';
            }

            $kId = $kabId ? $d->id : 0;
            $cId = $kecId ? $d->id : 0;

            $geoFeatures .= $dot.'{
                            "geometry": {
                                "type": "'.$d->geotype.'",
                                "coordinates": '.$coordinate.'
                            },
                            "type": "Feature",
                            "properties": {
                                "nama": "'.$d->nama.'",
                                "total": "'.number_format($d->total,0,'.','.').'",
                                "kabupaten": "'.$kId.'",
                                "kecamatan": "'.$cId.'"
                            },
                            "style":{
                                "fillColor": "'.$color.'"
                            }
                        }';
        }

        $tmpGeoJson = '{ 
            "type": "FeatureCollection",
            "features": [
                '.$geoFeatures.'
            ]
        }';
		
        $this->output
        ->set_content_type('application/json')
        ->set_output(json_decode(json_encode($tmpGeoJson)));
	}

    public function chartkelompoktani()
    {
        $kab    = $_GET['kab_id']; 
        $kec    = $_GET['kec_id'];

        if($kab > 0 && $kec > 0){
            // semua desa
            $data = $this->db->query('SELECT a.id AS desaId, a.nama,  
                    (SELECT count( aa.id ) FROM kelompok_tani aa
                    WHERE aa.desa_id = desaId ) AS total FROM m_desa AS a
                    WHERE kecamatan_id = '.$kec)->result_object();
            
            $kecamatan = $this->db->query('SELECT nama from m_kecamatan WHERE id = '.$kec)->row_object();
            $title = 'Data Kecamatan '.$kecamatan->nama;
        }else
        if($kab > 0 && empty($kec)){
            // semua kecamatan
            $data = $this->db->query('SELECT a.id AS kecId, a.nama,
                    ( SELECT count( aa.id ) FROM kelompok_tani aa INNER JOIN m_desa bb ON aa.desa_id = bb.id
                    WHERE bb.kecamatan_id = kecId) AS total 
                    FROM m_kecamatan a WHERE a.geotype IS NOT NULL AND kabupaten_id = '.$kab)->result_object();

            $kabupaten = $this->db->query('SELECT nama from m_kabupaten WHERE id = '.$kab)->row_object();
            $title = 'Data '.$kabupaten->nama;
        }else{
            // semua kabupaten
            $data = $this->db->query('SELECT a.id as kabId, a.nama,
                    (SELECT count(aa.id) FROM kelompok_tani aa
                    INNER JOIN m_desa bb ON aa.desa_id = bb.id
                    INNER JOIN m_kecamatan cc ON bb.kecamatan_id = cc.id
                    WHERE cc.kabupaten_id = kabId
                    ) as total
                    FROM m_kabupaten a')->result_object();
            
            $title = 'Data Jawa Barat';
        }

        $labels = []; $fields = [];
        foreach($data as $key => $d){
            $labels[$key] = str_replace("Kabupaten","Kab.",$d->nama);
            $fields[$key] = $d->total;
        }

        $result = array(
            'status' => 200,
            'message' => 'Berhasil ambil data chart kelompok tani',
            'data' =>  array(
                'title' => $title,
                'labels' => $labels,
                'datasets' => array(
                    array(
                        'label' => "Jumlah Data",
                        'data' => $fields,
                        'backgroundColor' => "#003f5c"
                    )
                )
            )
        );

        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($result));

    }

    // Data wilayah

    public function getKabupaten()
    {
        $data = $this->db->query('SELECT id,nama FROM m_kabupaten')->result_object();
        $result = array(
            'status' => 200,
            'message' => 'Berhasil ambil data',
            'data' => $data
        );
        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($result));
    }

    public function getKecamatan($kabID = false)
    {
        if(!$kabID) return 'error';
        $data = $this->db->query('SELECT id,nama FROM m_kecamatan WHERE kabupaten_id = '.$kabID)->result_object();
        $result = array(
            'status' => 200,
            'message' => 'Berhasil ambil data',
            'data' => $data
        );
        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($result));
    }

    public function getDesa($kecID = false)
    {
        if(!$kecID) return 'error';
        $data = $this->db->query('SELECT id,nama FROM m_desa WHERE kecamatan_id = '.$kecID)->result_object();
        $result = array(
            'status' => 200,
            'message' => 'Berhasil ambil data',
            'data' => $data
        );
        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($result));
    }

    public function import()
    {
        $json = file_get_contents(APPPATH.'../assets/geojson/kecamatan.json');
        foreach(json_decode($json)->features as $js){
            $kab = $this->db->get_where('m_kabupaten', ['kode' => $js->properties->KABKOTNO])->row();
            if($kab){
                $this->db->where('nama', ucwords(strtolower($js->properties->KECAMATAN)));
                $this->db->where('kabupaten_id', $kab->id);
                $this->db->update('m_kecamatan', array(
                    'geoid' => $js->properties->OBJECTID,
                    'geotype' => $js->geometry->type,
                    'geolocation' => json_encode($js->geometry->coordinates)
                ));
            }
        }
    }

}