<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('m_mahasiswa');
	}
	public function index()
	{
		$data['konten'] = 'v_mahasiswa';
		$data['mahasiswa'] = $this->m_mahasiswa->GetAll()->result();
		$this->load->view('v_template', $data);
	}

	public function tambah()
	{
		$data['konten'] = 'v_tambah';
		$this->load->view('v_template', $data);
	}

	public function edit($id){
		$data['konten'] = 'v_edit';
		$data['detailMahasiswa'] = $this->m_mahasiswa->detailMahasiswa($id);
		$this->load->view('v_template', $data);
	}

	public function update(){
		$id = $this->input->post('id');
		$nim = $this->input->post('nim');
		$nama = $this->input->post('nama');
		$prodi = $this->input->post('prodi');

		$arrUpdate = array(
			'id' => $id,
			'nim' => $nim,
			'nama' => $nama,
			'prodi' => $prodi,
		);
	
		$this->m_mahasiswa->update($id, $arrUpdate);
		redirect('mahasiswa');
	}

	public function delete($id){
		$this->m_mahasiswa->delete($id);
		redirect('mahasiswa');
	}


	public function simpan()
	{
		$this->form_validation->set_rules('nim', 'NIM', 'required|trim|is_unique[mahasiswa.nim]');
		$this->form_validation->set_rules('nim', 'Nama', 'required|trim');
		$this->form_validation->set_rules('prodi', 'Prodi', 'required|trim');
		
		$this->form_validation->set_message('is_unique', '{field} sudah terdaftar');

		if($this->form_validation->run() == false){
			$this->tambah();
		}else{
			//data masukan ke database
			$this->m_mahasiswa->simpan();

			$this->session->set_flashdata('message', '<div class="alert alert-success">Data berhasil ditambahkan</div>');
			redirect('mahasiswa');
		}
	}
}
