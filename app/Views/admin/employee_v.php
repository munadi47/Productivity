<section>
   
    <?php if(!empty(session()->getFlashdata('Success'))){ ?>
                <div class="alert alert-success">
                    <?php echo session()->getFlashdata('Success');?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
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

        <nav aria-label="breadcrumb shadow-sm p-3 mb-5 bg-white rounded notice notice-info" data-aos="fade-out" data-aos-duration="1000">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><i class="fas fa-table"></i> Company Data</li>
            <li class="breadcrumb-item" aria-current="page"><i class="fas fa-users"></i> Employee</li>
        </ol>
        </nav>


    <div class="card shadow-sm p-3 mb-5 bg-white rounded notice notice-info" data-aos="fade-out" data-aos-duration="1000" >

        <div class="card-body">
        <h4> Employee  </h4>

        <a title="Add data"  href="<?php echo base_url("Employee/add/"); ?>" alt="Edit" class="btn btn-outline-info btn-sm">
            <i class="fa fa-plus"></i> 
        </a>
        
        <a class="btn btn-outline-info btn-sm" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-file-excel"></i>  <i class="fa fa-caret-down"></i>
        </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" >
                    <a class="dropdown-item" href="Employee/export">Export Excel</a>
                    <a class="dropdown-item" href="Employee/import">Import Excel</a>
                    
                </div>
                
        
        <br><br>

        <table id="myTable" class="table table-striped table-bordered table-hover" >
            <thead class="thead-dark">
                <tr>
                    <th>NO</th>
                    <th>NIK</th>
                    <th>NAME</th> 	 	 	 	 	 
                    <th>EMAIL</th>
                    <!--th>password</th-->
                    <th>PHONE</th>
                    <!--th>level</th-->
                    <th>STATUS</th> 
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
            

            <?php $i = 1; ?>
            <?php foreach ($dataEmployee as $row) :?>
                <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $row->nik; ?></td>
                <td><?php echo $row->name; ?></td>
                <td><?php echo $row->email; ?></td>
                <td><a class="btn btn-primary" href="tel:<?php echo $row->phone1; ?>"><i class="fas fa-phone" style="padding-right: 1px;"></i>  <?php echo $row->phone1; ?></a></td>
                <td>
                <?php 
                if($row->status=='Fulfilled')
                { 
                    echo "<span class='badge badge-success'> Fulfilled </span>";
                }
                else
                { 
                    echo "<span class='badge badge-warning'> Not Fulfilled </span>";
                } 
                ?>
                
                </td>
                <td>
                    <a title="Detail" href="<?php echo base_url("Employee/detail/".$row->nik); ?>" class="btn btn-outline-info btn-sm">
                    <i class="fa fa-search" ></i> 
                    </a>
                    <a title="Edit"  href="<?php echo base_url("Employee/edit/".$row->nik); ?>" alt="Edit" class="btn btn-outline-info btn-sm">
                    <i class="fa fa-edit"></i>
                    </a>
                    <a title="Delete" href="<?php echo base_url("Employee/delete/".$row->nik); ?>" class="btn btn-outline-info btn-sm" onclick="return confirm('Apakah yakin data akan dihapus?');">
                    <i class="fa fa-trash" ></i>
                    </a>
                    
                </td>
                </tr>
                
            <?php 

            endforeach;
            ?>
            <?php
            if (empty($dataEmployee)) {
            ?>
                <tr>
                    <td class="text-center" colspan="9">No Data</td>
                </tr>

            <?php

            }
            
            ?>
            </tbody>
        </table>
        </div>
        
    </div>


</section>
