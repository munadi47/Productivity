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

class Product extends BaseController{
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->productModel = new \App\Models\productModel();
        $this->companyModel = new \App\Models\companyModel();
        $this->activityModel = new \App\Models\activityModel();
        $this->attendanceModel = new \App\Models\attendanceModel();


    }

    public function index(){
        $session = session();
    
        $data['dataProduct'] = $this->productModel->getCompany();
        $statusEmp['dataAttendance'] = $this->attendanceModel->getStatusAtt();

        echo view ('users/header_v',$statusEmp);
        echo view ('users/product_v',$data);
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
     
        $data['dataCompany'] = $this->companyModel->findAll();
        $statusEmp['dataAttendance'] = $this->attendanceModel->getStatusAtt();

        echo view('users/header_v',$statusEmp);
        echo view('users/product_form_v',$data);
        echo view('users/footer_v');
    }

    public function edit($id){
        $where = ['id_product'=> $id];
        $data['dataProduct'] = $this->productModel->where($where)->findAll()[0];
        $data['dataCompany'] = $this->companyModel->findAll();
        $statusEmp['dataAttendance'] = $this->attendanceModel->getStatusAtt();

        echo view('users/header_v',$statusEmp);
        echo view('users/product_form_v',$data);
        echo view ('users/footer_v');
    }

    public function save() {
        
        $id = $this->request->getPost('id_product');

        if (empty($id)) { //Insert
           
            $data = [
                'product_name'=>$this->request->getPost('product_name'),
                'std_price'=>$this->request->getPost('std_price'),
                'id_company'=>$this->request->getPost('id_company'),
                    
            ];
            
            $response = $this->productModel->insert($data);
            $act = 'Insert new Product data '.$data['product_name'];
            $this->record($act,session()->get('nik'));
            if($response){
                return redirect()->to(site_url('Product'))->with('Success', '<i class="fas fa-save"></i> Data has been saved');
            }else{
                return redirect()->to(site_url('Product'))->with('Failed', '<i class="fas fa-exclamination"></i> Data Failed to save');
            }

        } else { // Update
            $where = ['id_product'=>$id];
            $data = [
                'product_name'=>$this->request->getPost('product_name'),
                'std_price'=>$this->request->getPost('std_price'),
                'id_company'=>$this->request->getPost('id_company'),
                    
            ];
         
           
            $response = $this->productModel->update($where, $data);
            $act = 'Update Product data '.$data['product_name'];
            $this->record($act,session()->get('nik'));
            if($response){
                return redirect()->to(site_url('Product'))->with('Success', '<i class="fas fa-save"></i> Data has been saved');
            }else{
                return redirect()->to(site_url('Product'))->with('Failed', '<i class="fas fa-exclamination"></i> Data Failed to save');
            }
            
        }

        
    }


    //delete
    public function delete($id){
        $where = ['id_product'=>$id];   
        $where = ['id_product'=>$id]; 

    
        
        $response = $this->productModel->delete($where);
        $act = 'Delete Product data';
        $this->record($act,session()->get('nik'));
        if($response){
            return redirect()->to(site_url('Product'))->with('Success', '<i class="fas fa-trash"></i> Data has been deleted');
        }else{
            return redirect()->to(site_url('Product'))->with('Failed', '<i class="fas fa-exclamination"></i> Data Failed to delete');
        }
        

     
    }




    // Export ke excel
public function export()
{
$dataProduct = $this->productModel->getCompany();
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
->setCellValue('A1', 'ID PRODUCT')
->setCellValue('B1', 'PRODUCT NAME')
->setCellValue('C1', 'STANDARD PRICE')
->setCellValue('D1', 'COMPANY')

;

// Miscellaneous glyphs, UTF-8
$i=2; foreach($dataProduct as $row) {

$spreadsheet->setActiveSheetIndex(0)
->setCellValue('A'.$i, $row->id_product)
->setCellValue('B'.$i, $row->product_name)
->setCellValue('C'.$i, $row->std_price)
->setCellValue('D'.$i, $row->company_name)
;
$i++;
}
$act = 'Export all Product data to excel';
$this->record($act,session()->get('nik'));

// Rename worksheet
$spreadsheet->getActiveSheet()->setTitle('Product Data'.date('d-m-Y H'));

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$spreadsheet->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Product Data.xlsx"');
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

public function import(){
    $statusEmp['dataAttendance'] = $this->attendanceModel->getStatusAtt();

    echo view('users/header_v',$statusEmp);
    echo view('users/product_excel_form_v');
    echo view('users/footer_v');
}


public function do_upload(){
    $validated = $this->validate([
        'product_file' => [
            'uploaded[product_file]',
            'mime_in[product_file,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]',
            'max_size[product_file,1024]',
        ]
        
    ]);
    if(!$validated){
        return redirect()->to(site_url('Product'))->with('Failed','<i class="fas fa-times"></i> Failed to import, please check again');
    }
    else{
        $product_file = $this->request->getFile('product_file');
                //$userfile->move(WRITEPATH . 'uploads');
        $product_file->move('assets/uploads/file_excel/');
        $M = $product_file->getName();
        $this->import_file($M);
        return redirect()->to(site_url('Product'))->with('Success','<i class="fas fa-check"></i> Success to import file');
        
    }
}

public function import_file($nf){
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    $spreadsheet = $reader->load('assets/uploads/file_excel/'.$nf);
    $sheetData = $spreadsheet->getActiveSheet()->toArray();
    
    for($i = 1;$i < count($sheetData);$i++)
    {
        //perhatikan indeks harus sama dengan field atau column di database
        $data[$i]['product_name']  = $sheetData[$i][0];
        $data[$i]['std_price']  = $sheetData[$i][1];
        $data[$i]['id_company']  = $sheetData[$i][2];
        

       
    }
    foreach($data as $row):{
        $this->productModel->insert($row);
    }
    //$this->adminModel->set($data);
    //$this->adminModel->insert($data);
    //$this->adminModel->insert($data);
    endforeach;
    $act = 'Import new product data';
    $this->record($act,session()->get('nik'));
}	
        




}




   

    


    

