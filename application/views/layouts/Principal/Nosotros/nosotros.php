<?php 

$this->load->model('Helpers');
for($i=0; $i < count( $nosotros); $i++){
    $banner = $nosotros[$i]->portada;
    $idpagina = $nosotros[$i]->idpost;
    $titulo = $nosotros[$i]->titulo;
    $contenido = $nosotros[$i]->contenido;
}
; ?>
<script>
     	document.querySelector('header').classList.add('header-v4');
</script>

<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url(<?= $banner ?>);">
	<h2 class="ltext-105 cl0 txt-center">
		<?= $titulo ?>
	</h2>
</section>
<!-- Content page -->
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
 <?php }; ?>	
<hr>
 <section class="bg0 p-t-20 p-b-140">
	<div class="container">		 
	<div class="flex-w flex-sb-m p-b-52">
	    	
		<div class="container">			
		
			<div class="row isotope-grid">
			<?php 
			if(!empty($productos)){
				for ($p=0; $p < count($productos) ; $p++) {			
			
						$portada = $productos[$p]->url_image;				
					
			  ?>
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-pic hov-img0">
							<img src="<?= $portada ?>"  height="300" >	
							<p><h4><?= $productos[$p]->descripcion ?></h4></p>						
						</div>				
					</div>
				</div>
			<?php }
		}else{
			?>
			<p class="text-center">No hay Imágenes para mostrar</p>
		  <?php } ?>

		   </div>

		   <!-- Load more -->
		   <?php 		     
			
			   if(!empty($pagina['pagina'])){
				   $prevPagina = $pagina['pagina'] - 1;
				   $nextPagina = $pagina['pagina'] + 1;				  
			?>
		   <div class="flex-c-m flex-w w-full p-t-45">
		   <?php if($pagina['pagina'] > 1){ ?>
					<a href="<?= base_url() ?>nosotros/mas/<?= $prevPagina?>" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04"> <i class="fa fa-chevron-left" aria-hidden="true"></i> &nbsp; Anterior </a>&nbsp;&nbsp;
				<?php } ?>
				<?php ; if($pagina['pagina'] != $pagina['total_paginas']){ ?>			
					<a href="<?= base_url() ?>nosotros/mas/<?= $nextPagina ?>" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04"> Siguiente &nbsp; <i class="fa fa-chevron-right" aria-hidden="true"></i> </a>
				<?php } ?>
		   </div>
		   <?php 
			   }
			?>
	   </div>
	<div class="container text-center p-t-80">					
	</div>
</section>