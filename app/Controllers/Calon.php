<?php

namespace App\Controllers;

use App\Models\CalonModel;
use App\Models\VotingModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Calon extends BaseController
{
	public function index()
	{
		$calon = new CalonModel();
        
		$data['calon'] = $calon->findAll();

		echo view('admin/header');
		echo view('admin/calon', $data);
		echo view('admin/footer');
	}

	public function view($slug)
	{
		$calon = new CalonModel();
		$data['calon'] = $calon->where([
			'slug' => $slug
		])->first();

		if (!$data['calon']) {
			throw PageNotFoundException::forPageNotFound();
		}

		return view('admin/calon/view', $data);
	}

	public function tambah()
	{
        $session = session();
		echo view('admin/header');
		echo view('admin/calon/tambah');
		echo view('admin/footer');
	}

	public function save()
	{
        $session = session();
		helper(['form', 'url']);
		if ($this->request->getMethod() !== 'post') {
            return redirect()->to(base_url('calon/tambah'));
        }
		if (!$this->validate([
			'nik' => [
				'rules' => 'required|is_unique[calon.nik]',
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
			'alamat' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
				]
			],
			'tempat_lahir' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
				]
			],
			'tanggal_lahir' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
				]
			],
			'jenis_kelamin' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
				]
			],
			'motto' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
				]
			],
			'foto' => [
				'rules' => 'uploaded[foto]|mime_in[foto,image/jpg,image/jpeg,image/gif,image/png]|max_size[foto,2048]',
				'errors' => [
					'uploaded' => 'Harus Ada File yang diupload',
					'mime_in' => 'File Extention Harus Berupa jpg,jpeg,gif,png',
					'max_size' => 'Ukuran File Maksimal 2 MB'
				]
 
			]
		])) {
			$session->setFlashdata('error', $this->validator->listErrors());
			$this->validator->listErrors();
			return redirect()->back()->withInput();
		}else{
			$calonModel = new CalonModel();
			$dataFoto = $this->request->getFile('foto');
			$fileName = $dataFoto->getRandomName();
			$calonModel->insert([
				'foto' => $fileName,
				'nik' => $this->request->getPost('nik'),
				'nama' => $this->request->getPost('nama'),
				'motto' => $this->request->getPost('motto'),
				'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
				'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
				'tempat_lahir' => $this->request->getPost('tempat_lahir'),
				'alamat' => $this->request->getPost('alamat'),
			]);
			$dataFoto->move('uploads/foto/', $fileName);
			$session->setFlashdata('success', 'Calon Berhasil Ditambah');

			return redirect()->to(base_url('admin/calon'));
		} 
	}

	public function update()
	{
        $session = session();
		helper(['form', 'url']);
		if ($this->request->getMethod() !== 'post') {
            return redirect()->to(base_url('calon/tambah'));
        }
		if (!$this->validate([
			'nama' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
				]
			],
			'alamat' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
				]
			],
			'tempat_lahir' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
				]
			],
			'tanggal_lahir' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
				]
			],
			'jenis_kelamin' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
				]
			],
			'motto' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} Tidak boleh kosong',
				]
			],
			'foto' => [
				'rules' => 'mime_in[foto,image/jpg,image/jpeg,image/gif,image/png]|max_size[foto,2048]',
				'errors' => [
					'mime_in' => 'File Extention Harus Berupa jpg,jpeg,gif,png',
					'max_size' => 'Ukuran File Maksimal 2 MB'
				]
 
			]
		])) {
			$session->setFlashdata('error', $this->validator->listErrors());
			$this->validator->listErrors();
			return redirect()->back()->withInput();
		}else{
			$id = $this->request->getPost('id');
			if(!empty($_FILES['foto']['name'])){
				$dataFoto = $this->request->getFile('foto');
				$fileName = $dataFoto->getRandomName();
				$calonModel = new CalonModel();
				$calonModel->where('id_calon', $id);
				$calonModel->update($id, [
					'foto' => $fileName,
					'nama' => $this->request->getPost('nama'),
					'motto' => $this->request->getPost('motto'),
					'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
					'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
					'tempat_lahir' => $this->request->getPost('tempat_lahir'),
					'alamat' => $this->request->getPost('alamat'),
				]);
				$dataFoto->move('uploads/foto/', $fileName);
			}else{
				$calonModel = new CalonModel();
				$calonModel->where('id_calon', $id);
				$calonModel->update($id, [
					'nama' => $this->request->getPost('nama'),
					'motto' => $this->request->getPost('motto'),
					'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
					'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
					'tempat_lahir' => $this->request->getPost('tempat_lahir'),
					'alamat' => $this->request->getPost('alamat'),
				]);
			}
			$session->setFlashdata('success', 'Calon Berhasil Diupdate');

			return redirect()->to(base_url('admin/calon'));
		} 
	}

	public function edit($id){
        $calonModel = new CalonModel();
		$data['calon'] = $calonModel->where('id_calon', $id)->first();
		echo view('admin/header');
		echo view('admin/calon/edit',$data);
		echo view('admin/footer');
    }

	public function delete($id){
        $votingModel = new VotingModel();
		$votingModel->where('id_calon', $id)->delete();

        $calonModel = new CalonModel();
		$calonModel->where('id_calon', $id)->delete();
        return redirect('admin/calon');
    }
}
