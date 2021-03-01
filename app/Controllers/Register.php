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

class Register extends BaseController{
    public function __construct()
    {
        $this->session = \Config\Services::session();
    }

    public function index(){
        $session = session();
        echo view ('users/header_v');
        echo view ('admin/register_form_v');
        echo view ('users/footer_v');
        
    }

   

}




