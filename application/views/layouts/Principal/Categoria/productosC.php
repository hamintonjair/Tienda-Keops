	
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
							<img src="<?= $portada ?>"  height="350" alt="<?= $productos[$p]->nombre ?>">
							<a href="<?php echo base_url().'tienda/productosView/'.$productos[$p]->idproducto.'/'.$rutaProducto; ?>" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
								Ver producto
							</a>
						</div>

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<a href="<?php echo base_url().'tienda/productosView/'.$productos[$p]->idproducto.'/'.$rutaProducto; ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
									<?= $productos[$p]->nombre ?>
								</a>

								<span class="stext-105 cl3">
									<?= SMONEY.formatMoney($productos[$p]->precio);  echo " -" ?>
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
					<a href="<?= base_url() ?>tienda/categoria/<?= $idcategoria.'/'.$ruta.'/'.$prevPagina?>" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04"> <i class="fa fa-chevron-left" aria-hidden="true"></i> &nbsp; Anterior </a>&nbsp;&nbsp;
				<?php } ?>
				<?php ; if($pagina['pagina'] != $pagina['total_paginas']){ ?>			
					<a href="<?= base_url() ?>tienda/categoria/<?= $idcategoria.'/'.$ruta.'/'.$nextPagina ?>" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04"> Siguiente &nbsp; <i class="fa fa-chevron-right" aria-hidden="true"></i> </a>
				<?php } ?>
		   </div>
		   <?php 
			   }
			?>
	</div>		
	</section>