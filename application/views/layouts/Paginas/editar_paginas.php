<?php 
 for($i=0; $i < count( $infoPage); $i++){
        $option  = $infoPage[$i]->status;
        $fotoActual = $infoPage[$i]->portada;
        $ruta = $infoPage[$i]->ruta;
        $idpost = $infoPage[$i]->idpost;
        $titulo = $infoPage[$i]->titulo;
        $contenido = $infoPage[$i]->contenido;
    }
    $fotoRemove = 0;
    $imgPortada = $fotoActual != "" ? '<img id="img" src="'.base_url()."assets/Template/Admin/images/uploads/".$fotoActual.'">' : "";
    $pageRuta = base_url().''.$ruta;
?>
 <main class="app-content">    
      <div class="app-title">
        <div>
            <h1><i class="fa fa-file-text-o"></i> Actualiza página <small>Tienda Virtual</small>
            <!-- <?php if($_SESSION['permisosMod']->w){ ?>
                <a href="<?= base_url() ?>paginas/crear" class="btn btn-primary" ><i class="fas fa-plus-circle"></i> Crear página</a>
            <?php } ?>  -->

          </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>paginas">Páginas</a> | 
            <a href="<?= $pageRuta ?>" target="_blanck"> <i class="fa fas fa-globe" aria-hidden="true"></i> Ver página</a>
          </li>
        </ul>
      </div>
        <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <form id="formPaginas" name="formPaginas" class="form-horizontal">
                  <input type="hidden" id="idPost" name="idPost" value="<?= $idpost?>">
                  <input type="hidden" id="foto_actual" name="foto_actual" value="<?= $fotoActual ?>">
                  <input type="hidden" id="foto_remove" name="foto_remove" value="<?= $fotoRemove; ?>">

                  <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>
                  <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                          <label class="control-label">Titulo <span class="required">*</span></label>
                          <input class="form-control" id="txtTitulo" name="txtTitulo" type="text" value="<?= $titulo ?>" required="">
                        </div>
                        <div class="form-group">
                          <label class="control-label">Contenido</label>
                          <textarea class="form-control" id="txtContenido" name="txtContenido" >
                            <?= $contenido ?>
                          </textarea>
                        </div>
                        
                    </div>
                    <div class="col-md-2">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="listStatus">Estado <span class="required">*</span></label>
                                <select class="form-control selectpicker" id="listStatus" name="listStatus" required="">
                                  <option value="1">Activo</option>
                                  <option value="2">Inactivo</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                           <div class="form-group col-md-12">
                               <button id="btnActionForm" class="btn btn-primary btn-lg btn-block" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>
                           </div> 
                        </div>  
                    </div>
                  </div>
                  
                  <div class="tile-footer">
                     <div class="form-group col-md-12">
                         <div id="containerGallery">
                             <h4>Portada</h4>
                             <span>Tamaño sugerido (1920px X 239px)</span>
                         </div>
                         <hr>
                         <div id="containerImages">
                             <div class="photo">
                                <div class="prevPhoto prevPortada">
                                  <span class="delPhoto notBlock">X</span>
                                  <label for="foto"></label>
                                  <div>
                                      <!-- <?= $imgPortada ?> -->
                                  </div>
                                </div>
                                <div class="upimg">
                                  <input type="file" name="foto" id="foto">
                                </div>
                                <div id="form_alert"></div>
                            </div>
                         </div>
                     </div>
                                    
                  </div>
                </form>
              </div>
            </div>
        </div>
    </main>

<script>
  document.querySelector("#listStatus").value = <?= $option; ?> 
</script>
    