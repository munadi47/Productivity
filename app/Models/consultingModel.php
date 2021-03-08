<?php namespace App\Models;

use CodeIgniter\Model;

class consultingModel extends Model
{
    protected $table      = 'consulting';
    protected $primaryKey = 'id_consulting';

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_consulting','id_SalesPipeline','project_name','project_manager','remark','gantt_chart'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

   
    public function JoinConsul()
    {
         return $this->db->table('consulting')
         ->join('sales_pipeline', 'sales_pipeline.id_SalesPipeline=consulting.id_SalesPipeline')
         ->get()->getResultObject(); 
    }

    
    public function exportConsul($id)
    {
         return $this->db->table('consulting')
         ->join('sales_pipeline', 'sales_pipeline.id_SalesPipeline=consulting.id_SalesPipeline')
         ->where('consulting.id_consulting',$id)
         ->get()->getResultObject(); 
    }
    public function countConsulting()
    {
         return $this->db->table('consulting')
         ->select('*')
         ->countAllResults();
 
    }

    
   
    
   
}