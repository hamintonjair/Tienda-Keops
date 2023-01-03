
<div id="contectAjax"></div>
<main class="app-content">
          
        <?php                           
         
           $idrol = $_SESSION['idUser'];          
           $idpersona = $_SESSION['userData']->idpersona;
      
         ?>           
        <div class="app-title">
          <div>          
            <h1><i class="fa-solid fa-user-pen"></i> Clientes <small>Tienda Virtual</small>
             <?php  if(($_SESSION['permisosMod']->w)){ ?>  
                  <button class="btn btn-primary" type="button" onclick="openModalClientes();" data-toggle="modal" class="fa-solid fa-circle-plus">Nuevo</button>
             <?php }  ?>
            
            </h1>        
          </div>
          <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>dashboard/clientes">Clientes <small>Tienda Virtual</small></a></li>
          </ul>
        </div>

   <div class="modal-body">
     <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">          
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tableClientes">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Identificación</th>
                      <th>Nombres</th>
                      <th>Apellidos</th>
                      <th>Telefono</th>
                      <th>Email</th>             
                      <th>Acciones</th>
                   </tr>
                  </thead>
                  <tbody>                                         
                  <?php  if($_SESSION['permisosMod']->r){ ?>  
                       <?php
                         foreach($persona as $p)
                         {                              
                              echo '
                                <tr>
                                  <td>'.$p->idpersona.'</dt>  
                                  <td>'.$p->identificacion.'</dt>                    
                                  <td>'.$p->nombres.'</dt>
                                  <td>'.$p->apellidos.'</dt>
                                  <td>'.$p->telefono.'</dt>
                                  <td>'.$p->email_user.'</dt>                                                                                               
                                  <td>'.$p->opcion ='<div class="text-center"> '; ?>   

                                  <?php if($_SESSION['permisosMod']->r){  ?> 
                                  <?php if($idrol ==  $idpersona ){ ?>  
                                      <?php  echo '<button class="btn btn-info btn-sm btnVerCliente" us="'.$p->idpersona.'"  title="Ver cliente"><i class="far fa-eye"></i></button>
                                  '; 
                                  }}?>                                 
                                 
                                   <?php if($_SESSION['permisosMod']->u){  ?> 
                                    <?php if($idrol ==  $idpersona ){ ?> 
                                      <?php  echo ' <button class="btn btn-primary btn-sm  btnEditCliente" rl="'.$p->idpersona.'"  title="Editar"><i class="fas fa-pencil-alt"></i></button>
                                     ';                                   
                                    }}?>                                                               
                                    <?php if($_SESSION['permisosMod']->d){  ?> 
                                    <?php if($idrol ==  $idpersona ){ ?>                                      
                                    <?php  echo '<button class="btn btn-danger btn-sm  btnDelCliente" rl="'.$p->idpersona.'" title="Eliminar"><i class="far fa-trash-alt"></i></button></div>'.'</td>
                                  '; 
                                    }}?>
                               
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
         <!-- Modal guardar Cliente -->
         <div class="modal fade" id="modalFormCliente" tabindex="-1" role="dialog"  aria-hidden="true">
           <div class="modal-dialog modal-lg ">
             <div class="modal-content">
               <div class="modal-header headerRegister">
                 <h5 class="modal-title" id="titleModal">Nuevo Cliente</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               <div class="modal-body">
                 <div class="tile">
                       <form  id="formCliente" name="formCliente" class="form-horizontal" method="post" >
                       <input type="hidden" id="idCliente" name="idCliente" value ="">
                       <p class="text-primary">Los campos con asterisco (<font color="red">*</font>) son obligatorios.  NOTA "Si no 
                       ingresas el password este se genera automáticamente y será enviado al correo electrónico ingresado. "</p>
                          <div class="form-row">
                            <div class="form-group col-md-4">
                               <label class="control-label">Identificación <font color="red">*</font></label>
                               <input type="text" class="form-control valid validNumber" id="txtIdentificacion" name="txtIdentificacion" required="">
                            </div>                        
                            <div class="form-group col-md-4">
                               <label class="control-label">Nombres <font color="red">*</font></label>
                               <input type="text" class="form-control valid validText" id="txtNombre" name="txtNombre" required=""maxlength="30">
                            </div>                         
                            <div class="form-group col-md-4">
                               <label for="txtApellido">Apellidos <font color="red">*</font></label>
                               <input type="text" class="form-control valid validText" id="txtApellido" name="txtApellido" required="">
                            </div>                          
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-4">
                               <label for="txtTelefono">Teléfono <font color="red">*</font></label>
                               <input type="text" class="form-control valid validNumber" id="txtTelefono" name="txtTelefono" required="">
                            </div>                          
                            <div class="form-group col-md-4">
                               <label for="txtEmail">Email <font color="red">*</font></label>
                               <input type="text" class="form-control valid validEmail" id="txtEmail" name="txtEmail" required="">
                            </div>                                                               
                          <div class="form-group col-md-4">
                               <label for="txtPassword">Password</label>
                               <input type="password" class="form-control" id="txtPassword" name="txtPassword">
                            </div> 
                          </div>  
                          <hr>
                          <p class="text-primary">Datos Fiscales.</span></p>
                          <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Identificación Tributarias <font color="red">*</font></label>
                                <input class="form-control" type="text" id="txtNit" name="txtNit" required="">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Nombre Fiscal <font color="red">*</font></label>
                                <input class="form-control" type="text" id="txtNombreFiscal" name="txtNombreFiscal" required="">
                            </div>

                            <div class="form-group col-md-12">
                                <label>Dirección Fiscal <font color="red">*</font></p></label>
                                <input class="form-control" type="text" id="txtDirFiscal" name="txtDirFiscal" required="">
                            </div>
                          </div>
                          <div class="form-row">                                                   
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

         <!-- Modal ver cliente-->
      <div class="modal fade" id="modalViewCliente" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" >
          <div class="modal-content">
            <div class="modal-header header-primary">
              <h5 class="modal-title" id="titleModal">Datos del cliente</h5>
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
                    <td>Email (Cliente):</td>
                    <td id="celEmail">Larry</td>
                  </tr>
                  <tr>
                    <td>Identificacion Tributaria:</td>
                    <td id="celIde">Larry</td>
                  </tr>
                  <tr>
                    <td>Nombre Fiscal:</td>
                    <td id="celNomFiscal">Larry</td>
                  </tr>
                  <tr>
                    <td>Dirección Fiscal:</td>
                    <td id="celDirFiscal">Larry</td>
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

     <!--Editar cliente Modal -->
      <div class="modal fade" id="modalEditarCliente" tabindex="-1" role="dialog"  aria-hidden="true">
           <div class="modal-dialog modal-lg ">
             <div class="modal-content">
               <div class="modal-header headerUpdate">
                 <h5 class="modal-title" id="titleModal">Actualizar cliente</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               <div class="modal-body">
                 <div class="tile">
                       <form  id="formCliente" name="formCliente" class="form-horizontal" method="post" >
                       <input type="hidden" id="edit_idCliente" name="idCliente" value ="">
                       <p class="text-primary">NOTA "Si no ingresas un nuevo password, continuará con el que ya tiene asignado. "</p>
                       <p class="text-primary"></p>
                          <div class="form-row">
                            <div class="form-group col-md-4">
                               <label class="control-label">Identificación</font></label>
                               <input type="text" class="form-control valid validNumber" id="edit_Identificacion" name="txtIdentificacion" required="">
                            </div>                        
                            <div class="form-group col-md-4">
                               <label class="control-label">Nombres</label>
                               <input type="text" class="form-control valid validText" id="edit_Nombre" name="txtNombre" required=""maxlength="30">
                            </div>                         
                            <div class="form-group col-md-4">
                               <label for="txtApellido">Apellidos</label>
                               <input type="text" class="form-control valid validText" id="edit_Apellido" name="txtApellido" required="">
                            </div>                          
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-4">
                               <label for="txtTelefono">Teléfono</label>
                               <input type="text" class="form-control valid validNumber" id="edit_Telefono" name="txtTelefono" required="">
                            </div>                          
                            <div class="form-group col-md-4">
                               <label for="txtEmail">Email </label>
                               <input type="text" class="form-control valid validEmail" id="edit_Email" name="txtEmail" required="">
                            </div>                                                               
                          <div class="form-group col-md-4">
                               <label for="txtPassword">Password</label>
                               <input type="password" class="form-control" id="edit_Password" name="txtPassword">
                            </div> 
                          </div>  
                          <hr>
                          <p class="text-primary">Datos Fiscales.</span></p>
                          <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Identificación Tributarias</label>
                                <input class="form-control" type="text" id="edit_Nit" name="txtNit" required="">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Nombre Fiscal </label>
                                <input class="form-control" type="text" id="edit_NombreFiscal" name="txtNombreFiscal" required="">
                            </div>

                            <div class="form-group col-md-12">
                                <label>Dirección Fiscal </p></label>
                                <input class="form-control" type="text" id="edit_DirFiscal" name="txtDirFiscal" required="">
                            </div>
                          </div>
                          <div class="form-row">                                                   
                         <div class="title-footer">
                              <button id="updateCliente" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">
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
  
    </main>


    <!-- Essential


