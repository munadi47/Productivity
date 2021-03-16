<?php namespace App\Models;

use CodeIgniter\Model;

class employeeModel extends Model
{
    protected $table      = 'employee';
    protected $primaryKey = 'nik';

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nik','name','email','address','birthday','password','phone1','phone2','level','status','photo'];

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
         ->get()->getResultObject(); 
    }

    public function getDetail($id)
    {
         return $this->db->table('employee')
         ->where('employee.nik',$id)
         ->get()->getResultObject(); 
    }
    
    public function countEmployee()
    {
         return $this->db->table('employee')
         ->select('*')
         ->countAllResults();
 
    }
    public function countClosing($id)
    {
         return $this->db->table('sales_pipeline')
         ->select('*')
         ->where('nik',$id)
         ->countAllResults();
 
    }
    public function countPICClient($id)
    {
         return $this->db->table('client')
         ->select('*')
         ->where('nik',$id)
         ->countAllResults();
 
    }
    
}