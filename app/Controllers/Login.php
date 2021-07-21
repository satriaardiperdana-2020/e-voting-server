<?php 
namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\AdminModel;
use App\Models\PemilihModel;
 
class Login extends Controller
{
    public function index()
    {
        helper(['form']);
        return view('login');
    } 
 
    public function auth()
    {
        $session = session();
        $model = new PemilihModel();
        $nik = $this->request->getVar('nik');
        $password = $this->request->getVar('password');
        $data = $model->where('nik', $nik)->first();
        if($data){
            $pass = $data['password'];
            $verify_pass = $password == $pass;
            if($verify_pass){
                $ses_data = [
                    'id_pemilih'       => $data['id_pemilih'],
                    'nik'     => $data['nik'],
                    'logged_in'     => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to(base_url('voting'));
            }else{
                $session->setFlashdata('msg', 'Password Salah');
                return redirect()->to(base_url('login'));
            }
        }else{
            $session->setFlashdata('msg', 'NIK Tidak Ditemukan');
            return redirect()->to(base_url('login'));
        }
    }
 
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
} 