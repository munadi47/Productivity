<?php namespace App\Models;

use CodeIgniter\Model;

class classModel extends Model
{
    protected $table      = 'classification';
    protected $primaryKey = 'id_class';

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_class','sector','industry'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

   
   
}