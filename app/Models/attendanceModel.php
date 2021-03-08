<?php namespace App\Models;

use CodeIgniter\Model;

class attendanceModel extends Model
{
    protected $table      = 'log_attendance';
    protected $primaryKey = 'id_attendance';

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_attendance','nik','clock_in','clock_out'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getAttendanceEmp(){
        $builder = $this->table('log_attendance');
        $builder->join('employee','employee.nik = log_attendance.nik');
        //->orderBy('id_log','DESC');
        return $builder;
    }

    public function getATD(){
        return $this->db->table('log_attendance')
        ->join('employee','employee.nik=log_attendance.nik')
        ->get()->getResultObject(); 
    }


    public function update_data($co, $tbl, $id_atd)
    {
        $builder = $this->db->table($tbl);
        $builder->set('clock_out',$co);
        $builder->where('id_attendance',$id_atd);
        $builder->update();
        //$log = $builder->get()->getRow();
        return $builder;
    }   

    public function getId()
    {
        
    }

   

   
   
}