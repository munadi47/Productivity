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
        $this->activityModel = new \App\Models\activityModel();
        $this->attendanceModel = new \App\Models\attendanceModel();
        $this->form_validation = \Config\Services::validation();
        helper(['form', 'url']);
        helper('form');


    }

    public function index(){
        $session = session();

        session();
        $data['validation'] = $this->validator;
        $data = [ 'validate' => \Config\Services::validation()];
        $data['dataEmployee'] = $this->employeeModel->getEmployee();
        $statusEmp['dataAttendance'] = $this->attendanceModel->getStatusAtt();

        echo view ('users/header_v', $statusEmp);
        echo view ('admin/employee_v',$data);
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

       
        $statusEmp['dataAttendance'] = $this->attendanceModel->getStatusAtt();

        echo view('users/header_v',$statusEmp);
        echo view('admin/employee_form_add');
        echo view('users/footer_v');
    }

    public function edit($id){
        $where = ['nik'=> $id];
        
        $data['dataEmployee'] = $this->employeeModel->where($where)->findAll()[0];
        $statusEmp['dataAttendance'] = $this->attendanceModel->getStatusAtt();


        echo view('users/header_v',$statusEmp);
        echo view('admin/employee_form_v',$data);
        echo view ('users/footer_v');

        /*$session = session();
        $session->destroy();
        return redirect()->to('/login')->with('Success', '<i class="fas fa-exclamation"></i> Logout Sucsess');
        */

    }

    public function editProfile($id){
        $where = ['nik'=> $id];
        
        $data['dataEmployee'] = $this->employeeModel->where($where)->findAll()[0];
        $statusEmp['dataAttendance'] = $this->attendanceModel->getStatusAtt();


        echo view('users/header_v',$statusEmp);
        echo view('admin/profile_form',$data);
        echo view ('users/footer_v');

        /*$session = session();
        $session->destroy();
        return redirect()->to('/login')->with('Success', '<i class="fas fa-exclamation"></i> Logout Sucsess');*/
    }

    public function detail($id){
        $data['dataAttendance'] = $this->attendanceModel->getStatusAttX($id);

        $data['dataEmployee'] = $this->employeeModel->getDetail($id);
        $data['countClosing'] = $this->employeeModel->countClosing($id);
        $data['countPICClient'] = $this->employeeModel->countPICClient($id);

        echo view('users/header_v',$data);
        echo view('admin/employee_detail_v',$data);
        echo view ('users/footer_v');
    }

    
    public function save() {

        $id = $this->request->getPost('id');
        $val = $this->validate([
            'email' => [
                'label'  => 'email',
                'rules'  => 'required|valid_email',
                'errors' => [
                    'required' => 'Email Required'
                ]
            ],
            'password' => [
                'label'  => 'Rules.password',
                'rules'  => 'required|min_length[6]',
                'errors' => [
                    'min_length' => 'Your Password is too short, min : 6'
                ]
            ],
            ]);
        if (empty($id)) { //Insert
           if($val) {
                $data = [
                    'nik'=>$this->request->getPost('nik'),
                    'name'=>$this->request->getPost('name'),
                    'address'=>$this->request->getPost('address'),
                    'birthday'=>$this->request->getPost('birthday'),
                    'email'=>$this->request->getPost('email'),
                    'password'=> password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                    'phone1'=>$this->request->getPost('phone1'),
                    'phone2'=>$this->request->getPost('phone2'),
                    'level'=>$this->request->getPost('level'),

                  
                ]; 
                    $this->employeeModel->insert($data);
                    return redirect()->to(site_url('Employee'))->with('Success', '<i class="fas fa-save"></i> Data has been saved');    
                }
                else{
                    //tidak valid
                    session()->setFlashdata('errors', \Config\Services::validation()->getErrors() );
                    return redirect()->to(site_url('Employee/add'));//->with('Success', '<i class="fas fa-save"></i> You Can Login Now');
        
                }            
            
            
            $act = 'Insert new Employee data '.$data['name'];
            $this->record($act,session()->get('nik'));
            
            
        }
       
    }

    public function saveUpdate() {
        /*$data = [
            'nik'=>$this->request->getPost('nik'),
            'name'=>$this->request->getPost('name'),
            'address'=>$this->request->getPost('address'),
            'birthday'=>$this->request->getPost('birthday'), 
            'email'=>$this->request->getPost('email'),
            'phone1'=>$this->request->getPost('phone1'),
            'phone2'=>$this->request->getPost('phone2'),
            'id_eStatus'=>$this->request->getPost('id_eStatus'),
            'level'=>$this->request->getPost('level'),
          
        ];*/ 
        
        $id = $this->request->getPost('id');

        if (empty($id)) { //Insert
           
            
        } else { // Update
            $where = ['nik'=>$id];
            $validation= $this->validate([
                'photo' => [
                    'uploaded[photo]',
                    'mime_in[photo,application/pdf,application/zip,application/msword,application/x-tar,image/jpg,image/jpeg,image/png]',
                    'max_size[photo,5000]',
                ]
            ]);
          
            
            if (!$validation){
                $data = [
                    'nik'=>$this->request->getPost('nik'),
                    'name'=>$this->request->getPost('name'),
                    'address'=>$this->request->getPost('address'),
                    'birthday'=>$this->request->getPost('birthday'), 
                    'email'=>$this->request->getPost('email'),
                    'phone1'=>$this->request->getPost('phone1'),
                    'phone2'=>$this->request->getPost('phone2'),
                    'level'=>$this->request->getPost('level'),
                  
                ]; 
        
                $response = $this->employeeModel->update($where,$data);
                if($response){
                    return redirect()->to(site_url('Employee'))->with('Success', '<i class="fas fa-save"></i> Data has been updated, but chart not uploaded, please check again');
                }else{
                    return redirect()->to(site_url('Employee'))->with('Failed', '<i class="fas fa-times"></i> Data failed to save');
                }
                $act = 'Update employee data '.$data['project_name'];
                $this->record($act,session()->get('nik'));
            
            
            }else{
                $dt = $this->employeeModel->getWhere(['nik'=>$id])->getRow();
                $file1 = $dt->photo;
                $path = 'assets/uploads/profile/';
                @unlink($path.$file1);
                    $photo = $this->request->getFile('photo');
                    $photo->move('assets/uploads/profile/');
    
                    $data = [
                        'nik'=>$this->request->getPost('nik'),
                        'name'=>$this->request->getPost('name'),
                        'address'=>$this->request->getPost('address'),
                        'birthday'=>$this->request->getPost('birthday'), 
                        'email'=>$this->request->getPost('email'),
                        'phone1'=>$this->request->getPost('phone1'),
                        'phone2'=>$this->request->getPost('phone2'),
                        'level'=>$this->request->getPost('level'),
                        'photo'=> $this->request->getFile('photo')->getName()  

                    ]; 
                    
                $response =  $this->employeeModel->update($where, $data);
                if($response){
                    return redirect()->to(site_url('Employee'))->with('Success', '<i class="fas fa-save"></i> Data has been updated');
                }else{
                    return redirect()->to(site_url('Employee'))->with('Failed', '<i class="fas fa-times"></i> Data failed to save');
                }
                $act = 'Update Employee data '.$data['project_name'];
                $this->record($act,session()->get('nik'));   
            }

            ///////////////////
                /*$where = ['nik'=>$id];
                $response =  $this->employeeModel->update($where, $data);
        
            if($response){
                return redirect()->to(site_url('Employee'))->with('Success', '<i class="fas fa-save"></i> Data has been saved');
            }else {
                return redirect()->to(site_url('Employee'))->with('Failed', '<i class="fas fa-exclamination"></i> Data Failed to save');

            }*/
            
            
        }

       
    }

    public function saveProfile() {
        $session = session();
        $id = $this->request->getPost('id');
                
        if (empty($id)) { //Insert
            

        
        } else { // Update
                $where = ['nik'=>$id];

                $validation= $this->validate([
                    'photo' => [
                        'uploaded[photo]',
                        'mime_in[photo,image/jpg,image/jpeg,image/png]',
                        'max_size[photo,5000]',
                    ]
                ]);

                if (!$validation){
                    $data = array(
                        'nik'=>$this->request->getPost('nik'),
                        'name'=>$this->request->getPost('name'),
                        'address'=>$this->request->getPost('address'),
                        'birthday'=>$this->request->getPost('birthday'), 
                        'email'=>$this->request->getPost('email'),
                        'password'=> password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                        'phone1'=>$this->request->getPost('phone1'),
                        'phone2'=>$this->request->getPost('phone2'),
                        
                    );
                    $session->set($data); 
                    $response = $this->employeeModel->update($where,$data);
                    if($response){
                        return redirect()->to(site_url('Employee'))->with('Success', '<i class="fas fa-save"></i> Data has been updated, but photo not uploaded, please check again');
                    }else{
                        return redirect()->to(site_url('Employee'))->with('Failed', '<i class="fas fa-times"></i> Data failed to save');
                    }
                    $act = 'Update Employee data '.$data['project_name'];
                    $this->record($act,session()->get('nik'));
                
                
                }else{
                    $dt = $this->employeeModel->getWhere(['nik'=>$id])->getRow();
                    $file1 = $dt->photo;
                    $path = 'assets/uploads/profile/';
                    @unlink($path.$file1);
                        $photo = $this->request->getFile('photo');
                        $photo->move('assets/uploads/profile/');
                   
                    $data = array(
                        'nik'=>$this->request->getPost('nik'),
                        'name'=>$this->request->getPost('name'),
                        'address'=>$this->request->getPost('address'),
                        'birthday'=>$this->request->getPost('birthday'), 
                        'email'=>$this->request->getPost('email'),
                        'password'=> password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                        'phone1'=>$this->request->getPost('phone1'),
                        'phone2'=>$this->request->getPost('phone2'),
                        'photo'=> $this->request->getFile('photo')->getName()  
    
                    );
                    $session->set($data); 
                    $response = $this->employeeModel->update($where,$data);
                    if($response){
                        return redirect()->to(site_url('Employee'))->with('Success', '<i class="fas fa-save"></i> Data has been updated');
                    }else{
                        return redirect()->to(site_url('Employee'))->with('Failed', '<i class="fas fa-times"></i> Data failed to save');
                    }
                    $act = 'Update Employee data '.$data['project_name'];
                    $this->record($act,session()->get('nik'));   
                   
                }
              
               
        }

    }


    //delete
    public function delete($id){
        $where = ['nik'=>$id];   

        $response = $this->employeeModel->delete($where);
        $act = 'Delete Employee data, NIK : '.$id;
        $this->record($act,session()->get('nik'));
        if($response){
            return redirect()->to(site_url('Employee'))->with('Success', '<i class="fas fa-trash"></i> Data has been deleted');
        }else{
            return redirect()->to(site_url('Employee'))->with('Failed', '<i class="fas fa-exclamination"></i> Data Failed to delete');
        }
       

    }

    


    // Export ke excel
public function export()
{
$dataEmployee = $this->employeeModel->getEmployee();
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
->setCellValue('A1', 'NIK')
->setCellValue('B1', 'NAME')
->setCellValue('C1', 'EMAIL')
->setCellValue('D1', 'PASSWORD')
->setCellValue('E1', 'PHONE1')
->setCellValue('F1', 'PHONE2')
->setCellValue('G1', 'LEVEL')
;

// Miscellaneous glyphs, UTF-8
$i=2; foreach($dataEmployee as $row) {

$spreadsheet->setActiveSheetIndex(0)
->setCellValue('A'.$i, $row->nik)
->setCellValue('B'.$i, $row->name)
->setCellValue('C'.$i, $row->email)
->setCellValue('D'.$i, $row->password)
->setCellValue('E'.$i, $row->phone1)
->setCellValue('F'.$i, $row->phone2)
->setCellValue('G'.$i, $row->level)

;
$i++;
}
$act = 'Export all Employee data to excel';
$this->record($act,session()->get('nik'));

// Rename worksheet
$spreadsheet->getActiveSheet()->setTitle('Employee Data'.date('d-m-Y H'));

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$spreadsheet->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Employee Data.xlsx"');
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
    echo view('admin/employee_excel_form_v');
    echo view('users/footer_v');
}


public function do_upload(){
    $validated = $this->validate([
        'employee_file' => [
            'uploaded[employee_file]',
            'mime_in[employee_file,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]',
            'max_size[employee_file,1024]',
        ]
        
    ]);
    if(!$validated){
        return redirect()->to(site_url('Employee'))->with('Failed','<i class="fas fa-times"></i> Failed to import, please check again');
    }
    else{
        $employee_file = $this->request->getFile('employee_file');
                //$userfile->move(WRITEPATH . 'uploads');
        $employee_file->move('assets/uploads/file_excel/');
        $M = $employee_file->getName();
        $this->import_file($M);
        return redirect()->to(site_url('Employee'))->with('Success','<i class="fas fa-check"></i> Success to import file');
        
    }
}

public function import_file($nf){
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    $spreadsheet = $reader->load('assets/uploads/file_excel/'.$nf);
    $sheetData = $spreadsheet->getActiveSheet()->toArray();
    
    for($i = 1;$i < count($sheetData);$i++)
    {
        //perhatikan indeks harus sama dengan field atau column di database
        $data[$i]['nik']  = $sheetData[$i][0];
        $data[$i]['name']  = $sheetData[$i][1];
        $data[$i]['address']  = $sheetData[$i][2];
        $data[$i]['birthday'] = $sheetData[$i][3];
        $data[$i]['email'] = $sheetData[$i][4];
        $data[$i]['password'] = $sheetData[$i][5];
        $data[$i]['phone1'] = $sheetData[$i][6];
        $data[$i]['phone2'] = $sheetData[$i][7];
        $data[$i]['level'] = $sheetData[$i][8];

       
    }
    foreach($data as $row):{
        $this->employeeModel->insert($row);
    }
    //$this->adminModel->set($data);
    //$this->adminModel->insert($data);
    //$this->adminModel->insert($data);
    endforeach;
    $act = 'Import new employee data';
    $this->record($act,session()->get('nik'));
}	
        

}




