<?php

namespace App\Controllers;

use App\Models\CalonModel;
use App\Models\VotingModel;
use App\Models\PemilihModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Laporan extends BaseController
{
	public function index()
	{
		$calon = new CalonModel();
		$pemilih = new PemilihModel();
		$voting = new VotingModel();

		$data['laporan'] = $calon->findAll();
        for ($i=0; $i < count($data['laporan']); $i++) { 
            $data['laporan'][$i]['voting'] = $voting->findByCalon($data['laporan'][$i]['id_calon']);
        }

		echo view('admin/header');
		echo view('admin/laporan',$data);
		echo view('admin/footer');
	}

	public function view()
	{
		helper("filesystem");

		$calon = new CalonModel();
		$pemilih = new PemilihModel();
		$voting = new VotingModel();

		$data['laporan'] = $calon->findAll();
        for ($i=0; $i < count($data['laporan']); $i++) { 
            $data['laporan'][$i]['voting'] = $voting->findByCalon($data['laporan'][$i]['id_calon']);
			$path = 'uploads/foto/'.$data['laporan'][$i]['foto'];
			$type = pathinfo($path, PATHINFO_EXTENSION);
			$datafile = file_get_contents($path);
			$base64 = 'data:image/' . $type . ';base64,' . base64_encode($datafile);
            $data['laporan'][$i]['base64'] = $base64;
        }
        echo view('admin/export',$data);
	}

	public function export(){
		helper("filesystem");

		$calon = new CalonModel();
		$pemilih = new PemilihModel();
		$voting = new VotingModel();

		$data['laporan'] = $calon->findAll();
        for ($i=0; $i < count($data['laporan']); $i++) { 
            $data['laporan'][$i]['voting'] = $voting->findByCalon($data['laporan'][$i]['id_calon']);
			$path = 'uploads/foto/'.$data['laporan'][$i]['foto'];
			$type = pathinfo($path, PATHINFO_EXTENSION);
			$datafile = file_get_contents($path);
			$base64 = 'data:image/' . $type . ';base64,' . base64_encode($datafile);
            $data['laporan'][$i]['base64'] = $base64;
        }
		$dompdf = new \Dompdf\Dompdf(); 
		$options = $dompdf->getOptions(); 
		$options->set(array('isRemoteEnabled' => true));
		$dompdf->setOptions($options);
        $dompdf->loadHtml(view('admin/export',$data));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('Laporan Voting');
	}

}
