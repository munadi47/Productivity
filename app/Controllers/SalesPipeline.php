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

class SalesPipeline extends BaseController{
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->productModel = new \App\Models\productModel();
        $this->employeeModel = new \App\Models\employeeModel();
        $this->clientModel = new \App\Models\clientModel();
        $this->sales_pipelineModel = new \App\Models\sales_pipelineModel();


    }

    public function index(){
        $session = session();
    
        $data['dataPipeline'] = $this->sales_pipelineModel->JoinPipeline();
        echo view ('users/header_v');
        echo view ('users/sp_v',$data);
        echo view ('users/footer_v');
        
    }

   

    public function add(){
     
        $data['dataProduct'] = $this->productModel->findAll();
        $data['dataClient'] = $this->clientModel->findAll();
        $data['dataEmployee'] = $this->employeeModel->findAll();

        echo view('users/header_v');
        echo view('users/sp_form_v',$data);
        echo view('users/footer_v');
    }

    public function edit($id){
        $where = ['id_SalesPipeline'=> $id];
        $data['dataPipeline'] = $this->sales_pipelineModel->where($where)->findAll()[0];
        $data['dataProduct'] = $this->productModel->findAll();
        $data['dataClient'] = $this->clientModel->findAll();
        $data['dataEmployee'] = $this->employeeModel->findAll();

        echo view('users/header_v');
        echo view('users/sp_form_v',$data);
        echo view ('users/footer_v');
    }

    public function save() {
        
        $id = $this->request->getPost('id_SalesPipeline');

        if (empty($id)) { //Insert
           /*'nik','id_client','id_product','category','title','count','potential_revenue','total_revenue','status'*/
            $data = [
                'nik'=>$this->request->getPost('nik'),
                'id_client'=>$this->request->getPost('id_client'),
                'id_product'=>$this->request->getPost('id_product'),
                'category'=>$this->request->getPost('category'),
                'title'=>$this->request->getPost('title'),
                'count'=>$this->request->getPost('count'),
                'potential_revenue'=>$this->request->getPost('potential_revenue'),
                'total_revenue'=>$this->request->getPost('total_revenue'),
                'status'=>$this->request->getPost('status'), 
            ];
            
            $response = $this->sales_pipelineModel->insert($data);
            if($response){
                 /* JIKA CLOSING MAKA DATA TITLE AKAN INSERT KE DELIVERY TABEL
                $data = [
                'status'=>$this->request->getPost('status')
                'category'=>$this->request->getPost('category')
                ];
                if ($data['status']=='closing'){
                    $data = [
                        'id_SalesPipeline'=>$this->request->getPost('id_SalesPipeline'),
                    ];
                    if ($data['category']=='video'){
                        $this->videoModel->insert($data);

                    }elseif($data['category']=='digital content'){
                         $this->digital_contentModel->insert($data);
                    
                    }elseif($data['category']=='learning'){
                         $this->learningModel->insert($data);
                    }else{
                        $this->consultingModel->insert($data);
                    }
                }
                 return redirect()->to(site_url('SalesPipeline'))->with('Warning', '<i class="fas fa-exclamation"></i> Please Check Delivery Menu For Update Data');
                */
                return redirect()->to(site_url('SalesPipeline'))->with('Success', '<i class="fas fa-save"></i> Data has been saved');
                
            }else{
                return redirect()->to(site_url('SalesPipeline'))->with('Failed', '<i class="fas fa-exclamination"></i> Data Failed to save');
            }
            

            
        } else { // Update
            $where = ['id_SalesPipeline'=>$id];
            $data = [
                
                'nik'=>$this->request->getPost('nik'),
                'id_client'=>$this->request->getPost('id_client'),
                'id_product'=>$this->request->getPost('id_product'),
                'category'=>$this->request->getPost('category'),
                'title'=>$this->request->getPost('title'),
                'count'=>$this->request->getPost('count'),
                'potential_revenue'=>$this->request->getPost('potential_revenue'),
                'total_revenue'=>$this->request->getPost('total_revenue'),
                'status'=>$this->request->getPost('status'), 
            ];
           
            $response = $this->sales_pipelineModel->update($where, $data);
            if($response){
                /* JIKA CLOSING MAKA DATA TITLE AKAN INSERT KE DELIVERY TABEL
                $data = [
                'status'=>$this->request->getPost('status')
                'category'=>$this->request->getPost('category')
                ];
                if ($data['status']=='closing'){
                    $data = [
                        'id_SalesPipeline'=>$this->request->getPost('id_SalesPipeline'),
                    ];
                    if ($data['category']=='video'){
                        $this->videoModel->insert($data);

                    }elseif($data['category']=='digital content'){
                         $this->digital_contentModel->insert($data);
                    
                    }elseif($data['category']=='learning'){
                         $this->learningModel->insert($data);
                    }else{
                        $this->consultingModel->insert($data);
                    }
                }
                 return redirect()->to(site_url('SalesPipeline'))->with('Warning', '<i class="fas fa-exclamation"></i> Please Check Delivery Menu For Update Data');
                */
                return redirect()->to(site_url('SalesPipeline'))->with('Success', '<i class="fas fa-save"></i> Data has been saved');
            }else{
                return redirect()->to(site_url('SalesPipeline'))->with('Failed', '<i class="fas fa-exclamination"></i> Data Failed to save');
            }
            
        }

        
    }


    //delete
    public function delete($id){
        $where = ['id_SalesPipeline'=>$id];   

        
        $response = $this->sales_pipelineModel->delete($where);
        if($response){
            
            return redirect()->to(site_url('SalesPipeline'))->with('Success', '<i class="fas fa-trash"></i> Data has been deleted');
        }else{
            return redirect()->to(site_url('SalesPipeline'))->with('Failed', '<i class="fas fa-exclamination"></i> Data Failed to delete');
        }
        

     
    }




    // Export ke excel
public function export()
{
$dataPipeline = $this->sales_pipelineModel->JoinPipeline();
// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();


// Set document properties
$spreadsheet->getProperties()->setTitle('Office 2007 XLSX Test Document')
->setSubject('Office 2007 XLSX Test Document')
->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
->setKeywords('office 2007 openxml php')
->setCategory('Test result file');

// Add some data
$spreadsheet->setActiveSheetIndex(0)// $where = ['id_SalesPipeline'=>$id];
/*$data = [
    
    'nik'=>$this->request->getPost('nik'),
    'id_client'=>$this->request->getPost('id_client'),
    'id_product'=>$this->request->getPost('id_product'),
    'category'=>$this->request->getPost('category'),
    'title'=>$this->request->getPost('title'),
    'count'=>$this->request->getPost('count'),
    'potential_revenue'=>$this->request->getPost('potential_revenue'),
    'total_revenue'=>$this->request->getPost('total_revenue'),
    'status'=>$this->request->getPost('status'), 
];*/
->setCellValue('A1', 'ID SALES PIPELINE')
->setCellValue('B1', 'NIK')
->setCellValue('C1', 'CLIENT')
->setCellValue('D1', 'PRODUCT')
->setCellValue('E1', 'CATEGORY')
->setCellValue('F1', 'TITLE')
->setCellValue('G1', 'COUNT')
->setCellValue('H1', 'POTENTIAL REVENUE')
->setCellValue('I1', 'TOTAL REVENUE')
->setCellValue('J1', 'STATUS')

;

// Miscellaneous glyphs, UTF-8
$i=2; foreach($dataPipeline as $row) {

$spreadsheet->setActiveSheetIndex(0)
->setCellValue('A'.$i, $row->id_SalesPipeline)
->setCellValue('B'.$i, $row->name)
->setCellValue('C'.$i, $row->client_name)
->setCellValue('D'.$i, $row->product_name)
->setCellValue('E'.$i, $row->category)
->setCellValue('F'.$i, $row->title)
->setCellValue('G'.$i, $row->count)
->setCellValue('H'.$i, $row->potential_revenue)
->setCellValue('I'.$i, $row->total_revenue)
->setCellValue('J'.$i, $row->status)
;
$i++;
}

// Rename worksheet
$spreadsheet->getActiveSheet()->setTitle('Pipeline Data'.date('d-m-Y H'));

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$spreadsheet->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Sales Pipeline Data.xlsx"');
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




   

    


    

