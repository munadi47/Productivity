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

class Activity extends BaseController{
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->activityModel = new \App\Models\activityModel();
        $this->pager = \Config\Services::pager();
        
    }

    public function index(){
        $session = session();
        
        $activity = $this->activityModel->joinEmp();
         // paginate
        $paginate = 10;
        $data['dataAct']   = $activity->paginate($paginate,'dataAct');
        $data['pager']      = $activity->pager;
        $data['validation'] = $this->validator;
        
      

        echo view ('users/header_v');
        echo view ('admin/act_v',$data);
        echo view ('users/footer_v');


        
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
  ->setCellValue('A1', 'CLIENT')
  ->setCellValue('B1', 'TITLE')
  ->setCellValue('C1', 'CATEGORY PRODUCT')
  ->setCellValue('D1', 'COUNT')
  ->setCellValue('E1', 'POTENTIAL REVENUE')
  ->setCellValue('F1', 'TOTAL REVENUE')
  ->setCellValue('G1', 'STATUS')
  
  
  ;
  
  // Miscellaneous glyphs, UTF-8
  $i=2; foreach($dataClient as $row) {
  
  $spreadsheet->setActiveSheetIndex(0)
  ->setCellValue('A'.$i, $row->id_client)
  ->setCellValue('B'.$i, $row->title)
  ->setCellValue('C'.$i, $row->category)
  ->setCellValue('D'.$i, $row->count)
  ->setCellValue('E'.$i, $row->potential_revenue)
  ->setCellValue('F'.$i, $row->total_revenue)
  ->setCellValue('G'.$i, $row->status)
  
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




