
    <div id="contectAjax"></div>
        <main class="app-content">
              
        <?php                            
           $r = ($_SESSION['permisosMod']->r);
           $u = ($_SESSION['permisosMod']->u);
           $d = ($_SESSION['permisosMod']->d);          
         ?>
        <div class="app-title">
          <div>
            <h1><i class="fas fa-user-tag"></i> Roles Usuarios <small>Tienda Virtual</small> 
            <?php  if(($_SESSION['permisosMod']->w)){ ?>  
                  <button class="btn btn-primary" type="button" onclick="openModal();" data-toggle="modal" class="fa-solid fa-circle-plus">Nuevo</button>
            <?php }  ?>
          </h1>        
          </div>
          <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <?php
                 foreach($rol as $roles)
             {     } ?>                     
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Permisos/PermisosAdd/<?= $roles = 0 ?>">Ir a nuevo permisos</a></li>
          </ul>    
        </div>

  <div class="modal-body">
     <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">          
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tableRoles">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nombres</th>
                      <th>Descripción</th>
                      <th>Estado</th>
                      <th>Acciones</th>
                   </tr>
                  </thead>
                  <tbody>                                         
                      <!-- recorremos la tabla rol y traemos los datos -->
                  <?php
                         foreach($rol as $roles)
                         {
                          $statu = $roles->status;
                          $id = $roles->idrol;

                          if($roles->status == 1)
                            {                             
                              echo '
                                <tr>
                                  <td>'.$roles->idrol.'</dt>
                                  <td>'.$roles->nombrerol.'</dt>
                                  <td>'.$roles->descripcion.'</dt>
                                  <td>'.$roles->statu ='<span class="badge badge-success">Activo</span>'.'</dt> 
                                  <td>'.$roles->opcion ='<div class="text-center"> '  ; ?>       
                               
                                   <?php if($_SESSION['permisosMod']->r){  ?>  
                                      <?php  echo '<a class="btn btn-secondary btn-sm btnPermisosRol" href="Permisos/rol_especificos/'.$roles->idrol.'"  title="Permisos"><i class="fa-solid fa-key"></i></a>
                                  '; 
                                    } ?>
                                   <?php if($_SESSION['permisosMod']->u){  ?>  
                                      <?php  echo '<button class="btn btn-primary btn-sm btn btnEditRol" rl="'.$roles->idrol.'"  title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                   ';
                                    } ?>                               
                                  <?php if($_SESSION['permisosMod']->d){  ?>  
                                      <?php  echo '<button class="btn btn-danger btn-sm  btnDelRol" rl="'.$roles->idrol.'" title="Eliminar"><i class="far fa-trash-alt"></i></a></div>'.'</td>

                                  '; 
                                   ?>
                                  <?php   } ?>
                               </tr>
                                         
                     <?php  }
                         else
                            {
                              echo '
                              <tr>
                                <td>'.$roles->idrol.'</dt>
                                <td>'.$roles->nombrerol.'</dt>
                                <td>'.$roles->descripcion.'</dt>
                                <td>'.$roles->statu ='<span class="badge badge-danger">Inactivo</span>'.'</dt>
                                <td>'.$roles->opcion ='<div class="text-center"> '; ?> 
                             
                                 <?php if($_SESSION['permisosMod']->r){  ?>  
                                      <?php  echo '<a class="btn btn-secondary btn-sm btnPermisosRol" href="Permisos/rol_especificos/'.$roles->idrol.'"  title="Permisos"><i class="fa-solid fa-key"></i></a>
                                  '; 
                                 } ?>
                                   <?php if($_SESSION['permisosMod']->u){  ?>  
                                      <?php  echo '<button class="btn btn-primary btn-sm btn btnEditRol" rl="'.$roles->idrol.'"  title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                   ';
                                    } ?>                                
                                  <?php if($_SESSION['permisosMod']->d){  ?>  
                                      <?php  echo '<button class="btn btn-danger btn-sm  btnDelRol" rl="'.$roles->idrol.'" title="Eliminar"><i class="far fa-trash-alt"></i></a></div>'.'</td>
                                  '; 
                                   ?>
                                  <?php   } ?>
                          </tr>                               
                       <?php   } ?>                      
                   <?php   } ?>                                      
                                              
                  </tbody>
                </table>
              </div>
            </div>
          </div>
       </div>
    </div>
         <!-- Modal guardar -->
         <div class="modal fade" id="modalFormRol" tabindex="-1" role="dialog"  aria-hidden="true">
           <div class="modal-dialog modal-dialog-centered" role="document">
             <div class="modal-content">
               <div class="modal-header headerRegister">
                 <h5 class="modal-title" id="titleModal">Nuevo Rol</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               <div class="modal-body">
                 <div class="tile">
                   
                     <div class="tile-body">
                       <form  id="formRol" name="formRol" method="post" >
                       <input type="hidden" id="idRol" name="idRol" value ="">
                       <p class="text-primary">Los campos con asterisco (<font color="red">*</font>) son obligatorios.</p>  
                         <div class="form-group">
                           <label class="control-label">Nombre (<font color="red">*</font>)</label>
                           <input class="form-control" id="txtNombre" name="txtNombre" type="text" placeholder="Nombre del rol" required="">
                         </div>
                         <div class="form-group">
                           <label class="control-label">Descripción (<font color="red">*</font>)</label>
                           <textarea class="form-control" id="txtDescripcion" name="txtDescripcion" rows="2" placeholder="Descripción del rol" required=""></textarea>
                        
                          </div>

                         <div class="form-group">
                             <label for="exampleSelect1">Estado</label>
                             <select class="form-control selectpicker" id="listStatus" name="listStatus" required="">                                                         
                               <option selected="selected">Seleccionar..</option>
                               <option value="1">Activo</option>
                               <option value="2">Inactivo</option>                     
                             </select>
                           </div>
                         <div class="title-footer">
                       <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">
                        Guardar</span> </button>&nbsp;&nbsp;&nbsp; <a class="btn btn-danger" class="btn btn-secondary" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                     </div>
                       </form>
                     </div>
             
                   </div>

               </div> 
             </div>
           </div>
         </div>  
               <!--Editar Modal -->
               <div class="modal fade" id="modalEditarRol" tabindex="-1" role="dialog"  aria-hidden="true">
           <div class="modal-dialog modal-dialog-centered" role="document">
             <div class="modal-content">
               <div class="modal-header headerUpdate">
                 <h5 class="modal-title" id="titleModal">Actualizar Rol</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               <div class="modal-body">
                 <div class="tile">
                   
                     <div class="tile-body">
                       <form  id="formRol" name="formRol" method="post" >
                       <input type="hidden" id="edit_editar_Rol" name="edit_editar_Rol" value ="">
                         <div class="form-group">
                           <label class="control-label">Editar Nombre</label>
                           <input class="form-control" id="edit_nombre" name="txtNombre" type="text" placeholder="Nombre del rol" required="">
                         </div>
                         <div class="form-group">
                           <label class="control-label">Editar Descripción</label>
                           <textarea class="form-control" id="edit_descripcion" name="txtDescripcion" rows="2" placeholder="Descripción del rol" required=""></textarea>
                        
                          </div>

                         <div class="form-group">
                             <label for="exampleSelect1">Editar Estado</label>
                             <select class="form-control" id="edit_listStatus" name="listStatus" required="">                            
                               <option value="1">Activo</option>
                               <option value="2">Inactivo</option>                     
                             </select>
                           </div>

                         <div class="title-footer">
                       <button id="update" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">
                        Actualizar</span> </button>&nbsp;&nbsp;&nbsp; <a class="btn btn-secondary" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                     </div>
                       </form>
                     </div>
             
                   </div>

               </div> 
             </div>
           </div>
         </div>   
      
    </main>


    <!-- Essential


