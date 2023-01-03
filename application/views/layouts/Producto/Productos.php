<div id="contectAjax"></div>
<main class="app-content">

    <?php                        
           $r = ($_SESSION['permisosMod']->r);
           $u = ($_SESSION['permisosMod']->u);
           $d = ($_SESSION['permisosMod']->d);  
           $this->load->model("Helpers");   
                
         ?>
    <div class="app-title">
        <div>
            <h1><i class="fas fa-box"></i> Productos <small>Tienda Virtual</small>
                <?php  if(($_SESSION['permisosMod']->w)){ ?>
                <button class="btn btn-primary" type="button" onclick="openModalProductos();" data-toggle="modal" class="fa-solid fa-circle-plus">Nuevo</button>  
                <?php }  ?>
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>dashboard/categorias">Ir a categorías <small>Tienda Virtual</small></a></li>
        </ul>
    </div>

    <div class="modal-body">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tableProductos">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Código</th>
                                    <th>Nombre</th>                                                                                            
                                    <th>Stock</th> 
                                    <th>Precio</th>    
                                    <th>USD</th>                               
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- recorremos la tabla rol y traemos los datos -->
                               <?php
                         foreach($producto as $p)
                         {
                          $statu = $p->status;
                          $id = $p->categoriaid;
                          $precio =  $this->Helpers->formatMoney($p->precio);  
                          $preciofinal = $this->Helpers->Money().' '.$precio ;  
                          $USD =  CURRENCY.formatMoney($p->USD);   
                          if($p->status == 1)
                            {  
                                            
                              echo '
                                <tr>
                                 
                                  <td>'.$p->idproducto.'</dt>
                                  <td>'.$p->codigo.'</dt>
                                  <td>'.$p->nombre.'</dt>
                                  <td>'.$p->stock.'</dt>    
                                  <td>'.$preciofinal.'</dt>  
                                  <td>'.$USD.'</dt>                                                                                      
                                  <td>'.$p->statu ='<span class="badge badge-success">Activo</span>'.'</dt> 
                                  <td>'.$p->opcion ='<div class="text-center"> '  ; ?>       
                               
                               <?php if($_SESSION['permisosMod']->r){  ?>    
                                      <?php  echo '<button class="btn btn-info btn-sm btnVerProducto"  rl="'.$p->idproducto.'"  title="Ver producto"><i class="far fa-eye"></i></button>
                                  '; 
                               }?>     
                                <?php if($_SESSION['permisosMod']->u){  ?>                         
                                    <?php  echo '<button class="btn btn-primary btn-sm btn btnEditProducto" rl="'.$p->idproducto.'"  title="Editar producto"><i class="fas fa-pencil-alt"></i></button>
                                   ';
                                  } ?>
                              
                                  <?php if($_SESSION['permisosMod']->d){  ?> 
                                      <?php  echo '<button class="btn btn-danger btn-sm  btnDelProducto" rl="'.$p->idproducto.'" title="Eliminar producto"><i class="far fa-trash-alt"></i></button></div>'.'</td>

                                  '; 
                                   ?>
                                  <?php } ?>
                               </tr>
                                         
                     <?php  }
                         else
                            {
                              echo '
                              <tr>
                                <td>'.$p->idproducto.'</dt>
                                <td>'.$p->codigo.'</dt>
                                <td>'.$p->nombre.'</dt>
                                <td>'.$p->stock.'</dt>  
                                <td>'.$preciofinal.'</dt>   
                                <td>'.$USD.'</dt>                                                                                     
                                <td>'.$p->statu ='<span class="badge badge-danger">Inactivo</span>'.'</dt>
                                <td>'.$p->opcion ='<div class="text-center"> '; ?> 
                             
                                   <?php if($_SESSION['permisosMod']->r){  ?> 
                                      <?php  echo '<button class="btn btn-info btn-sm btnVerProducto"  rl="'.$p->idproducto.'"   title="Ver producto"><i class="far fa-eye"></i></button>
                                  '; 
                                   }?>   
                                     <?php if($_SESSION['permisosMod']->u){  ?>                          
                                    <?php  echo '<button class="btn btn-primary btn-sm btn btnEditProducto" rl="'.$p->idproducto.'"  title="Editar producto"><i class="fas fa-pencil-alt"></i></button>
                                   ';
                                     }?>                              
                                  <?php if($_SESSION['permisosMod']->d){  ?> 
                                      <?php  echo '<button class="btn btn-danger btn-sm  btnDelProducto" rl="'.$p->idproducto.'" title="Eliminar producto"><i class="far fa-trash-alt"></i></button></div>'.'</td>
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

   
    <!-- Modal guardar y Editar-->
 <div class="modal fade" id="modalFormProductos" tabindex="-1"  role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-xl" >
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Prducto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div id="divLoading" >
          <div>
            <img src="<?php echo base_url(); ?>assets/Template/Admin/images/loading.svg" alt="Loading">
          </div>
        </div>
            <form id="formProducto" name="formProducto" class="form-horizontal">
              <input type="hidden" id="idProducto" name="idProducto" value="">             
              <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>
              <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                      <label class="control-label">Nombre Producto(<font color="red">*</font>)</label>
                      <input class="form-control" id="txtNombre" name="txtNombre" type="text"  required="">
                    </div>
                    <div class="form-group">
                      <label class="control-label">Descripción Producto </label>
                      <textarea class="form-control" id="txtDescripcionC" id="txtDescripcion" name="txtDescripcion" rows="4"></textarea>
                    </div>                    
                </div>
                <div class="col-md-4">  
                <div class="form-group"> 
                    <label class="control-label">Código  (<font color="red">*</font>)</label>
                    <input class="form-control valid validNumber" id="txtCodigo" name="txtCodigo" type="text" placeholder="Código de barra" require="">
                    <br>
                    <div id="divBarcode" class="notblock textcenter">
                        <div id="printCode">
                          <svg id="barcode"></svg>
                        </div>
                        <button class="btn btn-success btn-sm" type="button" onClick="printBarcode('#printCode')"><i class="fas fa-print"> Imprimir</i></button></button>
                    </div>
                </div>   
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="control-label">Precio  (<font color="red">*</font>)</label>
                        <input class="form-control valid validNumber" id="txtPrecio" name="txtPrecio" type="text"   placeholder="Precio" require="">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">Stock  (<font color="red">*</font>)</label>
                        <input class="form-control valid validNumber" id="txtStock" name="txtStock" type="text"  placeholder="Cantidad" require="">
                    </div>                    
                </div>  
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listCategoria" class="control-label">Categoría  (<font color="red">*</font>)</label>
                        <select class="form-control selectpicker " id="listCategoria" name="listCategoria" require="">
                        <option selected="selected">Seleccionar..</option>
                              <?php foreach($categoria as $p):  ?>                                            
                                                <option value="<?= $p->idcategoria ?>"><?= $p->nombre?>
                                            </option>
                                <?php endforeach ?>   
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleSelect1">Estado (<font color="red">*</font>)</label> 
                        <select class="form-control selectpicker" id="listStatus" name="listStatus" required="">
                        <option selected="selected">Seleccionar..</option>
                          <option value="1">Activo</option>
                          <option value="2">Inactivo</option>
                        </select> 
                    </div>                    
                </div>  
                <div class="row">
                    <div class="form-group col-md-6">
                        <p class="control-label"><font color="red">Es necesario que ingreses el varlor de "1-USD" para que se haga la conversíon y evitar errores, agregue así "4729.76".</font> </p>
                       
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">USD  (<font color="red">*</font>)</label>
                        <input  class="form-control" id="USD" name="USD" type="text"  placeholder="4729,76" require="">
                    </div>                    
                </div>  
                <div class="row">
                <div class="form-group col-md-6">                
                    <button id="btnActionForm" class="btn btn-primary btn-lg btn-block" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;

                </div>  
                <div class="form-group col-md-6">
               <button  onclick="btnActionCancelar();" class="btn btn-danger btn-lg btn-block " type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>     
                </div>  
                </div>
              </div>           
              
              <div class="tile-footer">
                <div class="form-group col-md-12">
                  <div id="containerGallery">
                    <span>Agregar foto (440 x 545)</span>
                    <button class="btnAddImage btn btn-info btn-sm" type="button">
                      <i class="fas fa-plus"></i>
                    </button>
                  </div>
                  <hr>
                  <div id="containerImages">
                    <!--  <div id="div24">
                      <div class="prevImage">
                        <img src="<?php echo base_url(); ?>/assets/Template/Admin/images/uploads/producto1.jpg">
                      </div>
                      <input type="file" name="foto" id="img1" class="inputUploadfile">
                      <label for="img1" class="btnUploadfile"><i class="fas fa-upload"></i></label>
                      <button class="btnDeleteImage" type="button" onclick="DelItem('div24')"><i class="fas fa-trash-alt"></i></button>

                    </div>                -->
                    <!-- <div id="div24">
                      <div class="prevImage">                  
                         <img  class="loading" src="<?php echo base_url(); ?>assets/Template/Admin/images/loading.svg">
                      </div>
                      <input type="file" name="foto" id="img1" class="inputUploadfile">
                      <label for="img1" class="btnUploadfile"><i class="fas fa-upload"></i></label>
                      <button class="btnDeleteImage" type="button" onclick="DelItem('div24')"><i class="fas fa-trash-alt"></i></button>

                    </div>  -->

                  </div>
								</div>
							</div>
		
             </div>
         </div>
      </form>
      </div>
    </div>
  </div>
 <!-- Modal ver producto-->
 <div class="modal fade" id="modalViewProductos" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" >
      <div class="modal-content">
        <div class="modal-header header-primary">
          <h5 class="modal-title" id="titleModal">Datos del producto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table table-bordered">
            <tbody>
              <tr>
                <td>Código:</td>
                <td id="celCodigo">65459658265</td>
              </tr>
              <tr>
                <td>Nombres:</td>
                <td id="celNombre"></td>
              </tr>
              <tr>
                <td>Precio:</td>
                <td id="celPrecio"></td>
              </tr>
              <tr>
                <td>Stock:</td>
                <td id="celStock"></td>
              </tr>
              <tr>
                <td>Categoría:</td>
                <td id="celCategoria"></td>
              </tr>
              <tr>
                <td>Status:</td>
                <td id="celStatus"></td>
              </tr>
              <tr>
                <td>Descripción:</td>
                <td id="celDescripcion"></td>
              </tr>
              <tr >
                <td>Foto de referencia:</td>
                <td id="celFotos"></td>
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
