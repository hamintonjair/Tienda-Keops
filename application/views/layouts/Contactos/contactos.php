<?php    
    // getModal('modalMensaje',$data);
?>
  <main class="app-content">    
      <div class="app-title">
        <div>
            <h1><i class="fas fa-user-tag"></i> Contactos <small> Tienda Virtual</small></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>contactos">Contactos <small> Tienda Virtual</small></a></li>
        </ul>
      </div>
        <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tableContactos">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nombre</th>
                          <th>Email</th>
                          <th>Fecha</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php  if($_SESSION['permisosMod']->r){ ?>  
                       <?php
                         foreach($contactos as $c)
                         {                              
                              echo '
                                <tr>
                                  <td>'.$c->id.'</dt>  
                                  <td>'.$c->nombre.'</dt>                    
                                  <td>'.$c->email.'</dt>
                                  <td>'.$c->fecha.'</dt>                                                            
                                  <td>'.$c->opcion ='<div class="text-center">'; ?>                                   
                                  <?php if($_SESSION['permisosMod']->r){  ?>    
                                 <?php  echo '<button class="btn btn-info btn-sm" onClick="fntViewInfo('.$c->id.')" title="Ver mensaje"><i class="far fa-eye"></i></button></div>';                                   
      
                                     }?>                         
                               </tr>                                      
                        <?php  }?>   
                  <?php }  ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div>

        
    <!-- Modal -->
<div class="modal fade" id="modalViewMensaje" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl" >
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Datos del contacto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td>ID:</td>
              <td id="celCodigo"></td>
            </tr>
            <tr>
              <td>Nombres:</td>
              <td id="celNombre"></td>
            </tr>
            <tr>
              <td>Email:</td>
              <td id="celEmail"></td>
            </tr>
            <tr>
              <td>Fecha:</td>
              <td id="celFecha"></td>
            </tr>
            <tr>
              <td>Mensaje:</td>
              <td id="celMensaje"></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

    </main>



    