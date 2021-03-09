<?php namespace App\Models;

use CodeIgniter\Model;

class companyModel extends Model
{
    protected $table      = 'company';
    protected $primaryKey = 'id_company';

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_company','company_name','address','phone','field'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

   
}