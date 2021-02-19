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

use App\Models\ProductModel;
use mysqli;
use phpDocumentor\Reflection\PseudoTypes\False_;

class headPipeline extends BaseController{
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->headPipelineModel = new \App\Models\headPipelineModel();
        $this->detailPipelineModel = new \App\Models\headPipelineModel();
        $this->employeeModel = new \App\Models\employeeModel();
        $this->clientModel = new \App\Models\clientModel();
      
    }

    public function index(){
        $session = session();
        $data['dataHead'] = $this->headPipelineModel->getHeadSales();
        echo view ('users/header_v');
        echo view ('users/head_v',$data);
        echo view ('users/footer_v');
        
    }

   

    public function add(){
        $data['dataEmployee'] = $this->employeeModel->findAll();
        $data['dataClient'] = $this->clientModel->findAll();
        echo view('users/header_v');
        echo view('users/head_form_v',$data);
        echo view('users/footer_v');
    }

    public function edit($id){
        $where = ['id_headPipeline'=> $id];
        $data['dataHead'] = $this->headPipelineModel->where($where)->findAll()[0];
        
        echo view('users/header_v');
        echo view('users/head_form_v',$data);
        echo view ('users/footer_v');
    }

    public function detail($id){
       /* TADI MALEM SAMPE SINI */
        $data['dataDetail'] = $this->headPipelineModel->nilaijoin($id);
        echo view('users/header_v');
        echo view('users/detail_form_v',$data);
        echo view ('users/footer_v');
    }

    public function save() {
        
        $id = $this->request->getPost('id_headPipeline');

        if (empty($id)) { //Insert
           
            $data = [
                'id_client'=>$this->request->getPost('id_client'),
                'id_employee'=>$this->request->getPost('id_employee'),
              
            ];

            $response = $this->headPipelineModel->insert($data);
            if($response){
                return redirect()->to(site_url('headPipeline'))->with('Success', '<i class="fas fa-save"></i> Data has been saved');
            }else{
                return redirect()->to(site_url('headPipeline'))->with('Failed', '<i class="fas fa-exclamination"></i> Data Failed to save');
            }
        
         
            

            
        } else { // Update
            $where = ['id_headPipeline'=>$id];
            $data = [
                'id_client'=>$this->request->getPost('id_client'),
                'id_employee'=>$this->request->getPost('id_employee'),
             
                    
            ];
         
          
            $response = $this->headPipelineModel->update($where,$data);
            if($response){
                return redirect()->to(site_url('headPipeline'))->with('Success', '<i class="fas fa-save"></i> Data has been saved');
            }else{
                return redirect()->to(site_url('headPipeline'))->with('Failed', '<i class="fas fa-exclamination"></i> Data Failed to save');
            }
            
            
        }

       
    }


    //delete
    public function delete($id){
        $where = ['id_headPipeline'=>$id];   
        $where_detail = $this->headPipelineModel->nilaijoin($id);
        $response_head = $this->headPipelineModel->delete($where);
        $response_detail = $this->detailPipelineModel->delete($where_detail);
        
        
        
        if($response_head && $response_detail){
            return redirect()->to(site_url('headPipeline'))->with('Success', '<i class="fas fa-trash"></i> Data has been deleted');
        }else{
            return redirect()->to(site_url('headPipeline'))->with('Failed', '<i class="fas fa-exclamination"></i> Data Failed to delete');
        }
        
    }



/*TADI SIANG SAMPE SINI */

    // Export ke excel
public function export()
{
$dataHead = $this->headPipelineModel->getHeadSales();
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
->setCellValue('A1', 'ID HEAD PIPELINE')
->setCellValue('B1', 'CLIENT')
->setCellValue('C1', 'PIC')


;

// Miscellaneous glyphs, UTF-8
$i=2; foreach($dataHead as $row) {

$spreadsheet->setActiveSheetIndex(0)
->setCellValue('A'.$i, $row->id_headPipeline)
->setCellValue('B'.$i, $row->client_name)
->setCellValue('C'.$i, $row->employee_name)

;
$i++;
}

// Rename worksheet
$spreadsheet->getActiveSheet()->setTitle(' Data Head Pipeline'.date('d-m-Y H'));

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$spreadsheet->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Head Pipeline Data.xlsx"');
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

