<?php 
namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\AdminModel;
use App\Models\PemilihModel;
 
class AdminLogin extends Controller
{
    public function index()
    {
        helper(['form']);
        return view('admin');
    } 
 
    public function auth()
    {
        $session = session();
        $model = new AdminModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $data = $model->where('username', $username)->first();
        if($data){
            $pass = $data['password'];
            $verify_pass = $password == $pass;
            if($verify_pass){
                $ses_data = [
                    'id_admin'       => $data['id_admin'],
                    'username'     => $data['username'],
                    'logged_in'     => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to(base_url('admin/calon'));
            }else{
                $session->setFlashdata('msg', 'Username atau Password Salah');
                return redirect()->to(base_url('admin'));
            }
        }else{
            $session->setFlashdata('msg', 'Username atau Password Salah');
            return redirect()->to(base_url('admin/calon'));
        }
    }
 
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/admin');
    }
} 