<?php 
namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\AdminModel;
use App\Models\CalonModel;
use App\Models\PemilihModel;
use App\Models\VotingModel;
 
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
		$postjson = json_decode(file_get_contents('php://input'),true);

		$fileName = md5(time()).time().".jpg";
        $str = substr(($postjson['foto'].'==='),0, strlen($postjson['foto']) + (strlen($postjson['foto']) % 4));
        $str = str_replace("-",'+',str_replace("_","/",$str));
        $str = substr($str, 0, -1);

        $ifp = fopen( $fileName, 'wb' ); 
    
        $data = explode( ',', $str );
    
        fwrite( $ifp, base64_decode( $data[ 1 ] ) );
    
        fclose( $ifp ); 
        rename($fileName, "uploads/foto/".$fileName);

		$img_file = $fileName;

		$model->insert([
			'foto' => $fileName,
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
		$response = array(
    		'status' => true,
    		'message' => 'Update Calon Berhasil'
        );
		$model = new CalonModel();
		$postjson = json_decode(file_get_contents('php://input'),true);

        if($postjson['foto'] != ''){
            
            $fileName = md5(time()).time().".jpg";
            $str = substr(($postjson['foto'].'==='),0, strlen($postjson['foto']) + (strlen($postjson['foto']) % 4));
            $str = str_replace("-",'+',str_replace("_","/",$str));
            $str = substr($str, 0, -1);

            $ifp = fopen( $fileName, 'wb' ); 
        
            $data = explode( ',', $str );
        
            fwrite( $ifp, base64_decode( $data[ 1 ] ) );
        
            fclose( $ifp ); 
            rename($fileName, "uploads/foto/".$fileName);

            $img_file = $fileName;
            
            $model->where('id_calon', $postjson['id_calon']);
            $model->update($postjson['id_calon'], [
                'foto' => $fileName,
                'nama' => $postjson['nama'],
                'motto' => $postjson['motto'],
                'jenis_kelamin' => $postjson['jenis_kelamin'],
                'tanggal_lahir' => $postjson['tanggal_lahir'],
                'tempat_lahir' => $postjson['tempat_lahir'],
                'alamat' => $postjson['alamat'],
            ]);
        }else{
            $model->where('id_calon', $postjson['id_calon']);
            $model->update($postjson['id_calon'], [
                'nama' => $postjson['nama'],
                'motto' => $postjson['motto'],
                'jenis_kelamin' => $postjson['jenis_kelamin'],
                'tanggal_lahir' => $postjson['tanggal_lahir'],
                'tempat_lahir' => $postjson['tempat_lahir'],
                'alamat' => $postjson['alamat'],
            ]);
        }

		header('Content-Type: application/json');
		echo json_encode($response);
	}

    public function calonDelete(){
        
		$response = array(
    		'status' => true,
    		'message' => 'Delete Calon Berhasil'
        );
		$postjson = json_decode(file_get_contents('php://input'),true);
        $votingModel = new VotingModel();
		$votingModel->where('id_calon', $postjson['id_calon'])->delete();

        $calonModel = new CalonModel();
		$calonModel->where('id_calon', $postjson['id_calon'])->delete();
        
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

	public function laporan(){
        $calon = new CalonModel();
		$pemilih = new PemilihModel();
		$voting = new VotingModel();

		$laporan = $calon->findAll();
        for ($i=0; $i < count($laporan); $i++) { 
            $laporan[$i]['voting'] = $voting->findByCalon($laporan[$i]['id_calon']);
			$type = pathinfo('uploads/foto/'.$laporan[$i]['foto'], PATHINFO_EXTENSION);
			$data = file_get_contents('uploads/foto/'.$laporan[$i]['foto']);
			$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            $laporan[$i]['base64'] = $base64;
        }

        usort($laporan, function($a, $b) {
            return $b['voting'] <=> $a['voting'];
        });

        $response = $laporan;

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