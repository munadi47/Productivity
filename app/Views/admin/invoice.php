<html>
	<head>
	</head>
	<body>
    <section>
		
	<style>
	table, tr, td {
	padding: 15px;
	}
	</style>
	<table style="background-color: #fffff; color: #fff">
		<tbody>
			<tr>
				<td><img src="../public/assets/img/logo.jpg" height="60px"/></td>
				<td align="right"><br/>
					IDE GROUP<br/>
						Jakarta Utara, Indonesia<br/>
					<strong>01234567890</strong> | <strong>ide-group@ide.co.id</strong>
				</td>
			</tr>
		</tbody>
	</table>
	<?php foreach ($dataFinance as $row) :?>


	<table>
		<tbody>
			<tr>
				<td>Invoice to<br/>
				<strong><?php echo $row->id_client; ?></strong>
				<br/>
				<?php echo $row->address; ?>
				</td>

				<td align="right">
				<strong>Total : Rp<?php echo number_format($row->invoice_amount,0,",","."); ?></strong><br/>
				Invoice ID: <?php echo $row->id_finance; ?>LKC<br/>
				Invoice Create: <?php echo date('Y-m-d', strtotime($row->invoice_date)) ?>
				</td>
			
			</tr>
		</tbody>
	</table>
<br />
<br />
<br />
	<hr>

	<table>
	<tr>
		<th><strong>Client Name</strong></th>
		<th><strong>Total</strong></th>
		<th><strong>Status</strong></th>
	</tr>
	<tr>
		<td><?php echo $row->id_client; ?></td>
		<td><?php echo number_format($row->invoice_amount,0,",","."); ?></td>
		<td><?php echo $row->status; ?> </td>
	</tr>
	<tr>
	<hr>
	<td colspan="4">
	<div align="right">
	<h2 align="right">Thank you for your business.</h2><br/>
	<img src="../public/assets/img/munadi.png" height="60px"/><br/><br/><br/>
	</div>
	<p align="right">IDE GROUP.</p>
	</td>
	</tr>
	</table>

	<?php
		endforeach;
	?>
</section>
</body>
</html>