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
        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-graduation-cap"></i> Learning</li>
    </ol>
    </nav>
    <div class="card shadow-sm p-3 mb-5 bg-white rounded notice notice-info" data-aos="fade-out" data-aos-duration="1000" >
           
                <div class="card-body">
                <h4> LEARNING DELIVERY  </h4>
                
                <a title="Add data"  href="<?php echo base_url("Learning/add/"); ?>" alt="Edit" class="btn btn-outline-info btn-sm">
                    <i class="fa fa-plus"></i> 
                </a>
                
                <a title="Export data to excel" href="<?php echo base_url("Learning/export/"); ?>" class="btn btn-outline-info btn-sm">
                <i class="fas fa-file-excel"></i> 
                </a>
               
                <br>
                <br>
                <span class="table-responsive">
                <table id="myTable" class="table table-hover table-bordered text-center " >
                <thead class="thead-dark ">
                    <tr>
                        <th > NO </th>
                        <th >TITLE</th>
                        <th >CLIENT NAME</th>
                        <th >TOPIC</th>
                        <th >DELIVER DATE</th>
                        <th >COACH NAME</th>
                        <th >METHOD</th>
                        <th >CERTIFICATE</th>
                        <th >REMARK</th>
                        <th >ACTION</th>
                    
                    </tr>

                </thead>
                <tbody>
                

                   
                <?php $nomor = 1; ?>
                <?php foreach ($dataLearning as $row) :?>
                    
                    <tr>
                        <td><?php echo $nomor++; ?></td>
                        <td><?php echo $row->title; ?></td>
                        <td><?php echo $row->id_client; ?></td>
                        <td><?php echo $row->topic; ?></td>
                        <td><?php echo date("d M, Y", strtotime($row->date_deliver));?></td>
                        <td><?php echo $row->coach_name; ?></td>
                        <td> <?php if($row->method=='online'){

                            ?><span class="badge badge-success">
                                <?php }else {?>
                                    <span class="badge badge-danger">
                                <?php } ?>
                       
                            <?php echo $row->method; ?>
                        </td>
                        <td><?php echo $row->certificate; ?></td>
                        <td><?php echo $row->remark; ?></td>
                        <td>
                            <a title="Report Client Learning"  href="<?php echo base_url("Learning/exportLearning/".$row->id_learning); ?>" alt="Edit" class="btn btn-outline-info btn-sm">
                            <i class="fa fa-file-excel"></i> 
                            </a>
                            <a title="Edit"  href="<?php echo base_url("Learning/edit/".$row->id_learning); ?>" alt="Edit" class="btn btn-outline-info btn-sm">
                            <i class="fa fa-edit"></i> 
                            </a>
                            <a title="Delete" href="<?php echo base_url("Learning/delete/".$row->id_learning); ?>" class="btn btn-outline-info btn-sm" onclick="return confirm('Apakah yakin data akan dihapus?');">
                            <i class="fa fa-trash" ></i> 
                            </a>
                        </td>
                    </tr>
                    
                <?php 

                endforeach;
                ?>
                <?php
                if (empty($dataLearning)) {
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
