<?php namespace App\Models;

use CodeIgniter\Model;

class consultingModel extends Model
{
    protected $table      = 'consulting';
    protected $primaryKey = 'id_consulting';

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_consulting','id_SalesPipeline','project_name','project_manager','remark','id_chart'];

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
    public function getChart($id)
    {
         return $this->db->table('consulting as c')
         ->join('gantt_chart as g', 'g.id_chart=c.id_chart')
         ->where('g.id_chart',$id)
         ->get()->getResultObject(); 
    }
}