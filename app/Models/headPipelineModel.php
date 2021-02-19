<?php

namespace App\Models;

use CodeIgniter\Model;

class head_salesModel extends Model
{
    protected $table      = 'head_sales';
    protected $primaryKey = 'id_headPipeline';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['id_headPipeline', 'nik' , 'id_client'];

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

    public function nilaijoin($id) {
		$this->db->select('*');
		$this->db->from('detail_sales');
		$this->db->join('head_sales', 'head_sales.id_headPipeline = detail_sales.id_headPipeline', 'left');
		$this->db->where('detail_sales.id_headPipeline',$id);
		return $this->db->get()->result();
	}



}
?>