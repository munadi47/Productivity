<?php
namespace App\Controllers;
use App\Models\authModel;    

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

class Auth extends BaseController{
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->employeeModel = new \App\Models\employeeModel();
        $this->loginModel = new \App\Models\AuthModel();
        helper('form');
        $this->form_validation = \Config\Services::validation();
        $this->activityModel = new \App\Models\activityModel();

    }

    public function index()
    {
        session();
        $data = [ 'validate' => \Config\Services::validation()];

        echo view ('users/header_v');
        echo view ('admin/register_form_v', $data);
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

    public function register(){   
        $data['dataEmployee'] = $this->employeeModel->getEmployee();

        if ($this->validate([
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
            ]
        ])) {
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
                return redirect()->to(site_url('Login'))->with('Success', '<i class="fas fa-save"></i> You Can Login Now');
            
        }
        else{
            //tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors() );
            return redirect()->to(site_url('/Auth'));//->with('Success', '<i class="fas fa-save"></i> You Can Login Now');

        }
    }        
        
        
    public function login()
    {
        $session = session();
        $model = new AuthModel;
        $table = 'employee';
        $username = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $row = $model->get_data_login($username,$table);
        //$data = $model->where('email',$username)->first();
        
        //var_dump($data);

        if ($row == NULL){
            return redirect()->to('/login')->with('Failed', '<i class="fas fa-exclamation"></i> Failed To Login');
        }
        if(password_verify($password,$row->password)){
            
            $data = array(
            'login' => TRUE,
            'nik' => $row->nik,
            'name' => $row->name,
            'birthday' => $row->birthday,
            'email' => $row->email,
            'level' => $row->level,
            'address' => $row->address,
            'phone1' => $row->phone1,
            'phone2' => $row->phone2,
            'photo' => $row->photo,
            );
        $act = 'Has Login';
        $this->record($act,$data['nik']);

        $session->set($data);        
        return redirect()->to('/Client')->with('Success', '<i class="fas fa-exclamation"></i> Sucsess To Login');
       
        }else{

                return redirect()->to('/login')->with('Failed', '<i class="fas fa-exclamation"></i> Failed To Login');
                //->withInput()->with('validate',$pesanValidasi);
                //->with('Failed', '<i class="fas fa-exclamation"></i> Failed To Login');
        }
        
        /*$data = array(
            'login' => TRUE,
            'nik' => $row->nik,
            'name' => $row->name,
            'birthday' => $row->birthday,
            'email' => $row->email,
            'level' => $row->level,
            'address' => $row->address,
            'phone1' => $row->phone1,
            'phone2' => $row->phone2,
            'id_eStatus' => $row->id_eStatus,
        );
        $session->set($data);
        //var_dump($data);
        return redirect()->to('/Client')->with('Success', '<i class="fas fa-exclamation"></i> Sucsess Login');*/
    }

    public function logout()
    {
        $act = 'Has Logout';
        $this->record($act,session()->get('nik'));
        $session = session();
        $session->destroy();
        return redirect()->to('/login')->with('Success', '<i class="fas fa-exclamation"></i> Logout Sucsess');
       
    }


}

   





