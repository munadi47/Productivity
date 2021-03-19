<?php namespace App\Models;

use CodeIgniter\Model;

class learningModel extends Model
{
    protected $table      = 'learning';
    protected $primaryKey = 'id_learning';

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_learning','id_SalesPipeline','topic','date_deliver','coach_name','method','certificate','remark'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

   
    public function JoinLearning()
    {
         return $this->db->table('learning')
         ->join('sales_pipeline', 'sales_pipeline.id_SalesPipeline=learning.id_SalesPipeline')
         ->get()->getResultObject(); 
    }
    
    public function exportLearning($id)
    {
         return $this->db->table('learning')
         ->join('sales_pipeline', 'sales_pipeline.id_SalesPipeline=learning.id_SalesPipeline')
         ->where('learning.id_learning',$id)
         ->get()->getResultObject(); 
    }
    public function countLearning()
    {
         return $this->db->table('learning')
         ->select('*')
         ->countAllResults();
 
    }
    public function learning()
    {
         return $this->db->table('sales_pipeline')
         ->select('*')
         ->where("sales_pipeline.category = 'learning'")
         ->get()->getResult();
 
    }
}