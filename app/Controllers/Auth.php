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
        $this->empstatusModel = new \App\Models\empstatusModel();
        $this->loginModel = new \App\Models\AuthModel();

    }

    public function index()
    {
        $data['dataEmpstatus'] = $this->empstatusModel->findAll();

        echo view ('users/header_v');
        echo view ('admin/register_form_v', $data);
        echo view ('users/footer_v');

    }

    public function register(){   
        $data['dataEmployee'] = $this->employeeModel->getEmployee();
        $data['dataEmpstatus'] = $this->empstatusModel->findAll();

        $data = [
            'nik'=>$this->request->getPost('nik'),
            'name'=>$this->request->getPost('name'),
            'address'=>$this->request->getPost('address'),
            'birthday'=>$this->request->getPost('birthday'),
            'email'=>$this->request->getPost('email'),
            'password'=> $this->request->getPost('password'),
            'phone1'=>$this->request->getPost('phone1'),
            'phone2'=>$this->request->getPost('phone2'),
            'id_eStatus'=>$this->request->getPost('id_eStatus'),
            'level'=>$this->request->getPost('level'),
          
        ]; 
            $this->employeeModel->insert($data);
        return redirect()->to(site_url('Login'))->with('Success', '<i class="fas fa-save"></i> You Can Login Now');

        
    }

    public function login()
    {
        $session = session();
        $model = new authModel();
        $table = 'employee';
        $username = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $row = $model->get_data_login($username,$table);
        //$data = $model->where('email',$username)->first();

        //var_dump($data);
        if ($row == NULL){
            return redirect()->to('/login')->with('Failed', '<i class="fas fa-exclamation"></i> Failed To Login');
        }
        /*elseif (password_verify($password,$row->password)){
            $data = array(
                'login' => TRUE,
                'nama' => $row->name,
                'email' => $row->email,
                'level' => $row->level,
            );
            session()->set($data);
            return redirect()->to('/Client')->with('Success', '<i class="fas fa-exclamination"></i> Sucsess To Login');
        }*/
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
            'id_eStatus' => $row->id_eStatus,
        );
        $session->set($data);
        //var_dump($data);
        return redirect()->to('/Client')->with('Success', '<i class="fas fa-exclamation"></i> Sucsess Login');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login')->with('Success', '<i class="fas fa-exclamation"></i> Logout Sucsess');

    }


}

   





