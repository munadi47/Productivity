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
        <li class="breadcrumb-item"><a href="#"><i class="fas fa-filter"></i> Sales Pipeline</a></li>
        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-users"></i> Client</li>
    </ol>
    </nav>
    <div class="card shadow-sm p-3 mb-5 bg-white rounded notice notice-info" data-aos="fade-out" data-aos-duration="1000" >
           
                <div class="card-body ">
                <h4> CLIENT  </h4>
                
                <a title="Add data"  href="<?php echo base_url("Client/add/"); ?>" alt="Edit" class="btn btn-outline-info btn-sm">
                    <i class="fa fa-plus"></i> 
                </a>
                
                <a title="Export data to excel" href="<?php echo base_url("Client/export/"); ?>" class="btn btn-outline-info btn-sm">
                <i class="fas fa-file-excel"></i> 
                </a>
               
                <br>
                <br>
                <span class="table-responsive">
                <table id="myTable" class="table table-hover table-bordered text-center " >
                <thead class="thead-dark ">
                    <tr>
                        <th>#</th>
                        <th>CLIENT</th>
                        <th>PHONE</th>
                        <th>PIC</th>
                        <th>ACTION</th>
                    
                    </tr>
                </thead>
                <tbody>
                

                <?php
                $nomor=1;
                ?>
               
                <?php foreach ($dataClient as $row) :?>
                    
                    <tr>
                        <td><?php echo $nomor++; ?></td>
                        <td><?php echo $row->id_client ?></td>
                        
                        <td><a class="btn btn-primary" href="tel:<?php echo $row->phone; ?>"><?php echo $row->phone; ?>&nbsp;<i class="fas fa-phone" style="padding-right: 1px;"></i></a></td>
                        <td><?php echo $row->name; ?></td>
                        <td>
                            <a title="View Detail" href="<?php echo base_url("Client/detail/".$row->id_client); ?>" class="btn btn-outline-info btn-sm">
                            <i class="fa fa-search" ></i> 
                            </a>
                            <a title="Download Client Purchase Report " href="<?php echo base_url("Client/export_detail/".$row->id_client); ?>" class="btn btn-outline-info btn-sm">
                            <i class="fas fa-file-excel"></i>
                            </a>
                            <a title="Edit"  href="<?php echo base_url("Client/edit/".$row->id_client); ?>" alt="Edit" class="btn btn-outline-info btn-sm">
                            <i class="fa fa-edit"></i> 
                            </a>
                            <a title="Delete" href="<?php echo base_url("Client/delete/".$row->id_client); ?>" class="btn btn-outline-info btn-sm" onclick="return confirm('Apakah yakin data akan dihapus?');">
                            <i class="fa fa-trash" ></i> 
                            </a>
                        </td>
                    </tr>
                    
                <?php 

                endforeach;
                ?>
                <?php
                if (empty($dataClient)) {
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
