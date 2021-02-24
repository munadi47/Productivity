<html>
	<head>
		<style>
			table{
				border-collapse: collapse;
				width: 100%;
			}
			td, th {
				border : 1px solid #000000;
				text-align: center;
			}
		</style>
	</head>
	<body>
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

		<p align="right">        
			<img src="../public/assets/img/ide.jpg" height="60px"/><br/>
			
			<i>IDE GROUP</i><br>
			Jakarta, Indonesia<br>
			021911911
		</p>

		<hr>
		<hr>
		<p></p>
        <?php foreach ($dataFinance as $row) :?>
		<p>
			Pembeli : <?php echo $row->client_name; ?><br>
			Alamat : <?php echo $row->client_name; ?><br>
			Transaksi No :<?php echo $row->client_name; ?><br>
			Tanggal : <?php echo $row->client_name; ?>
            
            <?php echo date('Y-m-d', strtotime($row->invoice_date)) ?>
		
        </p>
		<table cellpadding="6" >
			<tr>
				<th><strong>Client Name</strong></th>
				<th><strong>Ammount</strong></th>
				<th><strong>Total Harga</strong></th>
			</tr>
			<tr>
				<td><?php echo $row->client_name; ?></td>
				<td><?php echo number_format($row->invoice_amount,0,",","."); ?></td>
				<td><?php echo number_format($row->invoice_amount,0,",","."); ?></td>
			</tr>
		</table>
        <?php
         endforeach;
        ?>
    </section>
	</body>
</html>