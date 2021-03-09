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
                <h4> COMPANY  </h4>
                
                <a title="Add data"  href="<?php echo base_url("Company/add/"); ?>" alt="Edit" class="btn btn-outline-info btn-sm">
                    <i class="fa fa-plus"></i> 
                </a>
               
                <a class="btn btn-outline-info btn-sm" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-file-excel"></i>  <i class="fa fa-caret-down"></i>
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" >
                    <a class="dropdown-item" href="Company/export">Export Excel</a>
                    <a class="dropdown-item" href="Company/import">Import Excel</a>
                    
                </div>
                
                
                            
               
                <br>
                <br>
                <span class="table-responsive">
                <table id="myTable" class="table table-hover table-bordered text-center " >
                <thead class="thead-dark ">
                    <tr>
                        <th> # </th>
                        <th>COMPANY NAME</th>
                        <th>ADDRESS</th>
                        <th>PHONE</th>
                        <th>FIELD</th>
                        <th>ACTION</th>
                       
                    
                    </tr>
                </thead>
                <tbody>
                

                <?php
               
                ?>
                <?php $nomor = 1; ?>
                <?php foreach ($dataCompany as $row) :?>
                    
                    <tr>
                        <td><?php echo $nomor++; ?></td>
                        <td><?php echo $row->company_name; ?></td>
                        <td><?php echo $row->address; ?></td>
                        <td><?php echo $row->phone; ?></td>
                        <td><?php echo $row->field; ?></td>
                        <td>
                            <a title="Edit"  href="<?php echo base_url("Company/edit/".$row->id_company); ?>" alt="Edit" class="btn btn-outline-info btn-sm">
                            <i class="fa fa-edit"></i> 
                            </a>
                            <a title="Delete" href="<?php echo base_url("Company/delete/".$row->id_company); ?>" class="btn btn-outline-info btn-sm" onclick="return confirm('Apakah yakin data akan dihapus?');">
                            <i class="fa fa-trash" ></i> 
                            </a>
                        </td>
                    </tr>
                    
                <?php 

                endforeach;
                ?>
                <?php
                if (empty($dataCompany)) {
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
