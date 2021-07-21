<?php 
namespace App\Models;
 
use CodeIgniter\Model;
 
class CalonModel extends Model
{
    protected $table      = 'calon';
    protected $primaryKey = 'id_calon';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_calon', 'nik', 'nama','motto','alamat','jenis_kelamin','tempat_lahir','tanggal_lahir', 'foto'];


    function findByID($id_calon){
        $builder = $this->db->table('calon');
        return $builder->select('*')
            ->where('id_calon',$id_calon)
            ->get(); 
    }
}
