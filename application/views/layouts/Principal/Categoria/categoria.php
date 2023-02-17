
	
<section div class="bg0 m-t-23 p-b-140">
		<div class="container">
		 
			<div class="flex-w flex-sb-m p-b-52">
				<div class="flex-w flex-l-m filter-tope-group m-tb-10">
			<?php  ; ?>	            
			     <h3>Tienda virtual - Categorías</h3>	
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
									if(count($categoria) > 0){
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

		
	
