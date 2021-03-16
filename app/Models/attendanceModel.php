<?php namespace App\Models;

use CodeIgniter\Model;

class attendanceModel extends Model
{
    protected $table      = 'log_attendance';
    protected $primaryKey = 'id_attendance';

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_attendance','nik','clock_in','clock_out'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getAttendanceEmp(){
        $builder = $this->table('log_attendance');
        $builder->join('employee','employee.nik = log_attendance.nik')
        ;//->orderBy('id_attendance','DESC');
        return $builder;
    }

    public function getATD(){
        return $this->db->table('log_attendance')
        ->join('employee','employee.nik=log_attendance.nik')
        ->orderBy('id_attendance','DESC')
        ->get()->getResultObject(); 
    }


    public function update_data($co, $tbl, $id_atd)
    {
        $builder = $this->db->table($tbl);
        $builder->set('clock_out',$co);
        $builder->where('id_attendance',$id_atd);
        $builder->update();
        //$log = $builder->get()->getRow();
        return $builder;
    }   

    public function getId()
    {
        
    }

    public function getStatusAtt(){
        $id = session()->get('nik');
        
        $query = $this->db->query("SELECT YEARWEEK(clock_in) AS tahun_minggu,SUM(nik=$id) AS jumlah FROM log_attendance WHERE YEARWEEK(clock_in)=YEARWEEK(NOW() ) GROUP BY YEARWEEK(clock_in) ");
        //return $query->getResult();

        if($query){
            foreach($query->getResult() as $data){
                $dataAttendance[] = $data;
            }
           if(!empty($dataAttendance)){
               return $dataAttendance;
            } return false;
            
        }
    }

    public function getStatusAttX($id){
        
        $query = $this->db->query("SELECT YEARWEEK(clock_in) AS tahun_minggu,SUM(nik=$id) AS jumlah FROM log_attendance WHERE YEARWEEK(clock_in)=YEARWEEK(NOW() ) GROUP BY YEARWEEK(clock_in) ");
        //return $query->getResult(); 
        

        if($query){
            foreach($query->getResult() as $data){
                $dataAttendance[] = $data;
            }
           if(!empty($dataAttendance)){
               return $dataAttendance;
            } return false;
            
        }
    }

    public function countAttendance(){        
        $query = $this->db->query("SELECT (DATE_FORMAT(clock_in,'%M')) AS 'bulan', COUNT(*) AS total FROM log_attendance WHERE year(clock_in)= '2021' GROUP BY (DATE_FORMAT(clock_in,'%M')) ORDER BY 'bulan' ");
        if($query){
            foreach($query->getResult() as $data){
                $countAttendance[] = $data;
            }
           if(!empty($countAttendance)){
               return $countAttendance;
            } return false;
            
        }
    }


    public function AttToday()
    {
        
        $builder = $this->table('log_attendance');
        $builder->select('employee.name,clock_in')
        ->join('employee','employee.nik=log_attendance.nik')
        ->where("DATE('clock_in')",'CURDATE()');
        return $builder;
    }
   
}