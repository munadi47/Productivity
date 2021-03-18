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
        $this->clientModel = new \App\Models\clientModel();
        $this->employeeModel = new \App\Models\employeeModel();
        $this->activityModel = new \App\Models\activityModel();
        $this->videoModel = new \App\Models\videoModel();
        $this->digitalModel = new \App\Models\digital_contentModel();
        $this->financeModel = new \App\Models\financeModel();

        date_default_timezone_set("Asia/Jakarta");
    }

    public function index(){
        $session = session();
        //$this->load->library('user_agent');
        $notif['deadlineStory'] = $this->videoModel->deadlineStory();
        $notif['deadlineShoot'] = $this->videoModel->deadlineShoot();
        $notif['deadlineEdit'] = $this->videoModel->deadlineEdit();
        $notif['deadlineStoryDigital'] = $this->digitalModel->deadlineStory();
        $notif['deadlineVoice'] = $this->digitalModel->deadlineVoice();
        $notif['deadlineAnimate'] = $this->digitalModel->deadlineAnimate();
        $notif['deadlineCompile'] = $this->digitalModel->deadlineCompile();
        $notif['deadlineFinance'] = $this->financeModel->deadlineFinance();
        $notif['dataAttendance'] = $this->attendanceModel->getStatusAtt();
        $data['dataRow'] = $this->attendanceModel->getRowAtt();
        $data['dataCheckIn'] = $this->attendanceModel->checkin();
        $data['dataCheckOut'] = $this->attendanceModel->checkout();

        $data['dataEmployee'] = $this->employeeModel->findAll();
        

        echo view ('admin/header_v_admin',$notif);
        echo view ('users/attendance_v',$data);
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
    

    public function view(){
        $session = session();
        $notif['deadlineStory'] = $this->videoModel->deadlineStory();
        $notif['deadlineShoot'] = $this->videoModel->deadlineShoot();
        $notif['deadlineEdit'] = $this->videoModel->deadlineEdit();
        $notif['deadlineStoryDigital'] = $this->digitalModel->deadlineStory();
        $notif['deadlineVoice'] = $this->digitalModel->deadlineVoice();
        $notif['deadlineAnimate'] = $this->digitalModel->deadlineAnimate();
        $notif['deadlineCompile'] = $this->digitalModel->deadlineCompile();
        $notif['deadlineFinance'] = $this->financeModel->deadlineFinance();
        $notif['dataAttendance'] = $this->attendanceModel->getStatusAtt();
        $data['dataAttendance'] = $this->attendanceModel->getATD();
        echo view('admin/header_v_admin',$notif);
        echo view('users/log_attendance_v',$data);
        echo view('users/footer_v');
        
    }

    public function clockin() {
        $session = session();

        /* update data juga
        $table = 'log_attendance';
        $id = $this->request->getPost('id_attendance');
        $co = $this->request->getPost('clock_out');
        $row = $this->attendanceModel->update_data($co,$table,$id);
        */
        
        $datain = [ 	 	 
            'nik'=> session()->get('nik'),
            'clock_in'=> date('Y-m-d H:i:s'),          
        ]; 

        $status = [ 	 	 
            'status'=> session()->get('status'),
        ];
            $insert = $this->attendanceModel->insert($datain);
            $id = $this->attendanceModel->getInsertID(); 
            

            if($insert) {
                $data = array(
                    'id_attendance' => $id,
                    );
        
                $session->set($data);
            }
            
            $act = 'Present (Clock in)';
            $this->record($act,session()->get('nik'));
            
            //bug activity
            //$act = 'Insert new Attendance data, Client = '.$datain['nik'];
            //$this->record($act,session()->get('name'));
                return redirect()->to(site_url('Attendance'))->with('Success', '<i class="fas fa-save"></i> Clockin saved on '.date('H:i:s'));            
    } 

    public function clockout($id){
        $session = session();
        //$id = $this->attendanceModel->getInsertID(); 
        //$id['dataOut'] = $this->attendanceModel->getInsertID();

        $where = ['id_attendance'=> $id];
        $dataout = [ 	 	
            'clock_out'=> date('Y-m-d H:i:s'),          
        ]; 
        $datain = [ 	 	 
            'nik'=> session()->get('nik'),
            'clock_in'=> date('Y-m-d H:i:s'),          
        ]; 

            $this->attendanceModel->update($where,$dataout);
            //$id = $this->attendanceModel->getInsertID(); 
            $act = 'Out (Clock out)';
            $this->record($act,session()->get('nik'));
            return redirect()->to(site_url('Attendance'))->with('Success', '<i class="fas fa-save"></i> Clockout saved on '.date('H:i:s'));            
        
       
    }


     public function delete($id){
        $where = ['id_attendance'=>$id];   

        $response = $this->attendanceModel->delete($where);
        /*$act = 'Delete client data '.$id;
        $this->record($act,session()->get('nik'));
        */
        if($response){
            return redirect()->to(site_url('Attendance/view'))->with('Success', '<i class="fas fa-trash"></i> Data has been deleted');
        }else{
            return redirect()->to(site_url('Attendance/view'))->with('Failed', '<i class="fas fa-exclamation"></i> Data Failed to delete');
        }
       

    }


    // Export ke excel
public function export()
{
$dataAttendance = $this->attendanceModel->getATD();
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
->setCellValue('B1', 'NAME')
->setCellValue('C1', 'CLOCK IN')
->setCellValue('D1', 'CLOCK OUT')
;

// Miscellaneous glyphs, UTF-8
$i=2; foreach($dataAttendance as $row) {

$spreadsheet->setActiveSheetIndex(0)
->setCellValue('A'.$i, $row->id_attendance)
->setCellValue('B'.$i, $row->name)
->setCellValue('C'.$i, date("h:i A", strtotime($row->clock_in)))
->setCellValue('D'.$i, date("h:i A", strtotime($row->clock_out)))

;
$i++;
}
$act = 'Export all Finance data to excel';
$this->record($act,session()->get('nik'));

// Rename worksheet
$spreadsheet->getActiveSheet()->setTitle('Attendance Data'.date('d-m-Y H'));

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$spreadsheet->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Attendance Data.xlsx"');
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




