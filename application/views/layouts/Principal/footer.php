<?php 	  
      $this->load->model("Helpers");
      $catFotter = $this->Helpers->getCatFooter();	
	  $catFotter2 = $this->Helpers->getCatFooter2();	
	  $this->load->model("ConfiguracionModel");
	  $empresa = $this->ConfiguracionModel->getEmpresa();
	  $telefono =  $empresa[0]->telefono;
	  $direccion =  $empresa[0]->direccion;
	  $email_empresa =  $empresa[0]->email_empresa;
	  $facebook =  $empresa[0]->facebook;
	  $instagram =  $empresa[0]->instagram;
	  $whatsapp =  $empresa[0]->whatsapp;
	  $linkedin =  $empresa[0]->linkedin;
	  $twitter =  $empresa[0]->twitter;
	  $N_empresa =  $empresa[0]->empresa;


; ?>
		<!-- Footer -->
	<footer class="bg3 p-t-75 p-b-32">
		<div class="container">
			<div class="row">
				<div class="col-sm-3 col-lg-2 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Categorías
					</h4>
					<?php if(count($catFotter) > 0){ ?>
					<ul>
						<?php foreach ($catFotter as $cat) { ?>
						<li class="p-b-10 ">
							<a href="<?= base_url() ?>tienda/categoria/<?= $cat->idcategoria.'/'.$cat->ruta?>" class="stext-107 cl7 hov-cl1 trans-04">
								<?= $cat->nombre ?>
							</a>
						</li>
						<?php } ?>
					</ul>
					<?php } ?>
				</div>
				<div class="col-sm-3 col-lg-2 p-b-50">					
					<?php if(count($catFotter2) > 0){ ?>
					<ul>
						<?php foreach ($catFotter2 as $ca) { ?>
						<li class="p-b-10 ">
							<a href="<?= base_url() ?>tienda/categoria/<?= $ca->idcategoria.'/'.$ca->ruta?>" class="stext-107 cl7 hov-cl1 trans-04">
								<?= $ca->nombre ?>
							</a>
						</li>
						<?php } ?>
					</ul>
					<?php } ?>
				</div>

				<div class="col-sm-6 col-lg-4 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Cotacto
					</h4>
					
					<p class="stext-107 cl7 size-201">
						<?=   $direccion  ?> <br>
						Tel: <a class="linkFooter" href="tel:<?=   $telefono  ?>"><?=   $telefono  ?></a><br>
						Email: <a class="linkFooter" href="mailto:<?=   $email_empresa ?>"><?=  $email_empresa ?></a>
					</p>					

					<div class="p-t-27">
						<a href="<?= $facebook ?>" target="_blanck" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-facebook"></i>
						</a>

						<a href="<?= $instagram ?>" target="_blanck"  class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-instagram"></i>
						</a>
					
						<a href="https://wa.me/<?= $whatsapp ?>" target="_blanck"  class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
						<i class="fa fa-whatsapp" aria-hidden="true"></i>
						</a>
					
						<a href="<?= $linkedin ?>" target="_blanck"  class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
						<i class="fa fa-linkedin" aria-hidden="true"></i>
						</a>

						<a href="<?= $twitter ?>" target="_blanck"  class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
						<i class="fa fa-twitter" aria-hidden="true"></i>
						</a>
					</div>
				</div>

				<div class="col-sm-6 col-lg-4 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Suscríbete
					</h4>

					<form id="frmSuscripcion" name="frmSuscripcion">
						<div class="wrap-input1 w-full p-b-4">
							<input class="input1 bg-none plh1 stext-107 cl7" type="text" id="nombreSuscripcion" name="nombreSuscripcion" placeholder="Nombre completo" required>
							<div class="focus-input1 trans-04"></div>
						</div>
						<br>
						<div class="wrap-input1 w-full p-b-4">
							<input class="input1 bg-none plh1 stext-107 cl7" type="email" id="emailSuscripcion" name="emailSuscripcion" placeholder="email@example.com" required >
							<div class="focus-input1 trans-04"></div>
						</div>

						<div class="p-t-18">
							<button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
								Suscribirme
							</button>
						</div>
					</form>
				</div>
			</div>

			<div class="p-t-40">
				<p class="stext-107 cl6 txt-center">
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					 <small> <?=   $N_empresa ; ?> | Copyright © 2023 Papelería Keops S.A.S Todos los derechos reservados - Colorlib</small>
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
				</p>
			</div>
		</div>
	</footer>
	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>
	<script>	   
		const smony = "<?= SMONEY; ?>";
	</script>
<!--===============================================================================================-->	
	<script src="<?php echo base_url(); ?>assets/Template/Cliente/assets2/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>assets/Template/Cliente/assets2/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>assets/Template/Cliente/assets2/vendor/bootstrap/js/popper.js"></script>
	<script src="<?php echo base_url(); ?>assets/Template/Cliente/assets2/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>assets/Template/Cliente/assets2/vendor/select2/select2.min.js"></script>

<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>assets/Template/Cliente/assets2/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/Template/Cliente/assets2/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>assets/Template/Cliente/assets2/vendor/slick/slick.min.js"></script>
	<script src="js/slick-custom.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>assets/Template/Cliente/assets2/vendor/parallax100/parallax100.js"></script>
	<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>assets/Template/Cliente/assets2/vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>

<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>assets/Template/Cliente/assets2/vendor/isotope/isotope.pkgd.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>assets/Template/Cliente/assets2/vendor/sweetalert/sweetalert.min.js"></script>

<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>assets/Template/Cliente/assets2/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>assets/Template/Cliente/assets2/js/main.js"></script>
	<script src="<?php echo base_url(); ?>assets/Template/Cliente/js/function.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/libreria/sweetalert2/dist/sweetalert2.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/Template/Admin/js/functions_admin.js"></script>
	<script src="<?php echo base_url(); ?>assets/Template/Admin/js/functions_login.js"></script>
</body>
</html>