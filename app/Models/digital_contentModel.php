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
    public function countDigital()
    {
         return $this->db->table('digital_content')
         ->select('*')
         ->countAllResults();
 
    }
    public function digital()
    {
         return $this->db->table('sales_pipeline')
         ->select('*')
         ->where("sales_pipeline.category = 'digital content'")
         ->get()->getResult();
 
    }
    public function storyboard()
    {

         $query = $this->db->query("SELECT digital_content.storyboard_pic AS pic ,digital_content.storyboard_date AS duedate, sales_pipeline.title AS judul FROM digital_content,sales_pipeline WHERE digital_content.id_SalesPipeline = sales_pipeline.id_SalesPipeline");
         if($query){
             foreach($query->getResult() as $data){
                 $storyboard[] = $data;
             }
            if(!empty($storyboard)){
                return $storyboard;
             } return false;
             
         }
 
    }
    public function voiceover()
    {

         $query = $this->db->query("SELECT digital_content.voiceover_pic AS pic ,digital_content.voiceover_date AS duedate, sales_pipeline.title AS judul FROM digital_content,sales_pipeline WHERE digital_content.id_SalesPipeline = sales_pipeline.id_SalesPipeline");
         if($query){
             foreach($query->getResult() as $data){
                 $voiceover[] = $data;
             }
            if(!empty($voiceover)){
                return $voiceover;
             } return false;
             
         }
 
    }
    public function animate()
    {

         $query = $this->db->query("SELECT digital_content.animate_pic AS pic ,digital_content.animate_date AS duedate, sales_pipeline.title AS judul FROM digital_content,sales_pipeline WHERE digital_content.id_SalesPipeline = sales_pipeline.id_SalesPipeline");
         if($query){
             foreach($query->getResult() as $data){
                 $animate[] = $data;
             }
            if(!empty($animate)){
                return $animate;
             } return false;
             
         }
 
    }
    public function compile()
    {

         $query = $this->db->query("SELECT digital_content.compile_pic AS pic ,digital_content.compile_date AS duedate, sales_pipeline.title AS judul FROM digital_content,sales_pipeline WHERE digital_content.id_SalesPipeline = sales_pipeline.id_SalesPipeline");
         if($query){
             foreach($query->getResult() as $data){
                 $compile[] = $data;
             }
            if(!empty($compile)){
                return $compile;
             } return false;
             
         }
 
    }
    public function deadlineStory()
    {
        $query = $this->db->query("SELECT digital_content.storyboard_date,digital_content.storyboard_pic FROM digital_content WHERE digital_content.storyboard_date = CURDATE()");
        return $query->getResult();
 
    }
    public function deadlineVoice()
    {
        $query = $this->db->query("SELECT digital_content.voiceover_date,digital_content.voiceover_pic FROM digital_content WHERE digital_content.voiceover_date = CURDATE()");
        return $query->getResult();
 
    }
    public function deadlineAnimate()
    {
        $query = $this->db->query("SELECT digital_content.animate_date,digital_content.animate_pic FROM digital_content WHERE digital_content.animate_date = CURDATE()");
        return $query->getResult();
 
    }
    public function deadlineCompile()
    {
        $query = $this->db->query("SELECT digital_content.compile_date,digital_content.compile_pic FROM digital_content WHERE digital_content.compile_date = CURDATE()");
        return $query->getResult();
 
    }
    
    


}