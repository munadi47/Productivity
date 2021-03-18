<?php namespace App\Models;

use CodeIgniter\Model;

class attendanceModel extends Model
{
    protected $table      = 'log_attendance';
    protected $primaryKey = 'id_attendance';

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_attendance','nik','clock_in','ip','clock_out'];

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
        //->orderBy('id_attendance DESC')
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


    public function getStatusAtt(){ //berapa kali dia absen per minggu
        $id = session()->get('nik');
        
        $query = $this->db->query("SELECT id_attendance, YEARWEEK(clock_in) AS tahun_minggu,SUM(nik=$id) AS jumlah FROM log_attendance WHERE YEARWEEK(clock_in)=YEARWEEK(NOW() ) GROUP BY YEARWEEK(clock_in) ");
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

    public function getStatusAtttes(){ //return data array di controller berupa 'jumlah'yg akan di condisikan
        $id = session()->get('nik');
        
        $query = $this->db->query("SELECT id_attendance, YEARWEEK(clock_in) AS tahun_minggu,SUM(nik=$id) AS jumlah FROM log_attendance WHERE YEARWEEK(clock_in)=YEARWEEK(NOW() ) GROUP BY YEARWEEK(clock_in) ");
        return $query;

    
    }

    public function getRowAtt(){ //ambil id pertama row pertama
        $id = session()->get('nik');

        $query = $this->db->query("SELECT * FROM `log_attendance` WHERE (nik=$id) ORDER BY id_attendance DESC");
        //return $query->getRow();
        return $query->getRow();
        //return $row;
        
        /*if($query){
            if (isset($row)) {
                return $row->id_attendance;
            } return false;
            
        }*/
    }

    

    public function getStatusAttX($id){ //untuk detail id
        
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
        $date = date('Y');
        $grafik = $this->db->query("
        select 
        ifnull((SELECT count(clock_in) FROM (log_attendance)WHERE((Month(clock_in)=1)AND (YEAR(clock_in)=$date))),0) AS `January`,
        ifnull((SELECT count(clock_in) FROM (log_attendance)WHERE((Month(clock_in)=2)AND (YEAR(clock_in)=$date))),0) AS `Februari`,
        ifnull((SELECT count(clock_in) FROM (log_attendance)WHERE((Month(clock_in)=3)AND (YEAR(clock_in)=$date))),0) AS `Maret`,
        ifnull((SELECT count(clock_in) FROM (log_attendance)WHERE((Month(clock_in)=4)AND (YEAR(clock_in)=$date))),0) AS `April`,
        ifnull((SELECT count(clock_in) FROM (log_attendance)WHERE((Month(clock_in)=5)AND (YEAR(clock_in)=$date))),0) AS `Mei`,
        ifnull((SELECT count(clock_in) FROM (log_attendance)WHERE((Month(clock_in)=6)AND (YEAR(clock_in)=$date))),0) AS `Juni`,
        ifnull((SELECT count(clock_in) FROM (log_attendance)WHERE((Month(clock_in)=7)AND (YEAR(clock_in)=$date))),0) AS `Juli`,
        ifnull((SELECT count(clock_in) FROM (log_attendance)WHERE((Month(clock_in)=8)AND (YEAR(clock_in)=$date))),0) AS `Agustus`,
        ifnull((SELECT count(clock_in) FROM (log_attendance)WHERE((Month(clock_in)=9)AND (YEAR(clock_in)=$date))),0) AS `September`,
        ifnull((SELECT count(clock_in) FROM (log_attendance)WHERE((Month(clock_in)=10)AND (YEAR(clock_in)=$date))),0) AS `Oktober`,
        ifnull((SELECT count(clock_in) FROM (log_attendance)WHERE((Month(clock_in)=11)AND (YEAR(clock_in)=$date))),0) AS `November`,
        ifnull((SELECT count(clock_in) FROM (log_attendance)WHERE((Month(clock_in)=12)AND (YEAR(clock_in)=$date))),0) AS `Desember`
         
        from log_attendance GROUP BY year(clock_in)");
        return $grafik;
        //return $query->getResultArray();
        /*if($query){
            foreach($query->getResult() as $data){
                $countAttendance[] = $data;
            }
           if(!empty($countAttendance)){
               return $countAttendance;
            } return false;
            
        }*/
    }


    public function AttToday()
    {
        $builder = $this->table('log_attendance');
        $builder->select('employee.name,clock_in,employee.photo,id_attendance')
        ->join('employee','employee.nik=log_attendance.nik')
        ->where("DATE('clock_in')",'CURDATE()')
        ->orderBy('id_attendance','DESC');
        return $builder;
    }

    public function checkin()
    {
        $id = session()->get('nik');

        $query = $this->db->query("SELECT * FROM log_attendance WHERE (nik = $id) AND date(clock_in)=CURDATE() AND clock_in IS NOT NULL GROUP BY  date(clock_in)=CURDATE()");

        //return $query->get()->getResultObject();

        if($query){
            foreach($query->getResult() as $data){
                $dataClock[] = $data;
            }
           if(!empty($dataClock)){
               return $dataClock;
            } return false;
            
        }
    }

    public function checkout()
    {
        $id = session()->get('nik');

        $query = $this->db->query("SELECT * FROM log_attendance WHERE (nik = '$id') AND date(clock_in)=CURDATE() AND clock_out IS NULL GROUP BY date(clock_in)=CURDATE()");

        if($query){
            foreach($query->getResult() as $data){
                $dataClock[] = $data;
            }
           if(!empty($dataClock)){
               return $dataClock;
            } return false;
            
        }
    }
   
}