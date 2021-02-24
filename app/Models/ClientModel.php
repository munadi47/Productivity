<?php namespace App\Models;

use CodeIgniter\Model;

class clientModel extends Model
{
    protected $table      = 'client';
    protected $primaryKey = 'id_client';

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_client','client_name','id_class','address','phone','nik'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

   
    public function getPIC()
    {
         return $this->db->table('client')
         ->join('employee','employee.nik=client.nik')
         ->join('classification','classification.id_class=client.id_class')
         ->get()->getResultObject(); 
    }
    public function getDetail($id)
    {
        return $this->db->table('client as c')
        ->join('sales_pipeline as sp','sp.id_client=c.id_client')
        ->where('sp.id_client',$id)
        ->get()->getResultObject(); 

    }
}