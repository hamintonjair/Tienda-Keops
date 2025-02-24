<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tienda extends CI_Controller
{

	public function __construct()
	{
		// session_regenerate_id(true);
		parent::__construct();

		session_start();
		$this->load->model("TproductosModel");
		$this->load->model("TcategoriaModel");
		$this->load->model("TclienteModel");
		$this->load->model("TtipoPagoModel");
		$this->load->model("ProductosModel");
		$this->load->model("UsuariosModel");
		$this->load->model("ConfiguracionModel");
		$this->load->model("Helpers");
	}
	public function index()
	{

		$slider = $this->TcategoriaModel->getCategoriasT(CAT_SLIDER);
		$banner = $this->TcategoriaModel->getCategoriasT(CAT_BANNER);
		$footer = $this->TcategoriaModel->getCategoriasT(CAT_FOOTER);
		$footer2 = $this->TcategoriaModel->getCategoriasT2(CAT_FOOTER2);
		$productos = $this->TproductosModel->getProducto();
		$pageContent = $this->Helpers->getPageRout('inicio');
		$categoria = $this->TcategoriaModel->getCategorias();

		$page['page'] = $pageContent;
		$this->load->view('layouts/Principal/header');
		$this->load->view('layouts/Principal/Carrito/modalCarrito');
		$this->load->view('layouts/Principal/slide', compact('slider'));
		$this->load->view('layouts/Principal/banner', compact('banner'));
		$this->load->view('layouts/Principal/productos', compact('productos', 'page', 'categoria'));
		$this->load->view('layouts/Principal/footer', compact('footer', 'footer2'));
	}
	//preguntas frecuentes
	public function Preguntas()
	{

		$this->load->view('layouts/Principal/header');
		$this->load->view('layouts/Principal/Carrito/modalCarrito');
		$this->load->view('layouts/Principal/Preguntas/preguntasFrecuentes');
		$this->load->view('layouts/Principal/footer');
	}
	//productos
	public function Tienda()
	{
		$pagina =  1;
		$cantProductos = $this->TproductosModel->cantProductos();
		$total_registro = $cantProductos[0]->total_registro;

		$desde = ($pagina - 1) * PROPORPAGINA;
		$total_paginas = ceil($total_registro / PROPORPAGINA);
		$productos = $this->TproductosModel->getProductoPage($desde, PROPORPAGINA);
		$categoria = $this->TcategoriaModel->getCategorias();

		$pagina = array(
			'pagina' => $pagina,
			'total_paginas' => $total_paginas,
		);

		$this->load->view('layouts/Principal/header');
		$this->load->view('layouts/Principal/Carrito/modalCarrito');
		$this->load->view('layouts/Principal/tienda', compact('productos', 'pagina', 'categoria'));
		$this->load->view('layouts/Principal/footer');
	}
	//carrito
	public function Carrito_compra()
	{

		if (empty($_SESSION['arrCarrito'])) {
			echo '<script>window.location.href="http://localhost/sitio-keops/"</script>';
		}
		$this->load->view('layouts/Principal/header');
		$this->load->view('layouts/Principal/Carrito/modalCarrito');
		$this->load->view('layouts/Principal/Carrito/carritoComprar');
		$this->load->view('layouts/Principal/footer');
	}
	//categorias
	public function Categoria($id, $ruta, $pagina = null)
	{
		if (empty($id)) {
			echo '<script>window.location.href="http://localhost/sitio-keops/"</script>';
		} else {
			// $pagina =  1;	

			$pagina = is_numeric($pagina) ? $pagina : 1;

			$cantProductos = $this->TproductosModel->cantProductos($id);
			$total_registro = $cantProductos[0]->total_registro;

			$desde = ($pagina - 1) * PROCATEGORIA;
			$total_paginas = ceil($total_registro / PROCATEGORIA);

			$pagina = array(
				'pagina' => $pagina,
				'total_paginas' => $total_paginas,
			);
			$idcategoria = $this->Helpers->strClean($id);
			$Nruta = $this->Helpers->strClean($ruta);
			$Nproductos = $this->TproductosModel->getProductosCategoriasP($idcategoria, $Nruta, $desde, PROCATEGORIA);

			$categoria = $this->TcategoriaModel->getCategorias();
			$productos = $Nproductos['productos'];

			$this->load->view('layouts/Principal/header');
			$this->load->view('layouts/Principal/Carrito/modalCarrito');
			$this->load->view('layouts/Principal/Categoria/categoria', compact('categoria'));
			$this->load->view('layouts/Principal/Categoria/productosC', compact('productos', 'pagina', 'ruta', 'idcategoria'));
			$this->load->view('layouts/Principal/footer');
		}
	}
	//informacio de productos por categorias
	public function ProductosView($id, $ruta)
	{

		$idcategoria = "";
		$idproducto = $this->Helpers->strClean($id);
		$Nruta = $this->Helpers->strClean($ruta);
		//buscar los elementos que pertenecen a ese producto
		$productosT = $this->TproductosModel->getProductos($idproducto, $Nruta);

		if (empty($productosT)) {

			echo '<script>window.location.href="http://localhost/sitio-keops/"</script>';
		} else {
			for ($i = 0; $i < count($productosT); $i++) {

				$idcategoria =  $productosT[$i]->categoriaid;
			}
			//enviar id que pertenesca a esa categoria y traer 8 productos aleatorio
			$productosRandow = $this->TproductosModel->getProductosRandow($idcategoria, 8, "r");

			$this->load->view('layouts/Principal/header', compact('productosT'));
			$this->load->view('layouts/Principal/Carrito/modalCarrito');
			$this->load->view('layouts/Principal/VerProductos/productos', compact('productosT', 'productosRandow'));
			$this->load->view('layouts/Principal/footer');
		}
	}
	// //añadir al carrito
	// public function addCarrito(){

	//    if ($this->input->is_ajax_request()) {		

	// 	        // unset($_SESSION['arrCarrito']);exit;
	// 			$arrCarrito = array();
	// 			$cantCarrito = 0;
	// 			$idproducto = openssl_decrypt($this->input->post('id'), METHODENCRIPT, KEY);
	// 			$cantidad = $this->input->post('cant');

	// 			 if(is_numeric($idproducto) && is_numeric($cantidad)){

	// 				$arrInfoProducto = $this->TproductosModel->getProductoIDT($idproducto);

	// 				for($i =0;$i < count($arrInfoProducto); $i++){

	// 					$nombre =  $arrInfoProducto[$i]->nombre;
	// 					$precio =  $arrInfoProducto[$i]->precio;
	// 					$USD =  $arrInfoProducto[$i]->USD;
	// 					//obtener la imagen
	// 					if(count($arrInfoProducto[$i]->images) > 0 ){
	// 						$images = $arrInfoProducto[$i]->images[0]->url_image;
	// 					}					
	// 				}						
	// 				if(!empty($arrInfoProducto)){

	// 					$arrProducto = ['idproducto' => $idproducto,
	// 										 'producto' => $nombre,
	// 										 'cantidad' => $cantidad,
	// 										 'precio' => $precio,
	// 										 'imagen' => $images,
	// 										 'USD'    => $USD
	// 				  ];					
	// 		         // di ya existe la variable de session no agrega el mismo producto solo la cantidad
	// 					if(isset($_SESSION['arrCarrito'])){

	// 						$on = true;
	// 						$arrCarrito = $_SESSION['arrCarrito'];
	// 					   //condicional para añadir la cantidad al producto si le damos añadir varias veces
	// 						for ($pr=0; $pr <count($arrCarrito); $pr++) {   

	// 							if($arrCarrito[$pr]['idproducto'] == $idproducto){
	// 								$arrCarrito[$pr]['cantidad'] += $cantidad;
	// 								$on = false;								
	// 				    	    }
	// 					    }	
	// 						//si es verdadero es para agregar al carrito					
	// 						if($on){
	// 							array_push($arrCarrito,$arrProducto);
	// 						}
	// 						$_SESSION['arrCarrito'] = $arrCarrito;

	// 					}else{
	// 							array_push($arrCarrito, $arrProducto);
	// 							$_SESSION['arrCarrito'] = $arrCarrito;							
	// 					}

	// 					foreach ($_SESSION['arrCarrito'] as $pro) {

	// 						$cantCarrito += $pro['cantidad'];
	// 					}					
	// 					$htmlCarrito ="";
	// 					$htmlCarrito =  $this->Helpers->getFile('layouts/Principal/Carrito/modalCarrito',$_SESSION['arrCarrito']);
	// 					$arrResponse = array("status" => true, 
	// 										"msg" => '¡Se agrego al corrito!',
	// 										"cantCarrito" => $cantCarrito,
	// 										"htmlCarrito" => $htmlCarrito
	// 									);

	// 			 }else{
	// 			 	$arrResponse = array("status" => false, "msg" => 'Producto no existente.');
	// 			}

	// 		}else{

	// 			$arrResponse = array("status" => false, "msg" => 'Dato incorrecto.');
	// 		}	
	// 		echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);	
	//     }else{
	// 	redirect('error');		
	//     }      
	//     die();
	// }
	//añadir al carrito
	public function addCarrito()
	{

		if ($this->input->is_ajax_request()) {

			// unset($_SESSION['arrCarrito']);exit;
			$arrCarrito = array();
			$cantCarrito = 0;
			$cant =  0;
			$idproducto = openssl_decrypt($this->input->post('id'), METHODENCRIPT, KEY);
			$cantidad = $this->input->post('cant');
			$cantidadP = $this->ProductosModel->listarP($idproducto);
			$cantTemporal = 0;
			if (!empty($_SESSION['arrCarrito'])) {
				$arrCarr = $_SESSION['arrCarrito'];
				for ($pr = 0; $pr < count($arrCarr); $pr++) {

					$id_Producto = $arrCarr[$pr]['idproducto'];

					if ($id_Producto == $idproducto) {
						$cant = $arrCarr[$pr]['cantidad'];
					}
					$cantTemporal += $arrCarr[$pr]['cantidad'];
				}
			};

			$Cantidad = $cantidadP[0]->stock + $cant;

			//aqui se modifico
			if ($cant >= $cantidadP[0]->stock || $cantidadP[0]->stock < $Cantidad) {

				$arrResponse = array(
					"status" => false,
					"msg" => 'Stock insuficiente.',
					"cantCarrito" => $cantTemporal,
				);
			} else {

				if (is_numeric($idproducto) && is_numeric($cantidad)) {

					$arrInfoProducto = $this->TproductosModel->getProductoIDT($idproducto);

					for ($i = 0; $i < count($arrInfoProducto); $i++) {

						$nombre =  $arrInfoProducto[$i]->nombre;
						$precio =  $arrInfoProducto[$i]->precio;
						$USD =  $arrInfoProducto[$i]->USD;
						//obtener la imagen
						if (count($arrInfoProducto[$i]->images) > 0) {
							$images = $arrInfoProducto[$i]->images[0]->url_image;
						}
					}
					if (!empty($arrInfoProducto)) {

						$arrProducto = [
							'idproducto' => $idproducto,
							'producto' => $nombre,
							'cantidad' => $cantidad,
							'precio' => $precio,
							'imagen' => $images,
							'USD'    => $USD
						];
						// di ya existe la variable de session no agrega el mismo producto solo la cantidad
						if (isset($_SESSION['arrCarrito'])) {

							$on = true;
							$arrCarrito = $_SESSION['arrCarrito'];
							//condicional para añadir la cantidad al producto si le damos añadir varias veces
							for ($pr = 0; $pr < count($arrCarrito); $pr++) {

								if ($arrCarrito[$pr]['idproducto'] == $idproducto) {
									$arrCarrito[$pr]['cantidad'] += $cantidad;
									$on = false;
								}
							}
							//si es verdadero es para agregar al carrito					
							if ($on) {
								array_push($arrCarrito, $arrProducto);
							}
							$_SESSION['arrCarrito'] = $arrCarrito;
						} else {
							array_push($arrCarrito, $arrProducto);
							$_SESSION['arrCarrito'] = $arrCarrito;
						}

						foreach ($_SESSION['arrCarrito'] as $pro) {

							$cantCarrito += $pro['cantidad'];
						}
						$cant =	$cantCarrito;
						$htmlCarrito = "";
						$htmlCarrito =  $this->Helpers->getFile('layouts/Principal/Carrito/modalCarrito', $_SESSION['arrCarrito']);
						$arrResponse = array(
							"status" => true,
							"msg" => '¡Se agrego al corrito!',
							"cantCarrito" => $cantCarrito,
							"htmlCarrito" => $htmlCarrito
						);
					} else {
						$arrResponse = array("status" => false, "msg" => 'Producto no existente.');
					}
				} else {
					$arrResponse = array("status" => false, "msg" => 'Dato incorrecto.');
				}
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		} else {
			redirect('error');
		}
		die();
	}
	//eliminar producto del carrito
	public function delCarrito()
	{

		$empresa = $this->ConfiguracionModel->getEmpresa();
		$costo_evio =  $empresa[0]->costo_evio;

		if ($this->input->is_ajax_request()) {

			$arrCarrito = array();
			$cantCarrito = 0;
			$subtotal = 0;
			$subtotal2 = 0;
			$idproducto = openssl_decrypt($this->input->post('id'), METHODENCRIPT, KEY);
			$option = $this->input->post('option');

			if (is_numeric($idproducto) and ($option == 1 or $option == 2)) {
				$arrCarrito = $_SESSION['arrCarrito'];
				for ($pr = 0; $pr < count($arrCarrito); $pr++) {
					if ($arrCarrito[$pr]['idproducto'] == $idproducto) {
						//eliminamos
						unset($arrCarrito[$pr]);
					}
				}
				//ordena el array
				sort($arrCarrito);
				$_SESSION['arrCarrito'] = $arrCarrito;
				foreach ($_SESSION['arrCarrito'] as $pro) {
					$cantCarrito += $pro['cantidad'];
					$subtotal += $pro['cantidad'] * $pro['precio'];
					$subtotal2 += $pro['cantidad'] * $pro['USD'];
				}

				$htmlCarrito = "";
				//si la variable option es = 1, es porque se va eliminar desde el modal del carrito
				if ($option == 1) {
					$htmlCarrito = $this->Helpers->getFile('layouts/Principal/Carrito/modalCarrito', $_SESSION['arrCarrito']);
				}
				$arrResponse = array(
					"status" => true,
					"msg" => '¡Producto eliminado!',
					"cantCarrito" => $cantCarrito,
					"htmlCarrito" => $htmlCarrito,
					"subTotal" => SMONEY . formatMoney($subtotal),
					"subTotal2" => CURRENCY . formatMoney($subtotal2),
					"total" => CURRENCY . formatMoney($subtotal2 + $costo_evio)
				);
			} else {
				$arrResponse = array("status" => false, "msg" => 'Dato incorrecto.');
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		} else {
			redirect('error');
		}
		die();
	}
	// //actualizar carrito
	// public function updCarrito(){

	// 	$empresa = $this->ConfiguracionModel->getEmpresa();
	// 	$costo_evio =  $empresa[0]->costo_evio;	
	// 	if($this->input->is_ajax_request()){

	// 		$arrCarrito = array();
	// 		$totalProducto = 0;
	// 		$subtotal = 0;
	// 		$total = 0;
	// 		$totalProducto2 = 0;
	// 		$subtotal2 = 0;
	// 		$total2 = 0;

	// 		$idproducto = openssl_decrypt($this->input->post('id'), METHODENCRIPT, KEY);
	// 		$cantidad = intval($this->input->post('cantidad'));

	// 		if(is_numeric($idproducto) &&  $cantidad > 0){

	// 			$arrCarrito = $_SESSION['arrCarrito'];				
	// 			for ($p=0; $p < count($arrCarrito); $p++) { 
	// 				if($arrCarrito[$p]['idproducto'] == $idproducto){
	// 					$arrCarrito[$p]['cantidad'] = $cantidad;
	// 					$totalProducto = $arrCarrito[$p]['precio'] * $cantidad;
	// 					$totalProducto2 = $arrCarrito[$p]['USD'] * $cantidad;
	// 					break;
	// 				}
	// 			}
	// 			$_SESSION['arrCarrito'] = $arrCarrito;
	// 			foreach ($_SESSION['arrCarrito'] as $pro) {
	// 				$subtotal += $pro['cantidad'] * $pro['precio']; 
	// 				$subtotal2 += $pro['cantidad'] * $pro['USD']; 
	// 			}
	// 			$arrResponse = array("status" => true, 
	// 								"post" => '¡Producto actualizado!',
	// 								"totalProducto" => SMONEY.formatMoney($totalProducto),
	// 								"totalProducto2" => CURRENCY.formatMoney($totalProducto2),
	// 								"subTotal" => SMONEY.formatMoney($subtotal),
	// 								"subTotal2" => CURRENCY.formatMoney($subtotal2),						
	// 								"total" => CURRENCY.formatMoney($subtotal2 + $costo_evio )						
	// 							);

	// 		}else{
	// 			$arrResponse = array("status" => false, "msg" => 'Dato incorrecto.');
	// 		}
	// 		 echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
	// 	}else{
	// 		redirect('error');	
	// 	}
	// 	die();
	// }
	//actualizar carrito
	public function updCarrito()
	{

		$empresa = $this->ConfiguracionModel->getEmpresa();
		$costo_evio =  $empresa[0]->costo_evio;
		if ($this->input->is_ajax_request()) {

			$arrCarrito = array();
			$totalProducto = 0;
			$subtotal = 0;
			$total = 0;
			$totalProducto2 = 0;
			$subtotal2 = 0;
			$total2 = 0;

			//aqui se modifico
			$idproducto = openssl_decrypt($this->input->post('id'), METHODENCRIPT, KEY);
			$cantidad = intval($this->input->post('cantidad'));
			$cantidadP = $this->ProductosModel->listarP($idproducto);

			if ($cantidad <= $cantidadP[0]->stock) {

				if (is_numeric($idproducto) &&  $cantidad > 0) {

					$arrCarrito = $_SESSION['arrCarrito'];
					for ($p = 0; $p < count($arrCarrito); $p++) {
						if ($arrCarrito[$p]['idproducto'] == $idproducto) {
							$arrCarrito[$p]['cantidad'] = $cantidad;
							$totalProducto = $arrCarrito[$p]['precio'] * $cantidad;
							$totalProducto2 = $arrCarrito[$p]['USD'] * $cantidad;
							break;
						}
					}
					$_SESSION['arrCarrito'] = $arrCarrito;
					foreach ($_SESSION['arrCarrito'] as $pro) {
						$subtotal += $pro['cantidad'] * $pro['precio'];
						$subtotal2 += $pro['cantidad'] * $pro['USD'];
					}
					$arrResponse = array(
						"status" => true,
						"post" => '¡Producto actualizado!',
						"totalProducto" => SMONEY . formatMoney($totalProducto),
						"totalProducto2" => CURRENCY . formatMoney($totalProducto2),
						"subTotal" => SMONEY . formatMoney($subtotal),
						"subTotal2" => CURRENCY . formatMoney($subtotal2),
						"total" => CURRENCY . formatMoney($subtotal2 + $costo_evio)
					);
				} else {
					$arrResponse = array("status" => false, "msg" => 'Dato incorrecto.');
				}
			} else {
				$arrResponse = array("status" => false, "msg" => 'Stock insuficiente.');
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		} else {
			redirect('error');
		}
		die();
	}
	//procesar pago
	public function ProcesarPago()
	{

		if (empty($_SESSION['arrCarrito'])) {
			echo '<script>window.location.href="http://localhost/sitio-keops/"</script>';
		}
		if (isset($_SESSION['login'])) {

			$this->setDetalleTemp();
		}
		$tipopago = $this->TtipoPagoModel->getTipoPago();

		$this->load->view('layouts/Principal/header');
		$this->load->view('layouts/Principal/Carrito/modalCarrito');
		$this->load->view('layouts/Principal/Carrito/ProcesarPago', compact('tipopago'));
		$this->load->view('layouts/Principal/footer');
	}

	//insert cliente
	public function registro()
	{
		if ($this->input->is_ajax_request()) {

			if (empty($nombre = $this->input->post("txtNombre")) || empty($apellido = $this->input->post("txtApellido")) || empty($telefono = $this->input->post("txtTelefono")) || empty($email = $this->input->post("txtEmailCliente"))) {
				$respuesta = array('status' => false, 'msg' => 'Todos los campos son obligatorios.');
			} else {
				$nombre = ucwords($this->Helpers->strClean($this->input->post("txtNombre")));
				$apellido = ucwords($this->Helpers->strClean($this->input->post("txtApellido")));
				$telefono = intval($this->Helpers->strClean($this->input->post("txtTelefono")));
				$email = strtolower($this->Helpers->strClean($this->input->post("txtEmailCliente")));

				$intTipoId = 3;

				$responseEmail = $this->UsuariosModel->ValidarEmail($email);

				if ($responseEmail == true) {
					$respuesta = array('status' => false, 'msg' => '¡Atención! el email ya existe, ingrese otro.');
				} else {
					//se genera el password si viene vacio de lo contrario se encripta
					$password = $this->Helpers->passGenerator();
					$passwordEncript =  hash("SHA256", $password);

					$datos = array(
						"nombres"         => $nombre,
						"apellidos"       => $apellido,
						"telefono"        => $telefono,
						"email_user"      => $email,
						"password"        => $passwordEncript,
						"rolid"           => $intTipoId,

					);
					$iduser = $this->TclienteModel->InsertCliente($datos);

					if (!empty($iduser)) {
						$id = $iduser->idpersona;

						$respuesta = array('status' => true, 'post' => 'Datos guardados correctamente.');

						$nombreUsuario = $nombre . ' ' . $apellido;
						$dataUsuario = array(
							'nombreUsuario' => $nombreUsuario,
							'emailC'         => $email,
							'password'      => $password,
							'asunto'        => 'Bienvenido a tu tienda en línea'
						);
						$_SESSION['idUser'] = $id;
						$_SESSION['login'] = true;

						$datos = $this->Helpers->sessionUser($id);
						$_SESSION['userData'] = $datos;

						$this->Helpers->sendEmail($dataUsuario, 'email_bienvenida');
					} else {
						$respuesta = array('status' => false, 'msg' => 'No es posible almacenar el cliente.');
					}
				}
			}
			echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
		} else {
			redirect('error');
		}
		die();
	}

	public function setDetalleTemp()
	{
		$id = session_id();

		$resultPerdido = array(
			'idcliente' => $_SESSION['idUser'],
			'idtransaccion' => $id,
			'productos' => $_SESSION['arrCarrito'],
		);
		$this->TclienteModel->insertDetalleTemp($resultPerdido);
	}
	//procesar ventas
	public function procesarVenta()
	{

		$empresa = $this->ConfiguracionModel->getEmpresa();
		$costo_evioU =  $empresa[0]->costo_evio;
		$costo_evioP =  $empresa[0]->costo_envioP;
		$email_pedido =  $empresa[0]->email_pedido;

		$idtransaccionpaypal = NULL;
		$datospaypal = NULL;
		$personaid = $_SESSION['idUser'];
		$monto = 0;
		$montoUSD = 0;
		$tipopagoid = intval($this->Helpers->strClean($this->input->post("inttipopago")));
		$direccionenvio = $this->Helpers->strClean($this->input->post("direccion")) . ', ' . $this->Helpers->strClean($this->input->post("ciudad"));
		$status = "Pendiente";
		$subtotal = 0;
		$subtotal2 = 0;
		$costo_envioU = $costo_evioU;
		$costo_envioP = $costo_evioP;

		if (!empty($_SESSION['arrCarrito'])) {
			foreach ($_SESSION['arrCarrito'] as $pro) {
				$subtotal += $pro['cantidad'] * $pro['precio'];
				$subtotal2 += $pro['cantidad'] * $pro['USD'];
			}
			$monto = $subtotal + $costo_envioP;
			$montoUSD = $subtotal2 + $costo_evioU;

			//Pago contra entrega
			if (empty($this->input->post("datapay"))) {
				//Crear pedido
				$request_pedido = $this->TclienteModel->insertPedido(
					$idtransaccionpaypal,
					$datospaypal,
					$personaid,
					$costo_envioU,
					$costo_envioP,
					$monto,
					$tipopagoid,
					$direccionenvio,
					$status,
					$montoUSD
				);


				if (!empty($request_pedido)) {
					//Insertamos detalle
					$idPedido = $request_pedido;
					foreach ($_SESSION['arrCarrito'] as $producto) {
						$productoid = $producto['idproducto'];
						$precio = $producto['precio'];
						$USD = $producto['USD'];
						$cantidad = $producto['cantidad'];
						$result = $this->TclienteModel->insertDetalle($idPedido, $productoid, $precio, $USD, $cantidad);
					}
					$infoOrden = $this->TclienteModel->getPedido($idPedido);

					$dataEmailOrden = array(
						'asunto' => "Se ha creado la orden No." . $idPedido,
						'email' => $_SESSION['userData']->email_user,
						'emailCopia' => $email_pedido,
					);

					$this->Helpers->sendEmailPedido($dataEmailOrden, $infoOrden, "email_notificacion_orden");

					// Verifica que $idPedido no sea nulo antes de pasarlo a openssl_encrypt
					if (!is_null($idPedido)) {
						$orden = openssl_encrypt($idPedido, METHODENCRIPT, KEY);
					} else {
						// Manejar el caso de que $idPedido sea nulo
						$orden = 'default_value';
					}

					// Verifica que $idtransaccionpaypal no sea nulo antes de pasarlo a openssl_encrypt
					if (!is_null($idtransaccionpaypal)) {
						$transaccion = openssl_encrypt($idtransaccionpaypal, METHODENCRIPT, KEY);
					} else {
						// Manejar el caso de que $idtransaccionpaypal sea nulo
						$transaccion = 'default_value';
					}

					$arrResponse = array(
						"status" => true,
						"orden" => $orden,
						"transaccion" => $transaccion,
						"msg" => 'Pedido realizado'
					);

					$_SESSION['dataorden'] = $arrResponse;
					unset($_SESSION['arrCarrito']);
					// session_regenerate_id(true);
					ob_start();
				} else {
					//Pago con PayPal
					$jsonPaypal = $this->input->post("datapay");
					$objPaypal = json_decode($jsonPaypal);
					$status = "Aprobado";
					if (is_object($objPaypal)) {
						$datospaypal = $jsonPaypal;
						$idtransaccionpaypal = $objPaypal->purchase_units[0]->payments->captures[0]->id;
						if ($objPaypal->status == "COMPLETED") {
							$totalPaypal = formatMoney($objPaypal->purchase_units[0]->amount->value);
							if ($monto == $totalPaypal) {
								$status = "Completo";
							}
							//Crear pedido
							$request_pedido = $this->TclienteModel->insertPedido(
								$idtransaccionpaypal,
								$datospaypal,
								$personaid,
								$costo_envioU,
								$costo_envioP,
								$monto,
								$tipopagoid,
								$direccionenvio,
								$status,
								$montoUSD
							);
							if (!empty($request_pedido)) {

								$idPedido = $request_pedido->idpedido;
								//Insertamos detalle
								foreach ($_SESSION['arrCarrito'] as $producto) {
									$productoid = $producto['idproducto'];
									$precio = $producto['precio'];
									$USD = $producto['USD'];
									$cantidad = $producto['cantidad'];


									$this->TclienteModel->insertDetalle($idPedido, $productoid, $precio, $USD, $cantidad);
								}
								$infoOrden = $this->TclienteModel->getPedido($idPedido);
								$dataEmailOrden = array(
									'asunto' => "Se ha creado la orden No." . $idPedido,
									'email' => $_SESSION['userData']->email_user,
									'emailCopia' => $email_pedido,
								);

								$this->Helpers->sendEmailPedido($dataEmailOrden,	$infoOrden, "email_notificacion_orden");

								$orden = openssl_encrypt($idPedido, METHODENCRIPT, KEY);
								$transaccion = openssl_encrypt($idtransaccionpaypal, METHODENCRIPT, KEY);

								$arrResponse = array(
									"status" => true,
									"orden" => $orden,
									"transaccion" => $transaccion,
									"msg" => 'Pedido realizado'
								);

								$_SESSION['dataorden'] = $arrResponse;
								unset($_SESSION['arrCarrito']);
								// session_regenerate_id(true);	
								ob_start();
							} else {
								$arrResponse = array("status" => false, "msg" => 'No es posible procesar el pedido.');
							}
						} else {
							$arrResponse = array("status" => false, "msg" => 'No es posible completar el pago con PayPal.');
						}
					} else {
						$arrResponse = array("status" => false, "msg" => 'Hubo un error en la transacción.');
					}
				}
			} else {
				$arrResponse = array("status" => false, "msg" => 'No es posible procesar el pedido.');
			}


			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);

			die();
		}
	}
	//confirmar pedidos
	public function confirmarpedido()
	{

		if (empty(($_SESSION['dataorden']))) {
			echo '<script>window.location.href="http://localhost/sitio-keops/"</script>';
		} else {
			$dataorden = $_SESSION['dataorden'];
			$idpedido = openssl_decrypt($dataorden['orden'], METHODENCRIPT, KEY);
			$transaccion = openssl_decrypt($dataorden['transaccion'], METHODENCRIPT, KEY);

			$data = array(
				'idpedido'    => openssl_decrypt($dataorden['orden'], METHODENCRIPT, KEY),
				'transaccion' => openssl_decrypt($dataorden['transaccion'], METHODENCRIPT, KEY),

			);
			$this->load->view('layouts/Principal/header');
			$this->load->view('layouts/Principal/Carrito/modalCarrito');
			$this->load->view('layouts/Principal/ConfirmarPedidos/confirmarPedido', $data);
			$this->load->view('layouts/Principal/footer');
		}
		//se destruye la variable de sesion
		unset($_SESSION['dataorden']);
	}
	//paginacion rpoductos
	public function page($pagina = null)
	{

		$pagina = is_numeric($pagina) ? $pagina : 1;
		$cantProductos = $this->TproductosModel->cantProductos();
		$total_registro = $cantProductos[0]->total_registro;
		$desde = ($pagina - 1) * PROPORPAGINA;
		$total_paginas = ceil($total_registro / PROPORPAGINA);
		$productos = $this->TproductosModel->getProductoPage($desde, PROPORPAGINA);
		$categoria = $this->TcategoriaModel->getCategorias();
		$pagina = array(
			'pagina' => $pagina,
			'total_paginas' => $total_paginas,
		);

		$this->load->view('layouts/Principal/header');
		$this->load->view('layouts/Principal/Carrito/modalCarrito');
		$this->load->view('layouts/Principal/tienda', compact('productos', 'pagina', 'categoria'));
		$this->load->view('layouts/Principal/footer');
	}
	//buscador 
	public function search()
	{

		if (empty($_REQUEST['s'])) {
			echo '<script>window.location.href="http://localhost/sitio-keops/"</script>';
		} else {
			$busqueda = $this->Helpers->strClean($_REQUEST['s']);
		}

		$pagina = empty($_REQUEST['p']) ? 1 : intval($_REQUEST['p']);
		$cantProductos =  $this->TproductosModel->cantProdSearch($busqueda);
		$total_registro = $cantProductos[0]->total_registro;
		$desde = ($pagina - 1) * PROBUSCAR;
		$total_paginas = ceil($total_registro / PROBUSCAR);
		$productos = $this->TproductosModel->getProdSearch($busqueda, $desde, PROBUSCAR);
		$pagina = array(
			'pagina' => $pagina,
			'total_paginas' => $total_paginas,
		);
		$categoria = $this->TcategoriaModel->getCategorias();

		$this->load->view('layouts/Principal/header');
		$this->load->view('layouts/Principal/Carrito/modalCarrito');
		$this->load->view('layouts/Principal/Search/search', compact('productos', 'busqueda', 'pagina', 'categoria'));
		$this->load->view('layouts/Principal/footer');
	}
	//inscripcion
	public function suscripcion()
	{
		if ($this->input->is_ajax_request()) {

			$nombre = ucwords(strtolower($this->Helpers->strClean($this->input->post('nombreSuscripcion'))));
			$email  = strtolower($this->Helpers->strClean($this->input->post('emailSuscripcion')));

			$suscripcion = $this->TclienteModel->setSuscripcion($nombre, $email);
			if ($suscripcion > 0) {
				$arrResponse = array('status' => true, 'msg' => "Gracias por tu suscripción.");
				//Enviar correo
				$empresa = $this->ConfiguracionModel->getEmpresa();
				$email_suscripcion =  $empresa[0]->email_suscripcion;
				$dataUsuario = array(
					'asunto' => "Nueva suscripción",
					'email' => $email_suscripcion,
					'nombreUsuario' => $nombre,
					'emailC' => $email
				);
				$this->Helpers->sendEmail($dataUsuario, "email_suscripcion");
			} else {
				$arrResponse = array('status' => false, 'msg' => "El email ya fue registrado.");
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		} else {
			redirect('error');
		}
		die();
	}
	//enviar correo de contacto
	public function contacto()
	{

		if ($this->input->is_ajax_request()) {

			$nombre = ucwords(strtolower($this->Helpers->strClean($this->input->post('nombreContacto'))));
			$email  = strtolower($this->Helpers->strClean($this->input->post('emailContacto')));
			$mensaje  = $this->Helpers->strClean($this->input->post('mensaje'));
			$useragent = $_SERVER['HTTP_USER_AGENT'];
			$ip        = $_SERVER['REMOTE_ADDR'];
			$dispositivo = "PC";

			if (preg_match("/mobile/i", $useragent)) {
				$dispositivo = "Movil";
			} else if (preg_match("/tablet/i", $useragent)) {
				$dispositivo = "Tablet";
			} else if (preg_match("/iPhone/i", $useragent)) {
				$dispositivo = "iPhone";
			} else if (preg_match("/iPad/i", $useragent)) {
				$dispositivo = "iPad";
			}

			$userContact = $this->TclienteModel->setContacto($nombre, $email, $mensaje, $ip, $dispositivo, $useragent);
			if ($userContact > 0) {
				$arrResponse = array('status' => true, 'msg' => "Su mensaje fue enviado correctamente.");
				//Enviar correo
				$empresa = $this->ConfiguracionModel->getEmpresa();
				$email_contacto =  $empresa[0]->email_contacto;
				$dataUsuario = array(
					'asunto' => "Nuevo Usuario en contacto",
					'email' => $email_contacto,
					'nombreUsuario' => $nombre,
					'emailC' => $email,
					'mensaje' => $mensaje
				);
				$this->Helpers->sendEmail($dataUsuario, "email_contacto");
			} else {
				$arrResponse = array('status' => false, 'msg' => "No es posible enviar el mensaje.");
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		} else {
			redirect('error');
		}
		die();
	}
}