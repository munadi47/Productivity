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
   
   
    /*public function countFinance(){
     $query = $this->db->query("SELECT sum(invoice_amount) AS jumlah, YEAR(invoice_date) as tahun FROM finance GROUP BY(tahun) ");
     if($query){
         foreach($query->getResult() as $data){
             $countFinance[] = $data;
         }
        if(!empty($countFinance)){
            return $countFinance;
         } return false;
         
        }
    }*/

    public function deadlineFinance()
    {
        $query = $this->db->query("SELECT id_fStatus,finance.invoice_duedate,finance.id_client FROM finance WHERE finance.invoice_duedate = CURDATE()");
        return $query->getResult();
    }

    public function countFinance(){        
        $date = date('Y');
        $grafik = $this->db->query("
        select 
        ifnull((SELECT sum(invoice_amount) FROM (finance)WHERE((Month(invoice_date)=1)AND (YEAR(invoice_date)=2021))),0) AS `January`,
        ifnull((SELECT sum(invoice_amount) FROM (finance)WHERE((Month(invoice_date)=2)AND (YEAR(invoice_date)=2021))),0) AS `Februari`,
        ifnull((SELECT sum(invoice_amount) FROM (finance)WHERE((Month(invoice_date)=3)AND (YEAR(invoice_date)=2021))),0) AS `Maret`,
        ifnull((SELECT sum(invoice_amount) FROM (finance)WHERE((Month(invoice_date)=4)AND (YEAR(invoice_date)=2021))),0) AS `April`,
        ifnull((SELECT sum(invoice_amount) FROM (finance)WHERE((Month(invoice_date)=5)AND (YEAR(invoice_date)=2021))),0) AS `Mei`,
        ifnull((SELECT sum(invoice_amount) FROM (finance)WHERE((Month(invoice_date)=6)AND (YEAR(invoice_date)=2021))),0) AS `Juni`,
        ifnull((SELECT sum(invoice_amount) FROM (finance)WHERE((Month(invoice_date)=7)AND (YEAR(invoice_date)=2021))),0) AS `Juli`,
        ifnull((SELECT sum(invoice_amount) FROM (finance)WHERE((Month(invoice_date)=8)AND (YEAR(invoice_date)=2021))),0) AS `Agustus`,
        ifnull((SELECT sum(invoice_amount) FROM (finance)WHERE((Month(invoice_date)=9)AND (YEAR(invoice_date)=2021))),0) AS `September`,
        ifnull((SELECT sum(invoice_amount) FROM (finance)WHERE((Month(invoice_date)=10)AND (YEAR(invoice_date)=2021))),0) AS `Oktober`,
        ifnull((SELECT sum(invoice_amount) FROM (finance)WHERE((Month(invoice_date)=11)AND (YEAR(invoice_date)=2021))),0) AS `November`,
        ifnull((SELECT sum(invoice_amount) FROM (finance)WHERE((Month(invoice_date)=12)AND (YEAR(invoice_date)=2021))),0) AS `Desember`
         
        from finance GROUP BY year(invoice_amount)");
        return $grafik;
        //return $query->getResultArray();
        /*if($query){
            foreach($query->getResult() as $data){
                $countAttendance[] = $data;
            }
           if(!empty($countAttendance)){
               return $countAttendance;
            } return false;
            
        }*/
    }

 
}
