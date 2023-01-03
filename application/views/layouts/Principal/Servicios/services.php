<section class="bg0 p-t-23 p-b-140">
	<div class="container">
		 
	<div class="flex-w flex-sb-m p-b-52">
			 <div class="flex-w flex-l-m filter-tope-group m-tb-10">
		 <?php  ; ?>            	 
			  <h3>Lo que Ofrecemos</h3>		 
		   <?php 	; ?>		
		 </div>

			 <div class="flex-w flex-c-m m-tb-10">
					<div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
						&nbsp;&nbsp;
						<i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
						<i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
						 Categoría &nbsp;
					</div>
				</div>
				<!-- Filter -->
				<div class="dis-none panel-filter w-full p-t-10">
					<div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
						<div class="filter-col4 p-b-27">
							<div class="mtext-102 cl2 p-b-15">
								Categorías
							</div>

							<div class="flex-w p-t-4 m-r--5">
								<?php 
									if(!empty($categoria)){
										foreach ($categoria as $category) {											
								 ?>
								<a href="<?= base_url() ?>tienda/categoria/<?= $category->idcategoria.'/'.$category->ruta ?>" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
									<?= $category->nombre ?> <span> &nbsp;(<?= $category->cantidad ?>)</span>
								</a>
								<?php 
										}
									}
								 ?>
							</div>
						</div>
					</div>
			</div>
	 </div>
		<div class="container">			
		
			<div class="row isotope-grid">
			<?php 
			if(!empty($productos)){
				for ($p=0; $p < count($productos) ; $p++) {
					$rutaProducto = $productos[$p]->ruta; 
					if(count($productos[$p]->images) > 0 ){
						$portada = $productos[$p]->images[0]->url_image;
					}else{
						$portada = base_url().'assets/Template/Admin/images/uploads/product.png';
					}
					
			  ?>
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-pic hov-img0">
							<img src="<?= $portada ?>"  height="250" alt="<?= $productos[$p]->nombre ?>"  >
							<a href="<?= 'tienda/productosView/'.$productos[$p]->idproducto.'/'.$rutaProducto; ?>" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
								Ver producto
							</a>
						</div>

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<a href="<?= 'tienda/productosView/'.$productos[$p]->idproducto.'/'.$rutaProducto;  ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
									<?= $productos[$p]->nombre ?></a>

								<span class="stext-105 cl3">							
									<?= SMONEY.formatMoney($productos[$p]->precio); echo " -"  ?>
									<?= CURRENCY.formatMoney($productos[$p]->USD); ?>
								</span>
							</div>

							<div class="block2-txt-child2 flex-r p-t-3">
							<a href="#"
								 id="<?= openssl_encrypt($productos[$p]->idproducto,METHODENCRIPT,KEY); ?>"
								 class="btn-addwish-b2 dis-block pos-relative js-addwish-b2 js-addcart-detail
								 icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11
								 ">
									<i class="zmdi zmdi-shopping-cart"></i>
								</a>								
							</div>
						</div>
					</div>
				</div>
			<?php }
		}else{
			?>
			<p class="text-center">No hay productos para mostrar <a href="<?= base_url() ?>tienda"> Ver productos</a></p>
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
					<a href="<?= base_url() ?>tienda/page/<?= $prevPagina ?>" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04"> <i class="fa fa-chevron-left" aria-hidden="true"></i> &nbsp; Anterior </a>&nbsp;&nbsp;
				<?php } ?>
				<?php if($pagina['pagina'] != $pagina['total_paginas']){ ?>
					<a href="<?= base_url() ?>tienda/page/<?= $nextPagina ?>" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04"> Siguiente &nbsp; <i class="fa fa-chevron-right" aria-hidden="true"></i> </a>
				<?php } ?>
		   </div>
		   <?php 
			   }
			?>
	   </div>

	<div class="container text-center p-t-80">			
		
	</div>
</section>