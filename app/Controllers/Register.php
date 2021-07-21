<?php 
namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\AdminModel;
use App\Models\PemilihModel;
 
class Register extends Controller
{
    public function index()
    {
        helper(['form']);
        $data = [];
        return view('register', $data);
    }

    public function save()
    {
        helper(['form']);
        $rules = [
            'nik'          => 'required|is_unique[pemilih.nik]',
            'nama'         => 'required|max_length[50]',
            'password'      => 'required|max_length[50]',
            'confirm-password'  => 'matches[password]'
        ];
         
        if($this->validate($rules)){
            $model = new PemilihModel();
            $data = [
                'nik'     => $this->request->getVar('nik'),
                'nama'    => $this->request->getVar('nama'),
                'password' => $this->request->getVar('password')
            ];
            $model->save($data);
            return redirect()->to('login');
        }else{
            $data['validation'] = $this->validator;
            echo view('register', $data);
        }
         
    }
} 