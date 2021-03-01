<?php namespace App\Models;

use CodeIgniter\Model;

class digital_contentModel extends Model
{
    protected $table      = 'digital_content';
    protected $primaryKey = 'id_digital';

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_digital','id_SalesPipeline','storyboard_pic','storyboard_date','voiceover_pic','voiceover_date','animate_pic','animate_date','compile_pic','compile_date','remark'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

   
    public function JoinDigital()
    {
         return $this->db->table('digital_content')
         ->join('sales_pipeline', 'sales_pipeline.id_SalesPipeline=digital_content.id_SalesPipeline')
         ->get()->getResultObject(); 
    }
    public function exportDigital($id)
    {
         return $this->db->table('digital_content')
         ->join('sales_pipeline', 'sales_pipeline.id_SalesPipeline=digital_content.id_SalesPipeline')
         ->where('digital_content.id_digital',$id)
         ->get()->getResultObject(); 
    }

}