<?php namespace App\Models;

use CodeIgniter\Model;

class financestatusModel extends Model
{
    protected $table      = 'finance_status';
    protected $primaryKey = 'id_fStatus';

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_fStatus','status'];
     	 	 	 	 	 

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

}
