
    <!-- <div id="contectAjax"></div> -->
        <main class="app-content">
        <div class="app-title">
          <div>
            <h1><i class="fa-solid fa-user-pen"></i> 
            <?php if(empty($permisos[0]->roles)): ?>    
                El usuario No tiene permisos asignados             
           <?php else: ?>
                Permisos del Usuario  <?=$permisos[0]->roles ?>
           <?php endif; ?>
             <a href="<?php echo base_url(); ?>permisos/PermisosAdd/<?php if(empty($permisos[0]->rolid)): ?>                                                                            
                                                                            <?php else: ?>
                                                                              <?=$permisos[0]->rolid ?>
                                                                            <?php endif; ?>">
            <button class="btn btn-primary" class="fa-solid fa-circle-plus">Agregar/Modificar permisos</button></a> 
                               
            </h1>        
          </div>
          <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>roles">Ir a roles</a></li>
          </ul>
        </div>     

        <div class="modal-body">
     
     <div class="col-md-12">
          <div class="tile">
          <form  action="<?php echo base_url(); ?>permisos/actualizar" method="POST">                                      
          <input type="hidden" name="idpermiso" value="  <?php if(empty($permisos[0]->rolid)): ?> 
                                                              <?php else: ?>
                                                                <?=$permisos[0]->rolid ?>
                                                            <?php endif; ?>  " requiered >           
            <div class="tile-body">          
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tableRoles">
                <thead>
                            <tr>
                              <th>ID</th>
                              <th>Módulo</th>
                              <th>Leer</th>
                              <th>Ver</th>
                              <th>Crear</th>
                              <th>Actualizar</th>                                              
                            </tr>
                          </thead>
                          <tbody>                     
                          <?php if(!empty($permisos)): ?>                         
                              <?php foreach($permisos as $p): ?>                         
                              <tr>
                                  <td> <?=  $p->moduloid ?></td>
                                  <td> <?=  $p->modulos ?></td>                             
                                  <td>
                                        <?php if($p->r == 0): ?>
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
                              <?php endforeach ?>   
                         <?php endif;?>            
                    </tbody>
                </table>
              </div>
            </div>
          </form>
          </div>
       </div>
       </form> 
     </div>
    </div>
 
 </main>