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

class Video extends BaseController{
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->videoModel = new \App\Models\videoModel();
        $this->sales_pipelineModel = new \App\Models\sales_pipelineModel();
        $this->activityModel = new \App\Models\activityModel();
        $this->attendanceModel = new \App\Models\attendanceModel();

    }

    public function index(){
        $session = session();
    
        $data['dataVideo'] = $this->videoModel->JoinVideo();
        $data['storyboard'] = $this->videoModel->storyboard();
        $data['shooting'] = $this->videoModel->shooting();
        $data['editing'] = $this->videoModel->editing();
        $statusEmp['dataAttendance'] = $this->attendanceModel->getStatusAtt();

        echo view ('users/header_v',$statusEmp);
        echo view ('users/video_v',$data);
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
     
        $data['dataPipeline'] = $this->videoModel->video();
        $statusEmp['dataAttendance'] = $this->attendanceModel->getStatusAtt();

        echo view('users/header_v',$statusEmp);
        echo view('users/video_form_v',$data);
        echo view('users/footer_v');
    }

  

    public function edit($id){
        $where = ['id_video'=> $id];
        $data['dataVideo'] = $this->videoModel->where($where)->findAll()[0];
        $data['dataPipeline'] = $this->videoModel->video();
        $statusEmp['dataAttendance'] = $this->attendanceModel->getStatusAtt();

        echo view('users/header_v',$statusEmp);
        echo view('users/video_form_v',$data);
        echo view ('users/footer_v');
    }

    public function save() {
        
        $id = $this->request->getPost('id_video');

        if (empty($id)) { //Insert
           
            $data = [
                'storyboard_pic'=>$this->request->getPost('storyboard_pic'),
                'storyboard_date'=>$this->request->getPost('storyboard_date'),
                'shooting_pic'=>$this->request->getPost('shooting_pic'),
                'shooting_date'=>$this->request->getPost('shooting_date'),
                'editing_pic'=>$this->request->getPost('editing_pic'),
                'editing_date'=>$this->request->getPost('editing_date'),
                'remark'=>$this->request->getPost('remark'),
                'id_SalesPipeline'=>$this->request->getPost('id_SalesPipeline'),
                    
            ];
            
            $response = $this->videoModel->insert($data);
            $act = 'Insert new video data, storyboard PIC : '.$data['storyboard_pic'];
            $this->record($act,session()->get('nik'));
            if($response){
                return redirect()->to(site_url('Video'))->with('Success', '<i class="fas fa-save"></i> Data has been saved');
            }else{
                return redirect()->to(site_url('Video'))->with('Failed', '<i class="fas fa-exclamination"></i> Data Failed to save');
            }
            

            
        } else { // Update
            $where = ['id_video'=>$id];
            $data = [
                'storyboard_pic'=>$this->request->getPost('storyboard_pic'),
                'storyboard_date'=>$this->request->getPost('storyboard_date'),
                'shooting_pic'=>$this->request->getPost('shooting_pic'),
                'shooting_date'=>$this->request->getPost('shooting_date'),
                'editing_pic'=>$this->request->getPost('editing_pic'),
                'editing_date'=>$this->request->getPost('editing_date'),
                'remark'=>$this->request->getPost('remark'),
                'id_SalesPipeline'=>$this->request->getPost('id_SalesPipeline'),
                    
            ];
            
         
           
            $response = $this->videoModel->update($where, $data);
            $act = 'Update video data, storyboard PIC : '.$data['storyboard_pic'];
            $this->record($act,session()->get('nik'));
            if($response){
                return redirect()->to(site_url('Video'))->with('Success', '<i class="fas fa-save"></i> Data has been saved');
            }else{
                return redirect()->to(site_url('Video'))->with('Failed', '<i class="fas fa-exclamination"></i> Data Failed to save');
            }
            
        }

        
    }


    //delete
    public function delete($id){

        $where = ['id_video'=>$id]; 

    
        
        $response = $this->videoModel->delete($where);
        $act = 'Delete video data ';
        $this->record($act,session()->get('nik'));
        if($response){
            return redirect()->to(site_url('Video'))->with('Success', '<i class="fas fa-trash"></i> Data has been deleted');
        }else{
            return redirect()->to(site_url('Video'))->with('Failed', '<i class="fas fa-exclamination"></i> Data Failed to delete');
        }
        

     
    }




    // Export ke excel
public function export()
{
$dataVideo = $this->videoModel->JoinVideo();
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
->setCellValue('A1', 'ID VIDEO')
->setCellValue('B1', 'CLIENT')
->setCellValue('C1', 'STORYBOARD PIC')
->setCellValue('D1', 'STORYBOARD DUE DATE')
->setCellValue('E1', 'SHOOTING PIC')
->setCellValue('F1', 'SHOOTING DUE DATE')
->setCellValue('G1', 'EDITING PIC')
->setCellValue('H1', 'EDITING DUE DATE')
->setCellValue('I1', 'REMARK')

;

// Miscellaneous glyphs, UTF-8
$i=2; foreach($dataVideo as $row) {

$spreadsheet->setActiveSheetIndex(0)
->setCellValue('A'.$i, $row->id_video)
->setCellValue('B'.$i, $row->id_client)
->setCellValue('C'.$i, $row->storyboard_pic)
->setCellValue('D'.$i, $row->storyboard_date)
->setCellValue('E'.$i, $row->shooting_pic)
->setCellValue('F'.$i, $row->shooting_date)
->setCellValue('G'.$i, $row->editing_pic)
->setCellValue('H'.$i, $row->editing_date)
->setCellValue('I'.$i, $row->remark)
;
$i++;
}
$act = 'Export all video data to excel';
$this->record($act,session()->get('nik'));

// Rename worksheet
$spreadsheet->getActiveSheet()->setTitle('Video Data'.date('d-m-Y H'));

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$spreadsheet->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Video.xlsx"');
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
    public function exportSchedule($id)
    {
    $dataVideo = $this->videoModel->schedule($id);
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
    ->setCellValue('B1', 'STORYBOARD PIC')
    ->setCellValue('C1', 'STORYBOARD DUE DATE')
    ->setCellValue('D1', 'SHOOTING PIC')
    ->setCellValue('E1', 'SHOOTING DUE DATE')
    ->setCellValue('F1', 'EDITING PIC')
    ->setCellValue('G1', 'EDITING DUE DATE')
    ->setCellValue('H1', 'REMARK')
    
    ;
    
    // Miscellaneous glyphs, UTF-8
    $i=2; foreach($dataVideo as $row) {
    
    $spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('A'.$i, $row->id_client)
    ->setCellValue('B'.$i, $row->storyboard_pic)
    ->setCellValue('C'.$i, $row->storyboard_date)
    ->setCellValue('D'.$i, $row->shooting_pic)
    ->setCellValue('E'.$i, $row->shooting_date)
    ->setCellValue('F'.$i, $row->editing_pic)
    ->setCellValue('G'.$i, $row->editing_date)
    ->setCellValue('H'.$i, $row->remark)
    ;
    $i++;
    }
    $act = 'Export client video data to excel '.$row->id_client;
    $this->record($act,session()->get('nik'));
    
    // Rename worksheet
    $spreadsheet->getActiveSheet()->setTitle('Schedule Video'.date('d-m-Y H'));
    
    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $spreadsheet->setActiveSheetIndex(0);
    
    // Redirect output to a client’s web browser (Xlsx)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Schedule video.xlsx"');
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
    



}