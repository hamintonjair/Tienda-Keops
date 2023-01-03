    <main class="app-content">
      <div class="app-title">
         <div>

            <h1><i class="fa fa fa-dashboard"></i> Dashboard <small>Tienda Virtual</small></h1>
      
          </div>
          <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>dashboard">Dashboard</a></li>
          </ul>
      </div>
      <div class="row">
        <?php if(!empty($_SESSION['permisos'][2]->r)){ ?>
        <div class="col-md-6 col-lg-3">
          <a href="<?= base_url() ?>dashboard/usuarios" class="linkw">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
              <div class="info">
                <h4>Usuarios</h4>
                <p><b><?= $usuarios ?></b></p>
              </div>
            </div>
          </a>
        </div>
        <?php } ?>
        <?php if(!empty($_SESSION['permisos'][3]->r)){ ?>
        <div class="col-md-6 col-lg-3">
          <a href="<?= base_url() ?>dashboard/clientes" class="linkw">
            <div class="widget-small info coloured-icon"><i class="icon fa fa-user fa-3x"></i>
              <div class="info">
                <h4>Clientes</h4>
                <p><b><?= $clientes ?></b></p>
              </div>
            </div>
          </a>
        </div>
        <?php } ?>
        <?php if(!empty($_SESSION['permisos'][4]->r) ){ ?>
        <div class="col-md-6 col-lg-3">
          <a href="<?= base_url() ?>productos" class="linkw">
            <div class="widget-small warning coloured-icon"><i class="icon fa fa fa-archive fa-3x"></i>
              <div class="info">
                <h4>Productos</h4>
                <p><b><?= $productos ?></b></p>
              </div>
            </div>
          </a>
        </div>
        <?php } ?>
        <?php if(!empty($_SESSION['permisos'][5]->r)){ ?>
        <div class="col-md-6 col-lg-3">
          <a href="<?= base_url() ?>pedidos" class="linkw">
            <div class="widget-small danger coloured-icon"><i class="icon fa fa-shopping-cart fa-3x"></i>
              <div class="info">
                <h4>Pedidos</h4>
                <p><b><?= $pedidos ?></b></p>
              </div>
            </div>
          </a>
        </div>
        <?php } ?>
      </div>
       <div class="row">
        <?php if(!empty($_SESSION['permisos'][5]->r)){ ?>
        <div class="col-md-6"> 
          <div class="tile">
            <h3 class="tile-title">Últimos Pedidos</h3>
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Cliente</th>
                  <th>Estado</th>
                  <th class="text-right">Monto</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php 
                    if(count($lastOrders) > 0 ){
                      foreach ($lastOrders as $pedido) {
                 ?>
                <tr>
                  <td><?= $pedido->idpedido ?></td>
                  <td><?= $pedido->nombre ?></td>
                  <td><?= $pedido->status ?></td>
                  <td class="text-right"><?= SMONEY." ".formatMoney($pedido->monto) ?></td>
                  <td><a href="<?= base_url() ?>pedidos/orden/<?= $pedido->idpedido ?>" ><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                </tr>
                <?php } 
                  } ?>

              </tbody>
            </table>
          </div>
        </div>
        <?php } ?>

        <div class="col-md-6">
          <div class="tile">
            <div class="container-title">
              <h3 class="tile-title">Tipo de pagos por mes</h3>
              <div class="dflex">             
                <input class="date-picker pagoMes" name="pagoMes" placeholder="Mes y Año">
                <button type="button" class="btnTipoVentaMes btn btn-info btn-sm" onclick="fntSearchPagos()"> <i class="fas fa-search"></i> </button>
                <label for="">Seleccione el mes y año &nbsp;</label>       
              </div>
            </div>
            <div id="pagosMesAnio"></div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="container-title">
              <h3 class="tile-title">Ventas por mes</h3>
              <div class="dflex">
              <label for="">Seleccione el mes y año &nbsp;</label>       
                <input class="date-picker ventasMes" name="ventasMes" placeholder="Mes y Año">
                <button type="button" class="btnVentasMes btn btn-info btn-sm" onclick="fntSearchVMes()"> <i class="fas fa-search"></i> </button>
              </div>
            </div>
            <div id="graficaMes"></div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="tile">
            <div class="container-title">
              <h3 class="tile-title">Ventas por año</h3>
              <div class="dflex">
              <label for="">Escriba el año &nbsp;</label>       
                <input class="ventasAnio" name="ventasAnio" placeholder="Año" minlength="4" maxlength="4" onkeypress="return controlTag(event);">
                <button type="button" class="btnVentasAnio btn btn-info btn-sm" onclick="fntSearchVAnio()"> <i class="fas fa-search"></i> </button>
              </div>
            </div>
            <div id="graficaAnio"></div>
          </div>
        </div>
      </div> 

    </main>

    