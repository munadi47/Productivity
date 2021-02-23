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

    <table style="background-color: #222222; color: #fff">
        <tbody>
        <tr>
        <td><h1>INVOICE</h1></td>
        <td align="right"><img src="<?php echo base_url('assets/img/LOGO IDE.png'); ?>" height="60px"/><br/>
        <i>IDE GROUP</i><br>
        123 street, ABC Store<br/>
        Country, State, 00000
        <br/>
        <strong>+62-1234567890</strong> | <strong>ide@ide-group.com</strong>
        </td>
        
        </tr>
        </tbody>
    </table>

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