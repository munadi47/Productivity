<?php
namespace App\Controllers;

require('../excel/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
// End load library phpspreadsheet

use CodeIgniter\HTTP\Files\UploadedFile;

use App\Models\umkmModel;
use mysqli;
use phpDocumentor\Reflection\PseudoTypes\False_;

class Umkm extends BaseController{
    public function __construct()
    {
        helper('html');
        helper('form');
        $this->session = \Config\Services::session();
        $this->umkmModel = new \App\Models\umkmModel();
        $this->aksesModel = new \App\Models\aksesModel();
        $this->adminModel = new \App\Models\adminModel();
        $pager = \Config\Services::pager();
    }

    public function index(){
        $session = session();
        if(!$this->validate([])){
        
        
        $keyword = $this->request->getVar('keyword');
        if($keyword){
            $umkm = $this->umkmModel->search($keyword);
            
            
        } else {
            $umkm = $this->umkmModel;
        }

         // paginate
        $paginate = 5;
        $data['dataUmkm']   = $umkm->paginate($paginate, 'dataUmkm');
        $data['pager']      = $this->umkmModel->pager;
        $data['validation'] = $this->validator;
        
       
        echo view ('header_v');
        echo view ('umkm_v',$data);
        echo view ('footer_v');
        }
    }

   

    public function add(){
        echo view('header_v');
        echo view('umkm_form_v');
        echo view('footer_v');
    }

    public function edit($id){
        $where = ['id_umkm'=> $id];
        $data['dataUmkm'] = $this->umkmModel->where($where)->findAll()[0];
        
        echo view('header_v');
        echo view('umkm_form_v',$data);
        echo view ('footer_v');
    }

    public function save() {
        
        $id = $this->request->getPost('id_umkm');

        if (empty($id)) { //Insert
            $validation = $this->validate([
                'foto_ktp' => 'uploaded[foto_ktp]|mime_in[foto_ktp,image/jpg,image/jpeg,image/gif,image/png]|max_size[foto_ktp,4096]',
                'foto_surat' => 'uploaded[foto_surat]|mime_in[foto_surat,image/jpg,image/jpeg,image/gif,image/png]|max_size[foto_surat,4096]'
                ]);
            
            if($validation == FALSE){
                $data = [
                    'nama_umkm'=>$this->request->getPost('nama_umkm'),
                    'komoditas'=>$this->request->getPost('komoditas'),
                    'alamat'=>$this->request->getPost('alamat'),
                    'kontak'=>$this->request->getPost('kontak'),
                    'no_ktp'=>$this->request->getPost('no_ktp'),
                    
                ];
            }else{
                $ktp = $this->request->getFile('foto_ktp');
                $surat = $this->request->getFile('foto_surat');
                $ktp->move('assets/images/');
                $surat->move('assets/images/');
                $data = [
                    'nama_umkm'=>$this->request->getPost('nama_umkm'),
                    'komoditas'=>$this->request->getPost('komoditas'),
                    'alamat'=>$this->request->getPost('alamat'),
                    'kontak'=>$this->request->getPost('kontak'),
                    'no_ktp'=>$this->request->getPost('no_ktp'),
                    'foto_ktp' => $ktp->getName(),
                    'foto_surat' => $surat->getName(),
                    
                ];
    
            }
            $this->umkmModel->insert($data);
            

            
        } else { // Update
            $where = ['id_umkm'=>$id];

            $validation = $this->validate([
                'foto_ktp' => 'uploaded[foto_ktp]|mime_in[foto_ktp,image/jpg,image/jpeg,image/gif,image/png]|max_size[foto_ktp,4096]',
                'foto_surat' => 'uploaded[foto_surat]|mime_in[foto_surat,image/jpg,image/jpeg,image/gif,image/png]|max_size[foto_surat,4096]'
            ]);

            if($validation == FALSE){
                $data = [
                    'nama_umkm'=>$this->request->getPost('nama_umkm'),
                    'komoditas'=>$this->request->getPost('komoditas'),
                    'alamat'=>$this->request->getPost('alamat'),
                    'kontak'=>$this->request->getPost('kontak'),
                    'no_ktp'=>$this->request->getPost('no_ktp'),
                    
                ];
            }else{
                $dt = $this->umkmModel->getWhere(['id_umkm'=>$id])->getRow();
                $gambar1 = $dt->foto_ktp;
                $gambar2 = $dt->foto_surat;
                $path = 'assets/images/';
                @unlink($path.$gambar1);
                    $ktp = $this->request->getFile('foto_ktp');
                    $ktp->move('assets/images/');
                @unlink($path.$gambar2);
                    $surat = $this->request->getFile('foto_surat');
                    $surat->move('assets/images/');
                $data = [
                    'nama_umkm'=>$this->request->getPost('nama_umkm'),
                    'komoditas'=>$this->request->getPost('komoditas'),
                    'alamat'=>$this->request->getPost('alamat'),
                    'kontak'=>$this->request->getPost('kontak'),
                    'no_ktp'=>$this->request->getPost('no_ktp'),
                    'foto_ktp' => $ktp->getName(),
                    'foto_surat' => $surat->getName(),
                        
                ];}
            $this->umkmModel->update($where, $data);
            
            
        }

        return redirect()->to(site_url('Umkm'))->with('berhasil', 'Data Berhasil di Simpan');
    }


    //delete
    public function delete($id){
        $where = ['id_umkm'=>$id];
        $dt = $this->umkmModel->getWhere(['id_umkm'=>$id])->getRow();
        $this->umkmModel->delete($where);
        
        
        $gambar1 = $dt->foto_ktp;
        $gambar2 = $dt->foto_surat;
        $path = 'assets/images/';
        @unlink($path.$gambar1);
        @unlink($path.$gambar2);
        
        

        return redirect()->to(site_url('Umkm'))->with('berhasil', 'Data Berhasil di Hapus');
    }




    // Export ke excel
public function export()
{
$ExcelUMKM = $this->umkmModel->findAll();
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
->setCellValue('A1', 'ID UMKM')
->setCellValue('B1', 'NAMA')
->setCellValue('C1', 'KOMODITAS')
->setCellValue('D1', 'ALAMAT')
->setCellValue('E1', 'KONTAK')
->setCellValue('F1', 'NO KTP')
->setCellValue('G1', 'NAMA FILE KTP')
->setCellValue('H1', 'NAMA FILE SURAT')
;

// Miscellaneous glyphs, UTF-8
$i=2; foreach($ExcelUMKM as $ExcelUMKM) {

$spreadsheet->setActiveSheetIndex(0)
->setCellValue('A'.$i, $ExcelUMKM->id_umkm)
->setCellValue('B'.$i, $ExcelUMKM->nama_umkm)
->setCellValue('C'.$i, $ExcelUMKM->komoditas)
->setCellValue('D'.$i, $ExcelUMKM->alamat)
->setCellValue('E'.$i, $ExcelUMKM->kontak)
->setCellValue('F'.$i, $ExcelUMKM->no_ktp)
->setCellValue('G'.$i, $ExcelUMKM->foto_ktp)
->setCellValue('H'.$i, $ExcelUMKM->foto_surat);
$i++;
}

// Rename worksheet
$spreadsheet->getActiveSheet()->setTitle('Data UMKM '.date('d-m-Y H'));

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$spreadsheet->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Report UMKM.xlsx"');
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
