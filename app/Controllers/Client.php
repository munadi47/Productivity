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
      
    }

    public function index(){
        $session = session();
        $data['dataClient'] = $this->clientModel->getPIC();
        echo view ('users/header_v');
        echo view ('users/client_v',$data);
        echo view ('users/footer_v');
        
    }

   

    public function add(){
        $data['dataEmployee']  = $this->employeeModel->findAll();
        echo view('users/header_v');
        echo view('users/client_form_v',$data);
        echo view('users/footer_v');
    }

    public function edit($id){
        $where = ['id_client'=> $id];
        $data['dataClient'] = $this->clientModel->where($where)->findAll()[0];
        
        echo view('users/header_v');
        echo view('users/client_form_v',$data);
        echo view ('users/footer_v');
    }

    public function save() {
        
        $id = $this->request->getPost('id_client');

        if (empty($id)) { //Insert
           
            $data = [
                'client_name'=>$this->request->getPost('client_name'),
                'address'=>$this->request->getPost('address'),
                'phone'=>$this->request->getPost('phone'),
                'nik'=>$this->request->getPost('nik'),
              
            ];
        
            $this->clientModel->insert($data);
            

            
        } else { // Update
            $where = ['id_client'=>$id];
            $data = [
                'client_name'=>$this->request->getPost('client_name'),
                'address'=>$this->request->getPost('address'),
                'phone'=>$this->request->getPost('phone'),
                'nik'=>$this->request->getPost('nik'),
             
                    
            ];
         
            $this->clientModel->update($where, $data);
            
            
        }

        return redirect()->to(site_url('Client'))->with('Success', '<i class="fas fa-save"></i> Data has been saved');
    }


    //delete
    public function delete($id){
        $where = ['id_client'=>$id];   

        $session = $this->clientModel->delete($where);
        
        
        
        if(delete($session)){
            $this->clientModel->delete($where);
            return redirect()->to(site_url('Client'))->with('Success', '<i class="fas fa-trash-alt"></i> Data Berhasil di Hapus');
    
        }       

    }


    // Export ke excel
public function export()
{
$dataCompany = $this->companyModel->findAll();
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
->setCellValue('A1', 'ID COMPANY')
->setCellValue('B1', 'COMPANY NAME')


;

// Miscellaneous glyphs, UTF-8
$i=2; foreach($dataCompany as $row) {

$spreadsheet->setActiveSheetIndex(0)
->setCellValue('A'.$i, $row->id_company)
->setCellValue('B'.$i, $row->company_name)

;
$i++;
}

// Rename worksheet
$spreadsheet->getActiveSheet()->setTitle('Company Data'.date('d-m-Y H'));

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$spreadsheet->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Company Data.xlsx"');
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
