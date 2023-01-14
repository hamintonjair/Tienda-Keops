<?php 
	$cantCarrito = 0;
	if(isset($_SESSION['arrCarrito']) && count($_SESSION['arrCarrito']) > 0){ 
		foreach($_SESSION['arrCarrito'] as $product) {
			$cantCarrito += $product['cantidad'];
		}
	}
	$this->load->model("Helpers");
	$titulo  = $this->Helpers->getInfoPage(PPREGUNTAS);

	for ($p = 0; $p < count($titulo); $p++) { 
		
		$titu = $titulo[$p]->titulo;	
		$conten  = $titulo[$p]->contenido;			
		
	};	
    if(empty($conten )){
             $titu  =  "";
			 $conten  =  "";
	};
	$this->load->model("ConfiguracionModel");
	$empresa = $this->ConfiguracionModel->getEmpresa();
	$N_empresa =  $empresa[0]->empresa;
	$descripcion =  $empresa[0]->descripcion;
	for($i=0;$i< count($empresa);$i++){
           $logo = $empresa[$i]->logo;
	}
	$url= base_url().'assets/Template/Admin/images/uploads/'.$logo;	

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?= $N_empresa; ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<?php 
		$nombreSitio = $N_empresa ;
		$descripcion = $descripcion ;
		$nombreProducto = $N_empresa ;
		$urlWeb = base_url();
		$urlImg = base_url()."assets/Template/Admin/images/portada.png";

		if(!empty($productosT)){

			for ($p = 0; $p < count($productosT); $p++) { 
				$descripcion = $descripcion ;
				$nombreProducto = $productosT[$p]->nombre;			
				$urlWeb  = base_url()."tienda/productosView/".$productosT[$p]->idproducto.'/'.$productosT[$p]->ruta;
				$urlImagen = $productosT[$p]->images;
				$urlImg = $urlImagen[$p]->url_image;
			};		
		}
	?>
	<meta property="og:locale" 		content='es_ES'/>
	<meta property="og:type"        content="website" />
	<meta property="og:site_name"	content="<?= $nombreSitio; ?>"/>
	<meta property="og:description" content="<?= $descripcion; ?>" />
	<meta property="og:title"       content="<?= $nombreProducto; ?>" />
	<meta property="og:url"         content="<?= $urlWeb; ?>" />
	<meta property="og:image"       content="<?= $urlImg; ?>" />
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?php echo base_url(); ?>favicon.ico"/>
<!--===============================================================================================-->
   <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"> -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/Template/Cliente/assets2/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/Template/Cliente/assets2/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/Template/Cliente/assets2/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/Template/Cliente/assets2/fonts/linearicons-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/Template/Cliente/assets2/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/Template/Cliente/assets2/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/Template/Cliente/assets2/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/Template/Cliente/assets2/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/Template/Cliente/assets2/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/Template/Cliente/assets2/vendor/slick/slick.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/Template/Cliente/assets2/vendor/MagnificPopup/magnific-popup.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/Template/Cliente/assets2/vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/Template/Cliente/assets2/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/Template/Cliente/assets2/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/Template/Cliente/assets2/css/main2.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/libreria/sweetalert2/dist/sweetalert2.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/Template/Admin/css/style.css">  -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/Template/Admin/css/stylereal.css"> 


	<!-- Product Detail -->
	
<!-- <title>Free Snow Bootstrap Website Template | Single :: w3layouts</title> -->
<link href="<?php echo base_url(); ?>assets/Template/Cliente/assets3/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/Template/Cliente/assets3/css/style.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800" rel="stylesheet" type="text/css">
<!-- scrip para el boot -->
<script src="//code.tidio.co/he656z7p8gra0kt1f8pg3wj5wgxcqed8.js" async></script>

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script src="<?php echo base_url(); ?>assets/Template/Cliente/assets3/js/jquery.min.js"></script>
<script type="text/javascript">
        $(document).ready(function() {
            $(".dropdown img.flag").addClass("flagvisibility");

            $(".dropdown dt a").click(function() {
                $(".dropdown dd ul").toggle();
            });
                        
            $(".dropdown dd ul li a").click(function() {
                var text = $(this).html();
                $(".dropdown dt a span").html(text);
                $(".dropdown dd ul").hide();
                $("#result").html("Selected value is: " + getSelectedValue("sample"));
            });
                        
            function getSelectedValue(id) {
                return $("#" + id).find("dt a span.value").html();
            }

            $(document).bind('click', function(e) {
                var $clicked = $(e.target);
                if (! $clicked.parents().hasClass("dropdown"))
                    $(".dropdown dd ul").hide();
            });


            $("#flagSwitcher").click(function() {
                $(".dropdown img.flag").toggleClass("flagvisibility");
            });
        });
     </script>
     <!----details-product-slider--->
				<!-- Include the Etalage files -->
					<link rel="stylesheet" href="<?php echo base_url(); ?>assets/Template/Cliente/assets3/css/etalage.css">
					<script src="<?php echo base_url(); ?>assets/Template/Cliente/assets3/js/jquery.etalage.min.js"></script>
				<!-- Include the Etalage files -->
				<script>
						jQuery(document).ready(function($){
			
							$('#etalage').etalage({
								thumb_image_width: 300,
								thumb_image_height: 400,
								
								show_hint: true,
								click_callback: function(image_anchor, instance_id){
									alert('Callback example:\nYou clicked on an image with the anchor: "'+image_anchor+'"\n(in Etalage instance: "'+instance_id+'")');
								}
							});
							// This is for the dropdown list example:
							$('.dropdownlist').change(function(){
								etalage_show( $(this).find('option:selected').attr('class') );
							});

					});
				</script>
				<!----//details-product-slider--->	
<!--===============================================================================================-->
</head>
<body class="animsition">
	
<div id="divLoading" >
          <div>
            <img src="<?php echo base_url(); ?>assets/Template/Admin/images/loading.svg" alt="Loading">
          </div>
    </div>
<?php 

$data = current_url();
$inicio = "http://localhost/Tienda-online/index.php";
$carrito = "http://localhost/Tienda-online/index.php/carrito";
$pago =    "http://localhost/Tienda-online/index.php/carrito/procesarpago";
$servicios = "http://localhost/Tienda-online/index.php/servicios";
$tienda =    "http://localhost/Tienda-online/index.php/tienda";
$nosotros = "http://localhost/Tienda-online/index.php/nosotros";
$sucursales =    "http://localhost/Tienda-online/index.php/sucursales";
$contacto =    "http://localhost/Tienda-online/index.php/contacto";

?>

	<!-- Header -->
	<header>	
		<!-- Header desktop -->
		<div class="container-menu-desktop ">
		<div class="top-bar">
			<div class="content-topbar flex-sb-m h-full container">
				<div class="left-top-bar">
					<?php if(isset($_SESSION['login'])){ ?>
						Bienvenido: <?= $_SESSION['userData']->nombres.' '.$_SESSION['userData']->apellidos ?>
						<?php } ?>
					</div>

					<div class="right-top-bar flex-w h-full">
						<a href="<?= base_url() ?>preguntas-frecuentes" class="flex-c-m trans-04 p-lr-25" >
							Help & FAQs
						</a>
						<?php 
							if(isset($_SESSION['login'])){
						?>
						<a href="<?= base_url() ?>dashboard" class="flex-c-m trans-04 p-lr-25">
							Mi cuenta
						</a>
						<?php } 
							if(isset($_SESSION['login'])){
						?>
						<a href="<?= base_url() ?>login/logout" class="flex-c-m trans-04 p-lr-25">
							Salir
						</a>
						<?php }else{ ?>
						<a href="<?= base_url() ?>login" class="flex-c-m trans-04 p-lr-25">
							Iniciar Sesión
						</a>
						<?php } ?>
					</div>				
				</div>
			</div>

			<div class="wrap-menu-desktop">
				<nav class="limiter-menu-desktop container">
					 	
					<!-- Logo desktop -->		
					<a href="<?php echo base_url(); ?>" class="logo">
						<img src="<?=$url?>" alt="Tienda Virtual">
					</a>
				
					<!-- Menu desktop -->
			
					<div class="menu-desktop">
						<ul class="main-menu">
						
							<li class="active-menu">
								<a href="<?php echo base_url(); ?>">Inicio</a>								
							</li>
                    
							<li >
							
								<a href="<?php echo base_url(); ?>tienda">Tienda</a>
							
							</li>	
							<li >
							
								<a href="<?php echo base_url(); ?>servicios">Servicios & más</a>
							
							</li>	

							<li>	
						
				 	          <a  href="<?php echo base_url(); ?>carrito">Carrito</a>
							 							
			            	</li>
							
							<li>
				            	<a href="<?php echo base_url(); ?>nosotros">Nosotros</a>
							
			            	</li>

							<li>
								<a href="<?= base_url(); ?>sucursales">Sucursales</a>
							
							</li>

							<li>
								<a href="<?php echo base_url(); ?>contacto">Contacto</a>
							
							</li>						
							
						</ul>
					</div>	

					<!-- Icon header -->
					<div class="wrap-icon-header flex-w flex-r-m">
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
							<i class="zmdi zmdi-search"></i>
						</div>
										
						<?php if($carrito == $pago || $data != $carrito ){ ?>
						<div class="cantCarrito icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="<?= $cantCarrito; ?> ">
							<i class="zmdi zmdi-shopping-cart"></i>
						</div>
						<?php } ?>
						
					</div>
				</nav>
			</div>	
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<!-- Logo moblie -->		
			<div  class="logo-mobile">
				<a href="<?php echo base_url(); ?>"><img src="<?=$url?>" alt="Tienda Virtual"></a>
			</div>

			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m m-r-15">
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
					<i class="zmdi zmdi-search"></i>
				</div>
				<?php if( $data != $carrito || $data != $carrito ){ ?>
				<div class="cantCarrito icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="<?= $cantCarrito; ?>">
					<i class="zmdi zmdi-shopping-cart"></i>
				</div>	
			<?php } ?>			
			</div>
			<!-- Button show menu -->
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>

		<!-- Menu Mobile -->
		<div class="menu-mobile">	
		     <ul class="topbar-mobile">
				<li>
					<div class="left-top-bar">
						<?php if(isset($_SESSION['login'])){ ?>
							Bienvenido: <?= $_SESSION['userData']->nombres.' '.$_SESSION['userData']->apellidos ?>
						<?php } ?>
					</div>
				</li>

				<li>
					<div class="right-top-bar flex-w h-full">
						<a href="<?= base_url() ?>preguntas-frecuentes" class="flex-c-m p-lr-10 trans-04" >
							Help & FAQs
						</a>
						<?php 
							if(isset($_SESSION['login'])){
						?>
						<a href="<?= base_url() ?>dashboard" class="flex-c-m trans-04 p-lr-25">
							Mi cuenta
						</a>
						<?php } 
							if(isset($_SESSION['login'])){
						?>
						<a href="<?= base_url() ?>login/logout" class="flex-c-m trans-04 p-lr-25">
							Salir
						</a>
						<?php }else{ ?>
						<a href="<?= base_url() ?>login" class="flex-c-m trans-04 p-lr-25">
							Iniciar Sesión
						</a>
						<?php } ?>
					</div>
				</li>
			</ul>		
		   
			<ul class="main-menu-m">	
				<li>		
					<a href="<?php echo base_url(); ?>">Inicio</a>								
				</li>
				
				<li>
					<a href="<?php echo base_url(); ?>tienda">Tienda</a>
				</li>
				<li>						
					<a href="<?php echo base_url(); ?>servicios">Servicios & más</a>
							
				</li>	
				<li>		
					<a href="<?php echo base_url(); ?>carrito">Carrito</a>								
				</li>

				<li>
				  	<a href="<?php echo base_url(); ?>nosotros">Nosotros</a>
				</li>

				<li>
						<a href="<?= base_url(); ?>sucursales">Sucursales</a>
				</li>

				<li>
					<a href="<?php echo base_url(); ?>contacto">Contacto</a>
				</li>		
			</ul>
		</div>

		<!-- Modal Search -->
	
		<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
			<div class="container-search-header">
				<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
					<img src="<?= base_url() ?>assets/Template/Cliente/assets2/images/icons/icon-close2.png" alt="CLOSE">
				</button>

				<form class="wrap-search-header flex-w p-l-15" method="get" action="<?= base_url() ?>/tienda/search" >
					<button class="flex-c-m trans-04">
						<i class="zmdi zmdi-search"></i>
					</button>
					<input type="hidden" name="p" value="1">
					<input class="plh3" type="text" name="s" placeholder="Buscar...">
				</form>
			</div>
		</div>
	</header>
	
