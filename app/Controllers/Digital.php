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

class Digital extends BaseController{
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->digital_contentModel = new \App\Models\digital_contentModel();
        $this->sales_pipelineModel = new \App\Models\sales_pipelineModel();

    }

    public function index(){
        $session = session();
    
        $data['dataDigital'] = $this->digital_contentModel->JoinDigital();
        echo view ('users/header_v');
        echo view ('users/digital_v',$data);
        echo view ('users/footer_v');
        
    }

   

    public function add(){
     
        $data['dataPipeline'] = $this->sales_pipelineModel->findAll();

        echo view('users/header_v');
        echo view('users/digital_content_form_v',$data);
        echo view('users/footer_v');
    }

    public function edit($id){
        $where = ['id_digital'=> $id];
        $data['dataDigital'] = $this->digital_contentModel->where($where)->findAll()[0];
        $data['dataPipeline'] = $this->sales_pipelineModel->findAll();

        echo view('users/header_v');
        echo view('users/digital_content_form_v',$data);
        echo view ('users/footer_v');
    }

    public function save() {
        
        $id = $this->request->getPost('id_video');

        if (empty($id)) { //Insert
           
            $data = [
                'storyboard_pic'=>$this->request->getPost('storyboard_pic'),
                'storyboard_date'=>$this->request->getPost('storyboard_date'),
                'voiceover_pic'=>$this->request->getPost('voiceover_pic'),
                'voiceover_date'=>$this->request->getPost('voiceover_date'),
                'animate_pic'=>$this->request->getPost('animate_pic'),
                'animate_date'=>$this->request->getPost('animate_date'),
                'compile_pic'=>$this->request->getPost('compile_pic'),
                'compile_date'=>$this->request->getPost('compile_date'),
                'remark'=>$this->request->getPost('remark'),
                'id_SalesPipeline'=>$this->request->getPost('id_SalesPipeline'),
                    
            ];
            
            $response = $this->digital_contentModel->insert($data);
            if($response){
                return redirect()->to(site_url('Digital'))->with('Success', '<i class="fas fa-save"></i> Data has been saved');
            }else{
                return redirect()->to(site_url('Digital'))->with('Failed', '<i class="fas fa-exclamination"></i> Data Failed to save');
            }
            

            
        } else { // Update
            $where = ['id_digital'=>$id];
            $data = [
                'storyboard_pic'=>$this->request->getPost('storyboard_pic'),
                'storyboard_date'=>$this->request->getPost('storyboard_date'),
                'voiceover_pic'=>$this->request->getPost('voiceover_pic'),
                'voiceover_date'=>$this->request->getPost('voiceover_date'),
                'animate_pic'=>$this->request->getPost('animate_pic'),
                'animate_date'=>$this->request->getPost('animate_date'),
                'compile_pic'=>$this->request->getPost('compile_pic'),
                'compile_date'=>$this->request->getPost('compile_date'),
                'remark'=>$this->request->getPost('remark'),
                'id_SalesPipeline'=>$this->request->getPost('id_SalesPipeline'),
                    
            ];
         
           
            $response = $this->digital_contentModel->update($where, $data);
            if($response){
                return redirect()->to(site_url('Digital'))->with('Success', '<i class="fas fa-save"></i> Data has been saved');
            }else{
                return redirect()->to(site_url('Digital'))->with('Failed', '<i class="fas fa-exclamination"></i> Data Failed to save');
            }
            
        }

        
    }


    //delete
    public function delete($id){

        $where = ['id_digital'=>$id]; 

    
        
        $response = $this->digital_contentModel->delete($where);
        if($response){
            return redirect()->to(site_url('Digital'))->with('Success', '<i class="fas fa-trash"></i> Data has been deleted');
        }else{
            return redirect()->to(site_url('Digital'))->with('Failed', '<i class="fas fa-exclamination"></i> Data Failed to delete');
        }
        

     
    }




    // Export ke excel
public function export()
{
$dataDigital = $this->digital_contentModel->JoinDigital();
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
->setCellValue('A1', 'ID DIGITAL')
->setCellValue('B1', 'TITLE')
->setCellValue('C1', 'CLIENT')
->setCellValue('D1', 'STORYBOARD PIC')
->setCellValue('E1', 'STORYBOARD DATE')
->setCellValue('F1', 'VOICEOVER PIC')
->setCellValue('G1', 'VOICEOVER DATE')
->setCellValue('H1', 'ANIMATE PIC')
->setCellValue('I1', 'ANIMATE DATE')
->setCellValue('J1', 'COMPILE PIC')
->setCellValue('K1', 'COMPILE DATE')
->setCellValue('L1', 'REMARK')

;

// Miscellaneous glyphs, UTF-8
$i=2; foreach($dataDigital as $row) {

$spreadsheet->setActiveSheetIndex(0)
->setCellValue('A'.$i, $row->id_digital)
->setCellValue('B'.$i, $row->title)
->setCellValue('C'.$i, $row->client_name)
->setCellValue('D'.$i, $row->storyboard_pic)
->setCellValue('E'.$i, $row->storyboard_date)
->setCellValue('F'.$i, $row->voiceover_pic)
->setCellValue('G'.$i, $row->voiceover_date)
->setCellValue('H'.$i, $row->animate_pic)
->setCellValue('I'.$i, $row->animate_date)
->setCellValue('J'.$i, $row->compile_pic)
->setCellValue('K'.$i, $row->compile_date)
->setCellValue('L'.$i, $row->remark)
;
$i++;
}

// Rename worksheet
$spreadsheet->getActiveSheet()->setTitle('Digital Data'.date('d-m-Y H'));

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$spreadsheet->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Digital Content.xlsx"');
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