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
   

   
   
}