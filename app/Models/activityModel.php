<?php namespace App\Models;

use CodeIgniter\Model;

class activityModel extends Model
{
    protected $table      = 'activity_log';
    protected $primaryKey = 'id_log';

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_log','activity_name','nik','datetime'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function joinEmp(){
        return $this->db->table('activity_log')
        ->join('employee','employee.nik = activity_log.nik')
        ->get()->getResultObject();
    }
    public function record ($activity_name,$nik) { //method untuk merekam aktivitas

        $toRecord = array();
        $toRecord['activity_name'] = $activity_name;
        $toRecord['datetime'] = date("Y-m-d h:i:s");
        $toRecord['nik'] = $nik;
  
        $result = $this->database->insert('activity_log', $toRecord); // simpan data ke tabel
  
         if(!$result):
            return false;
         endif;
         return $result;
  
     }

   
   
}