    <section>
		
			<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
						       
				<?php 
				for ($j=0; $j < count($slider) ; $j++) { 	 ?>	
				
					<li data-target="#carouselExampleCaptions" data-slide-to="<?= $slider[$j]->idcategoria ?>" class="<?php echo ($j==0)?'active':'' ?>"></li>
					
				<?php } ?>
				</ol>	
				<div class="carousel-inner">
				<?php for ($i=0; $i < count($slider) ; $i++) { 
							$ruta = $slider[$i]->ruta; 						
								?>
					<div class="carousel-item <?php echo ($i==0)?'active':'' ?>">
						<img  src="<?= $slider[$i]->portada ?>" class="d-block w-100"  height="550px" >
						<div class="carousel-caption d-md-block">
							<h1><?= $slider[$i]->nombre ?></h1>
							<p><h3><?= $slider[$i]->descripcion ?></h3></p>
							<a href="<?= 'tienda/Categoria/'.$slider[$i]->idcategoria.'/'.$ruta; ?>" class=" stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04" tabindex="-1" _msthash="3117531" _msttexthash="204568">Ir a la tienda </a>	
						</div>
					</div>	
					<?php } ?>				
				</div>
				
				<button class="carousel-control-prev" type="button" data-target="#carouselExampleCaptions" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</button>
				<button class="carousel-control-next" type="button" data-target="#carouselExampleCaptions" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</button>
				
			</div>	
</section>
