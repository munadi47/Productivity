<?php namespace App\Models;

use CodeIgniter\Model;

class activityModel extends Model
{
    protected $table      = 'activity_log';
    protected $primaryKey = 'id_log';

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_log','activity_name','nik','datetime'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function joinEmp(){
        return $this->db->table('activity_log')
        ->join('employee','employee.nik = activity_log.nik')
        ->get()->getResultObject();
    }
   

   
   
}