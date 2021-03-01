<?php namespace App\Models;

use CodeIgniter\Model;

class authModel extends Model
{
    protected $table      = 'employee';
    protected $primaryKey = 'nik';

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nik','name','email','address','birthday','password','phone1','phone2','id_eStatus','level','photo'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function get_data_login($email, $tbl)
    {
        $builder = $this->db->table($tbl);
        $builder->where('email',$email);
        $log = $builder->get()->getRow();
        return $log;
    }   
   
}