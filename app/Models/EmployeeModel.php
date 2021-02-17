<?php namespace App\Models;

use CodeIgniter\Model;

class employeeModel extends Model
{
    protected $table      = 'employee';
    protected $primaryKey = 'nik';

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nik','name','email','password','phone1','phone2','id_eStatus','level'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

   
    public function getEmployee()
    {
         return $this->db->table('employee')
         ->join('employee_status', 'employee_status.id_eStatus=employee.id_eStatus')
         ->get()->getResultObject(); 
    }
}