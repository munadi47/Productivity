<?php namespace App\Models;

use CodeIgniter\Model;

class empstatusModel extends Model
{
    protected $table      = 'employee_status';
    protected $primaryKey = 'id_eStatus';

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_eStatus','status'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}