

    <main class="app-content">
      <div class="row user">
        <div class="col-md-12">
          <div class="profile">
            <div class="info"><img class="user-img" src="<?=$url['url_logo']?>">         
              <h4>Logo actual de la empresa</h4>
              
            </div>
            <div class="cover-image"></div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="tile p-0">
            <ul class="nav flex-column nav-tabs user-tabs">
              <li class="nav-item"><a class="nav-link active" href="#user-timeline" data-toggle="tab">Datos de la empresa</a></li>
              <li class="nav-item"><a class="nav-link" href="#user-settings" data-toggle="tab">Datos Paypal</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-9">
          <div class="tab-content">
            <div class="tab-pane active" id="user-timeline">
              <div class="timeline-post">
                <div class="post-media">
                  <div class="content">
                    <h5>DATOS DE LA EMPRESA <button class="btn btn-sm btn-info" type="button" onclick="openModalConfiguracion();"><i class="fas fa-pencil-alt" ></i></button></h5>                               
                  </div>
                </div>
                <div class="table-responsive">
                <table class="table table-bordered">
                    <body>                       
                        <tr>
                            <td>Nombres:</td>
                            <td><?= $empresa['empresa'][0]->empresa;?></td>
                        </tr>
                        <tr>
                            <td>Dirección:</td>
                            <td><?= $empresa['empresa'][0]->direccion;?></td>
                        </tr>
                        <tr>
                            <td>Teléfono:</td>
                            <td><?= $empresa['empresa'][0]->telefono;?></td>
                        </tr>
                        <tr>
                            <td>Whatsapp:</td>
                            <td><?= $empresa['empresa'][0]->whatsapp;?></td>
                        </tr>      
                        <tr>
                            <td>Email (empresa):</td>
                            <td><?= $empresa['empresa'][0]->email_empresa;?></td>
                        </tr>
                        <tr>
                            <td>Email (pedido):</td>
                            <td><?= $empresa['empresa'][0]->email_pedido;?></td>
                        </tr>
                        <tr>
                            <td>Email (suscripción):</td>
                            <td><?= $empresa['empresa'][0]->email_suscripcion;?></td>
                        </tr>
                        <tr>
                            <td>Email (contacto):</td>
                            <td><?= $empresa['empresa'][0]->email_contacto;?></td>
                        </tr>
                        <tr>
                            <td>Email (remitente):</td>
                            <td><?= $empresa['empresa'][0]->email_remitente;?></td>
                        </tr> 
                        <tr>
                            <td>Pagina web:</td>
                            <td><?= $empresa['empresa'][0]->web_empresa;?></td>
                        </tr>
                        <tr>
                            <td>Remitente:</td>
                            <td><?= $empresa['empresa'][0]->remitente;?></td>
                        </tr>
                        <tr>
                            <td>Descripción:</td>
                            <td><?= $empresa['empresa'][0]->descripcion;?></td>
                        </tr>  
                        <tr>
                            <td>Nombre tienda:</td>
                            <td><?= $empresa['empresa'][0]->nombre_tienda;?></td>
                        </tr>
                        <tr>
                            <td>Costo envío USD:</td>
                            <td><?= $empresa['empresa'][0]->costo_evio;?></td>
                        </tr>
                        <tr>
                            <td>Costo envío $:</td>
                            <td><?= $empresa['empresa'][0]->costo_envioP;?></td>
                        </tr>
                        <tr>
                            <td>Facebook:</td>
                            <td><?= $empresa['empresa'][0]->facebook;?></td>
                        </tr>    
                        <tr>
                            <td>Instagram:</td>
                            <td><?= $empresa['empresa'][0]->instagram;?></td>
                        </tr>
                        <tr>
                            <td>Linkedin:</td>
                            <td><?= $empresa['empresa'][0]->linkedin;?></td>
                        </tr>  
                        <tr>
                            <td>Twitter:</td>
                            <td><?= $empresa['empresa'][0]->twitter;?></td>
                        </tr>                            
                    </body>

                </table>
                </div>
              </div>
            </div>
            
            <div class="tab-pane fade" id="user-settings">                                             
                 <div class="timeline-post">
                    <div class="post-media">
                        <div class="content">
                            <h5>DATOS PAYPAL</h5>                
                        </div>
                        </div>
                        <div class="table-responsive">
                        <table class="table table-bordered">
                            <body>
                                <tr>
                                    <td style="width:150px;">Url paypal:</td>
                                    <td><?= $empresa['empresa'][0]->urlpaypal;?></td>
                                </tr>
                                <tr>
                                    <td>Idcliente paypal:</td>
                                    <td><?= $empresa['empresa'][0]->idcliente_paypal;?></td>
                                </tr>
                                <tr>
                                    <td>Secret paypal:</td>
                                    <td><?= $empresa['empresa'][0]->secret_paypal;?></td>
                                </tr>
                                                                
                            </body>
                        </table>
                    </div>            
                </div>  
            </div>
         </div>
      </div>

              <!-- Modal insert -->
      <div class="modal fade" id="modalFormConfiguracion" tabindex="-1" role="dialog"  aria-hidden="true">
           <div class="modal-dialog modal-xl">|
             <div class="modal-content">
               <div class="modal-header headerRegister">
                 <h5 class="modal-title" id="titleModal">Datos de la empresa</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               <div class="modal-body">
                 <div class="tile">
                    <form  id="formConfiguracion" name="formConfiguracion" class="form-horizontal" method="post" >
                       <input type="hidden" id="idConfiguracion" name="idConfiguracion" value ="<?= $empresa['empresa'][0]->id;?>">                     
                       <input type="hidden" id="foto_actual" name="foto_actual" value="<?= $empresa['empresa'][0]->logo;?>">
                       <input type="hidden" id="foto_remove" name="foto_remove" value="1">
                       <p class="text-primary">Los campos con asterisco (<font color="red">*</font>) son obligatorios."</p>
                          <div class="form-row">
                            <div class="form-group col-md-4">
                               <label class="control-label">Nombre (empresa)<font color="red">*</font></label>
                               <input type="text" class="form-control valid validText" id="Nombre" name="Nombre" placeholder="Empresa" value="<?= $empresa['empresa'][0]->empresa;?>"  required="">
                            </div>                                                                     
                            <div class="form-group col-md-4">
                               <label for="txt">Direccion <font color="red">*</font></label>
                               <input type="text" class="form-control  " id="Direccion" name="Direccion"  placeholder="Direccion" value="<?= $empresa['empresa'][0]->direccion;?>"  required="">
                            </div>                                           
                            <div class="form-group col-md-2">
                               <label for="txt">Teléfono <font color="red">*</font></label>
                               <input type="text" class="form-control" id="Telefono" name="Telefono"  valid validText placeholder="+(57)3126843729" maxlength="15"value="<?= $empresa['empresa'][0]->telefono;?>" required="">
                            </div>                          
                            <div class="form-group col-md-2">
                               <label for="txt">Whatsapp <font color="red">*</font></label>
                               <input type="text"  class="form-control" id="Whatsapp" name="Whatsapp" value="<?= $empresa['empresa'][0]->whatsapp;?>" placeholder="+573126843729" maxlength="13" required="">
                            </div> 
                        </div>  
                         <div class="form-row">                                                         
                           <div class="form-group col-md-4">
                            <label for="txt">Email (empresa)(<font color="red">*</font>)</label>
                                <input type="text" class="form-control valid validEmail" id="EmailEmpresa" name="EmailEmpresa" placeholder="E-mail" value="<?= $empresa['empresa'][0]->email_empresa;?>"required="">
                            </div>                         
                            <div class="form-group col-md-4">
                               <label for="txt">Email (pedido) <font color="red">*</font></label>
                               <input type="text" class="form-control valid validEmail" id="EmailPedido" name="EmailPedido" placeholder="E-mail" value="<?= $empresa['empresa'][0]->email_pedido;?>"required="">
                            </div>                          
                            <div class="form-group col-md-4">
                               <label for="txt">Email (suscripcion) <font color="red">*</font></label>
                               <input type="text" class="form-control valid validEmail" id="EmailSucripcion" placeholder="E-mail" name="EmailSucripcion" value="<?= $empresa['empresa'][0]->email_suscripcion;?>"required="">
                            </div>  
                        </div>     
                        <div class="form-row">                                                        
                           <div class="form-group col-md-4">
                            <label for="txt">Email (contacto)(<font color="red">*</font>)</label>
                                <input type="text" class="form-control valid validEmail" id="EmailContacto" name="EmailContacto" placeholder="E-mail" value="<?= $empresa['empresa'][0]->email_contacto;?>"required="">
                            </div>                
                            <div class="form-group col-md-4">
                            <label for="txt">Email (remitente)(<font color="red">*</font>)</label>
                                <input type="text" class="form-control valid validEmail" id="EmailRemitente" placeholder="E-mail" name="EmailRemitente"  value="<?= $empresa['empresa'][0]->email_remitente;?>"required="E-mail">
                            </div> 
                            <div class="form-group col-md-4">
                               <label class="control-label">Página web</label>
                               <input type="text" class="form-control " id="PaginaWeb" name="PaginaWeb" value="<?= $empresa['empresa'][0]->web_empresa;?>"placeholder="www.mipagina.com" maxlength="30">
                            </div>  
                        </div>    
                        <div class="form-row">                 
                            <div class="form-group col-md-4">
                               <label for="txt">Nombre (remitente) <font color="red">*</font></label>
                               <input type="text" class="form-control valid validText" id="Remitente" name="Remitente" placeholder="Tienda virtual" value="<?= $empresa['empresa'][0]->remitente;?>"required="">
                            </div>                                        
                           <div class="form-group col-md-4">
                            <label for="txt">Descripción(<font color="red">*</font>)</label>
                                <input type="text" class="form-control " id="Descripcion" name="Descripcion" placeholder="La mejor tienda en línea" value="<?= $empresa['empresa'][0]->descripcion;?>"required="">
                            </div> 
                            <div class="form-group col-md-4">
                               <label class="control-label">Nombre (tienda) <font color="red">*</font></label>
                               <input type="text" class="form-control valid validText" id="NombreTienda" name="NombreTienda" value="<?= $empresa['empresa'][0]->nombre_tienda;?>" placeholder="TiendaVirtual" maxlength="30">
                            </div> 
                        </div>     
                        <div class="form-row">               
                            <div class="form-group col-md-4">
                               <label for="txt">Costo (envío) EN USD para evitar errores<font color="red">*</font></label>
                               <input type="text" class="form-control valid validNumber" id="CostoEnvio" name="CostoEnvio" placeholder="10" value="<?= $empresa['empresa'][0]->costo_evio;?>"required="">
                            </div>   
                            <div class="form-group col-md-4">
                               <label for="txt">Costo (envío) peso colombianio<font color="red">*</font></label>
                               <input type="text" class="form-control valid validNumber" id="costo_envioP" name="costo_envioP" placeholder="20000" value="<?= $empresa['empresa'][0]->costo_envioP;?>"required="">
                            </div>                          
                          <div class="form-group col-md-4">
                            <label for="txt">Facebook(<font color="red">*</font>)</label>
                                <input type="text" class="form-control " id="Facebook" name="Facebook" placeholder="link perfil"value="<?= $empresa['empresa'][0]->facebook;?>" required="">
                            </div>                            
                        </div>      
                        <div class="form-row">  
                            <div class="form-group col-md-4">
                               <label  for="txt">Instagram</label>
                               <input type="text" class="form-control " id="Instagram" name="Instagram" value="<?= $empresa['empresa'][0]->instagram;?>"placeholder="link perfil">
                            </div>                     
                            <div class="form-group col-md-4">
                               <label for="txt">Linkedin</label>
                               <input type="text" class="form-control " id="Linkedin" name="Linkedin" value="<?= $empresa['empresa'][0]->linkedin;?>" placeholder="link perfil">
                            </div>                                                            
                            <div class="form-group col-md-4">
                               <label for="txt">Twitter</label>
                               <input type="text" class="form-control " id="Twitter" name="Twitter" value="<?= $empresa['empresa'][0]->twitter;?>"placeholder="link perfil">
                            </div>  
                       </div>   
                       <div class="form-row">
                       <div class="form-group col-md-4"> 
                            <input type="hidden" class="form-control" id="Logo" name="Logo" type="text"  value="" >                                                      
                            <div class="photo">
                                <label for="foto2">Logo (133 x 17)</label>
                                <div class="prevPhoto2">
                                <span class="delPhoto notBlock">X</span>
                                <label for="foto2"></label>
                                <div>
                                    <img id="img" src="<?=$url['url_logo']?>">
                                </div>
                                </div>
                                <div class="upimg">
                                <input type="file" name="foto2" id="foto2">
                                </div>
                                <div id="form_alert"></div>
                            </div>
                       </div>                    
                          </div>
                          <hr>
                          <p class="text-primary">Datos Paypal.</span></p>
                          <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Url paypal<font color="red">*</font></label>
                                <input class="form-control" type="text" id="url" name="url"  placeholder="https://api-m.paypal.com" value="<?= $empresa['empresa'][0]->urlpaypal;?>"required="" disabled="">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Idcliente paypal <font color="red">*</font></label>
                                <input class="form-control" type="text" id="idClientePaypal" name="idClientePaypal" placeholder="AbhJ6bOAngL_xCl7s_lq1Z5YqA1N" value="<?= $empresa['empresa'][0]->idcliente_paypal;?>"required="">
                            </div>

                            <div class="form-group col-md-12">
                                <label>Secret paypal <font color="red">*</font></p></label>
                                <input class="form-control" type="text" id="SecretPaypal" name="SecretPaypal" placeholder="ENuoJMfzelQGIBCniQII2gtpd2Yn4Ted"value="<?= $empresa['empresa'][0]->secret_paypal;?>" required="">
                            </div>
                          </div>
                          <div class="form-row">                                                   
                         <div class="title-footer">
                              <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">
                                Guardar</span> </button>&nbsp;&nbsp;&nbsp;

                             <button onclick="btnActionCancela();" class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i><span id="btnText">
                                Cerrar</span> </button>&nbsp;&nbsp;&nbsp;
                          </div>
                       </form>
                        </div>
                   </div>
               </div> 
             </div>
     </div>  


 </main>
   