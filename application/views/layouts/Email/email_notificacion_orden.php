
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Orden</title>
	<style type="text/css">
		p{
			font-family: arial;letter-spacing: 1px;color: #7f7f7f;font-size: 12px;
		}
		hr{border:0; border-top: 1px solid #CCC;}
		h4{font-family: arial; margin: 0;}
		table{width: 100%; max-width: 600px; margin: 10px auto; border: 1px solid #CCC; border-spacing: 0;}
		table tr td, table tr th{padding: 5px 10px;font-family: arial; font-size: 12px;}
		#detalleOrden tr td{border: 1px solid #CCC;}
		.table-active{background-color: #CCC;}
		.text-center{text-align: center;}
		.text-right{text-align: right;}

		@media screen and (max-width: 470px) {
			.logo{width: 90px;}
			p, table tr td, table tr th{font-size: 9px;}
		}
		#img{
			width: 100px;
			height: 50px;          
		}
	</style>
</head>
<?php  
	  $this->load->model("ConfiguracionModel");
	  $empresa = $this->ConfiguracionModel->getEmpresa();
	  $telefono =  $empresa[0]->telefono;
	  $N_empresa =  $empresa[0]->empresa; 
	  $direccion =  $empresa[0]->direccion; 
	  $email_empresa =  $empresa[0]->email_empresa; 
	  for($i=0;$i< count($empresa);$i++){
		$logo = $empresa[$i]->logo;
	}	
	?>
<body>
	<div>
		<br>
		<p class="text-center">Se ha generado una orden, a continuación encontrarás los datos.</p>
		<br>
		<hr>
		<br>
		<table>
			<tr>
				<td width="33.33%">
					<img id="img" class="logo" src="<?= base_url().'assets/Template/Admin/images/uploads/'.$logo?>" alt="Logo">
				</td>
				<td width="33.33%">
					<div class="text-center">
						<h4><strong><?=   $N_empresa?></strong></h4>
						<p>
							<?=   $direccion?> <br>
							Teléfono: <?= $telefono  ?> <br>
							Email: <?=   $email_empresa ?>
						</p>
					</div>
				</td>
				<td width="33.33%">
					<div class="text-right">
						<p>
							No. Orden: <strong><?= $orden[0]->idpedido ?></strong><br>
                            Fecha: <?= $orden[0]->fecha ?> <br>
                            <?php 
								if($orden[0]->tipopagoid == 1){
							 ?>
                            Método Pago: <?= $orden[0]->tipopago ?> <br>
                            Transacción: <?= $orden[0]->idtransaccionpaypal ?>
                        <?php }else{ ?>
                        	Método Pago: Pago contra entrega <br>
							Tipo Pago: <?= $orden[0]->tipopago ?>
                        <?php } ?>
						</p>
					</div>
				</td>				
			</tr>
		</table>
		<table>
			<tr>
		    	<td width="140">Nombre:</td>
		    	<td><?= $_SESSION['userData']->nombres.' '.$_SESSION['userData']->apellidos ?></td>
		    </tr>
		    <tr>
		    	<td>Teléfono</td>
		    	<td><?= $_SESSION['userData']->telefono ?></td>
		    </tr>
		    <tr>
		    	<td>Dirección de envío:</td>
		    	<td><?= $orden[0]->direccion_envio ?></td>
		    </tr>
		</table>
		<table>
		  <thead class="table-active">
		    <tr>
		      <th>Descripción</th>
		      <th class="text-right">Precio</th>
		      <th class="text-center">Cantidad</th>
		      <th class="text-right">Importe</th>
		    </tr>
		  </thead>
		  <tbody id="detalleOrden">
		  	<?php 
		  		if(count($detalle) > 0){
                    $subtotal = 0;  
					$subtotalt = 0; 
					$totalreal =0;
					$subtotalreal = 0;
					$precio = 0; 
					$importeR = 0; 
					$cantidad = 0;  
					$costo_envio = 0;

					if($orden[0]->tipopagoid == 1){ 
						foreach ($detalle as $producto) {
							$precio =  CURRENCY.' '.formatMoney($producto->USD);
							// formatMoney($producto->USD * $producto->cantidad);
						    $importe =   formatMoney($producto->USD * $producto->cantidad);	
							$subtotalt  =  $subtotal += $importe;					
							$subtotalreal  = CURRENCY.' '.formatMoney($subtotalt);					
							$cantidad = $producto->cantidad;
							$importeR = CURRENCY.' '.$importe;
							$costo_envio = CURRENCY.' '.formatMoney($orden[0]->costo_envio);
							$totalreal = CURRENCY.' '.$subtotalt + $orden[0]->costo_envio  ;	
							
							?>
							<tr>
							  <td><?= $producto->producto ?></td>
							  <td class="text-right"><?= $precio ?></td>
							  <td class="text-center"><?= $producto->cantidad?></td>
							  <td class="text-right"><?= $importeR ?></td>
							</tr>
							<?php }
				 ?>

				<?php 	 }else{
						foreach ($detalle as $producto) {
							$precio =  SMONEY.' '.formatMoney($producto->precio);
							// formatMoney($producto->precio * $producto->cantidad);
						    $importe =  $producto->precio * $producto->cantidad;	
							$subtotalt  =  $subtotal += $importe;							
							$subtotalreal  = SMONEY.' '.formatMoney($subtotalt);												
							$cantidad = $producto->cantidad;
							$importeR = SMONEY.' '.$importe;
							$costo_envio = SMONEY.' '.formatMoney($orden[0]->costo_envioP);
							$totalreal = SMONEY.' '.formatMoney($subtotalt + $orden[0]->costo_envioP);
							?>
							<tr>
							  <td><?= $producto->producto ?></td>
							  <td class="text-right"><?= $precio ?></td>
							  <td class="text-center"><?= $producto->cantidad?></td>
							  <td class="text-right"><?= $importeR ?></td>
							</tr>

						<?php }
								 }} ?>
			

		  </tbody>
		  <tfoot>
		  		<tr>
		  			<th colspan="3" class="text-right">Subtotal:</th>
		  			<td class="text-right"><?= $subtotalreal ?></td>
		  		</tr>
		  		<tr>
		  			<th colspan="3" class="text-right">Envío:</th>
		  			<td class="text-right"><?= $costo_envio ?></td>
		  		</tr>
		  		<tr>
		  			<th colspan="3" class="text-right">Total:</th>
		  			<td class="text-right"><?= $totalreal ?></td>
		  		</tr>
		  </tfoot>
		</table>
		<div class="text-center">
			<p>Si tienes preguntas sobre tu pedido, <br>pongase en contacto con nombre, teléfono y Email</p>
			<h4>¡Gracias por tu compra!</h4>			
		</div>
	</div>									
</body>
</html>