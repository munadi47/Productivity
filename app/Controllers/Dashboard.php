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
        $this->attendanceModel = new \App\Models\attendanceModel();

        
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
       $data['countClosing'] = $this->sales_pipelineModel->closing();
       $data['countProposal'] = $this->sales_pipelineModel->proposal();
       $data['countMeeting'] = $this->sales_pipelineModel->meeting();
       $data['countAttendance'] = $this->attendanceModel->countAttendance();
         
      
        echo view ('users/header_v');
        echo view ('admin/dashboard_v',$data);
        echo view ('users/footer_v');
        
    }

}