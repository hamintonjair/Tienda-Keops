	<!-- Banner -->

	<div class="sec-banner bg0 p-t-80 p-b-50">
		<div class="container">
		<div class="p-b-10">
				<h1 class="ltext-103 cl5">
				
				</h1>
		
		
			<div class="row">
				<?php 
				for ($j=0; $j < count($banner); $j++) {
					$ruta = $banner[$j]->ruta; 
				 ?>
				<div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
					<!-- Block1 -->
					<div class="block1 wrap-pic-w">
						<img src="<?= $banner[$j]->portada ?>" height="250" alt="<?= $banner[$j]->nombre ?>">

						<a href="<?= 'tienda/Categoria/'.$banner[$j]->idcategoria.'/'.$ruta; ?>" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
							<div class="block1-txt-child1 flex-col-l">
								<span  class="block1-name ltext-102 trans-04 p-b-8">
									<?= $banner[$j]->nombre?>
								</span>
								<!-- <span class="block1-info stext-102 trans-04">
									Spring 2018
								</span> -->
							</div>
							<div class="block1-txt-child2 p-b-4 trans-05">
								<div class="block1-link stext-101 cl0 trans-09">
									Ver productos
								</div>
							</div>
						</a>
					</div>
				</div>
				<?php 
				}
				 ?>
			</div>
		</div>
	</div>
</div>


        

