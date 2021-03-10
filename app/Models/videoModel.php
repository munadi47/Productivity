<?php namespace App\Models;

use CodeIgniter\Model;

class videoModel extends Model
{
    protected $table      = 'video';
    protected $primaryKey = 'id_video';

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_video','id_SalesPipeline','storyboard_pic','storyboard_date','shooting_pic','shooting_date','editing_pic','editing_date','remark'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

   
    public function JoinVideo()
    {
         return $this->db->table('video')
         ->join('sales_pipeline', 'sales_pipeline.id_SalesPipeline=video.id_SalesPipeline','inner')
        
         ->get()->getResultObject(); 
    }
     
    public function schedule($id)
    {
         return $this->db->table('video')
         ->join('sales_pipeline', 'sales_pipeline.id_SalesPipeline=video.id_SalesPipeline','inner')
         ->where('video.id_video',$id)

         ->get()->getResultObject(); 
    }
    public function get_where($id)
    {
         return $this->db->table('video')
         ->join('sales_pipeline', 'sales_pipeline.id_SalesPipeline=video.id_SalesPipeline','inner')
         ->where('video.id_video',$id)

         ->get()->getResultObject(); 
    }
    public function countVideo()
    {
         return $this->db->table('video')
         ->select('*')
         ->countAllResults();
 
    }
    public function video()
    {
         return $this->db->table('sales_pipeline')
         ->select('*')
         ->where("sales_pipeline.category = 'video'")
         ->get()->getResult();
 
    }
}