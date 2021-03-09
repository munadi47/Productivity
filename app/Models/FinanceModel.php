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

    public function getInvoice($id)
    {
         return $this->db->table('finance as f')
         ->join('finance_status as fs','fs.id_fStatus=f.id_fStatus')
         ->join('client as c', 'c.id_client=f.id_client')
         ->where('f.id_finance',$id)
         ->get()->getResultObject(); 
    }
   
   
    public function countFinance(){
     $query = $this->db->query("SELECT sum(invoice_amount) AS jumlah, YEAR(invoice_date) as tahun FROM finance GROUP BY(tahun) ");
     if($query){
         foreach($query->getResult() as $data){
             $countFinance[] = $data;
         }
        if(!empty($countFinance)){
            return $countFinance;
         } return false;
         
     }
 }

 
}
