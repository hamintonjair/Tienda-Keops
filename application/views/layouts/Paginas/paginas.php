
  <main class="app-content">    
      <div class="app-title">
        <div>
            <h1><i class="fas fa-user-tag"></i>Páginas <small>Tienda Virtual</small>
            <!-- <?php if($_SESSION['permisosMod']->w){ ?>
                <a href="<?= base_url() ?>paginas/crear" class="btn btn-primary" ><i class="fas fa-plus-circle"></i> Crear página</a>
            <?php } ?>            -->
          </h1> 
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>paginas">Páginas <small>Tienda Virtual</small></a></li>
        </ul>
      </div>
        <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tablePaginas">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Título</th>
                          <th>Fecha</th>
                          <th>Estado</th>
                          <th>Accione</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </main>

    