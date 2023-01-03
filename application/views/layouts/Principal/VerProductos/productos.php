
<!-- breadcrumb -->

<?php 
	$this->load->model("ConfiguracionModel");
	$empresa = $this->ConfiguracionModel->getEmpresa();
	$nombre_tienda =  $empresa[0]->nombre_tienda;	
?>
<?php 		if(!empty($productosT)){
		for ($p = 0; $p < count($productosT); $p++) { 

			$idproducto =$productosT[$p]->idproducto;
			$ruta_categoria = $productosT[$p]->categoriaid.'/'.$productosT[$p]->ruta_categoria;
			$urlShared = base_url()."tienda/productosView/".$productosT[$p]->idproducto.'/'.$productosT[$p]->ruta;
		}};?>

<?php for($i=0; $i < count($productosT); $i++) { ; ?>

<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="<?= base_url(); ?>" class="stext-109 cl8 hov-cl1 trans-04">
				Inicio
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>
			<a href="<?php echo base_url().'tienda/categoria/'.$ruta_categoria ?>" class="stext-109 cl8 hov-cl1 trans-04">
				<?= $productosT[$i]->categoria; ?>
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
			<?= $productosT[$i]->nombre; ?>
			</span>
		</div>
	</div>
<?php  } ; ?>	

	<!-- Product Detail -->
	<section class="sec-product-detail bg0 p-t-65 p-b-60">
	<div class="container">
			<div class="row">
				<div class="col-md-6 col-lg-7 p-b-30">
					<div class="p-l-25 p-r-30 p-lr-0-lg">
						<div class="wrap-slick3 flex-sb flex-w">
							<div class="wrap-slick3-dots"></div>
							<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

					    <div class="col-md-9 single_left">
							<?php if(!empty($productosT) ){;
							for($i=0; $i < count($productosT); $i++) {$arrImg = $productosT[$i]->images;?>		
														
							<?php if(empty($arrImg[0]->url_image)){; ?>												
								<div class="single_image">								
										<ul  id="etalage" >														
											<li>
												<a>											
													<img class="etalage_thumb_image" src="<?= base_url().'assets/Template/Admin/images/uploads/product.png'?>" />											
												</a>
											</li>
											<li>									
												<img class="etalage_source_image" src="<?= base_url().'assets/Template/Admin/images/uploads/product.png' ?>" />
											</li>									
										</ul>
						<?php }else{ ; ?>																						
					   <div class="single_image">								
						       	<ul  id="etalage" >														
									<li>
										<a>											
											<img class="etalage_thumb_image" src="<?= $arrImg[$i]->url_image; ?>" />											
										</a>
									</li>
									<?php for ($img=1; $img< count($arrImg) ; $img++) { ?>
									<li>									
										<img class="etalage_source_image" src="<?= $arrImg[$img]->url_image; ?>" />
									</li>	
								<?php 	}; ?>								
						        </ul>
								<?php } ; ?>
						<?php } }; ?>
						    </div>										     
						  </div>
						</div>
					</div>
				</div>		
             
				<div class="col-md-6 col-lg-5 p-b-30">
				<?php if(!empty($productosT)){;
								for($i=0; $i < count($productosT); $i++) {	
							
									?>									
					<div class="p-r-50 p-t-5 p-lr-0-lg">
					   <br>
						<h4 class="mtext-105 cl2 js-name-detail p-b-14">
					    	<?=  $productosT[$i]->nombre; ?>
						</h4>

						<span class="mtext-106 cl2" >
						<?= SMONEY.formatMoney($productosT[$i]->precio);  echo " -" ?>						
						<?= CURRENCY.formatMoney($productosT[$i]->USD); ?>
						</span>

						<p class="stext-102 cl3 p-t-23" >
					    	<?= $productosT[$i]->descripcion; ?>
						</p>					
		               <?php if($productosT[$i]->nombre != "Internet" && $productosT[$i]->nombre != "internet" &&
					    $productosT[$i]->nombre != "Servicio de Internet" && $productosT[$i]->nombre != "Servicios de Internet" &&
						$productosT[$i]->nombre != "servicio de internet" && $productosT[$i]->nombre != "servicios de internet") { ; ?>
							<div class="flex-w flex-r-m p-b-10">
								<div class="size-204 flex-w flex-m respon6-next">
									<div class="wrap-num-product flex-w m-r-20 m-tb-10">
										<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
											<i class="fs-16 zmdi zmdi-minus"></i>
										</div>

										<input id="cant-product" class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1" min="1">

										<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
											<i class="fs-16 zmdi zmdi-plus"></i>
										</div>
									</div>

									<button id="<?= openssl_encrypt($idproducto,METHODENCRIPT,KEY); ?>" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
										Agregar al carrito
									</button>
								</div>
							</div>
						</div>
                      <?php }; ?>
						<!--  -->
						<div class="flex-w flex-m p-l-100 p-t-40 respon7">
							<div class="flex-m bor9 p-r-10 m-r-11">
								Compartir en:
							</div>

							<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook"
								onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?= $urlShared; ?> &t=<?= $productosT[$i]->nombre ?>','ventanacompartir', 'toolbar=0, status=0, width=650, height=450');"
								>
								<i class="fa fa-facebook"></i>
							</a>

							<a href="https://twitter.com/intent/tweet?text=<?= $productosT[$i]->nombre?>&url=<?= $urlShared; ?>&hashtags=<?= 	$nombre_tienda ; ?>" target="_blank" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
								<i class="fa fa-twitter"></i>
							</a>

							<a href="https://api.whatsapp.com/send?text=<?= $productosT[$i]->nombre.' '.$urlShared ?>" target="_blank" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="WhatsApp">
							<i class="fa fa-whatsapp" aria-hidden="true"></i>
							</a>
						</div>	
						<?php }}; ?>					
					</div>
				</div>
			</div>
			
		</div>

		<div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
		<h3>Productos Relacionados</h3>
		</div>		
			
	</section>

	<!-- Related Products -->

	<section class="bg0 p-t-23 p-b-140">
		<div class="container">			
			<!-- Slide2 -->
			<div class="wrap-slick2">
				<div class="slick2 slick-initialized slick-slider">
				<?php 
			// var_dump($productosRandow);
					if(!empty($productosRandow)){
						for ($p = 0; $p < count($productosRandow); $p++) { 
							$ruta = $productosRandow[$p]->ruta;
							if(count($productosRandow[$p]->images) > 0 ){
								$portada = $productosRandow[$p]->images[0]->url_image;
								
							}else{
								$portada = base_url().'assets/Template/Admin/images/uploads/product.png';
							}
				 ?>				
					<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item ">		
						<!-- Block2 -->
				
						<div class="block2">
							<div class="block2-pic hov-img0">
							<img src="<?= $portada ?>"  height="350" alt="<?= $productosRandow[$p]->nombre ?>">

							<a href="<?php echo base_url().'tienda/productosView/'.$productosRandow[$p]->idproducto.'/'.$ruta; ?>" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
									Ver producto
								</a>
							</div>

							<div class="block2-txt flex-w flex-t p-t-14">
								<div class="block2-txt-child1 flex-col-l ">
								<a href="<?php echo base_url().'tienda/productosView/'.$productosRandow[$p]->idproducto.'/'.$ruta; ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
										<?= $productosRandow[$p]->nombre ?>
									</a>
									<span class="stext-105 cl3">
										<?= SMONEY.formatMoney($productosRandow[$p]->precio);  echo " -" ?>			
					                	<?= CURRENCY.formatMoney($productosRandow[$p]->USD); ?>
									</span>
								</div>							
								<div class="block2-txt-child2 flex-r p-t-3">
									<a href="#"
									 id="<?= openssl_encrypt($productosRandow[$p]->idproducto,METHODENCRIPT,KEY) ?>"
									 pr="1"
									 class="btn-addwish-b2 dis-block pos-relative js-addwish-b2 js-addcart-detail
									 icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11
									 ">
										<i class="zmdi zmdi-shopping-cart"></i>
									</a>
								</div>
							</div>
						</div>
					</div>	
				
					<?php 
						}
					}	
				 ?>				
				</div>			
		</div>
	</section>

