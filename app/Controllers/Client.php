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

class Client extends BaseController{
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->clientModel = new \App\Models\clientModel();
        $this->employeeModel = new \App\Models\employeeModel();
        $this->classModel = new \App\Models\classModel();
        $this->activityModel = new \App\Models\activityModel();
        $this->attendanceModel = new \App\Models\attendanceModel();
        $this->videoModel = new \App\Models\videoModel();
        $this->digitalModel = new \App\Models\digital_contentModel();
        $this->financeModel = new \App\Models\FinanceModel();
        
        $this->pager = \Config\Services::pager();
        date_default_timezone_set("Asia/Jakarta");

      
    }

    public function index(){
        $session = session();
        $data['dataClient'] = $this->clientModel->getPIC();
        $notif['deadlineStory'] = $this->videoModel->deadlineStory();
        $notif['deadlineShoot'] = $this->videoModel->deadlineShoot();
        $notif['deadlineEdit'] = $this->videoModel->deadlineEdit();
        $notif['deadlineStoryDigital'] = $this->digitalModel->deadlineStory();
        $notif['deadlineVoice'] = $this->digitalModel->deadlineVoice();
        $notif['deadlineAnimate'] = $this->digitalModel->deadlineAnimate();
        $notif['deadlineCompile'] = $this->digitalModel->deadlineCompile();
        $notif['deadlineFinance'] = $this->financeModel->deadlineFinance();
        $notif['dataAttendance'] = $this->attendanceModel->getStatusAtt();

        echo view ('users/header_v',$notif);
        echo view ('users/client_v',$data);
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
        $data['dataEmployee']  = $this->employeeModel->findAll();
        $data['dataClass']  = $this->classModel->findAll();
        $notif['deadlineStory'] = $this->videoModel->deadlineStory();
        $notif['deadlineShoot'] = $this->videoModel->deadlineShoot();
        $notif['deadlineEdit'] = $this->videoModel->deadlineEdit();
        $notif['deadlineStoryDigital'] = $this->digitalModel->deadlineStory();
        $notif['deadlineVoice'] = $this->digitalModel->deadlineVoice();
        $notif['deadlineAnimate'] = $this->digitalModel->deadlineAnimate();
        $notif['deadlineCompile'] = $this->digitalModel->deadlineCompile();
        $notif['deadlineFinance'] = $this->financeModel->deadlineFinance();
        $notif['dataAttendance'] = $this->attendanceModel->getStatusAtt();

        echo view('users/header_v',$notif);
        echo view('users/client_form_v',$data);
        echo view('users/footer_v');
    }

    public function edit($id){
        $where = ['id_client'=> $id];
        $data['dataClass']  = $this->classModel->findAll();
        $data['dataEmployee']  = $this->employeeModel->findAll();
        $data['dataClient'] = $this->clientModel->where($where)->findAll()[0];
        $notif['deadlineStory'] = $this->videoModel->deadlineStory();
        $notif['deadlineShoot'] = $this->videoModel->deadlineShoot();
        $notif['deadlineEdit'] = $this->videoModel->deadlineEdit();
        $notif['deadlineStoryDigital'] = $this->digitalModel->deadlineStory();
        $notif['deadlineVoice'] = $this->digitalModel->deadlineVoice();
        $notif['deadlineAnimate'] = $this->digitalModel->deadlineAnimate();
        $notif['deadlineCompile'] = $this->digitalModel->deadlineCompile();
        $notif['deadlineFinance'] = $this->financeModel->deadlineFinance();
        $notif['dataAttendance'] = $this->attendanceModel->getStatusAtt();

        echo view('users/header_v',$notif);
        echo view('users/client_edit_form_v',$data);
        echo view ('users/footer_v');
    }
    public function detail($id){
        $data['dataClient'] = $this->clientModel->joinclient($id);
        $detail = $this->clientModel->getDetail($id);
        $notif['deadlineStory'] = $this->videoModel->deadlineStory();
        $notif['deadlineShoot'] = $this->videoModel->deadlineShoot();
        $notif['deadlineEdit'] = $this->videoModel->deadlineEdit();
        $notif['deadlineStoryDigital'] = $this->digitalModel->deadlineStory();
        $notif['deadlineVoice'] = $this->digitalModel->deadlineVoice();
        $notif['deadlineAnimate'] = $this->digitalModel->deadlineAnimate();
        $notif['deadlineCompile'] = $this->digitalModel->deadlineCompile();
        $notif['deadlineFinance'] = $this->financeModel->deadlineFinance();
        $notif['dataAttendance'] = $this->attendanceModel->getStatusAtt();


         // paginate
        $paginate = 5;
        $data['dataDetail']   = $detail->paginate($paginate, 'dataDetail');
        $data['pager']      = $this->clientModel->getDetail($id)->pager;
        $data['validation'] = $this->validator;
        
       


        echo view('users/header_v',$notif);
        echo view('users/detail_client_v',$data);
        echo view ('users/footer_v');
    }
    public function add_type(){
        $notif['deadlineStory'] = $this->videoModel->deadlineStory();
        $notif['deadlineShoot'] = $this->videoModel->deadlineShoot();
        $notif['deadlineEdit'] = $this->videoModel->deadlineEdit();
        $notif['deadlineStoryDigital'] = $this->digitalModel->deadlineStory();
        $notif['deadlineVoice'] = $this->digitalModel->deadlineVoice();
        $notif['deadlineAnimate'] = $this->digitalModel->deadlineAnimate();
        $notif['deadlineCompile'] = $this->digitalModel->deadlineCompile();
        $notif['deadlineFinance'] = $this->financeModel->deadlineFinance();
        $notif['dataAttendance'] = $this->attendanceModel->getStatusAtt();

        
        echo view('users/header_v',$notif);
        echo view('users/class_form_v');
        echo view ('users/footer_v');
    }
   



    public function save() {
            $id = $this->request->getPost('id_client');
            $find = $this->clientModel->find($id);
            if(empty($find)){
            $data = [
                'id_client'=>$this->request->getPost('id_client'),
                'address_client'=>$this->request->getPost('address_client'),
                'email_client'=>$this->request->getPost('email_client'),
                'phone'=>$this->request->getPost('phone'),
                'nik'=>$this->request->getPost('nik'),
                'id_class'=>$this->request->getPost('id_class'),
              
            ];
                $this->clientModel->insert($data);
                $act = 'Insert new client data '.$data['id_client'];
                $this->record($act,session()->get('nik'));
                return redirect()->to(site_url('Client'))->with('Success', '<i class="fas fa-save"></i> Data has been saved');
            }   
            else {
                    return redirect()->to(site_url('Client'))->with('Failed', '<i class="fas fa-exclamation"></i> Data Failed to save, please check again');
            }
            
            
            
        }      

        /*TADI SAMPAI SINI*/     
        public function update() { // Update
            $id =  $this->request->getPost('id_client');
            $where = ['id_client'=>$id];
            $data = [
                'id_client'=>$this->request->getPost('id_client'),
                'address_client'=>$this->request->getPost('address_client'),
                'email_client'=>$this->request->getPost('email_client'),
                'phone'=>$this->request->getPost('phone'),
                'nik'=>$this->request->getPost('nik'),
                'id_class'=>$this->request->getPost('id_class'),
              
            ];
         
           
           $response = $this->clientModel->update($where,$data);
           if($response){
            $act = 'Update client data '.$id;
           $this->record($act,session()->get('nik'));
            return redirect()->to(site_url('Client'))->with('Success', '<i class="fas fa-save"></i> Data has been saved');
            }else {
            return redirect()->to(site_url('Client'))->with('Failed', '<i class="fas fa-exclamation"></i> Data Failed to save, please check again');
            }

    
            
            
    }

       
        public function save_class() {
 
            $data = [
                'id_class'=>$this->request->getPost('id_class'),
                'sector'=>$this->request->getPost('sector'),
              
            ];
                $act = 'Insert new type business data '.$data['sector'];
                $this->record($act,session()->get('nik'));
                $this->classModel->insert($data);
                return redirect()->to(site_url('Client/add'))->with('Success', '<i class="fas fa-save"></i> Data has been saved');
                
            
            
        }      


    //delete
    public function delete($id){
        $where = ['id_client'=>$id];   

        $response = $this->clientModel->delete($where);
        $act = 'Delete client data '.$id;
        $this->record($act,session()->get('nik'));
        if($response){
            return redirect()->to(site_url('Client'))->with('Success', '<i class="fas fa-trash"></i> Data has been deleted');
        }else{
            return redirect()->to(site_url('Client'))->with('Failed', '<i class="fas fa-exclamation"></i> Data Failed to delete');
        }
       

    }


    // Export ke excel
public function export()
{
$dataClient = $this->clientModel->getPIC();
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
->setCellValue('B1', 'SECTOR')
->setCellValue('C1', 'ADDRESS')
->setCellValue('D1', 'EMAIL')
->setCellValue('E1', 'PHONE')
->setCellValue('F1', 'PIC')


;

// Miscellaneous glyphs, UTF-8
$i=2; foreach($dataClient as $row) {

$spreadsheet->setActiveSheetIndex(0)
->setCellValue('A'.$i, $row->id_client)
->setCellValue('B'.$i, $row->sector)
->setCellValue('C'.$i, $row->address_client)
->setCellValue('D'.$i, $row->email_client)
->setCellValue('E'.$i, $row->phone)
->setCellValue('F'.$i, $row->name)
;
$i++;
$act = 'Export all client data to excel ';
$this->record($act,session()->get('nik'));  
}

// Rename worksheet
$spreadsheet->getActiveSheet()->setTitle('Client Data'.date('d-m-Y H'));

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$spreadsheet->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Client Data.xlsx"');
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
  public function export_detail($id)
  {
  $dataClient = $this->clientModel->exportClient($id);
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
  ->setCellValue('B1', 'TITLE')
  ->setCellValue('C1', 'COUNT')
  ->setCellValue('D1', 'POTENTIAL REVENUE')
  ->setCellValue('E1', 'TOTAL REVENUE')
  ->setCellValue('F1', 'STATUS')
  
  
  ;
  
  // Miscellaneous glyphs, UTF-8
  $i=2; foreach($dataClient as $row) {
  
  $spreadsheet->setActiveSheetIndex(0)
  ->setCellValue('A'.$i, $row->id_client)
  ->setCellValue('B'.$i, $row->title)
  ->setCellValue('C'.$i, $row->count)
  ->setCellValue('D'.$i, $row->potential_revenue)
  ->setCellValue('E'.$i, $row->total_revenue)
  ->setCellValue('F'.$i, $row->status)
  
  ;
  $i++;
  $act = 'Export client data to excel '.$row->id_client;
  $this->record($act,session()->get('nik'));  
  }
  
  // Rename worksheet
  $spreadsheet->getActiveSheet()->setTitle('Detail Purchase'.date('d-m-Y H'));
  
  // Set active sheet index to the first sheet, so Excel opens this as the first sheet
  $spreadsheet->setActiveSheetIndex(0);
  
  // Redirect output to a client’s web browser (Xlsx)
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment;filename="Detail Purchase.xlsx"');
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




