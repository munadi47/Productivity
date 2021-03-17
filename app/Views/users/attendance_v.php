<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<!-- Refresh setiap 1 menit -->
<!--meta http-equiv="refresh" content="60"-->

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

    <h2><i class="fas fa-user-clock"></i> Presensi </h2>

    <figure class="highcharts-figure">
    <div id="watch"></div>
    <p class="highcharts-description">
        
    </p>
    </figure>
    <div class="container">

<br/>

        <div class='text-center'>
            <!--
        <a title="clokin" href="<?php echo base_url("Attendance/clockin"); ?>" class="btn btn-sq-lg btn-primary">
        <i class="fa fa-sign-in-alt fa-5x"></i><br> Clock In 
        </a>

        <a title="clokout" href="<?php echo base_url("Attendance/clockout/".session()->get('id_attendance')); ?>" class="btn btn-sq-lg btn-danger" type="submit" id="checktime">
        <i class="fa fa-sign-out-alt fa-5x" aria-hidden="true"></i><br> Clock Out 
        </a>

-->

    <div class="row">
        <div class="col col-lg-6">
            <form action="<?php echo base_url("Attendance/clockin"); ?>" >
                <button type="submit" class="btn btn-sq-lg btn-primary" id="checktime1" <?php if(!empty($dataCheckIn)) echo "disabled" ?> ><i class="fa fa-sign-in-alt fa-5x" aria-hidden="true"></i><br>Clock In</button>
            
            </form>
        </div>

        
        <div class="col col-lg-6">
            <form action="<?php echo base_url("Attendance/clockout/".$dataRow->id_attendance); ?>" >
                <button type="submit" class="btn btn-sq-lg btn-danger" id="checktime2" <?php if(empty($dataCheckOut)) echo "disabled" ?>><i class="fa fa-sign-out-alt fa-5x" aria-hidden="true"></i><br>Clock Out </button>
            </form>
        </div>
    </div>

        <div class="text-center">

        </div>
            

    </div>
</section>
</div>

<!--script type="text/javascript" defer="defer">
// 
var enableDisable = function(){
    
    var UTC_hours = new Date().getUTCHours() +7;
    
    if (UTC_hours > 1 && UTC_hours < 24){
        if (){
            
        }
        document.getElementById('checktime1').disabled = false;
        document.getElementById('checktime2').disabled = false;

    }
    else
    {
        document.getElementById('checktime1').disabled = true;
        document.getElementById('checktime2').disabled = true;

    }
};
setInterval(enableDisable, 1000*60);
enableDisable();
// -->
</script-->