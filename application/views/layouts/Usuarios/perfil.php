
    <main class="app-content">
      <div class="row user">
        <div class="col-md-12">
          <div class="profile">
            <div class="info"><img class="user-img" src="<?php echo base_url(); ?>assets/Template/Admin/images/admin.png">         
              <h4><?= $_SESSION['userData']->nombres. ' ' .$_SESSION['userData']->apellidos;?></h4>
              <p><?= $_SESSION['userData']->nombrerol;?></p>
            </div>
            <div class="cover-image"></div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="tile p-0">
            <ul class="nav flex-column nav-tabs user-tabs">
              <li class="nav-item"><a class="nav-link active" href="#user-timeline" data-toggle="tab">Datos personales</a></li>
              <li class="nav-item"><a class="nav-link" href="#user-settings" data-toggle="tab">Datos fiscales</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-9">
          <div class="tab-content">
            <div class="tab-pane active" id="user-timeline">
              <div class="timeline-post">
                <div class="post-media">
                  <div class="content">
                    <h5>DATOS PERSONALES <button class="btn btn-sm btn-info" type="button" onclick="openModalPerfil();"><i class="fas fa-pencil-alt" arial-hidden="true"></i></button></h5>                
                  </div>
                </div>
                <table class="table table-bordered">
                    <body>
                        <tr>
                            <td style="width:150px;">Identificación:</td>
                            <td><?= $_SESSION['userData']->identificacion;?></td>
                        </tr>
                        <tr>
                            <td>Nombres:</td>
                            <td><?= $_SESSION['userData']->nombres;?></td>
                        </tr>
                        <tr>
                            <td>Apellidos:</td>
                            <td><?= $_SESSION['userData']->apellidos;?></td>
                        </tr>
                        <tr>
                            <td>Teléfono:</td>
                            <td><?= $_SESSION['userData']->telefono;?></td>
                        </tr>
                        <tr>
                            <td>Email (Usuario):</td>
                            <td><?= $_SESSION['userData']->email_user;?></td>
                        </tr>                        
                    </body>

                </table>
              </div>
            </div>
            <div class="tab-pane fade" id="user-settings">
              <div class="tile user-settings">
                <h4 class="line-head">Datos fiscales</h4>
                <form id="formDataFiscal" name="formDataFiscal">
                  <div class="row mb-4">
                    <div class="col-md-6">
                      <label>Identificación Tributaria</label>
                      <input class="form-control" type="text" id="txtNit" name="txtNit" value="<?= $_SESSION['userData']->nit;?>">
                    </div>
                    <div class="col-md-6">
                      <label>Nombre fiscal</label>
                      <input class="form-control" type="text" id="txtNombreFiscal" name="txtNombreFiscal" value="<?= $_SESSION['userData']->nombrefiscal;?>">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 mb-6">
                      <label>Dirección fiscal</label>
                      <input class="form-control" type="text" id="txtDireccionFiscal" name="txtDireccionFiscal" value="<?= $_SESSION['userData']->direccionfiscal;?>">
                    </div>                    
                  </div>
                  <div class="row mb-10">
                    <div class="col-md-12">
                      <button id="formFiscal" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Guardar</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>

          </div>
        </div>
      </div>

              <!-- Modal update perfil -->
              <div class="modal fade" id="modalFormPerfil" tabindex="-1" role="dialog"  aria-hidden="true">
           <div class="modal-dialog modal-lg ">
             <div class="modal-content">
               <div class="modal-header headerRegister">
                 <h5 class="modal-title" id="titleModal">Actualizar Datos</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>

               <div class="modal-body">
                 <div class="tile">
                       <form id="formPerfil" name="formPerfil" class="form-horizontal" >                     
                       <p class="text-primary">Los campos con asterisco (<font color="red">*</font>) son obligatorios.</p>
                          <div class="form-row">
                            <div class="form-group col-md-6">
                               <label class="control-label">Identificación <font color="red">*</font></label>
                               <input type="text" class="form-control" id="txtIdentificacion" name="txtIdentificacion" value="<?= $_SESSION['userData']->identificacion;?>" required="">
                            </div>                          
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-6">
                               <label class="control-label">Nombres <font color="red">*</font></label>
                               <input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" type="text" class="form-control valid validText" id="txtNombre" name="txtNombre" value="<?= $_SESSION['userData']->nombres;?>" required=""maxlength="30">
                            </div>                         
                            <div class="form-group col-md-6">
                               <label for="txtApellido">Apellidos <font color="red">*</font></label>
                               <input type="text" class="form-control valid validText" id="txtApellido" name="txtApellido" value="<?= $_SESSION['userData']->apellidos;?>" required="">
                            </div>                          
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-6">
                               <label for="txtTelefono">Teléfono <font color="red">*</font></label>
                               <input type="text" class="form-control valid validNumber" id="txtTelefono" name="txtTelefono" value="<?= $_SESSION['userData']->telefono;?>" required="">
                            </div>                          
                            <div class="form-group col-md-6">
                               <label for="txtEmail">Email</label>
                               <input type="text" class="form-control valid validEmail" id="txtEmail" name="txtEmail" value="<?= $_SESSION['userData']->email_user;?>" required="" readonly disabled>
                            </div>                          
                          </div>                          
                          <div class="form-row">
                            <div class="form-group col-md-6">
                               <label for="txtPassword">Password</label>
                               <input type="password" class="form-control" id="txtPassword" name="txtPassword">
                            </div>                                       
                            <div class="form-group col-md-6">
                               <label for="txtPassword">Confirmar Password</label>
                               <input type="password" class="form-control" id="txtPasswordConfirm" name="txtPasswordConfirm">
                            </div> 
                          </div>                  
                         <div class="title-footer">
                              <button id="btnActionForm" class="btn btn-info" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">
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


    </main>
   