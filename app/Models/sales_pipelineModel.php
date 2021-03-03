<?php namespace App\Models;

use CodeIgniter\Model;

class sales_pipelineModel extends Model
{
    protected $table      = 'sales_pipeline';
    protected $primaryKey = 'id_SalesPipeline';

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_SalesPipeline','nik','id_client','id_product','category','title','count','potential_revenue','total_revenue','status'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

   
    public function JoinPipeline()
    {
         return $this->db->table('sales_pipeline')
         ->join('employee', 'employee.nik=sales_pipeline.nik')
         ->join('client', 'client.id_client=sales_pipeline.id_client')
         ->join('product', 'product.id_product=sales_pipeline.id_product')
         ->get()->getResultObject(); 
    }
    public function closing()
    {
         return $this->db->table('sales_pipeline')
         ->where('sales_pipeline.status','closing')
         ->countAllResults();
         
         
    }
    public function proposal()
    {
         return $this->db->table('sales_pipeline')
         ->where('sales_pipeline.status','proposal')
         ->countAllResults();
         
         
    }
    public function meeting()
    {
         return $this->db->table('sales_pipeline')
         ->where('sales_pipeline.status','meeting')
         ->countAllResults();
         
         
    }
    public function statVideo($id)
    {
         $query = $this->db->query('select id_SalesPipeline from video where id_SalesPipeline ='.$id);
         return $query->getRow();
         
    }
    public function statLearning($id)
    {
         $query = $this->db->query('select id_SalesPipeline from learning where id_SalesPipeline ='.$id);
         return $query->getRow();
         
    }
    public function statDigital($id)
    {
         $query = $this->db->query('select id_SalesPipeline from digital_content where id_SalesPipeline ='.$id);
         return $query->getRow();
         
    }
    public function statConsulting($id)
    {
         $query = $this->db->query('select id_SalesPipeline from consulting where id_SalesPipeline ='.$id);
         return $query->getRow();
         
    }


}