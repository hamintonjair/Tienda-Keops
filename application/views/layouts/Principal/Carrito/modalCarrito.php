

<div class="wrap-header-cart js-panel-cart">
		<div class="s-full js-hide-cart"></div>

		<div class="header-cart flex-col-l p-l-65 p-r-25">
			<div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					Tu Carrito
				</span>

				<div id="productosCarrito" class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
					<i class="zmdi zmdi-close"></i>
				</div>
				
            </div>
            <div class="header-cart-content flex-w js-pscroll">
                <?php 
                    $total = 0;
                    $total2 = 0;
                    if(isset($_SESSION['arrCarrito']) and count($_SESSION['arrCarrito']) > 0){ 
                    ?>
                    <ul class="header-cart-wrapitem w-full">
                    <?php 
                        foreach ($_SESSION['arrCarrito'] as $producto) {
                        $total += $producto['cantidad'] * $producto['precio'];
                        $total2 += $producto['cantidad'] * $producto['USD'];
                        $idProducto = openssl_encrypt($producto['idproducto'],METHODENCRIPT,KEY);	
                    ?>	
                <li class="header-cart-item flex-w flex-t m-b-12">
                    <div class="header-cart-item-img" idpr="<?= $idProducto ?>" op="1" onclick="fntdelItem(this)">
                        <img style="width: 60px; height: 100px;" src="<?= $producto['imagen'] ?>" alt="<?= $producto['producto'] ?>">
                    </div>
                    <div class="header-cart-item-txt p-t-8">
                        <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                            <?= $producto['producto'] ?>
                        </a>
                        <span class="header-cart-item-info">
                            <?= $producto['cantidad'].' x '.SMONEY.formatMoney($producto['precio']) ?>     
                            <?= ' - '.CURRENCY.formatMoney($producto['USD']) ?>                     
                        </span>
                    </div>
                </li>
                <?php } ?>
                </ul>
                <div class="w-full">
                        <div class="header-cart-total w-full p-tb-40">
                            Total: <?= SMONEY.formatMoney($total); echo " -"?>
                             <?= CURRENCY.formatMoney($total2); ?>
                        </div>

                        <div class="header-cart-buttons flex-w w-full">
                            <a href="<?= base_url() ?>carrito" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                                Ver carrito
                            </a>

                            <a href="<?= base_url() ?>carrito/procesarpago" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                                Procesar pago
                            </a>
                        </div>
                </div>
                    <?php 
                    }
                    ?>
           </div>
 	 </div>
</div>
