

  <main class="app-content">  
  <?php                           
         
         $idrol = $_SESSION['idUser'];          
         $idpersona = $_SESSION['userData']->idpersona;
    
       ?>   
      <div class="app-title">
        <div>
        <h1><i class="fas fa-user-tag"></i> Suscriptores <small>Tienda Virtual</small>
          
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>dashboard"></i> Dashboard <small>Tienda Virtual</small></a></li>
        </ul>
       
      </div>
        <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tableSuscriptores">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nombre</th>
                          <th>Email</th>
                          <th>Fecha</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php  if($_SESSION['permisosMod']->r){ ?>  
                       <?php
                         foreach($suscriptores as $s)
                         {                              
                              echo '
                                <tr>
                                  <td>'.$s->idsuscripcion.'</dt>  
                                  <td>'.$s->nombre.'</dt>                    
                                  <td>'.$s->email.'</dt>
                                  <td>'.$s->fecha.'</dt>                               
                                                                                                
                                  '; ?>   
                                                                                               
                               
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
    </main>

    