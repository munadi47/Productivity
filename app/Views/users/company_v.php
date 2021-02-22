<section>
    <div class="container">
    <nav aria-label="breadcrumb shadow-sm p-3 mb-5 bg-white rounded" data-aos="fade-out" data-aos-duration="1000">
    <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><i class="fas fa-users"></i> Company</li>
    </ol>
    </nav>
    <?php if(!empty(session()->getFlashdata('berhasil'))){ ?>
                <div class="alert alert-success">
                    <?php echo session()->getFlashdata('berhasil');?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php }elseif(!empty(session()->getFlashdata('gagal'))){ ?>
                <div class="alert alert-danger">
                    <?php 
                        echo session()->getFlashdata('gagal');
                    ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        <?php
            }
        ?>
    <div class="card shadow-sm p-3 mb-5 bg-white rounded" data-aos="fade-out" data-aos-duration="1000" >

        <div class="card-body table-responsive ">
        <h4> COMPANY  </h4>

        <a title="Add data"  href="<?php echo base_url("Company/add/"); ?>" alt="Edit" class="btn btn-outline-info btn-sm">
            <i class="fa fa-plus"></i> 
        </a>
        
        <a title="Export data to excel" href="<?php echo base_url("Company/export/"); ?>" class="btn btn-outline-info btn-sm">
            <i class="fas fa-file-excel"></i> 
        </a>
        
        <br><br>
        <table id="myTable" class="table table-striped table-bordered table-hover" >
            <thead class="thead-light">
                <tr>
                 
                    <th>NO</th>
                    <th>COMPANY NAME</th>
                    <th>ACTION</th>
                
                </tr>
            </thead>
            <tbody>
    

            <?php $i = 1; ?>
            <?php foreach ($dataCompany as $row) :?>
                <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $row->company_name; ?></td>
                   
                    <td>
                        <a title="Edit"  href="<?php echo base_url("Client/edit/".$row->id_company); ?>" alt="Edit" class="btn btn-outline-info btn-sm">
                        <i class="fa fa-edit"></i>
                        </a>
                        <a title="Delete" href="<?php echo base_url("Client/delete/".$row->id_company); ?>" class="btn btn-outline-info btn-sm" onclick="return confirm('Apakah yakin data akan dihapus?');">
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
        </div>
        
    </div>
    </div>

</section>
