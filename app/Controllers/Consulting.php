<?php
namespace App\Controllers;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
require('../excel/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
// End load library phpspreadsheet

use CodeIgniter\HTTP\Files\UploadedFile;


use mysqli;
use phpDocumentor\Reflection\PseudoTypes\False_;

class Consulting extends BaseController{
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->consultingModel = new \App\Models\consultingModel();
        $this->sales_pipelineModel = new \App\Models\sales_pipelineModel();
        $this->activityModel = new \App\Models\activityModel();
        helper(['form', 'url']);
       
    }

    public function index(){
        $session = session();
        $data['validation'] = $this->validator;
        $data['dataConsul'] = $this->consultingModel->JoinConsul();
        echo view ('users/header_v');
        echo view ('users/consul_v',$data);
        echo view ('users/footer_v');
        
    }
    public function record ($activity_name,$nik) { //method untuk merekam aktivitas
        date_default_timezone_set("Asia/Jakarta");
        $toRecord = [
            'activity_name'=>$activity_name, 	 	 
            'nik'=> $nik,
            'datetime'=> date('Y-m-d H:i:s'),      ];
        $result = $this->activityModel->insert($toRecord); // simpan data ke tabel
  
         if(!$result):
            return false;
         endif;
         return $result;
  
     }


   

    public function add(){
        $data['dataPipeline'] = $this->consultingModel->consulting();

        echo view('users/header_v');
        echo view('users/consul_form_v',$data);
        echo view('users/footer_v');
    }

    public function edit($id){
        $where = ['id_consulting'=> $id];
        $data['dataConsul'] = $this->consultingModel->where($where)->findAll()[0];
        $data['dataPipeline'] = $this->consultingModel->consulting();

        echo view('users/header_v');
        echo view('users/consul_form_v',$data);
        echo view ('users/footer_v');
    }
    public function view_pdf($id){
        $where = ['id_consulting'=> $id];
        $data['dataConsul'] = $this->consultingModel->where($where)->findAll()[0];

        echo view('users/header_v');
        echo view('users/pdf_v',$data);
        echo view ('users/footer_v');
    }
    

    public function save() {
      
        $id = $this->request->getPost('id_consulting');

        if (empty($id)) { //Insert
           
            $validation = $this->validate([
                'gantt_chart' => [
                    'uploaded[gantt_chart]',
                    'mime_in[gantt_chart,application/pdf,application/zip,application/msword,application/x-tar]',
                    'max_size[gantt_chart,5000]',
                ]
            ]);
            
            if (!$validation){
                $data = [
                    'remark'=>$this->request->getPost('remark'),
                    'project_name'=>$this->request->getPost('project_name'),
                    'project_manager'=>$this->request->getPost('project_manager'),
                    'id_SalesPipeline'=>$this->request->getPost('id_SalesPipeline'),
                    
                ];
                $this->consultingModel->insert($data);
                $act = 'Insert new consulting data '.$data['project_name'];
                $this->record($act,session()->get('nik'));
               
            }else{
                $gantt_chart = $this->request->getFile('gantt_chart');
                $gantt_chart->move('assets/uploads/');
                $data = [
                    'remark'=>$this->request->getPost('remark'),
                    'project_name'=>$this->request->getPost('project_name'),
                    'project_manager'=>$this->request->getPost('project_manager'),
                    'id_SalesPipeline'=>$this->request->getPost('id_SalesPipeline'),
                    'gantt_chart'=> $gantt_chart->getName(),
                ];
                $this->consultingModel->insert($data);
                $act = 'Insert new consulting data '.$data['project_name'];
                $this->record($act,session()->get('nik'));
                
                
            }
           
          
            

            
        } else { // Update
            $where = ['id_consulting'=>$id];
            $validation= $this->validate([
                'gantt_chart' => [
                    'uploaded[gantt_chart]',
                    'mime_in[gantt_chart,application/pdf,application/zip,application/msword,application/jpg,application/png,application/x-tar]',
                    'max_size[gantt_chart,5000]',
                ]
            ]);
          
            
            if (!$validation){
                $data = [
                    'remark'=>$this->request->getPost('remark'),
                    'project_name'=>$this->request->getPost('project_name'),
                    'project_manager'=>$this->request->getPost('project_manager'),
                    'id_SalesPipeline'=>$this->request->getPost('id_SalesPipeline'),
                    
                ];
                $this->consultingModel->update($where,$data);
                $act = 'Update consulting data '.$data['project_name'];
                $this->record($act,session()->get('nik'));
            
            
            }else{
                $dt = $this->consultingModel->getWhere(['id_consulting'=>$id])->getRow();
                $file1 = $dt->gantt_chart;
                $path = 'assets/uploads/';
                @unlink($path.$file1);
                    $gantt_chart = $this->request->getFile('gantt_chart');
                    $gantt_chart->move('assets/uploads/');
               
                $data = [
                    'remark'=>$this->request->getPost('remark'),
                    'project_name'=>$this->request->getPost('project_name'),
                    'project_manager'=>$this->request->getPost('project_manager'),
                    'id_SalesPipeline'=>$this->request->getPost('id_SalesPipeline'),
                    'gantt_chart'=> $this->request->getFile('gantt_chart')->getName()  
                ];
                $this->consultingModel->update($where,$data);
                $act = 'Update consulting data '.$data['project_name'];
                $this->record($act,session()->get('nik'));   
               
            }
            
           
           
            
        }
        return redirect()->to(site_url('Consulting'))->with('Success', '<i class="fas fa-save"></i> Data has been saved');

        
    }


   


    //delete
    public function delete($id){

        $where = ['id_consulting'=>$id]; 
        $dt = $this->consultingModel->getWhere(['id_consulting'=>$id])->getRow();
        $gantt_chart = $dt->gantt_chart;
        $path = 'assets/uploads/';
        @unlink($path.$gantt_chart);
        
        $response = $this->consultingModel->delete($where);
        $act = 'Delete consulting data ';
        $this->record($act,session()->get('nik'));
        if($response){
            return redirect()->to(site_url('Consulting'))->with('Success', '<i class="fas fa-trash"></i> Data has been deleted');
        }else{
            return redirect()->to(site_url('Consulting'))->with('Failed', '<i class="fas fa-exclamination"></i> Data Failed to delete');
        }
        

     
    }
   
    



   // Export ke excel
public function export()
{
$dataConsul = $this->consultingModel->JoinConsul();
// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();


// Set document properties
$spreadsheet->getProperties()->setTitle('Office 2007 XLSX Test Document')
->setSubject('Office 2007 XLSX Test Document')
->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
->setKeywords('office 2007 openxml php')
->setCategory('Test result file');

// Add some data
$spreadsheet->setActiveSheetIndex(0)
->setCellValue('A1', 'ID CONSULTING')
->setCellValue('B1', 'TITLE')
->setCellValue('C1', 'ID CLIENT')
->setCellValue('D1', 'PROJECT NAME')
->setCellValue('E1', 'PROJECT MANAGER')
->setCellValue('F1', 'REMARK')


;

// Miscellaneous glyphs, UTF-8
$i=2; foreach($dataConsul as $row) {

$spreadsheet->setActiveSheetIndex(0)
->setCellValue('A'.$i, $row->id_consulting)
->setCellValue('B'.$i, $row->title)
->setCellValue('C'.$i, $row->id_client)
->setCellValue('D'.$i, $row->project_name)
->setCellValue('E'.$i, $row->project_manager)
->setCellValue('F'.$i, $row->remark)

;
$i++;
$act = 'Export all consulting data to excel ';
$this->record($act,session()->get('nik'));
}

// Rename worksheet
$spreadsheet->getActiveSheet()->setTitle('Consulting Data'.date('d-m-Y H'));

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$spreadsheet->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Consulting Report.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
exit;

}




   // Export ke excel
   public function Report($id)
   {
   $dataConsul = $this->consultingModel->exportConsul($id);
   // Create new Spreadsheet object
   $spreadsheet = new Spreadsheet();
   
   
   // Set document properties
   $spreadsheet->getProperties()->setTitle('Office 2007 XLSX Test Document')
   ->setSubject('Office 2007 XLSX Test Document')
   ->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
   ->setKeywords('office 2007 openxml php')
   ->setCategory('Test result file');
   
   // Add some data
   $spreadsheet->setActiveSheetIndex(0)
   ->setCellValue('A1', 'TITLE')
   ->setCellValue('B1', 'ID CLIENT')
   ->setCellValue('C1', 'PROJECT NAME')
   ->setCellValue('D1', 'PROJECT MANAGER')
   ->setCellValue('E1', 'REMARK')
   
   
   ;
   
   // Miscellaneous glyphs, UTF-8
   $i=2; foreach($dataConsul as $row) {
   
   $spreadsheet->setActiveSheetIndex(0)
   ->setCellValue('A'.$i, $row->title)
   ->setCellValue('B'.$i, $row->id_client)
   ->setCellValue('C'.$i, $row->project_name)
   ->setCellValue('D'.$i, $row->project_manager)
   ->setCellValue('E'.$i, $row->remark)
   
   ;
   $i++;
   
   }
   $act = 'Export consulting data to excel '.$row->project_name;
    $this->record($act,session()->get('nik'));
   
   // Rename worksheet
   $spreadsheet->getActiveSheet()->setTitle('Client Consulting'.date('d-m-Y H'));
   
   // Set active sheet index to the first sheet, so Excel opens this as the first sheet
   $spreadsheet->setActiveSheetIndex(0);
   
   // Redirect output to a client’s web browser (Xlsx)
   header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
   header('Content-Disposition: attachment;filename="Client Consulting.xlsx"');
   header('Cache-Control: max-age=0');
   // If you're serving to IE 9, then the following may be needed
   header('Cache-Control: max-age=1');
   
   // If you're serving to IE over SSL, then the following may be needed
   header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
   header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
   header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
   header('Pragma: public'); // HTTP/1.0
   
   $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
   $writer->save('php://output');
   exit;
   $act = 'Export client consulting data to excel';
   $this->record($act,session()->get('nik'));
   }


}