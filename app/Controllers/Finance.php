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
        $this->activityModel = new \App\Models\activityModel();
        $this->attendanceModel = new \App\Models\attendanceModel();
        $this->videoModel = new \App\Models\videoModel();
        $this->digitalModel = new \App\Models\digital_contentModel();
        


    }

    public function index(){
        $session = session();
        $data['dataFinance'] = $this->financeModel->getStatusFinance();
           
        $notif['deadlineStory'] = $this->videoModel->deadlineStory();
        $notif['deadlineShoot'] = $this->videoModel->deadlineShoot();
        $notif['deadlineEdit'] = $this->videoModel->deadlineEdit();
        $notif['deadlineStoryDigital'] = $this->digitalModel->deadlineStory();
        $notif['deadlineVoice'] = $this->digitalModel->deadlineVoice();
        $notif['deadlineAnimate'] = $this->digitalModel->deadlineAnimate();
        $notif['deadlineCompile'] = $this->digitalModel->deadlineCompile();
        $notif['deadlineFinance'] = $this->financeModel->deadlineFinance();
        $notif['dataAttendance'] = $this->attendanceModel->getStatusAtt();
        echo view ('admin/header_v_admin',$notif);
        echo view ('admin/finance_v',$data);
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
        $data['dataClient'] = $this->clientModel->findAll();
        $data['datafinancestatus'] = $this->financestatusModel->findAll();
           
        $notif['deadlineStory'] = $this->videoModel->deadlineStory();
        $notif['deadlineShoot'] = $this->videoModel->deadlineShoot();
        $notif['deadlineEdit'] = $this->videoModel->deadlineEdit();
        $notif['deadlineStoryDigital'] = $this->digitalModel->deadlineStory();
        $notif['deadlineVoice'] = $this->digitalModel->deadlineVoice();
        $notif['deadlineAnimate'] = $this->digitalModel->deadlineAnimate();
        $notif['deadlineCompile'] = $this->digitalModel->deadlineCompile();
        $notif['deadlineFinance'] = $this->financeModel->deadlineFinance();
        $notif['dataAttendance'] = $this->attendanceModel->getStatusAtt();


        echo view('admin/header_v_admin',$notif);
        echo view('admin/finance_form_v',$data);
        echo view('users/footer_v');
    }

    public function edit($id){
        $where = ['id_finance'=> $id];
        $data['datafinancestatus'] = $this->financestatusModel->findAll();
        $data['dataClient'] = $this->clientModel->findAll();
        $data['dataFinance'] = $this->financeModel->where($where)->findAll()[0];
          
        $notif['deadlineStory'] = $this->videoModel->deadlineStory();
        $notif['deadlineShoot'] = $this->videoModel->deadlineShoot();
        $notif['deadlineEdit'] = $this->videoModel->deadlineEdit();
        $notif['deadlineStoryDigital'] = $this->digitalModel->deadlineStory();
        $notif['deadlineVoice'] = $this->digitalModel->deadlineVoice();
        $notif['deadlineAnimate'] = $this->digitalModel->deadlineAnimate();
        $notif['deadlineCompile'] = $this->digitalModel->deadlineCompile();
        $notif['deadlineFinance'] = $this->financeModel->deadlineFinance();
        $notif['dataAttendance'] = $this->attendanceModel->getStatusAtt();


        echo view('users/header_v',$notif);
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
            $act = 'Insert new Finance data, Client : '.$data['id_client'];
            $this->record($act,session()->get('nik'));
            
            //masih aneh
            if($response){
                return redirect()->to(site_url('Finance'))->with('Success', '<i class="fas fa-save"></i> Data has been saved');
            }else{
                return redirect()->to(site_url('Finance'))->with('Failed', '<i class="fas fa-exclamination"></i> Data Failed to save');
            }
            
            
        } else { // Update
                $where = ['nik'=>$id];
                $response =  $this->financeModel->update($where, $data);
                $act = 'Update Finance data, Client : '.$data['id_client'];
                $this->record($act,session()->get('nik'));

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
        $act = 'Delete Finance data';
        $this->record($act,session()->get('nik'));
        if($response){
            return redirect()->to(site_url('Finance'))->with('Success', '<i class="fas fa-trash"></i> Data has been deleted');
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
        $pdf->SetMargins(-1, 0, -1);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('IDE GROUP');
        $pdf->SetTitle('Invoice');
        $pdf->SetSubject('Invoice');
        $pdf->SetKeywords('PDF, example, test, invoice');    


        $pdf->addPage();

        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        
        $this->response->setContentType('application/pdf');
        //Close and output PDF document
        $pdf->Output('Invoice.pdf', 'I');
        $act = 'Generate new Invoice data';
        $this->record($act,session()->get('nik'));
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
header('Content-Disposition: attachment;filename="Finance.xlsx"');
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
      
    $notif['deadlineStory'] = $this->videoModel->deadlineStory();
    $notif['deadlineShoot'] = $this->videoModel->deadlineShoot();
    $notif['deadlineEdit'] = $this->videoModel->deadlineEdit();
    $notif['deadlineStoryDigital'] = $this->digitalModel->deadlineStory();
    $notif['deadlineVoice'] = $this->digitalModel->deadlineVoice();
    $notif['deadlineAnimate'] = $this->digitalModel->deadlineAnimate();
    $notif['deadlineCompile'] = $this->digitalModel->deadlineCompile();
    $notif['deadlineFinance'] = $this->financeModel->deadlineFinance();
    $notif['dataAttendance'] = $this->attendanceModel->getStatusAtt();

    echo view('users/header_v',$notif);
    echo view('admin/finance_excel_form_v');
    echo view('users/footer_v');
}

public function do_upload(){
    $validated = $this->validate([
        'finance_file' => [
            'uploaded[finance_file]',
            'mime_in[finance_file,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]',
            'max_size[finance_file,1024]',
        ]
        
    ]);
    if(!$validated){
        return redirect()->to(site_url('Finance'))->with('Failed','<i class="fas fa-times"></i> Failed to import, please check again');
    }
    else{
        $finance_file = $this->request->getFile('finance_file');
                //$userfile->move(WRITEPATH . 'uploads');
        $finance_file->move('assets/uploads/file_excel/');
        $M = $finance_file->getName();
        $this->import_file($M);
        return redirect()->to(site_url('Finance'))->with('Success','<i class="fas fa-check"></i> Success to import file');
        
    }
}

public function import_file($nf){
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    $spreadsheet = $reader->load('assets/uploads/file_excel/'.$nf);
    $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
    //var_dump($sheetData);

    /*for($i = 1;$i < count($sheetData);$i++)
    {
        //perhatikan indeks harus sama dengan field atau column di database
        $data[$i]['id_client']  = $sheetData[$i][0];
        $data[$i]['id_fStatus'] = $sheetData[$i][1];
        $data[$i]['invoice_date']  = $sheetData[$i][2];
        $data[$i]['invoice_amount'] = $sheetData[$i][3];
        $data[$i]['invoice_duedate']  = $sheetData[$i][4];
  
    }*/
    foreach($sheetData as $key => $data):{
        if ($key == 1 ){
            continue;
        }
        $data = array (
            'id_client' => $data['A'], 	 	 	 	 
            'id_fStatus' => $data['B'],
            'invoice_date' => $data['C'],
            'invoice_amount' => $data['D'],
            'invoice_duedate' => $data['E'],
        );
        $this->financeModel->insert($data);
        var_dump($data);

    }
    endforeach;
    $act = 'Import new finance data';
    $this->record($act,session()->get('nik'));
}	
        
    

}




