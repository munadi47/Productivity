<?php

namespace App\Models;

use CodeIgniter\Model;

class detail_salesModel extends Model
{
    protected $table      = 'detail_sales';
    protected $primaryKey = 'id_detailPipeline';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['id_headPipeline', 'id_product' , 'id_client'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;


public function getHeadSales()
    {
         return $this->db->table('head_sales')
         ->join('employee', 'employee.nik=head_sales.nik')
         ->join('client', 'client.id_client=head_sales.id_client')
         ->get()->getResultObject(); 
    }

}
?>