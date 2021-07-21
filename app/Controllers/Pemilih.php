<?php

namespace App\Controllers;

use App\Models\CalonModel;
use App\Models\VotingModel;
use App\Models\PemilihModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Pemilih extends BaseController
{
	public function index()
	{
		$pemilih = new PemilihModel();
        
		$data['pemilih'] = $pemilih->findAll();

		echo view('admin/header');
		echo view('admin/pemilih', $data);
		echo view('admin/footer');
	}

	public function tambah()
	{
        $session = session();
		echo view('admin/header');
		echo view('admin/pemilih/tambah');
		echo view('admin/footer');
	}

	public function save()
	{
        $session = session();
		helper(['form', 'url']);
		if ($this->request->getMethod() !== 'post') {
            return redirect()->to(base_url('pemilih/tambah'));
        }
		if (!$this->validate([
			'nik' => [
				'rules' => 'required|is_unique[pemilih.nik]',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
					'is_unique' => '{field} Sudah Digunakan',
				]
			],
			'nama' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
				]
			],
			'password' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
				]
			]
		])) {
			$session->setFlashdata('error', $this->validator->listErrors());
			$this->validator->listErrors();
			return redirect()->back()->withInput();
		}else{
			$pemilihModel = new PemilihModel();
			$pemilihModel->insert([
				'nik' => $this->request->getPost('nik'),
				'nama' => $this->request->getPost('nama'),
				'password' => $this->request->getPost('password'),
			]);
			$session->setFlashdata('success', 'Permilih Berhasil Register');

			return redirect()->to(base_url('admin/pemilih'));
		} 
	}
}
