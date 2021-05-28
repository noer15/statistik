<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_jasa extends CI_Model
{
    public function update($p){
        return $this->db->where("id", $p["id"])
                        ->update("jasa_lingkungan", $p);
    }

    public function update_sarpras($p){
        return $this->db->where("id", $p["id"])
                        ->update("sarpras", $p);
    }

    public function input_data($data,$table){
        $this->db->insert($table,$data);
    }

    public function input_sarpras($data,$table){
        $this->db->insert($table,$data);
    }

    // penataan
    public function input_penataan($data,$table){
        $this->db->insert($table,$data);
    }
    public function update_penataan($p){
        return $this->db->where("id", $p["id"])
                        ->update("penataan", $p);
    }

     // benih
    public function input_benih($data,$table){
        $this->db->insert($table,$data);
    }
    public function update_benih($p){
        return $this->db->where("id", $p["id"])
                        ->update("benih", $p);
    }

    // rehabilitas
    public function input_rehabilitas($data,$table){
        $this->db->insert($table,$data);
    }
    public function update_rehabilitas($p){
        return $this->db->where("id", $p["id"])
                        ->update("rehabilitas", $p);
    }

    // persemaian
    public function input_persemaian($data,$table){
        $this->db->insert($table,$data);
    }
    public function update_persemaian($p){
        return $this->db->where("id", $p["id"])
                        ->update("persemaian", $p);
    }

    // penanaman
    public function input_penanaman($data,$table){
        $this->db->insert($table,$data);
    }
    public function update_penanaman($p){
        return $this->db->where("id", $p["id"])
                        ->update("penanaman", $p);
    }
}
