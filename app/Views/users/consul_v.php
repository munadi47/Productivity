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

    <nav aria-label="breadcrumb shadow-sm p-3 mb-5 bg-white rounded " data-aos="fade-out" data-aos-duration="1000">
    <ol class="breadcrumb">
    
        <li class="breadcrumb-item"><a href="#"><i class="fas fa-truck-loading"></i> Delivery</a></li>
        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-chalkboard-teacher"></i> Consulting</li>
    </ol>
    </nav>
    <div class="card shadow-sm p-3 mb-5 bg-white rounded notice notice-info" data-aos="fade-out" data-aos-duration="1000" >
           
                <div class="card-body">
                <h4> CONSULTING DELIVERY  </h4>
                
                <a title="Add data"  href="<?php echo base_url("Consulting/add/"); ?>" alt="Add" class="btn btn-outline-info btn-sm">
                    <i class="fa fa-plus"></i> 
                </a>
                
                <a title="Export data to excel" href="<?php echo base_url("Consulting/export/"); ?>" class="btn btn-outline-info btn-sm">
                <i class="fas fa-file-excel"></i> 
                </a>
               
               
                <br>
                <br>
                <span class="table-responsive">
                <table id="myTable" class="table table-hover table-bordered text-center " >
                <thead class="thead-dark ">
                    <tr>
                        <th > # </th>
                        <th >TITLE</th>
                        <th >CLIENT</th>
                        <th >PROJECT NAME</th>
                        <th >PROJECT MANAGER</th>
                        <th >GANTT CHART (ATTACH)</th>
                        <th >REMARK </th>
                        <th >ACTION</th>
                    
                    </tr>
                   
                </thead>
                <tbody>
                

                   
                <?php $nomor = 1; ?>
                <?php foreach ($dataConsul as $row) :?>
                    
                    <tr>
                        <td><?php echo $nomor++; ?></td>
                        <td><?php echo $row->title; ?></td>
                        <td><?php echo $row->id_client; ?></td>
                        <td><?php echo $row->project_name; ?></td>
                        <td><?php echo $row->project_manager; ?></td>
                        <td><a title="View Gantt Chart" class="btn btn-outline-secondary" href="<?php echo base_url('Consulting/view_pdf/'.$row->id_consulting); ?>"><i class="fa fa-file-alt"></i> &nbsp;<?php echo $row->gantt_chart; ?></a></td>
                        <td><?php echo $row->remark; ?></td>
                        <td>
                            <a title="Download Report"  href="<?php echo base_url("Consulting/Report/".$row->id_consulting); ?>" alt="Edit" class="btn btn-outline-info btn-sm">
                            <i class="fa fa-file-excel"></i> 
                            </a>
                            <a title="Edit"  href="<?php echo base_url("Consulting/edit/".$row->id_consulting); ?>" alt="Edit" class="btn btn-outline-info btn-sm">
                            <i class="fa fa-edit"></i> 
                            </a>
                            <a title="Delete" href="<?php echo base_url("Consulting/delete/".$row->id_consulting); ?>" class="btn btn-outline-info btn-sm" onclick="return confirm('Apakah yakin data akan dihapus?');">
                            <i class="fa fa-trash" ></i> 
                            </a>
                      
                        </td>
                    </tr>
                    
                <?php 

                endforeach;
                ?>
                <?php
                if (empty($dataConsul)) {
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
        
    


</section>
