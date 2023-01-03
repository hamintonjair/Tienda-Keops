<style>  
    #img{
           width: 100px;
           height: 50px;          
       }

</style>
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-file-text-o"></i> Pedidos <small>Tienda Virtual</small> </h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="<?= base_url(); ?>pedidos"> Pedidos</a></li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <?php
        
          if(empty( $pedidos)){
          
        ?>
        <p>Datos no encontrados</p>
        <?php }else{
            $totalF = 0;
            $clientes = $pedidos['cliente'];           
            $ordenes = $pedidos['orden'];
            $detalles = $pedidos['detalle'];
       foreach($clientes as $cliente) {  
          foreach($ordenes as $orden) {  
             foreach($detalles as $detalle) { 
         
                        }
                    }
                }?>
        <section id="sPedido" class="invoice">
          <div class="row mb-4">
            <div id="header" class="col-6" >            
            <img id="img" src="<?=$url_logo?>" >
              <?php if( $orden->tipopagoid == 1){ 
                  $totalF =  CURRENCY.' '. formatMoney($orden->USD); 
                ?>
                 <h2 class="page-header"><img src="<?= base_url(); ?>assets/Template/Admin/images/img-paypal.jpg" ></h2>
              <?php }else{  $totalF = SMONEY.' '. formatMoney($orden->monto); }; ?>
            </div>
            <div class="col-6">
              <h5 class="text-right">Fecha: <?= $orden->fecha ?></h5>
            </div>
          </div>
          <div class="row invoice-info">
            <div class="col-4">
            <?php  
              $this->load->model("ConfiguracionModel");
              $empresa = $this->ConfiguracionModel->getEmpresa();
              $telefono =  $empresa[0]->telefono;
              $N_empresa =  $empresa[0]->empresa; 
              $direccion =  $empresa[0]->direccion; 
              $email_empresa =  $empresa[0]->email_empresa; 
              $web_empresa =  $empresa[0]->web_empresa; 
            
            ?>
              <address><strong><?=    $N_empresa; ?></strong><br>
                <?=  $direccion ?><br>
                <?=  $telefono  ?><br>
                <?=  $email_empresa ?><br>
                <?=  $web_empresa ?>
              </address>
            </div>
            <div class="col-4">
              <address><strong><?= $cliente->nombres.' '.$cliente->apellidos?></strong><br>
                Envío: <?= $orden->direccion_envio; ?><br>
                Tel: <?= $cliente->telefono ?><br>
                Email: <?= $cliente->email_user ?>
               </address>
            </div>
            <div class="col-4"><b>Orden #<?= $orden->idpedido ?></b><br> 
                <b>Pago: </b><?= $orden->tipopago ?><br>
                <?php 
                foreach($ordenes as $orde) {                                
     
                 $transaccion = $orde->idtransaccionpaypal != "" ? 
                                $orde->idtransaccionpaypal : 
                                $orde->referenciacobro;
                                        
                
                if($transaccion == null){
                  $transacciones = 0;
                }else{
                  $transacciones =  $transaccion;
                }?>
              
                <b>Transacción:</b> <?= $transacciones ?> <br>
                <b>Estado:</b> <?= $orden->status ?> <br>
                <b>Monto:</b> <?=  $totalF ; }  ?>
            </div>
          </div>
          <div class="row">
            <div class="col-12 table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Descripción</th>
                    <th class="text-right">Precio</th>
                    <th class="text-center">Cantidad</th>
                    <th class="text-right">Importe</th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                        $subtotal = 0;
                        $subtotalF = 0;
                        $precio = 0;
                        $monto = 0;
                        $costo_envio = 0;                  
                        if(!empty($detalle)){                          
                            foreach($detalles as $detall) {  

                              if( $orden->tipopagoid == 1){
                                $subtotalF =  CURRENCY.' '.formatMoney($subtotal += $detall->cantidad * $detall->USD);
                                $precio =  CURRENCY.' '. formatMoney($detall->cantidad * $detall->USD);
                                $monto = CURRENCY.' '. formatMoney($orden->USD);
                                $costo_envio = CURRENCY.' '. formatMoney($orden->costo_envio);
                              }else{
                                $subtotalF =  SMONEY.' '.formatMoney($subtotal += $detall->cantidad * $detall->precio);
                                $precio =  SMONEY.' '. formatMoney($detall->cantidad * $detall->precio);
                                $monto = SMONEY.' '. formatMoney($orden->monto);
                                $costo_envio = SMONEY.' '. formatMoney($orden->costo_envioP);
                              }    
                               

                     ?>
                  <tr>
                    <td><?= $detall->producto ?></td>
                    <td class="text-right"><?=$precio ?></td>
                    <td class="text-center"><?= $detall->cantidad ?></td>
                    <td class="text-right"><?= $precio ?></td>
                  </tr>
                  <?php 
                            
                        }   }
                   ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-right">Sub-Total:</th>
                        <td class="text-right"><?= $subtotalF ?></td>
                    </tr>
                    <tr>
                        <th colspan="3" class="text-right">Envío:</th>
                        <td class="text-right"><?= $costo_envio ?></td>
                    </tr>
                    <tr>
                        <th colspan="3" class="text-right">Total:</th>
                        <td class="text-right"><?= $monto ?></td>
                    </tr>
                </tfoot>
              </table>
            </div>
          </div>
          <div class="row d-print-none mt-2">
            <div class="col-12 text-right"><a class="btn btn-primary" href="javascript:window.print('#sPedido');" ><i class="fa fa-print"></i> Imprimir</a></div>
          </div>
        </section>
        <?php
              } ?>
      </div>
    </div>
  </div>
</main>