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
       //$data['countFinance'] = $this->financeModel->countFinance();
       $data['countClosing'] = $this->sales_pipelineModel->closing();
       $data['countProposal'] = $this->sales_pipelineModel->proposal();
       $data['countMeeting'] = $this->sales_pipelineModel->meeting();
       $data['countAttendance'] = $this->attendanceModel->countAttendance();
       $data['deadlineStory'] = $this->videoModel->deadlineStory();
       $data['deadlineShoot'] = $this->videoModel->deadlineShoot();
       $data['deadlineEdit'] = $this->videoModel->deadlineEdit();
       $data['deadlineStoryDigital'] = $this->digitalModel->deadlineStory();
       $data['deadlineVoice'] = $this->digitalModel->deadlineVoice();
       $data['deadlineAnimate'] = $this->digitalModel->deadlineAnimate();
       $data['deadlineCompile'] = $this->digitalModel->deadlineCompile();
       $data['deadlineFinance'] = $this->financeModel->deadlineFinance();
       $statusEmp['dataAttendance'] = $this->attendanceModel->getStatusAtt();

       foreach($this->attendanceModel->countAttendance()->getResultArray() as $row)
       {
       $data['grafik'][]=(float)$row['January'];
       $data['grafik'][]=(float)$row['Februari'];
       $data['grafik'][]=(float)$row['Maret'];
       $data['grafik'][]=(float)$row['April'];
       $data['grafik'][]=(float)$row['Mei'];
       $data['grafik'][]=(float)$row['Juni'];
       $data['grafik'][]=(float)$row['Juli'];
       $data['grafik'][]=(float)$row['Agustus'];
       $data['grafik'][]=(float)$row['September'];
       $data['grafik'][]=(float)$row['Oktober'];
       $data['grafik'][]=(float)$row['November'];
       $data['grafik'][]=(float)$row['Desember'];

       }

       foreach($this->financeModel->countFinance()->getResultArray() as $f)
       {
       $data['fin'][]=(float)$f['January'];
       $data['fin'][]=(float)$f['Februari'];
       $data['fin'][]=(float)$f['Maret'];
       $data['fin'][]=(float)$f['April'];
       $data['fin'][]=(float)$f['Mei'];
       $data['fin'][]=(float)$f['Juni'];
       $data['fin'][]=(float)$f['Juli'];
       $data['fin'][]=(float)$f['Agustus'];
       $data['fin'][]=(float)$f['September'];
       $data['fin'][]=(float)$f['Oktober'];
       $data['fin'][]=(float)$f['November'];
       $data['fin'][]=(float)$f['Desember'];

       }
        
       $AttToday = $this->attendanceModel->AttToday();
       $paginate = 5;
       $data['AttToday']   = $AttToday->paginate($paginate,'AttToday');
       $data['pager']      = $this->attendanceModel->AttToday()->pager;
        echo view ('admin/header_v_admin',$data,$statusEmp);
        echo view ('admin/dashboard_v',$data);
        echo view ('users/footer_v');
            
        }

}