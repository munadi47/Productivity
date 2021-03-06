<?php
namespace App\Controllers;


class Dashboard extends BaseController{
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->sales_pipelineModel = new \App\Models\sales_pipelineModel();
        $this->employeeModel = new \App\Models\employeeModel();
        $this->productModel = new \App\Models\productModel();
        $this->clientModel = new \App\Models\clientModel();
        $this->videoModel = new \App\Models\videoModel();
        $this->learningModel = new \App\Models\learningModel();
        $this->digitalModel = new \App\Models\digital_contentModel();
        $this->consultingModel = new \App\Models\consultingModel();
        $this->financeModel = new \App\Models\FinanceModel();
        
        
    }

    public function index(){
       $data['countSales'] = $this->sales_pipelineModel->countSales();
       $data['countEmployee'] = $this->employeeModel->countEmployee();
       $data['countProduct'] = $this->productModel->countProduct();
       $data['countClient'] = $this->clientModel->countClient();
       $data['countVideo'] = $this->videoModel->countVideo();
       $data['countLearning'] = $this->learningModel->countLearning();
       $data['countDigital'] = $this->digitalModel->countDigital();
       $data['countConsulting'] = $this->consultingModel->countConsulting();
       $data['countFinance'] = $this->financeModel->countFinance();
     
      
         
      
        echo view ('users/header_v');
        echo view ('admin/dashboard',$data);
        echo view ('users/footer_v');
        
    }

}