<section>

   
    <div class="card shadow-sm p-3 mb-5 bg-white rounded" data-aos="fade-out" data-aos-duration="1000" >
           
                <div class="card-body">
                
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
                            <a title="Edit"  href="<?php echo base_url("Product/edit/".$row->id_product); ?>" alt="Edit" class="btn btn-warning btn-sm">
                            <i class="fa fa-edit"></i> 
                            </a>
                            <a title="Delete" href="<?php echo base_url("Product/delete/".$row->id_product); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah yakin data akan dihapus?');">
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
