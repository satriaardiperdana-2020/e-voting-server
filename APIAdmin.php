<?php 
namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\AdminModel;
use App\Models\CalonModel;
use App\Models\PemilihModel;
 
class APIAdmin extends Controller
{
	public function login()
    {
        $model = new AdminModel();
		$postjson = json_decode(file_get_contents('php://input'),true);
		
        $data = $model->where([
			'username' => $postjson['username']
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
	            		'id' => $data['id_admin'],
	            		'username' => $data['username'],
	            		'level' => 'admin'
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

	public function cek_nik_calon(){

        $model = new CalonModel();
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

	public function calonAdd(){
		$response = array(
    		'status' => true,
    		'message' => 'Add Calon Berhasil'
        );
		$model = new CalonModel();

		$fileName = $dataFoto->getRandomName();
		$bin = base64_decode($postjson['foto']);

		$im = imageCreateFromString($bin);

		if (!$im) {
			$response = array(
	    		'status' => false,
	    		'message' => 'Add Calon Gagal'
	        );
		  	die();
		}

		$img_file = '/uploads/foto/'+$fileName.".jpg";

		imagepng($im, $img_file, 0);

		$calonModel->insert([
			'foto' => $img_file,
			'nik' => $postjson['nik'],
			'nama' => $postjson['nama'],
			'motto' => $postjson['motto'],
			'jenis_kelamin' => $postjson['jenis_kelamin'],
			'tanggal_lahir' => $postjson['tanggal_lahir'],
			'tempat_lahir' => $postjson['tempat_lahir'],
			'alamat' => $postjson['alamat'],
		]);

		header('Content-Type: application/json');
		echo json_encode($response);
	}

	public function calonUpdate(){
		$model = new CalonModel();
        
		$response = $model->findAll();
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	public function pemilih(){
		$model = new PemilihModel();
        
		$response = $model->findAll();
		header('Content-Type: application/json');
		echo json_encode($response);
	}
}