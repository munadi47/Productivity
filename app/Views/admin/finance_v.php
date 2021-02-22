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

    <div class="card shadow-sm p-3 mb-5 bg-white rounded" data-aos="fade-out" data-aos-duration="1000" >

        <div class="card-body">
        <h4> FINANCE  </h4>

        <a title="Add data"  href="<?php echo base_url("Finance/add/"); ?>" alt="Edit" class="btn btn-outline-info btn-sm">
            <i class="fa fa-plus"></i> 
        </a>
        
        <a title="Export data to excel" href="<?php echo base_url("Finance/export/"); ?>" class="btn btn-outline-info btn-sm">
            <i class="fas fa-file-excel"></i> 
        </a>
        
        <br><br>


        <table id="myTable" class="table table-striped table-bordered table-hover" >
            <thead class="thead-light">
                <tr>
                    <th>NO</th>
                    <th>CLIENT</th>
                    <th>INVOICE CREATE</th> 	 	 	 	 	 
                    <th>INVOICE DUE DATE</th>
                    <!--th>password</th-->
                    <th>AMMOUNT</th>
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
                <td><?php echo $row->id_fStatus; ?></td>
                <td>
                    <a title="Edit"  href="<?php echo base_url("Finance/edit/".$row->nik); ?>" alt="Edit" class="btn btn-outline-info btn-sm">
                    <i class="fa fa-edit"></i>
                    </a>
                    <a title="Delete" href="<?php echo base_url("Finance/delete/".$row->nik); ?>" class="btn btn-outline-info btn-sm" onclick="return confirm('Apakah yakin data akan dihapus?');">
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
