<?php namespace App\Models;

use CodeIgniter\Model;

class productModel extends Model
{
    protected $table      = 'product';
    protected $primaryKey = 'id_product';

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_product','product_name','std_price','id_company'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

   
    public function getProduct()
    {
         return $this->db->table('product')
         ->join('company', 'company.id_company=product.id_company')
         ->get()->getResultObject(); 
    }
}