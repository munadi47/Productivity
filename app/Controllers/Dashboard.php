<?php
namespace App\Controllers;


class Dashboard extends BaseController{
    public function __construct()
    {
        $this->session = \Config\Services::session();
        
    }

    public function index(){
       
        echo view ('users/header_v');
        echo view ('admin/dashboard');
        echo view ('users/footer_v');
        
    }

}