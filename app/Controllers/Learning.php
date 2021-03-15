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

class Learning extends BaseController{
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->learningModel = new \App\Models\learningModel();
        $this->sales_pipelineModel = new \App\Models\sales_pipelineModel();
        $this->activityModel = new \App\Models\activityModel();
        $this->attendanceModel = new \App\Models\attendanceModel();


    }

    public function index(){
        $session = session();
    
        $data['dataLearning'] = $this->learningModel->JoinLearning();
        $statusEmp['dataAttendance'] = $this->attendanceModel->getStatusAtt();

        echo view ('users/header_v',$statusEmp);
        echo view ('users/learning_v',$data);
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
     
        $data['dataPipeline'] = $this->learningModel->learning();
        $statusEmp['dataAttendance'] = $this->attendanceModel->getStatusAtt();

        echo view('users/header_v',$statusEmp);
        echo view('users/learning_form_v',$data);
        echo view('users/footer_v');
    }

    public function edit($id){
        $where = ['id_learning'=> $id];
        $data['dataLearning'] = $this->learningModel->where($where)->findAll()[0];
        $data['dataPipeline'] = $this->learningModel->learning();
        $statusEmp['dataAttendance'] = $this->attendanceModel->getStatusAtt();


        echo view('users/header_v',$statusEmp);
        echo view('users/learning_form_v',$data);
        echo view ('users/footer_v');
    }

    public function save() {
        
        $id = $this->request->getPost('id_learning');

        if (empty($id)) { //Insert
           
            $data = [
               
                'id_SalesPipeline'=>$this->request->getPost('id_SalesPipeline'),
                'date_deliver'=>$this->request->getPost('date_deliver'),    
                'coach_name'=>$this->request->getPost('coach_name'),
                'method'=>$this->request->getPost('method'),
                'certificate'=>$this->request->getPost('certificate'),
                'remark'=>$this->request->getPost('remark'),    
            ];
            
            $response = $this->learningModel->insert($data);
            $act = 'Insert new Learning data,coach : '.$data['coach_name'];
            $this->record($act,session()->get('nik'));
            
            if($response){
                return redirect()->to(site_url('Learning'))->with('Success', '<i class="fas fa-save"></i> Data has been saved');
            }else{
                return redirect()->to(site_url('Learning'))->with('Failed', '<i class="fas fa-exclamination"></i> Data Failed to save');
            }
            

            
        } else { // Update
            $where = ['id_learning'=>$id];
            $data = [
               
                'id_SalesPipeline'=>$this->request->getPost('id_SalesPipeline'),
                'date_deliver'=>$this->request->getPost('date_deliver'),    
                'coach_name'=>$this->request->getPost('coach_name'),
                'method'=>$this->request->getPost('method'),
                'certificate'=>$this->request->getPost('certificate'),
                'remark'=>$this->request->getPost('remark'),    
            ];
           
            $response = $this->learningModel->update($where, $data);
            $act = 'Update Learning data,coach : '.$data['coach_name'];
            $this->record($act,session()->get('nik'));
            if($response){
                return redirect()->to(site_url('Learning'))->with('Success', '<i class="fas fa-save"></i> Data has been saved');
            }else{
                return redirect()->to(site_url('Learning'))->with('Failed', '<i class="fas fa-exclamination"></i> Data Failed to save');
            }
            
        }

        
    }


    //delete
    public function delete($id){

        $where = ['id_learning'=>$id]; 

    
        
        $response = $this->learningModel->delete($where);
        $act = 'Delete Learning data';
        $this->record($act,session()->get('nik'));
        if($response){
            return redirect()->to(site_url('Learning'))->with('Success', '<i class="fas fa-trash"></i> Data has been deleted');
        }else{
            return redirect()->to(site_url('Learning'))->with('Failed', '<i class="fas fa-exclamination"></i> Data Failed to delete');
        }
        

     
    }




    // Export ke excel
public function export()
{
$dataLearning = $this->learningModel->JoinLearning();
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
->setCellValue('A1', 'ID LEARNING')
->setCellValue('B1', 'CLIENT')
->setCellValue('C1', 'DATE DELIVER')
->setCellValue('D1', 'COACH NAME')
->setCellValue('E1', 'METHOD')
->setCellValue('F1', 'CERTIFICATE')
->setCellValue('G1', 'REMARK')


;

// Miscellaneous glyphs, UTF-8
$i=2; foreach($dataLearning as $row) {

$spreadsheet->setActiveSheetIndex(0)
->setCellValue('A'.$i, $row->id_learning)
->setCellValue('B'.$i, $row->id_client)
->setCellValue('C'.$i, $row->date_deliver)
->setCellValue('D'.$i, $row->coach_name)
->setCellValue('E'.$i, $row->method)
->setCellValue('F'.$i, $row->certificate)
->setCellValue('G'.$i, $row->remark)
;
$i++;
}
$act = 'Export all Learning data to excel';
$this->record($act,session()->get('nik'));

// Rename worksheet
$spreadsheet->getActiveSheet()->setTitle('Learning Data'.date('d-m-Y H'));

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$spreadsheet->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Learning.xlsx"');
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
    public function exportLearning($id)
    {
    $dataLearning = $this->learningModel->exportLearning($id);
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
    ->setCellValue('A1', 'CLIENT')
    ->setCellValue('B1', 'DATE DELIVER')
    ->setCellValue('C1', 'COACH NAME')
    ->setCellValue('D1', 'METHOD')
    ->setCellValue('E1', 'CERTIFICATE')
    ->setCellValue('F1', 'REMARK')
    
    
    ;
    
    // Miscellaneous glyphs, UTF-8
    $i=2; foreach($dataLearning as $row) {
    
    $spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('A'.$i, $row->id_client)
    ->setCellValue('B'.$i, $row->date_deliver)
    ->setCellValue('C'.$i, $row->coach_name)
    ->setCellValue('D'.$i, $row->method)
    ->setCellValue('E'.$i, $row->certificate)
    ->setCellValue('F'.$i, $row->remark)
    ;
    $i++;
    }
    
    // Rename worksheet
    $spreadsheet->getActiveSheet()->setTitle('Client Learning'.date('d-m-Y H'));
    
    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $spreadsheet->setActiveSheetIndex(0);
    
    // Redirect output to a client’s web browser (Xlsx)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Client Learning.xlsx"');
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
    $act = 'Export client Learning data to excel';
    $this->record($act,session()->get('nik'));
    }
    


}