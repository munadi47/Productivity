<?php namespace App\Models;

use CodeIgniter\Model;

class sales_pipelineModel extends Model
{
    protected $table      = 'sales_pipeline';
    protected $primaryKey = 'id_SalesPipeline';

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_SalesPipeline','nik','id_client','id_product','date_created','title','count','potential_revenue','total_revenue','status_p'];

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
     $query = $this->db->query("SELECT SUM(total_revenue)as total_closing FROM `sales_pipeline` WHERE sales_pipeline.status_p = 'closing' AND YEAR(CURDATE()) = YEAR(date_created)");
     if($query){
          foreach($query->getResult() as $data){
              $total_closing[] = $data;
          }
         if(!empty($total_closing)){
             return $total_closing;
          } return false;
          
      }
          
     }

    
    public function proposal()
    {
     $query = $this->db->query("SELECT SUM(total_revenue)as total_proposal FROM `sales_pipeline` WHERE sales_pipeline.status_p = 'proposal' AND YEAR(CURDATE()) = YEAR(date_created)");
     if($query){
          foreach($query->getResult() as $data){
              $total_proposal[] = $data;
          }
         if(!empty($total_proposal)){
             return $total_proposal;
          } return false;
          
      }
          
         
         
    }
    public function meeting()
    {
     $query = $this->db->query("SELECT SUM(total_revenue)as total_meeting FROM `sales_pipeline` WHERE sales_pipeline.status_p = 'meeting' AND YEAR(CURDATE()) = YEAR(date_created)");
     if($query){
          foreach($query->getResult() as $data){
              $total_meeting[] = $data;
          }
         if(!empty($total_meeting)){
             return $total_meeting;
          } return false;
          
      }
         
    }
    public function categoryVideo($id){
        $query = $this->db->query('SELECT product.category FROM `product` JOIN sales_pipeline ON sales_pipeline.id_product = product.id_product WHERE product.category = "video" AND sales_pipeline.id_product ='.$id);
        return $query->getRow();
    }
    public function categoryLearning($id){
     $query = $this->db->query('SELECT product.category FROM `product` JOIN sales_pipeline ON sales_pipeline.id_product = product.id_product WHERE product.category = "learning" AND sales_pipeline.id_product ='.$id);
     return $query->getRow();
 }
     public function categoryDigital($id){
          $query = $this->db->query('SELECT product.category FROM `product` JOIN sales_pipeline ON sales_pipeline.id_product = product.id_product WHERE product.category = "digital content" AND sales_pipeline.id_product ='.$id);
          return $query->getRow();
     }
     public function categoryConsulting($id){
          $query = $this->db->query('SELECT product.category FROM `product` JOIN sales_pipeline ON sales_pipeline.id_product = product.id_product WHERE product.category = "consulting" AND sales_pipeline.id_product ='.$id);
          return $query->getRow();
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
    public function countSales()
    {
         return $this->db->table('sales_pipeline')
         ->select('*')
         ->countAllResults();
 
    }


}