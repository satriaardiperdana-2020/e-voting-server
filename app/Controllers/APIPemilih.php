<?php 
namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\CalonModel;
use App\Models\VotingModel;
use App\Models\PemilihModel;
 
class APIPemilih extends Controller
{
	public function login()
    {
        $model = new PemilihModel();
		$postjson = json_decode(file_get_contents('php://input'),true);
		
        $data = $model->where([
			'nik' => $postjson['nik']
		])->first();
		$response = array(
    		'status' => false,
    		'message' => 'Username atau Password Salah'
        );
		if($data){
            $pass = $data['password'];
            $verify_pass = $postjson['password'] == $pass;
            if($verify_pass){
            	$response = array(
            		'status' => true,
            		'message' => 'Login Berhasil',
            		'data' => array(
	            		'id' => $data['id_pemilih'],
	            		'nama' => $data['nama'],
	            		'nik' => $data['nik'],
	            		'level' => 'pemilih'
            		)
            	);
            }else{
            	$response = array(
            		'status' => false,
            		'message' => 'Username atau Password Salah'
            	);
            }
        }else{
        	$response = array(
        		'status' => false,
        		'message' => 'Username atau Password Salah'
        	);
        }
		header('Content-Type: application/json');
		echo json_encode($response);
    }

	public function calon(){
		$model = new CalonModel();
        
		$response = $model->findAll();
		header('Content-Type: application/json');
		echo json_encode($response);
	}

    public function calonDetail(){
		$postjson = json_decode(file_get_contents('php://input'),true);
        
        $calonModel = new CalonModel();
		$response = $calonModel->where('id_calon', $postjson['id_calon'])->first();
		header('Content-Type: application/json');
		echo json_encode($response);
    }

	public function perolehanSuara(){
        $calon = new CalonModel();
		$pemilih = new PemilihModel();
		$voting = new VotingModel();

		$perolehan_suara = $calon->findAll();
        for ($i=0; $i < count($perolehan_suara); $i++) { 
            $perolehan_suara[$i]['voting'] = $voting->findByCalon($perolehan_suara[$i]['id_calon']);
        }

        usort($perolehan_suara, function($a, $b) {
            return $b['voting'] <=> $a['voting'];
        });

        $response = $perolehan_suara;

		header('Content-Type: application/json');
		echo json_encode($response);
	}

    public function pilihCalon(){
        $response = array(
            'status' => true,
            'message' => 'Voting Berhasil'
        );
		$postjson = json_decode(file_get_contents('php://input'),true);
		$votingModel = new VotingModel();
		$jumlah_voting = $votingModel->findByPemilih($postjson['id_pemilih']);
		if ($jumlah_voting > 0) {
            $response = array(
                'status' => false,
                'message' => 'Sudah Voting'
            );
		}else{
            $votingModel->insert([
                'id_calon' => $postjson['id_calon'],
                'id_pemilih' => $postjson['id_pemilih'],
            ]);
        }
		header('Content-Type: application/json');
		echo json_encode($response);
    }

	public function cek_nik()
    {
        $model = new PemilihModel();
		$postjson = json_decode(file_get_contents('php://input'),true);
		
        $data = $model->where([
			'nik' => $postjson['nik']
		])->first();
		$response = array(
    		'status' => false,
    		'message' => 'NIK Telah Digunakan'
        );
		if($data){
        	$response = array(
        		'status' => false,
        		'message' => 'NIK Telah Digunakan'
        	);
        }else{
        	$response = array(
        		'status' => true,
        		'message' => 'NIK Belum Digunakan'
        	);
        }
		header('Content-Type: application/json');
		echo json_encode($response);
    }

    public function daftar()
    {
        $model = new PemilihModel();
		$postjson = json_decode(file_get_contents('php://input'),true);
		
		$response = array(
    		'status' => true,
    		'message' => 'Daftar Berhasil'
        );
		$model = new PemilihModel();
		$model->insert([
			'nik' => $postjson['nik'],
			'nama' => $postjson['nama'],
			'password' => $postjson['password'],
		]);
		header('Content-Type: application/json');
		echo json_encode($response);
    }
}