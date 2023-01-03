<div id="contectAjax"></div>
<main class="app-content">

    <?php                            
           $r = ($_SESSION['permisosMod']->r);
           $u = ($_SESSION['permisosMod']->u);
           $d = ($_SESSION['permisosMod']->d);          
         ?>
    <div class="app-title">
        <div>
            <h1><i class="fas fa-box-tissue"></i> Fotos <small>Tienda Virtual</small>
                <?php  if(($_SESSION['permisosMod']->w)){ ?>
                <button class="btn btn-primary" type="button" onclick="openModalFotos();" data-toggle="modal" class="fa-solid fa-circle-plus">Nuevo</button>  
                <?php }  ?>
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>productos">Ir a productos <small>Tienda Virtual</small></a></li>
        </ul>
    </div>

    <div class="modal-body">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tableFotoss">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Descripcion</th>                                                                                                
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- recorremos la tabla rol y traemos los datos -->
                                <?php
                         foreach($fotos as $c)
                         {                     
                                                    
                              echo '
                                <tr>
                                  <td>'.$c->id.'</dt>                                 
                                  <td>'.$c->descripcion.'</dt>                                
                                  <td>'.$c->opcion ='<div class="text-center"> '  ; ?>       
                               
                               <?php if($_SESSION['permisosMod']->r){  ?>    
                                      <?php  echo '<button class="btn btn-info btn-sm btnVerFotos" us="'.$c->id.'"  title="Ver Fotos"><i class="far fa-eye"></i></button>
                                  '; 
                               }?>     
                                <?php if($_SESSION['permisosMod']->u){  ?>                         
                                    <?php  echo '<button class="btn btn-primary btn-sm btn btnEditFotos" rl="'.$c->id.'"  title="Editar Fotos"><i class="fas fa-pencil-alt"></i></a>
                                   ';
                                  } ?>                             
                                  <?php if($_SESSION['permisosMod']->d){  ?> 
                                      <?php  echo '<button class="btn btn-danger btn-sm  btnDelFotos" rl="'.$c->id.'" title="Eliminar Fotos"><i class="far fa-trash-alt"></i></a></div>'.'</td>

                                  '; 
                                   ?>
                                  <?php } ?>
                               </tr>                                                 
                                           
                   <?php   } ?>                                      

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal guardar y Editar-->
    <div class="modal fade" id="modalFormFotos" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" >
        <div class="modal-content">
          <div class="modal-header headerRegister">
            <h5 class="modal-title" id="titleModal">Nueva Foto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">     
                <form id="formFotos" name="formFotos" class="form-horizontal">
                  <input type="hidden" id="idFotos" name="idFotos" value="">
                  <input type="hidden" id="foto_actual" name="foto_actual" value="">
                  <input type="hidden" id="foto_remove" name="foto_remove" value="0">
                  <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>
                  <div class="row">
                    <div class="col-md-6">                        
                        <div class="form-group">
                          <label class="control-label">Descripción (<font color="red">*</font>)</label>
                          <textarea class="form-control" id="txtDescripcion" name="txtDescripcion" rows="2" placeholder="Descripción Categoría" required=""></textarea>
                        </div>                         
                    </div>
                    <div class="col-md-6">
                        <div class="photo">
                            <label for="foto">Foto (570 x 380)</label>
                            <div class="prevPhoto">
                              <span class="delPhoto notBlock">X</span>
                              <label for="foto"></label>
                              <div>
                                <img id="img" src="<?php echo base_url(); ?>/assets/Template/Admin/images/uploads/portada_categoria.png">
                              </div>
                            </div>
                            <div class="upimg">
                              <input type="file" name="foto" id="foto">
                            </div>
                            <div id="form_alert"></div>
                        </div>
                    </div>
                  </div>
                  
                  <div class="tile-footer">
                    <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
                  </div>
                </form>
          </div>
        </div>
      </div>
    </div>

     <!-- Modal ver Fotoss-->
    <div class="modal fade" id="modalViewFotos" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" >
        <div class="modal-content">
          <div class="modal-header header-primary">
            <h5 class="modal-title" id="titleModal">Datos de la foto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <table class="table table-bordered">
              <tbody>
                <tr>
                  <td>ID:</td>
                  <td id="celId"></td>
                </tr>               
                <tr>
                  <td>Descripción:</td>
                  <td id="celDescripcion"></td>
                </tr>              
                <tr>
                  <td>Foto:</td>
                  <td id="imgFotos"></td>
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