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
         ->join('sales_pipeline', 'sales_pipeline.id_SalesPipeline=video.id_SalesPipeline')
         ->get()->getResultObject(); 
    }
}