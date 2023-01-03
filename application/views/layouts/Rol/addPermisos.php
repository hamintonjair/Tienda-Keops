<!--Add permisos-->
    <main class="app-content" >
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Permisos de Roles <small>Tienda Virtual</small></h1> 
              
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>roles">Ir a roles</a></li>
          </ul>
      </div>
      <div class="row">
        <div  class="col-md-4 " >
          <div class="tile">
                        <form id="AddPermisos" name="AddPermisos"  action="" method="POST">          
                                    <div class="form-group" >
                                        <label for="rol"> <h5>Asignar Nuevo permisos</h5></label>
                                        <select name="rol" id="rol" class="form-control">
                                            <?php foreach($rol as $roles):  ?>                                            
                                                <option value="<?= $roles->idrol ?>"><?= $roles->nombrerol?>
                                            </option>
                                            <?php endforeach ?>                                   
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="modulo">Módulos:</label>
                                        <select name="modulo" id="modulo" class="form-control">
                                            <?php foreach($modulo as $modulos): ?>
                                                <option value="<?=  $modulos->idmodulo ?>"><?=  $modulos->titulo ?>
                                            </option>
                                            <?php endforeach; ?>                                   
                                        </select>
                                    </div>
                                 <div class="form-group">  

                                 <label>Ver</label><label for="Escribir" class="Escribir"></label>
                                    <label class="radio-inline">
                                       <input type="radio" id="re"  name="r" value="1" checked="checked">Si
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" id="re"  name="r" value="0" checked="checked">No 
                                    </label>                                      
                                </div>                          

                                <div class="form-group">
                                <label>Crear</label><label for="Escribir" class="Escribir"></label>
                                    <label class="radio-inline">
                                       <input type="radio" id="we"  name="w" value="1"checked="checked">Si   
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" id="we"  name="w" value="0" checked="checked">No
                                    </label>                                      
                                </div>
                                <div class="form-group">
                                <label>Actualizar</label><label for="Editar" class="Editar"></label>
                                    <label class="radio-inline">
                                       <input type="radio" id="ue"  name="u" value="1" checked="checked">Si       
                                    </label>
                                    <label class="radio-inline">
                                      <input type="radio" id="ue"  name="u" value="0" checked="checked">No
                                    </label>                                      
                                </div>
                                <div class="form-group">
                                <label>Eliminar</label><label for="Eliminar" class="Eliminar"></label>
                                    <label class="radio-inline">
                                        <input type="radio" id="de"  name="d" value="1" checked="checked">Si       
                                    </label>
                                    <label class="radio-inline">
                                      <input type="radio" id="de"  name="d" value="0" checked="checked">No     
                                    </label>                                      
                                </div>
                          
                                  <div class="text-center">
                                        <h6>
                                            Asignarás nuevos permiso a los Roles de Usuarios que aún no tengan,
                                            podrás escoger el Rol y luego el módulo al que quiere darle permisos, y por último
                                            marca los tipos de  permisos que le asignarás. 
                                        </h6>
                                  </div>                               
                                 <br>                             
                                  <div  class="text-center" class="form-group" >
                                      <button type="submit" class="btn btn-success"><span class="fa fa-fw fa-la fa-check-circle"
                                       aria-hidden="true"></span>Guardar Permisos</button>                                                                        
                                 </div>                     
                              
                  </form> 
            </div>
        </div>

<!--Buscar permisos-->
        <div  class="col-md-4 " >
          <div class="tile">  
             <div class="table-responsive">
                        <form id="" action="<?php echo base_url(); ?>permisos/BuscarPermisos"   method="POST">          
                                    <div class="form-group" >
                                        <label for="rol"> <h5>Buscar permisos</h5></label>
                                        <select name="rol" id="rol" class="form-control">
                                            <?php foreach($rol as $roles):  ?>                                            
                                                <option value="<?= $roles->idrol ?>"><?= $roles->nombrerol?>
                                            </option>
                                            <?php endforeach ?>                                   
                                        </select>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label for="modulo">Módulos:</label>
                                        <select name="modulo" id="modulo" class="form-control">
                                            <?php foreach($modulo as $modulos): ?>
                                                <option value="<?=  $modulos->idmodulo ?>"><?=  $modulos->titulo ?>
                                            </option>
                                            <?php endforeach; ?>                                   
                                        </select>
                                    </div>  
                                    <br>
                                    <div class="text-center">
                                        <h6>
                                            Buscarás los permisos de acuerdo al rol escogido. 
                                        </h6>                                  
                                    </div> 
                                    <br>
                                     <div class="text-center"  class="form-group">                                                                                                         
                                        <button class="btn btn-success">
                                            <span class="fa fa-fw fa-la fa-check-circle"aria-hidden="true"></span>Buscar Permisos
                                        </button>                                                                                                                                                    
                                    </div>      
                                    <br>
                                    <br>  
                                    <div class="form-group">
                                         <table class="table table-hover table-bordered" id="tableRole">
                                    <thead>
                                                <tr>
                                                <th>Ver</th>
                                                <th>Crear</th>
                                                <th>Actualizar</th>   
                                                <th>Eliminar</th>                               
                                                </tr>
                                            </thead>
                                            <tbody>                     
                                            <?php if(!empty($permisos)): ?>
                                                <?php foreach($permisos as $p): ?>                                               
                                                <tr>                                                                                             
                                                    <td>
                                                            <?php if($p->r == 0 ): ?>
                                                                <span class="btn-danger">No</span>
                                                            <?php else: ?>
                                                                <span class=" btn-success">Si</span>
                                                            <?php endif; ?>   
                                                    </td>   
                                                    <td> 
                                                            <?php if($p->w == 0):  ?>
                                                                <span class="btn-danger">No</span>
                                                            <?php else: ?>
                                                                <span class=" btn-success">Si</span>
                                                            <?php endif; ?>
                                                    </td>                                                                                             
                                                    <td> 
                                                            <?php if($p->u == 0):  ?>
                                                                <span class="btn-danger">No</span>
                                                                
                                                            <?php else: ?>
                                                                <span class=" btn-success">Si</span>
                                                            <?php endif; ?>
                                                    </td>                                   
                                                                                    
                                                    <td> 
                                                        <?php if($p->d == 0): ?>
                                                                <span class="btn-danger">No</span>
                                                            <?php else: ?>
                                                                <span class=" btn-success">Si</span>
                                                            <?php endif; ?>
                                                    </td>                                                                                          
                                                </tr>                                           
                                       
                                            <?php if($p->r == 1 || $p->w == 1 || $p->u == 1 || $p->d == 1): ?>
                                                            <h5>Rol: <?= $p->roles?></h5>  
                                                            <h5> Modulo: Puedes acceder a <?= $p->modulos?> </h5> 
                                                          <?php else: ?> 
                                                            <h5>Rol: <?= $p->roles?></h5>  
                                                            <h5> Modulo: No Puedes acceder a <?= $p->modulos?></h5>
                                                         <?php endif; ?>    
                                                   <?php endforeach ?>   
                                              <?php endif;?>           
                                        </tbody>
                                    </table>    
                                  
                                    </div>
                     </form> 
              </div>
             </div>
        </div>

     <!-- mostrar permisos del modulo escogidos-->                       

<!-- Actualizacion permisos-->
<br>
    <div  class="col-md-4 " >
          <div class="tile">
                      <form name="ActualizarPermisos" action=""  method="POST">             
                                    <div class="form-group" >
                                        <label for="idrol"> <h5>Actualizar Permisos</h5></label>
                                        <select name="idrol" id="idrol" class="form-control">
                                            <?php foreach($rol as $roles):  ?>                                            
                                                <option value="<?= $roles->idrol ?>"><?= $roles->nombrerol?>
                                            </option>
                                            <?php endforeach ?>                                   
                                        </select>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label for="idmodulo">Módulos:</label>
                                        <select  name="idmodulo" id="idmodulo"  class="form-control">
                                            <?php foreach($modulo as $modulos): ?>
                                                <option value="<?=  $modulos->idmodulo ?>"><?=  $modulos->titulo ?>
                                            </option>
                                            <?php endforeach; ?>                                   
                                        </select>
                                    </div>                                             
                                 
                                <div class="form-group">
                                <label>Ver</label><label for="Escribir" class="Escribir"></label>
                                    <label class="radio-inline">
                                       <input type="radio" id="rea"  name="r" value="1" checked="checked">Si
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" id="rea"  name="r" value="0" checked="checked">No 
                                    </label>                                      
                                </div>                          

                                <div class="form-group">
                                <label>Crear</label><label for="Escribir" class="Escribir"></label>
                                    <label class="radio-inline">
                                       <input type="radio" id="wea"  name="w" value="1"checked="checked">Si   
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" id="wea"  name="w" value="0" checked="checked">No
                                    </label>                                      
                                </div>
                                <div class="form-group">
                                <label>Actualizar</label><label for="Editar" class="Editar"></label>
                                    <label class="radio-inline">
                                       <input type="radio" id="uea"  name="u" value="1" checked="checked">Si       
                                    </label>
                                    <label class="radio-inline">
                                      <input type="radio" id="uea"  name="u" value="0" checked="checked">No
                                    </label>                                      
                                </div>
                                <div class="form-group">
                                <label>Eliminar</label><label for="Eliminar" class="Eliminar"></label>
                                    <label class="radio-inline">
                                        <input type="radio" id="dea"  name="d" value="1" checked="checked">Si       
                                    </label>
                                    <label class="radio-inline">
                                      <input type="radio" id="dea"  name="d" value="0" checked="checked">No     
                                    </label>                                      
                                </div>
                                 
                                <br>
                                <div class="text-center">
                                        <h6>
                                            Actualizarás los permisos de acceso y acciones que tendrá el rol en los módulos.
                                            Debes tener cuidado al realizar cualquier mododificación.  
                                        </h6>
                                </div>
                           
                                <br>
                                  <div class="text-center"  class="form-group" >                                                                                                         
                                      <button id="ActualizarPermisos" type="submit" class="btn btn-success"><span class="fa fa-fw fa-la fa-check-circle"
                                       aria-hidden="true"></span>Actualizar permisos</button>                                                                                                                                                     
                                </div>                               
                     </form> 
            </div>

        </div>
      
    </div>            
  
</main>
  
    <!-- <div id="contectAjax"></div> -->
