
    <div id="contectAjax"></div>
        <main class="app-content">
          
        <?php                           
         
           $idrol = $_SESSION['idUser']; 
           $datos = $_SESSION['userData']->idrol;
           $idpersona = $_SESSION['userData']->idpersona;
      
         ?>           
        <div class="app-title">
          <div>          
            <h1><i class="fas fa-user-tag"></i> Usuarios 
             <?php  if(($_SESSION['permisosMod']->w)){ ?>  
                  <button class="btn btn-primary" type="button" onclick="openModalUsuario();" data-toggle="modal" class="fa-solid fa-circle-plus">Nuevo</button>
             <?php }  ?>
            </h1>        
          </div>
          <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>roles"></i> Ir a Roles <small>Tienda Virtual</small></a></li>
          </ul>
        </div>

  <div class="modal-body">
     <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">          
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tableUsuarios">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nombres</th>
                      <th>Apellidos</th>
                      <th>Telefono</th>
                      <th>Email</th>  
                      <th>Rol</th>
                      <th>Status</th>
                      <th>Acciones</th>
                   </tr>
                  </thead>
                  <tbody>                                         
               
                  <?php
                         foreach($persona as $p)
                         {
                          $statu = $p->status;
                          $id = $p->idpersona;
                    
                          if($p->status == 1)
                            {                             
                              echo '
                                <tr>
                                  <td>'.$p->idpersona.'</dt>                               
                                  <td>'.$p->nombres.'</dt>
                                  <td>'.$p->apellidos.'</dt>
                                  <td>'.$p->telefono.'</dt>
                                  <td>'.$p->email_user.'</dt>
                                  <td>'.$p->nombrerol.'</dt>
                                  <td>'.$p->statu ='<span class="badge badge-success">Activo</span>'.'</dt>  
                                 
                                  <td>'.$p->opcion ='<div class="text-center"> '; ?>                     
                                   <?php if($_SESSION['permisosMod']->r){  ?>    
                                      <?php  echo '<button class="btn btn-info btn-sm btnVerUsuario" us="'.$p->idpersona.'"  title="Ver usuario"><i class="far fa-eye"></i></button>
                                  '; 
                                  ?>                                  
                                  <?php   } ?>
                                  <?php if($_SESSION['permisosMod']->u){  ?>    
                                    <?php if($datos ==  1 and $p->idrol != 1 || $idrol == 1 and $datos == 1 ){ ?> 
                                      <?php  echo ' <button class="btn btn-primary btn-sm  btnEditUsuario" rl="'.$p->idpersona.'"  title="Editar"><i class="fas fa-pencil-alt"></i></button>
                                     ';                                   
                                  ?>
                                  <?php } else{                                  
                                       echo ' <button class="btn btn-primary btn-sm  disabled  title="Editar"><i class="fas fa-pencil-alt"></i></button> '; 
                                  } } ?>

                                 
                                   <?php if($_SESSION['permisosMod']->d){  ?>    
                                    <?php if($idrol != $p->idpersona and $p->idrol != 1 || $idrol == 1 and $datos == 1  ){  ?> 
                                    <?php  echo '<button class="btn btn-danger btn-sm  btnDelUsuario" rl="'.$p->idpersona.'" title="Eliminar"><i class="far fa-trash-alt"></i></button></div>'.'</td>
                                  '; 
                                  ?>
                                 <?php } else{                                  
                                       echo ' <button class="btn btn-danger btn-sm  disabled  title="Eliminar"><i class="fas fa-trash-alt"></i></button> '; 
                                   } ?>

                                  <?php   } ?>
                               </tr>
                                        
                       <?php     }
                         else
                            {
                              echo '
                              <tr>
                                <td>'.$p->idpersona.'</dt>                          
                                <td>'.$p->nombres.'</dt>
                                <td>'.$p->apellidos.'</dt>
                                <td>'.$p->telefono.'</dt>
                                <td>'.$p->email_user.'</dt>
                                <td>'.$p->nombrerol.'</dt>
                                <td>'.$p->statu ='<span class="badge badge-danger">Inactivo</span>'.'</dt>
                                <td>'.$p->opcion ='<div class="text-center"> '; ?>  

                                
                                     <?php  echo '<button class="btn btn-info btn-sm btnVerUsuario" us="'.$p->idpersona.'"  title="Ver usuario"><i class="far fa-eye"></i></button>
                                    '; 
                                    ?>
                                                                
                                      <?php  echo ' <button class="btn btn-primary btn-sm  btnEditUsuario" rl="'.$p->idpersona.'"  title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                     ';                                   
                                    ?>                              
                            
                                    <?php  echo '<button class="btn btn-danger btn-sm  btnDelUsuario" rl="'.$p->idpersona.'" title="Eliminar"><i class="far fa-trash-alt"></i></a></div>'.'</td>
                                  '; 
                                  ?>                                
                             </tr>                               
                          <?php }  
                        
                        } ?>                                                              
                  </tbody>
                </table>
              </div>
            </div>
          </div>
       </div>

    </div>

         <!-- Modal guardar usuarios -->
         <div class="modal fade" id="modalFormUsuario" tabindex="-1" role="dialog"  aria-hidden="true">
           <div class="modal-dialog modal-lg ">
             <div class="modal-content">
               <div class="modal-header headerRegister">
                 <h5 class="modal-title" id="titleModal">Nuevo Usuario</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               <div class="modal-body">
                 <div class="tile">
                       <form  id="formUsuario" name="formUsuario" class="form-horizontal" method="post" >
                       <input type="hidden" id="idUsuario" name="idUsuario" value ="">
                       <p class="text-primary">Los campos con asterisco (<font color="red">*</font>) son obligatorios.  NOTA "Si no 
                       ingresas el password este se genera automáticamente y será enviado al correo electrónico ingresado. "</p>   
                          <div class="form-row">
                            <div class="form-group col-md-6">
                               <label class="control-label">Identificación (<font color="red">*</font>)</label>
                               <input type="text" class="form-control valid validNumber" id="txtIdentificacion" name="txtIdentificacion" required="">
                            </div>                          
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-6">
                               <label class="control-label">Nombres (<font color="red">*</font>)</label>
                               <input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" type="text" class="form-control valid validText" id="txtNombre" name="txtNombre" required=""maxlength="30">
                            </div>                         
                            <div class="form-group col-md-6">
                               <label for="txtApellido">Apellidos (<font color="red">*</font>)</label>
                               <input type="text" class="form-control valid validText" id="txtApellido" name="txtApellido" required="">
                            </div>                          
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-6">
                               <label for="txtTelefono">Teléfono</label>
                               <input type="text" class="form-control valid validNumber" id="txtTelefono" name="txtTelefono" required="">
                            </div>                          
                            <div class="form-group col-md-6">
                               <label for="txtEmail">Email (<font color="red">*</font>)</label>
                               <input type="text" class="form-control valid validEmail" id="txtEmail" name="txtEmail" required="">
                            </div>                          
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-6">
                               <label for="listRolid">Tipo usuario (<font color="red">*</font>)</label>
                               <select class="form-control selectpicker" id="listRolid" name="listRolid" required>
                               <option selected="selected">Seleccionar..</option>
                                             <?php foreach($rol as $roles): ?>
                                                <option value="<?=  $roles->idrol ?>"><?=  $roles->nombrerol ?>
                                            </option>
                                            <?php endforeach; ?> 
                               </select>                                    
                            </div> 
                            <div class="form-group col-md-6">
                                <label for="listStatus">Estado (<font color="red">*</font>)</label>
                                <select class="form-control selectpicker" id="listStatus" name="listStatus" required>
                                <option selected="selected">Seleccionar..</option>
                                  <option value="1">Activo</option>
                                  <option value="2">Inactivo</option>                     
                                </select>
                            </div>                            
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-6">
                               <label for="txtPassword">Password</label>
                               <input type="password" class="form-control" id="txtPassword" name="txtPassword">
                            </div> 
                          </div>                            
                         <div class="title-footer">
                              <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">
                                Guardar</span> </button>&nbsp;&nbsp;&nbsp;

                             <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i><span id="btnText">
                                Cerrar</span> </button>&nbsp;&nbsp;&nbsp;
                          </div>
                       </form>
                        </div>
                   </div>
               </div> 
             </div>
           </div>
         </div>    

         <!-- Modal ver usuarios-->
<div class="modal fade" id="modalViewUser" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Datos del usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td>Identificación:</td>
              <td id="celIdentificacion">654654654</td>
            </tr>
            <tr>
              <td>Nombres:</td>
              <td id="celNombre">Jacob</td>
            </tr>
            <tr>
              <td>Apellidos:</td>
              <td id="celApellido">Jacob</td>
            </tr>
            <tr>
              <td>Teléfono:</td>
              <td id="celTelefono">Larry</td>
            </tr>
            <tr>
              <td>Email (Usuario):</td>
              <td id="celEmail">Larry</td>
            </tr>
            <tr>
              <td>Tipo Usuario:</td>
              <td id="celTipoUsuario">Larry</td>
            </tr>
            <tr>
              <td>Estado:</td>
              <td id="celEstado">Larry</td>
            </tr>
            <tr>
              <td>Fecha registro:</td>
              <td id="celFechaRegistro">Larry</td>
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

               <!--Editar usuarios Modal -->

         <div class="modal fade" id="modalEditarUsuario" tabindex="-1" role="dialog"  aria-hidden="true">
           <div class="modal-dialog modal-lg ">
             <div class="modal-content">
               <div class="modal-header headerUpdate">
                 <h5 class="modal-title" id="titleModal">Actualizar Usuario</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               <div class="modal-body">
                 <div class="tile">
                       <form  id="formUsuario" name="formUsuario" class="form-horizontal" method="post" >
                       <input type="hidden" id="edit_idUsuario" name="edit_idUsuario" value ="">
                       <p class="text-primary">NOTA "Si no ingresas un nuevo password, continuará con el que ya tiene asignado. "</p>             
                          <div class="form-row">
                            <div class="form-group col-md-6">
                               <label for="txtIdentificacion">Identificación</label>
                               <input type="text" class="form-control valid validNumber" id="edit_lisIdentificacion" name="txtIdentificacion" required="">
                            </div>                          
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-6">
                               <label for="txtNombre">Actualizar Nombres</label>
                               <input type="text" class="form-control valid validText" id="edit_lisNombre" name="txtNombre" required="">
                            </div>                         
                            <div class="form-group col-md-6">
                               <label for="txtApellido">Actualizar Apellidos</label>
                               <input type="text" class="form-control valid validText" id="edit_lisApellido" name="txtApellido" required="">
                            </div>                          
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-6">
                               <label for="txtTelefono">Actualizar Teléfono</label>
                               <input type="text" class="form-control valid validNumber" id="edit_lisTelefono" name="txtTelefono" required="">
                            </div>                          
                            <div class="form-group col-md-6">
                               <label for="txtEmail">Actualizar Email</label>
                               <input type="text" class="form-control valid validEmail" id="edit_lisEmail" name="txtEmail" required="">
                            </div>                          
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-6">
                               <label for="listRolid">Tipo usuario (<font color="red">*</font>)</label>                                                                                 
                               <select class="form-control selectpicker" id="edit_listRolid" name="listRolid" required>  
                               <option selected="selected">Seleccionar..</option>
                                             <?php foreach($rol as $roles): ?>                                              
                                                <option value="<?=  $roles->idrol ?>"><?=  $roles->nombrerol ?>
                                            </option>
                                            <?php endforeach; ?> 
                               </select>                                                             
                            </div> 
                            <div class="form-group col-md-6">
                        <label for="exampleSelect1">Estado (<font color="red">*</font>)</label> 
                        <select class="form-control selectpicker" id="edit_listStatus" name="edit_listStatus" required="">
                        <option selected="selected">Seleccionar..</option>
                          <option value="1">Activo</option>
                          <option value="2">Inactivo</option>
                        </select> 
                    </div>                              
                            </div>
                          <div class="form-row">
                            <div class="form-group col-md-6">
                               <label for="txtPassword">Actualizar Password </label>
                               <input type="password" class="form-control" id="edit_Password" name="txtPassword">
                            </div> 
                          </div>                            
                         <div class="title-footer">
                              <button id="updateUsuario" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">
                                Actualizar</span> </button>&nbsp;&nbsp;&nbsp;

                             <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i><span id="btnText">
                                Cerrar</span> </button>&nbsp;&nbsp;&nbsp;
                          </div>
                       </form>
                        </div>
                   </div>
               </div> 
             </div>
           </div>
         </div>    


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
                       <form  id="formRo" name="formRo" method="post" >
                       <input type="hidden" id="edit_editar_Rol" name="edit_editar_Rol" value ="">
                         <div class="form-group">
                           <label class="control-label">Editar Nombre</label>
                           <input class="form-control valid validNumber" id="edit_nombre" name="txtNombre" type="text" placeholder="Nombre del rol" required="">
                         </div>
                         <div class="form-group">
                           <label class="control-label">Editar Descripción</label>
                           <textarea class="form-control valid validNumber" id="edit_descripcion" name="txtDescripcion" rows="2" placeholder="Descripción del rol" required=""></textarea>
                        
                          </div>

                         <div class="form-group">
                             <label for="exampleSelect1">Editar Estado</label>
                             <select class="form-control" id="edit_listStatus" name="listStatus" required="">
                               <option value="1">Activo</option>
                               <option value="2">Inactivo</option>                     
                             </select>
                           </div>
                         <div class="tile-footer">
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


