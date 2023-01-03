         <!-- Modal guardar -->
         <div class="modal fade" id="modalFormAyuda" tabindex="-1" role="dialog"  aria-hidden="true">
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
                       <form  id="formAyuda" name="formAyuda" method="post" >
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