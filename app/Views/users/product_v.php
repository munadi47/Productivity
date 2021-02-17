<section>

    <div class="container">
    <h2 style="font-weight:bolder; ">Product Data</h2>
    <hr>
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
        <p>
            <a href="Product/add" class="btn btn-primary btn-sm">
               <i class="fa fa-plus"></i> Add Data
            </a>
        </p>
        
        

            <p>
                <a href="<?php echo site_url('Product/export'); ?>" class="btn btn-success">
                <i class="fas fa-download"></i> &nbsp;<i class="fa fa-file-excel"></i> Download Excel Data
                </a>
                
            </p>

            <br>
        <div class="table-responsive">
        <table id="myTable" class="table table-striped table-bordered table-hover" >
            <thead class="thead-light">
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
                    <td><?php echo $row->std_price; ?></td>
                    <td><?php echo $row->company_name; ?></td>
                    <td>
                        <a href="<?php echo base_url("Product/edit/".$row->id_pasien); ?>" class="btn btn-warning btn-sm">
                           <i class="fa fa-edit"></i> Edit
                        </a>
                        <a href="<?php echo base_url("Product/delete/".$row->id_pasien); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah yakin data akan dihapus?');">
                           <i class="fa fa-trash"></i> Delete
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
