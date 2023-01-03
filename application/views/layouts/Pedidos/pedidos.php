
 <div id="divModal"></div>
<main class="app-content">

    <?php                            
           $r = ($_SESSION['permisosMod']->r);
           $u = ($_SESSION['permisosMod']->u);
           $d = ($_SESSION['permisosMod']->d);  
           $this->load->model("Helpers");   
                
         ?>
    <div class="app-title">
        <div>
            <h1><i class="fas fa-box"></i>Pedido <small>Tienda Virtual</small></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>productos">Ir a Productos <small>Tienda Virtual</small></a></li>
        </ul>
    </div>

    <div class="modal-body">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tablePedidos">
                            <thead>
                                <tr>                               
                                <th>#</th>
                                <th>Ref. / Transacción</th>
                                <th>Fecha</th>
                                <th>Monto</th>
                                <th>Tipo pago</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- recorremos la tabla rol y traemos los datos -->
                               <?php
                         foreach($pedidos as $p)
                         {                    
                        
                            $p->transaccion = $p->referenciacobro;
                            if($p->idtransaccionpaypal != ""){
                              $p->transaccion = $p->idtransaccionpaypal;
                            }

                            $precio =  $this->Helpers->formatMoney($p->monto); 
                            $montofinal = $this->Helpers->Money().' '.$precio ; 
             
                              echo '
                                <tr>
                                  <td>'.$p->idpedido.'</dt>
                                  <td>'.$p->idtransaccionpaypal.'</dt>
                                  <td>'.$p->fecha.'</dt>
                                  <td>'.$montofinal.'</dt>
                                  <td>'.$p->tipopago.'</dt>    
                                  <td>'.$p->status.'</dt>                                                                                            
                                  <td>'.$p->opcion ='<div class="text-center"> ' ; ?>       
                               
                      <?php if($_SESSION['permisosMod']->r){  ; ?>                                      
                                <?php  echo '<a title="Ver Detalle" href="pedidos/orden/'.$p->idpedido.'" class="btn btn-info btn-sm"> <i class="far fa-eye"></i> </a> ';
                                     ?>

                           <?php  if($p->idtipopago == 1){  ?>                                
                                    <?php  echo '<a title="Ver Transacción" href="pedidos/transaccion/'.$p->idtransaccionpaypal.'" class="btn btn-info btn-sm"> <i class="fa fa-paypal" aria-hidden="true"></i> </a>
                                      ';
                                  }else{?>
                                     <?php  echo '<button  class="btn btn-secondary btn-sm" disabled=""><i class="fa fa-paypal" aria-hidden="true"></i></button> ';
                                   } ?>                               
                                  
                     <?php }  if($_SESSION['permisosMod']->u){  ?>     
                                    <?php  echo '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo(this,'.$p->idpedido.')" title="Editar pedido"><i class="fas fa-pencil-alt"></i></button>';
                                  }  
                             ?>                              
                        </tr> 
                           
                 <?php  } ?>                      
                                                       
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
   </div>

</div>

   </main>

   