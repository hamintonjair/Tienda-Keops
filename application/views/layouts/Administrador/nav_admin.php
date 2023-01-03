 <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?= base_url(); ?>assets/Template/Admin/images/admin.png" alt="User Image">
        <div>       
          <p class="app-sidebar__user-name"><?= $_SESSION['userData']->nombres;?></p>
          <p class="app-sidebar__user-designation"><?= $_SESSION['userData']->nombrerol;?></p>
        </div>
       
      </div>
      <ul class="app-menu">
      <?php  if(!empty($_SESSION['permisos'][1]->r)){ ?>
         <li>
          <a class="app-menu__item" href="<?= base_url(); ?>dashboard">
            <i class="app-menu__icon fa fa-dashboard"></i>
            <span class="app-menu__label">Dashboard</span>
          </a>
        </li>
      <?php  };?> 
      <?php  if(!empty($_SESSION['permisos'][2]->r)){ ?>
        <li class="treeview">
          <a class="app-menu__item" href="#" data-toggle="treeview">       
              <i class="app-menu__icon fa fa-users" aria-hidden="true"></i>
              <span class="app-menu__label">Usuarios</span>
              <i class="treeview-indicator fa fa-angle-right"></i>
          </a>  
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="<?= base_url(); ?>dashboard/usuarios"><i class="icon fa fa-circle-o"></i> Usuarios</a></li>
            <li><a class="treeview-item" href="<?= base_url(); ?>roles" > <i class="icon fa fa-circle-o"></i> Rol</a></li>
          </ul>
        </li>
        <?php  };?> 
        <?php if(!empty($_SESSION['permisos'][3]->r)){ ?>
        <li>
            <a class="app-menu__item"href="<?= base_url(); ?>dashboard/clientes"> 
            <i class="app-menu__icon fa fa-user" aria-hidden="true"></i>     
            <span class="app-menu__label"> Clientes</span></a>
        </li>
        <?php  };?>      
        <?php  if(!empty($_SESSION['permisos'][4]->r) || !empty($_SESSION['permisos'][6]->r)){ ?>
          <li class="treeview">
          <a class="app-menu__item" href="#" data-toggle="treeview">       
              <i class="app-menu__icon fa fa-archive" aria-hidden="true"></i>
              <span class="app-menu__label">Tienda</span>
              <i class="treeview-indicator fa fa-angle-right"></i>
          </a>  
          <ul class="treeview-menu">
        <?php  if(!empty($_SESSION['permisos'][4]->r)){?>
            <li><a class="treeview-item" href="<?= base_url(); ?>productos"><i class="icon fa fa-circle-o"></i> Productos</a></li>
        <?php  }; ?> 
        <?php  if(!empty($_SESSION['permisos'][6]->r)){?>
            <li><a class="treeview-item" href="<?= base_url(); ?>dashboard/categorias" > <i class="icon fa fa-circle-o"></i> Categorias</a></li>
        <?php  }; ?> 
          </ul>
        </li>
       <?php  }; ?> 
       <?php  if(!empty($_SESSION['permisos'][5]->r)){ ?>
        <li>
            <a class="app-menu__item"href="<?= base_url(); ?>pedidos">
            <i class="app-menu__icon fa fa-shopping-cart" aria-hidden="true"></i>
            <span class="app-menu__label">Pedidos</span></a>
        </li>   
        <?php  };?>  
        <?php  if(!empty($_SESSION['permisos'][MSUSCRIPTORES]->r)){ ?>
        <li>
            <a class="app-menu__item"href="<?=  base_url(); ?>suscriptores">
            <i class="app-menu__icon fa fa-user-tie" aria-hidden="true"></i>
            <span class="app-menu__label">Suscriptores</span></a>
        </li>   
        <?php  };?>  
        <?php if(!empty($_SESSION['permisos'][MDCONTACTOS]->r)){ ?>
        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>contactos">
                <i class="app-menu__icon fas fa-envelope" aria-hidden="true"></i>
                <span class="app-menu__label">Mensajes</span>
            </a>
        </li>
         <?php } ?>

         <?php if(!empty($_SESSION['permisos'][MDPAGINAS]->r)){ ?>
        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>paginas">
                <i class="app-menu__icon fas fa-file-alt" aria-hidden="true"></i>
                <span class="app-menu__label">Páginas</span>
            </a>
        </li>
         <?php } ?>
         <?php if(!empty($_SESSION['permisos'][MDFOTOS]->r)){ ?>
        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>fotos">
                <i class="app-menu__icon fa fa-file-image-o" aria-hidden="true"></i>
            
                <span class="app-menu__label">Fotos</span>
            </a>
        </li>
         <?php } ?>
          <li>
            <a class="app-menu__item"href="<?= base_url(); ?>" target="_blank">     
            <i class="app-menu__icon fa fa-sign-out" aria-hidden="true" ></i>
            <span class="app-menu__label">Ir a panel cliente</span></a>
         </li>        
      </ul>
    </aside>