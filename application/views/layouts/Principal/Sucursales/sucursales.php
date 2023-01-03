<?php 
$this->load->model('Helpers');

for($i=0; $i < count( $sucursales); $i++){
  $banner = $sucursales[$i]->portada;
  $idpagina = $sucursales[$i]->idpost;
  $titulo = $sucursales[$i]->titulo;
  $contenido = $sucursales[$i]->contenido;
}
 ?>
<script>
  document.querySelector('header').classList.add('header-v4');
</script>

 <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url(<?= $banner ?>);">
  <h2 class="ltext-105 cl0 txt-center">
    <?= $titulo ?>
  </h2>
</section>

<?php

  if($this->Helpers->viewPage($idpagina)){
   
    echo $contenido;
  }else{
  ?>
<div>
  <div class="container-fluid py-5 text-center" >
  <img src="<?= base_url() ?>assets/Template/Admin/images/construction.png" alt="En construcción">
    <h3>Estamos trabajando para usted.</h3>
  </div>
</div>
<?php 
  }

?>