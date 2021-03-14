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

    <nav aria-label="breadcrumb shadow-sm p-3 mb-5 bg-white rounded" data-aos="fade-out" data-aos-duration="1000">
    <ol class="breadcrumb">
    
        <li class="breadcrumb-item"><a href="#"><i class="fas fa-truck-loading"></i> Delivery</a></li>
        <li class="breadcrumb-item" aria-current="page"><i class="fas fa-video"></i> Video</li>
        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-calendar"></i> Video Schedule</li>
    </ol>
    </nav>
    <div class="card shadow-sm p-3 mb-5 bg-white rounded notice notice-info" data-aos="fade-out" data-aos-duration="1000" >
           
                <div class="card-body">
                <a title="Back" href="<?php echo base_url("Video"); ?>" class="btn btn-outline-info btn-md">
                    <i class="fas fa-arrow-left"></i> 
                </a>
                <br>
                <h4 style="padding-top: 2vw;"> <?php foreach($dataDigital as $row): echo $row->title; endforeach;?>  </h4>
                <h5> <?php foreach($dataDigital as $row): echo $row->id_client; endforeach;?>  </h5>
                <p> Information : Due Date </p>
              
                <br>
                <div id="calendar"></div>
                
                <script>

                    document.addEventListener('DOMContentLoaded', function() {
                    var calendarEl = document.getElementById('calendar');
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        headerToolbar: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth,timeGridWeek,timeGridDay'
                        },
                            initialView: 'dayGridMonth'
                        
                    });
                    calendar.render();
                        calendar.changeView('dayGridMonth');
                        calendar.addEvent({ title: '<?php if(!empty($storyboard)) foreach ($storyboard as $data) echo $data->pic." : Storyboard"?>', start: '<?php echo $data->duedate ?>' });
                        calendar.addEvent({ title: '<?php if(!empty($shooting)) foreach ($shooting as $data) echo $data->pic." : Shooting"?>', start: '<?php echo $data->duedate ?>' });
                        calendar.addEvent({ title: '<?php if(!empty($editing)) foreach ($editing as $data) echo $data->pic." : Editing"?>', start: '<?php echo $data->duedate ?>' });
                    });

                </script>
               
                </div>
    </div>
        
    


</section>
