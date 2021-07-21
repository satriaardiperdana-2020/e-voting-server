<?php

namespace App\Controllers;

use App\Models\CalonModel;
use App\Models\VotingModel;
use App\Models\PemilihModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Voting extends BaseController
{
	public function index()
	{
        $session = session();
		$calon = new CalonModel();
		$voting = new VotingModel();
        
		$id_pemilih = $session->get('id_pemilih');
		$data['voting'] = $calon->findAll();
		$data['jumlah_voting'] = $voting->findByPemilih($id_pemilih);

		echo view('header');
		echo view('voting', $data);
		echo view('footer');
	}

	public function profil($id)
	{
		$calon = new CalonModel();
		$data['calon'] = $calon->where('id_calon',$id)->first();

		echo view('header');
		echo view('profil', $data);
		echo view('footer');
	}

	public function vote($id)
	{
        $session = session();
		$id_pemilih = $session->get('id_pemilih');
		$votingModel = new VotingModel();
		$jumlah_voting = $votingModel->findByPemilih($id_pemilih);
		if ($jumlah_voting > 0) {
			return redirect()->to(base_url('voting'));
		}
		$id_calon = $id;
		$votingModel->insert([
			'id_calon' => $id_calon,
			'id_pemilih' => $id_pemilih,
		]);
		$session->setFlashdata('success', 'Voting Berhasil');

		return redirect()->to(base_url('voting'));
	}
}
