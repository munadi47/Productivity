<div class="card shadow-sm p-3 mb-5 bg-white rounded notice notice-info" data-aos="zoom-in" data-aos-duration="1000" >
<section>

<?php if(!empty(session()->getFlashdata('Success'))){ ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo session()->getFlashdata('Success');?>
                        <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php }elseif(!empty(session()->getFlashdata('Failed'))){ ?>
                    <div class="alert alert-danger">
                        <?php 
                            echo session()->getFlashdata('Failed');
                        ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
    <?php
    }
    ?>

    <div class="container">
    <h2><i class="fas fa-briefcase"></i> Presensi </h2>
    <hr>
        <form method="POST" action="<?php echo base_url('Attendance/save_clockin'); ?>">


        <div class="form-group row">
            <label hidden class="col-sm-2 col-form-label">NO</label>
            <div class="col-sm-10">
            <input type="hidden" id="id_attendance" name="id_attendance" value="<?php if(!empty($dataAttendance)) echo $dataAttendance->id_attendance; ?>"> 
            </div>
        </div>

        <div class="form-group row">
                <label class="col-sm-2 col-form-label">Name </label>
                <div class="col-sm-10">
                    <select name="nik" class="form-select" aria-label="Default select example">
                        
                        <?php foreach($dataEmployee as $row) : ?>
                            <option value="<?php echo $row->nik; ?>"
                            
                            <?php if(!empty($dataAttendance) && session()->get('nik') == $row->nik) echo 'selected'; ?> > 
                            
                            <?php echo $row->name//session()->get('name') ?> </option>
                        <?php endforeach;?>
                        
                    </select>
                </div>
                
        </div>
        <br>
   
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Clock In </label>
            <div class="col-sm-9">
            <input type="text" class="form-control" id="clock_in" name="clock_in" value="<?php if(!empty($dataAttendance)) echo date("Y-m-d h:i:s"); ?>"> 
               
            </div>
        </div>
        <br>
           
           
            <button type="submit" class="btn btn-success">Clock In</button>
            <button type="button" onclick="window.history.back();" class="btn btn-outline-secondary">Back</button>
           
        </form>
    </div>
</section>
</div>