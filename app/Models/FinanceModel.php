<?php namespace App\Models;

use CodeIgniter\Model;

class financeModel extends Model
{
    protected $table      = 'finance';
    protected $primaryKey = 'id_finance';

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_finance','id_client','id_fStatus','invoice_date','invoice_amount','invoice_duedate'];
     	 	 	 	 	 

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

   
    public function getStatusFinance()
    {
         return $this->db->table('finance')
         ->join('finance_status','finance_status.id_fStatus=finance.id_fStatus')
         ->join('client', 'client.id_client=finance.id_client')
         ->get()->getResultObject(); 
    }
}
