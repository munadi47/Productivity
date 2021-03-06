<?php
namespace App\Controllers;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
require('../excel/vendor/autoload.php');
// Include the main TCPDF library (search for installation path).


use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use TCPDF;

// End load library phpspreadsheet

use CodeIgniter\HTTP\Files\UploadedFile;
use mysqli;
use phpDocumentor\Reflection\PseudoTypes\False_;

class Attendance extends BaseController{
    public function __construct()
    {
        $this->session = \Config\Services::session();

        $this->attendanceModel = new \App\Models\attendanceModel();

        $this->employeeModel = new \App\Models\employeeModel();
        $this->empstatusModel = new \App\Models\empstatusModel();
        $this->activityModel = new \App\Models\activityModel();

    }

    public function index(){
        $session = session();
        $data['dataAttendance'] = $this->attendanceModel->getAttendanceEmp();
        $data['dataEmployee'] = $this->employeeModel->findAll();

        echo view ('users/header_v');
        echo view ('users/attendance_v',$data);
        echo view ('users/footer_v');
        
    }

    public function record ($activity_name,$nik) { //method untuk merekam aktivitas

        $toRecord = array();
        $toRecord['activity_name'] = $activity_name;
        $toRecord['datetime'] = date("Y-m-d h:i:s");
        $toRecord['nik'] = $nik;
  
        $result = $this->activityModel->insert($toRecord); // simpan data ke tabel
  
         if(!$result):
            return false;
         endif;
         return $result;
  
     }

   
   

    public function add(){
        $data['dataEmployee'] = $this->employeeModel->findAll();
        
        echo view('users/header_v');
        echo view('admin/finance_form_v',$data);
        echo view('users/footer_v');
    }

    /*public function edit($id){
        $where = ['id_finance'=> $id];
        $data['datafinancestatus'] = $this->financestatusModel->findAll();
        $data['dataClient'] = $this->clientModel->findAll();
        $data['dataFinance'] = $this->financeModel->where($where)->findAll()[0];
        

        echo view('users/header_v');
        echo view('admin/finance_form_v',$data);
        echo view ('users/footer_v');
    }*/

    public function save_clockin() {
        $datain = [ 	 	 
            'nik'=>$this->request->getPost('nik'),
            'clock_in'=>$this->request->getPost('clock_in'),          
            'clock_out'=>$this->request->getPost('clock_out'),

        ]; 

        $dataout = [ 	 	 
            'id_attendance'=>$this->request->getPost('id_attendance'),
            'nik'=>$this->request->getPost('nik'),
            'clock_out'=>$this->request->getPost('clock_out'),

        ]; 
        
        $id = $this->request->getPost('id_attendance');

        if (empty($id)) { //Insert
           
            $response = $this->attendanceModel->insert($datain);
            //bug activity
            //$act = 'Insert new Attendance data, Client = '.$dataout['nik'];
            //$this->record($act,session()->get('name'));
            

            if($response){
                return redirect()->to(site_url('Attendance'))->with('Success', '<i class="fas fa-save"></i> Clockin saved');
            }else{
                return redirect()->to(site_url('Attendance'))->with('Failed', '<i class="fas fa-exclamination"></i> Data Failed to save');
            }
            
            
        } /*else 
        { // Update
                $where = ['id_attendance'=>$id];
                $response =  $this->financeModel->update($where, $datain);
                $act = 'Update Attendance data, Client = '.$datain['id_attendance'];
                $this->record($act,session()->get('nik'));

            if($response){
                return redirect()->to(site_url('Attendance'))->with('Success', '<i class="fas fa-save"></i> Data has been saved');
            }else{
                return redirect()->to(site_url('Attendance'))->with('Failed', '<i class="fas fa-exclamination"></i> Data Failed to save');
            }
        }*/

       
    }

    //delete
    /*public function delete($id){
        $where = ['id_finance'=>$id];   

        $response = $this->financeModel->delete($where);
        $act = 'Delete Finance data '.$id;
        $this->record($act,session()->get('nik'));
        if($response){
            return redirect()->to(site_url('Finance'))->with('Success', '<i class="fas fa-save"></i> Data has been deleted');
        }else{
            return redirect()->to(site_url('Finance'))->with('Failed', '<i class="fas fa-exclamination"></i> Data Failed to delete');
        }
       

    }*/

    // Export ke excel
public function export()
{
$dataFinance = $this->financeModel->getStatusFinance();
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
->setCellValue('A1', 'ID')
->setCellValue('B1', 'INVOICE DATE')
->setCellValue('C1', 'INOVICE DUE DATE')
->setCellValue('D1', 'INVOICE AMOUNT')
->setCellValue('E1', 'STATUS')
;

// Miscellaneous glyphs, UTF-8
$i=2; foreach($dataFinance as $row) {

$spreadsheet->setActiveSheetIndex(0)
->setCellValue('A'.$i, $row->id_finance)
->setCellValue('B'.$i, $row->invoice_date)
->setCellValue('C'.$i, $row->invoice_duedate)
->setCellValue('D'.$i, $row->invoice_amount)
->setCellValue('E'.$i, $row->id_fStatus)

;
$i++;
}
$act = 'Export all Finance data to excel';
$this->record($act,session()->get('nik'));

// Rename worksheet
$spreadsheet->getActiveSheet()->setTitle('Finance Data'.date('d-m-Y H'));

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

}




