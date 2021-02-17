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
        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Home</a></li>
        <li class="breadcrumb-item"><a href="#"><i class="fas fa-donate"></i> Sales CRM</a></li>
        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-archive"></i> Product</li>
    </ol>
    </nav>
    <div class="card shadow-sm p-3 mb-5 bg-white rounded" data-aos="fade-out" data-aos-duration="1000" >
           
                <div class="card-body">
                <h4> PRODUCT  </h4>
                
                <a title="Add data"  href="<?php echo base_url("Product/add/"); ?>" alt="Edit" class="btn btn-outline-info btn-sm">
                    <i class="fa fa-plus"></i> 
                </a>
                
                <a title="Export data to excel" href="<?php echo base_url("Product/export/"); ?>" class="btn btn-outline-info btn-sm">
                <i class="fas fa-file-excel"></i> 
                </a>
               
                <br>
                <br>
                <div class="table-responsive">
                <table id="myTable" class="table table-hover table-bordered text-center " >
                <thead class="thead-dark ">
                    <tr>
                    
                        <th>PRODUCT NAME</th>
                        <th>STANDARD PRICE</th>
                        <th>COMPANY NAME</th>
                        <th>ACTION</th>
                    
                    </tr>
                </thead>
                <tbody>
                

                <?php
               
                ?>
                <?php foreach ($dataProduct as $row) :?>
                    
                    <tr>
                        
                        <td><?php echo $row->product_name; ?></td>
                        <td>Rp. <?php echo $row->std_price=number_format($row->std_price,0,",","."); ?></td>
                        <td><?php echo $row->company_name; ?></td>
                        <td>
                            <a title="Edit"  href="<?php echo base_url("Product/edit/".$row->id_product); ?>" alt="Edit" class="btn btn-outline-info btn-sm">
                            <i class="fa fa-edit"></i> 
                            </a>
                            <a title="Delete" href="<?php echo base_url("Product/delete/".$row->id_product); ?>" class="btn btn-outline-info btn-sm" onclick="return confirm('Apakah yakin data akan dihapus?');">
                            <i class="fa fa-trash" ></i> 
                            </a>
                        </td>
                    </tr>
                    
                <?php 

                endforeach;
                ?>
                <?php
                if (empty($dataProduct)) {
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
