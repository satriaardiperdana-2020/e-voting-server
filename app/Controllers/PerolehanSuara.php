<?php

namespace App\Controllers;

use App\Models\CalonModel;
use App\Models\VotingModel;
use App\Models\PemilihModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class PerolehanSuara extends BaseController
{
	public function index()
	{
		$calon = new CalonModel();
		$pemilih = new PemilihModel();
		$voting = new VotingModel();

		$data['perolehan_suara'] = $calon->findAll();
        for ($i=0; $i < count($data['perolehan_suara']); $i++) { 
            $data['perolehan_suara'][$i]['voting'] = $voting->findByCalon($data['perolehan_suara'][$i]['id_calon']);
        }

		echo view('header');
		echo view('perolehan_suara',$data);
		echo view('footer');
	}

}
