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
        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-desktop"></i> Digital Content</li>
    </ol>
    </nav>
    <div class="card shadow-sm p-3 mb-5 bg-white rounded notice notice-info" data-aos="fade-out" data-aos-duration="1000" >
           
                <div class="card-body">
                <h4> DIGITAL CONTENT </h4>
                
                <a title="Add data"  href="<?php echo base_url("Digital/add/"); ?>" alt="Edit" class="btn btn-outline-info btn-sm">
                    <i class="fa fa-plus"></i> 
                </a>
                
                <a title="Export data to excel" href="<?php echo base_url("Digital/export/"); ?>" class="btn btn-outline-info btn-sm">
                <i class="fas fa-file-excel"></i> 
                </a>
               
                <br>
                <br>
                <span class="table-responsive">
                <table id="myTable" class="table table-hover table-bordered text-center " >
                <thead class="thead-dark ">
                    <tr>
                        <th rowspan="2"> # </th>
                        <th rowspan="2" >TITLE</th>
                        <th rowspan="2" >CLIENT</th>
                        <th colspan="2"><i class="fa fa-clipboard"></i> Storyboard</th>
                        <th colspan="2"><i class="fa fa-microphone-alt"></i> Voiceover</th>
                        <th colspan="2"><i class="fa fa-magic"></i> Animate</th>
                        <th colspan="2"><i class="fa fa-wrench"></i> Compile</th>
                        <th rowspan="2">REMARK </th>
                        <th rowspan="2">ACTION</th>
                    
                    </tr>
                    <tr>
                        
                        <th>PIC</th>
                        <th>Due Date</th>
                        <th>PIC</th>
                        <th>Due Date</th>
                        <th>PIC</th>
                        <th>Due Date</th>
                        <th>PIC</th>
                        <th>Due Date</th>
                        
                        
                        
                    </tr>
                </thead>
                <tbody>
                

                   
                <?php $nomor = 1; ?>
                <?php foreach ($dataDigital as $row) :?>
                    
                    <tr>
                        <td><?php echo $nomor++; ?></td>
                        <td><?php echo $row->title; ?></td>
                        <td><?php echo $row->id_client; ?></td>
                        <td><?php echo $row->storyboard_pic; ?></td>
                        <td><?php echo $row->storyboard_date; ?></td>
                        <td><?php echo $row->voiceover_pic; ?></td>
                        <td><?php echo $row->voiceover_date; ?></td>
                        <td><?php echo $row->animate_pic; ?></td>
                        <td><?php echo $row->animate_date; ?></td>
                        <td><?php echo $row->compile_pic; ?></td>
                        <td><?php echo $row->compile_date; ?></td>
                        <td><?php echo $row->remark; ?></td>
                        <td >
                          
                            <span>
                               
                                <a title="Download Report"  href="<?php echo base_url("Digital/schedule/".$row->id_digital); ?>" alt="Edit" class="btn btn-outline-info btn-sm">
                                <i class="fa fa-file-excel"></i> 
                                </a>
                                <a title="Edit"  href="<?php echo base_url("Digital/edit/".$row->id_digital); ?>" alt="Edit" class="btn btn-outline-info btn-sm">
                                <i class="fa fa-edit"></i> 
                                </a>
                                <a title="Delete" href="<?php echo base_url("Digital/delete/".$row->id_digital); ?>" class="btn btn-outline-info btn-sm" onclick="return confirm('Apakah yakin data akan dihapus?');">
                                <i class="fa fa-trash" ></i> 
                                </a>
                                
                            </span>
                            
                        </td>
                    </tr>
                    
                <?php 

                endforeach;
                ?>
                <?php
                if (empty($dataDigital)) {
                ?>

                    <tr>
                        <td class="text-center" colspan="13">No Data</td>
                    </tr>

                <?php

                }
                
                ?>
                </tbody>
            </table>
                </span>
            </div>
    </div>
    <div class="card shadow-sm p-3 mb-5 bg-white rounded notice notice-info" data-aos="fade-out" data-aos-duration="1000" >
        <div class="card-body">
            <h4> Digital Content Calendar </h4>
                <p> Note : Information in due date </p>
              
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
                            initialView: 'dayGridMonth',
                            editable: false,
                            
                        eventColor: '#3498db',
                           
                        
                    });
                    calendar.render();
                        calendar.changeView('dayGridMonth');
                        calendar.addEvent({ title: '<?php if(!empty($storyboard)) foreach ($storyboard as $data) echo $data->pic; echo " : Storyboard "; echo $data->judul;?>', start: '<?php echo $data->duedate ?>' });
                        calendar.addEvent({ title: '<?php if(!empty($voiceover)) foreach ($voiceover as $data) echo $data->pic;  echo " : Voiceover "; echo $data->judul;?>', start: '<?php echo $data->duedate ?>' });
                        calendar.addEvent({ title: '<?php if(!empty($animate)) foreach ($animate as $data) echo $data->pic; echo " : Animate "; echo $data->judul;?>', start: '<?php echo $data->duedate ?>' });
                        calendar.addEvent({ title: '<?php if(!empty($compile)) foreach ($compile as $data) echo $data->pic; echo " : Compile "; echo $data->judul;?>', start: '<?php echo $data->duedate ?>' });
                    });

                </script>
        </div>
    </div>       
    
    


</section>
