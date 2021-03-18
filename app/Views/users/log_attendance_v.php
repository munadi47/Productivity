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
    
        <li class="breadcrumb-item"><a href="#"><i class="fas fa-table"></i> Company Data</a></li>
        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-building"></i> Company</li>
    </ol>
    </nav>
    <div class="card shadow-sm p-3 mb-5 bg-white rounded notice notice-info" data-aos="fade-out" data-aos-duration="1000" >
           
                <div class="card-body">
                <h4> Log Attendance  </h4>
                                
                <a title="Export data to excel" href="<?php echo base_url("Attendance/export/"); ?>" class="btn btn-outline-info btn-sm">
                <i class="fas fa-file-excel"></i> 
                </a>
               
                <br>
                <br>
                <span class="table-responsive">
                <table id="log" class="table table-hover table-bordered text-center " >
                <thead class="thead-dark ">
                    <tr>
                    <th style="display:none;">ID</th>
                    <th style="display:none;">Date</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>clock In</th>
                        <th>clock Out</th>
                        <th>IP</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                

                <?php
               
                ?>
                <?php foreach ($dataAttendance as $row) :?>
                    
                    <tr>
                    <td style="display:none;"><?php echo $row->id_attendance; ?></td>
                    <td style="display:none;"><?php echo date("d/m/Y", strtotime($row->clock_in)); ?></td>
                        <td><?php echo date("M d, Y", strtotime($row->clock_in)); ?></td>
                        <td><?php echo $row->name; ?></td>
                        <td><?php echo date("h:i A", strtotime($row->clock_in)); ?></td>
                        <td><?php echo date("h:i A", strtotime($row->clock_out)); ?></td>
                        <td><?php echo $row->ip; ?></td>
                        <td>
                            <a title="Delete" href="<?php echo base_url("Attendance/delete/".$row->id_attendance); ?>" class="btn btn-outline-info btn-sm" onclick="return confirm('Apakah yakin data akan dihapus?');">
                            <i class="fa fa-trash" ></i> 
                            </a>
                        </td>
                    </tr>
                    
                <?php 

                endforeach;
                ?>
                <?php
                if (empty($dataAttendance)) {
                ?>

                    <tr>
                        <td class="text-center" colspan="9">No Data</td>
                    </tr>

                <?php

                }
                
                ?>
                </tbody>
            </table>
                </span>
            </div>
        
    

    </div>
</section>
