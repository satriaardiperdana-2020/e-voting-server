<?php 
namespace App\Models;
 
use CodeIgniter\Model;
 
class PemilihModel extends Model{
    protected $table = 'pemilih';
    protected $allowedFields = ['id_pemilih','nik','nama','password'];
}