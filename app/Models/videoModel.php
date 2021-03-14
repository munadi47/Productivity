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
    public function storyboard()
    {

         $query = $this->db->query("SELECT storyboard_pic AS pic, storyboard_date AS duedate, title AS judul FROM video,sales_pipeline WHERE video.id_SalesPipeline = sales_pipeline.id_SalesPipeline");
         if($query){
             foreach($query->getResult() as $data){
                 $storyboard[] = $data;
             }
            if(!empty($storyboard)){
                return $storyboard;
             } return false;
             
         }
 
    }
    public function shooting()
    {

         $query = $this->db->query("SELECT shooting_pic AS pic, shooting_date AS duedate, title AS judul FROM video,sales_pipeline WHERE video.id_SalesPipeline = sales_pipeline.id_SalesPipeline");
         if($query){
             foreach($query->getResult() as $data){
                 $shooting[] = $data;
             }
            if(!empty($shooting)){
                return $shooting;
             } return false;
             
         }
 
    }
    public function editing()
    {

         $query = $this->db->query("SELECT editing_pic AS pic, editing_date AS duedate, title AS judul FROM video,sales_pipeline WHERE video.id_SalesPipeline = sales_pipeline.id_SalesPipeline");
         if($query){
             foreach($query->getResult() as $data){
                 $editing[] = $data;
             }
            if(!empty($editing)){
                return $editing;
             } return false;
             
         }
 
    }

    public function deadlineStory()
    {
        $query = $this->db->query("SELECT video.storyboard_date,video.storyboard_pic FROM video WHERE video.storyboard_date = CURDATE()");
        return $query->getResult();
 
    }

    public function deadlineShoot()
    {

        $query = $this->db->query("SELECT video.shooting_date,video.shooting_pic FROM video WHERE video.shooting_date = CURDATE()");
        return $query->getResult();
 
 
    }
    public function deadlineEdit()
    {

        $query = $this->db->query("SELECT video.editing_date,video.editing_pic FROM video WHERE video.editing_date = CURDATE()");
        return $query->getResult();
 
    }
}