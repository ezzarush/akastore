<html>
<body>
<table width="100%">
	<thead>
		<tr><td align="center" colspan="10"><h3>AKASTORE ONLINE SHOP</h3><hr/></td></tr>
	</thead>
	<tbody>
	<?php
	if($status == 'request'){
		?>
		<tr>
			<td width="100px">Nama</td>
			<td width="10px">:</td>
			<td><?=$nama;?></td>
		</tr>
		<tr>
			<td width="100px">No.Telp</td>
			<td width="10px">:</td>
			<td><?=$telp;?></td>
		</tr>
		<tr>
			<td width="100px">Product Type</td>
			<td width="10px">:</td>
			<td><?=$product_type.' - '.$product_title;?></td>
		</tr>
		<tr>
			<td width="100px">QTY</td>
			<td width="10px">:</td>
			<td><?=$qty;?></td>
		</tr>
		<tr>
			<td width="100px">Total Price</td>
			<td width="10px">:</td>
			<td><?=$qty*$price;?></td>
		</tr>
		<tr>
			<td width="100px">Status</td>
			<td width="10px">:</td>
			<td><?=strtoupper($status);?></td>
		</tr>
		<tr>
			<td width="100px">Messages</td>
			<td width="10px">:</td>
			<td>
				<?php
				if($status=='request'){
					echo 'Silakan lakukan pembayaran dan akses <a target="_BLANK" href="http://localhost/akastore/customer/payment_confirmation/'.$product_id.'">halaman</a> berikut untuk konfirmasi pembayaran';
				}else{
					echo 'status belum ditentukan';
				}
				?>
			</td>
		</tr>
		<?php
	}else{?>
		<tr>
			<td colspan="10" align="center">Pembayaran sudah kami terima, pesanan anda sedang kami proses</td>
		</tr>
	<?php
	}?>
	</tbody>
</table>
</body>
</html>