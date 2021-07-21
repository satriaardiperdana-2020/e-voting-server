<?php 
namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\AdminModel;
use App\Models\PemilihModel;
 
class Dashboard extends Controller
{
    public function index()
    {
        helper(['form']);
        return view('dashboard');
    } 
} 