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
        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-video"></i> Video</li>
    </ol>
    </nav>
    <div class="card shadow-sm p-3 mb-5 bg-white rounded" data-aos="fade-out" data-aos-duration="1000" >
           
                <div class="card-body">
                <h4> VIDEO DELIVERY  </h4>
                
                <a title="Add data"  href="<?php echo base_url("Video/add/"); ?>" alt="Edit" class="btn btn-outline-info btn-sm">
                    <i class="fa fa-plus"></i> 
                </a>
                
                <a title="Export data to excel" href="<?php echo base_url("Video/export/"); ?>" class="btn btn-outline-info btn-sm">
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
                        <th rowspan="2" >ID CLIENT</th>
                        <th colspan="2"><i class="fa fa-clipboard"></i> Storyboard</th>
                        <th colspan="2"><i class="fa fa-video"></i> Shooting</th>
                        <th colspan="2"><i class="fa fa-user-edit"></i> Editing</th>
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
                        
                        
                        
                    </tr>
                </thead>
                <tbody>
                

                   
                <?php $nomor = 1; ?>
                <?php foreach ($dataVideo as $row) :?>
                    
                    <tr>
                        <td><?php echo $nomor++; ?></td>
                        <td><?php echo $row->title; ?></td>
                        <td><?php echo $row->id_client; ?></td>
                        <td><?php echo $row->storyboard_pic; ?></td>
                        <td><?php echo $row->storyboard_date; ?></td>
                        <td><?php echo $row->shooting_pic; ?></td>
                        <td><?php echo $row->shooting_date; ?></td>
                        <td><?php echo $row->editing_pic; ?></td>
                        <td><?php echo $row->editing_date; ?></td>
                        <td><?php echo $row->remark; ?></td>
                        <td>
                            <a title="Schedule"  href="<?php echo base_url("Video/schedule/".$row->id_video); ?>" alt="Edit" class="btn btn-outline-info btn-sm">
                            <i class="fa fa-file-contract"></i> 
                            </a>
                            <a title="Edit"  href="<?php echo base_url("Video/edit/".$row->id_video); ?>" alt="Edit" class="btn btn-outline-info btn-sm">
                            <i class="fa fa-edit"></i> 
                            </a>
                            <a title="Delete" href="<?php echo base_url("Video/delete/".$row->id_video); ?>" class="btn btn-outline-info btn-sm" onclick="return confirm('Apakah yakin data akan dihapus?');">
                            <i class="fa fa-trash" ></i> 
                            </a>
                        </td>
                    </tr>
                    
                <?php 

                endforeach;
                ?>
                <?php
                if (empty($dataVideo)) {
                ?>

                    <tr>
                        <td class="text-center" colspan="11">No Data</td>
                    </tr>

                <?php

                }
                
                ?>
                </tbody>
            </table>
                </span>
            </div>
        
    


</section>
