<?php 

use App\Models\authModel;

function allow($level)
{
    $session = \Config\Services::session();
    $user = $session->get('email');
    $table = 'employee';
    $model = new AuthModel();
    $row = $model->get_data_login($user, $table);
    if ($row != NULL){
        if ($row->level == $level){
            return true;
        } else {
            return false;
        }
    }
}