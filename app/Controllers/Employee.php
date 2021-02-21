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

class Employee extends BaseController{
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->employeeModel = new \App\Models\employeeModel();
        $this->empstatusModel = new \App\Models\empstatusModel();

    }

    public function index(){
        $session = session();
        $data['dataEmployee'] = $this->employeeModel->getEmployee();

        echo view ('users/header_v');
        echo view ('admin/employee_v',$data);
        echo view ('users/footer_v');
        
    }

   

    public function add(){

        $data['dataEmpstatus'] = $this->empstatusModel->findAll();

        echo view('users/header_v');
        echo view('admin/employee_form_v',$data);
        echo view('users/footer_v');
    }

    public function edit($id){
        $where = ['nik'=> $id];
        $data['dataEmpstatus'] = $this->empstatusModel->findAll();
        $data['dataEmployee'] = $this->employeeModel->where($where)->findAll()[0];
        $data['dataEmpstatus'] = $this->empstatusModel->findAll();
        

        echo view('users/header_v');
        echo view('admin/employee_form_v',$data);
        echo view ('users/footer_v');
    }

    public function save() {
        $data = [
            'nik'=>$this->request->getPost('nik'),
            'name'=>$this->request->getPost('name'),
            'email'=>$this->request->getPost('email'),
            'password'=>$this->request->getPost('password'),
            'phone1'=>$this->request->getPost('phone1'),
            'phone2'=>$this->request->getPost('phone2'),
            'id_eStatus'=>$this->request->getPost('id_eStatus'),
            'level'=>$this->request->getPost('level'),
          
        ]; 
        
        $id = $this->request->getPost('id');

        if (empty($id)) { //Insert
           
            $response = $this->employeeModel->insert($data);
            
            //masih aneh
            if($response != true){
                return redirect()->to(site_url('Employee'))->with('Success', '<i class="fas fa-save"></i> Data has been saved');
            }else{
                return redirect()->to(site_url('Employee'))->with('Failed', '<i class="fas fa-exclamination"></i> Data Failed to save');
            }
            
            
        } else { // Update
                $where = ['nik'=>$id];
                $response =  $this->employeeModel->update($where, $data);

            if($response){
                return redirect()->to(site_url('Employee'))->with('Success', '<i class="fas fa-save"></i> Data has been saved');
            }else{
                return redirect()->to(site_url('Employee'))->with('Failed', '<i class="fas fa-exclamination"></i> Data Failed to save');
            }
            
            
        }

       
    }


    //delete
    public function delete($id){
        $where = ['nik'=>$id];   

        $response = $this->employeeModel->delete($where);
        if($response){
            return redirect()->to(site_url('Employee'))->with('Success', '<i class="fas fa-save"></i> Data has been deleted');
        }else{
            return redirect()->to(site_url('Employee'))->with('Failed', '<i class="fas fa-exclamination"></i> Data Failed to delete');
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
->setCellValue('A1', 'ID CLIENT')
->setCellValue('B1', 'CLIENT NAME')
->setCellValue('C1', 'ADDRESS')
->setCellValue('D1', 'PHONE')
->setCellValue('E1', 'PIC')


;

// Miscellaneous glyphs, UTF-8
$i=2; foreach($dataClient as $row) {

$spreadsheet->setActiveSheetIndex(0)
->setCellValue('A'.$i, $row->id_client)
->setCellValue('B'.$i, $row->client_name)
->setCellValue('C'.$i, $row->address)
->setCellValue('D'.$i, $row->phone)
->setCellValue('E'.$i, $row->name)

;
$i++;
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
  $dataClient = $this->clientModel->getDetail($id);
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
  ->setCellValue('A1', 'NO')
  ->setCellValue('B1', 'CLIENT NAME')
  ->setCellValue('C1', 'TITLE PRODUCT')
  ->setCellValue('D1', 'CATEGORY PRODUCT')
  ->setCellValue('E1', 'COUNT')
  ->setCellValue('F1', 'POTENTIAL REVENUE')
  ->setCellValue('G1', 'TOTAL REVENUE')
  ->setCellValue('H1', 'STATUS')
  
  
  ;
  
  // Miscellaneous glyphs, UTF-8
  $i=2; foreach($dataClient as $row) {
  
  $spreadsheet->setActiveSheetIndex(0)
  ->setCellValue('A'.$i, $row->id_client)
  ->setCellValue('B'.$i, $row->client_name)
  ->setCellValue('C'.$i, $row->title)
  ->setCellValue('D'.$i, $row->category)
  ->setCellValue('E'.$i, $row->count)
  ->setCellValue('F'.$i, $row->potential_revenue)
  ->setCellValue('G'.$i, $row->total_revenue)
  ->setCellValue('I'.$i, $row->status)
  
  ;
  $i++;
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




