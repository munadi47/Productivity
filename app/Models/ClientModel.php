<?php namespace App\Models;

use CodeIgniter\Model;

class clientModel extends Model
{
    protected $table      = 'client';
    protected $primaryKey = 'id_client';

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_client','id_class','address','phone','nik'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

   
    public function getPIC()
    {
         return $this->db->table('client')
         ->join('employee','employee.nik=client.nik')
         ->join('classification','classification.id_class=client.id_class')
         ->get()->getResultObject(); 
    }
    public function getDetail($id)
    {
        $builder = $this->table('client');
        $builder->join('sales_pipeline','sales_pipeline.id_client=client.id_client')
        ->where('sales_pipeline.id_client',$id);
        return $builder;
    }
    public function exportClient($id)
    {
        return $this->db->table('client')
        ->join('sales_pipeline', 'sales_pipeline.id_client=client.id_client','inner')
        ->where('client.id_client',$id)

        ->get()->getResultObject(); 
    }
    public function search($keyword,$id){
        $builder = $this->table('client');
        $builder->join('sales_pipeline','sales_pipeline.id_client=client.id_client')
        ->where('sales_pipeline.id_client',$id)
        ->like('id_client',$keyword)
        ->orLike('category',$keyword)
        ->orLike('count',$keyword)
        ->orLike('total_revenue',$keyword)
        ->orLike('title',$keyword);
        return $builder;
    }
    public function countClient()
    {
         return $this->db->table('client')
         ->select('*')
         ->countAllResults();
 
    }
    
}