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

        <nav aria-label="breadcrumb shadow-sm p-3 mb-5 bg-white rounded" data-aos="fade-out" data-aos-duration="1000">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><i class="fas fa-users"></i> Finance</li>
        </ol>
        </nav>

    <div class="card shadow-sm p-3 mb-5 bg-white rounded notice notice-info" data-aos="fade-out" data-aos-duration="1000" >

        <div class="card-body">
        <h4> FINANCE  </h4>

        <a title="Add data"  href="<?php echo base_url("Finance/add/"); ?>" alt="Edit" class="btn btn-outline-info btn-sm">
            <i class="fa fa-plus"></i> 
        </a>
        
        <a class="btn btn-outline-info btn-sm" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-file-excel"></i>  <i class="fa fa-caret-down"></i>
        </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" >
                    <a class="dropdown-item" href="Finance/export">Export Excel</a>
                    <a class="dropdown-item" href="Finance/import">Import Excel</a>
                    
                </div>
                
        

               
        <br><br>
        

        <table id="myTable" class="table table-striped table-bordered table-hover" >
            <thead class="thead-dark">
                <tr>
                    <th>NO</th>
                    <th>CLIENT</th>
                    <th>INVOICE CREATE</th> 	 	 	 	 	 
                    <th>INVOICE DUE DATE</th>
                    <!--th>password</th-->
                    <th>AMOUNT</th>
                    <th>STATUS</th>
                    <!--th>level</th-->
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
            

            <?php $i = 1; ?>
            <?php foreach ($dataFinance as $row) :?>
                <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $row->id_client; ?></td>
                <td><?php echo $row->invoice_date; ?></td>
                <td><?php echo $row->invoice_duedate; ?></td>
                <td>Rp. <?php echo $row->invoice_amount=number_format($row->invoice_amount,0,",","."); ?></td>


                <td><?php if($row->status != 'Full'){
                    ?><span class="badge badge-warning"><?php
                }
                else{
                    ?><span class="badge badge-success"><?php
                } echo $row->status; ?>
                </td>

                <td>
                    <a title="Create Invoice" href="<?php echo base_url("Finance/invoice/".$row->id_finance); ?>" target="__blank" class="btn btn-outline-info btn-sm">
                    <i class="fa fa-file-alt" ></i>
                    </a>
                    <a title="Edit"  href="<?php echo base_url("Finance/edit/".$row->id_finance); ?>" alt="Edit" class="btn btn-outline-info btn-sm">
                    <i class="fa fa-edit"></i>
                    </a>
                    <a title="Delete" href="<?php echo base_url("Finance/delete/".$row->id_finance); ?>" class="btn btn-outline-info btn-sm" onclick="return confirm('Apakah yakin data akan dihapus?');">
                    <i class="fa fa-trash" ></i>
                    </a>

                </td>
                </tr>
                
            <?php 

            

            endforeach;
            ?>
            <?php
            if (empty($dataFinance)) {
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
