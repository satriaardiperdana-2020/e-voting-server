<?php 
namespace App\Models;
 
use CodeIgniter\Model;
 
class VotingModel extends Model{
    protected $table = 'voting';
    protected $allowedFields = ['id_voting','id_pemilih','id_calon','tanggal'];

    function findByPemilih($id_pemilih){
        $builder = $this->db->table('voting');
        return $builder->select('*')
            ->where('id_pemilih',$id_pemilih)
            ->countAllResults(); 
    }

    function findByCalon($id_calon){
        $builder = $this->db->table('voting');
        return $builder->select('*')
            ->where('id_calon',$id_calon)
            ->countAllResults(); 
    }
}