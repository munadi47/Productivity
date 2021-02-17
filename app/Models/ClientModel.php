<?php namespace App\Models;

use CodeIgniter\Model;

class clientModel extends Model
{
    protected $table      = 'client';
    protected $primaryKey = 'id_client';

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_client','client_name','address','phone','nik'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

   
    public function getClient()
    {
         return $this->db->table('client')
         ->join('employee', 'employee.nik=client.nik')
         ->get()->getResultObject(); 
    }
}