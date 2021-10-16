<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_mahasiswa extends CI_Model {
    public function GetAll(){
        return $query = $this->db->get('mahasiswa');
    }

    public function simpan(){
        $data = array(
            'nim' => $this->input->post('nim'),
            'nama' => $this->input->post('nama'),
            'prodi' => $this->input->post('prodi')
        );
        $this->db->insert('mahasiswa', $data);
    }

    public function detailMahasiswa($id){
        $this->db->where('id',$id);
        return $query = $this->db->get('mahasiswa')->row();
    }

    public function update($id, $data){
        $this->db->where('id',$id);
        $this->db->update('mahasiswa', $data);
    }

    public function delete($id){
        $this->db->where('id',$id);
        $this->db->delete('mahasiswa');
    }
}
