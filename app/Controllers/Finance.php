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

class Finance extends BaseController{
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->financeModel = new \App\Models\financeModel();
        $this->financestatusModel = new \App\Models\financestatusModel();
        $this->clientModel = new \App\Models\clientModel();

    }

    public function index(){
        $session = session();
        $data['dataFinance'] = $this->financeModel->getStatusFinance();

        echo view ('users/header_v');
        echo view ('admin/finance_v',$data);
        echo view ('users/footer_v');
        
    }

   

    public function add(){
        $data['dataClient'] = $this->clientModel->findAll();
        $data['datafinancestatus'] = $this->financestatusModel->findAll();
        

        echo view('users/header_v');
        echo view('admin/finance_form_v',$data);
        echo view('users/footer_v');
    }

    public function edit($id){
        $where = ['id_finance'=> $id];
        $data['datafinancestatus'] = $this->financestatusModel->findAll();
        $data['dataClient'] = $this->clientModel->findAll();
        $data['dataFinance'] = $this->financeModel->where($where)->findAll()[0];
        

        echo view('users/header_v');
        echo view('admin/finance_form_v',$data);
        echo view ('users/footer_v');
    }

    public function save() {
        $data = [ 	 	 
            'id_client'=>$this->request->getPost('id_client'),
            'invoice_date'=>$this->request->getPost('invoice_date'),
            'invoice_duedate'=>$this->request->getPost('invoice_duedate'),          
            'invoice_amount'=>$this->request->getPost('invoice_amount'),
            'id_fStatus'=>$this->request->getPost('id_fStatus'),

        ]; 
        
        $id = $this->request->getPost('id_finance');

        if (empty($id)) { //Insert
           
            $response = $this->financeModel->insert($data);
            
            //masih aneh
            if($response){
                return redirect()->to(site_url('Finance'))->with('Success', '<i class="fas fa-save"></i> Data has been saved');
            }else{
                return redirect()->to(site_url('Finance'))->with('Failed', '<i class="fas fa-exclamination"></i> Data Failed to save');
            }
            
            
        } else { // Update
                $where = ['nik'=>$id];
                $response =  $this->financeModel->update($where, $data);

            if($response){
                return redirect()->to(site_url('Finance'))->with('Success', '<i class="fas fa-save"></i> Data has been saved');
            }else{
                return redirect()->to(site_url('Finance'))->with('Failed', '<i class="fas fa-exclamination"></i> Data Failed to save');
            }
            
            
        }

       
    }


    //delete
    public function delete($id){
        $where = ['id_finance'=>$id];   

        $response = $this->financeModel->delete($where);
        if($response){
            return redirect()->to(site_url('Finance'))->with('Success', '<i class="fas fa-save"></i> Data has been deleted');
        }else{
            return redirect()->to(site_url('Finance'))->with('Failed', '<i class="fas fa-exclamination"></i> Data Failed to delete');
        }
       

    }
    public function invoice($id)
    {
        $data['dataFinance'] = $this->financeModel->getInvoice($id);

        $html=  view('admin/invoice',$data);
        
        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('Invoice');
        $pdf->SetSubject('Invoice');
        $pdf->SetKeywords('PDF, example, test, invoice');    

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->addPage();

        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        $this->response->setContentType('application/pdf');
        //Close and output PDF document
        $pdf->Output('Invoice.pdf', 'I');

    
    
    }



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
->setCellValue('A1', 'ID FINANCE')
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




