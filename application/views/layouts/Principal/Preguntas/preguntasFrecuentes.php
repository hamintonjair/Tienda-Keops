<?php 
	$this->load->model("Helpers");
	$preguntas  = $this->Helpers->getInfoPage(PPREGUNTAS);
for ($p = 0; $p < count($preguntas); $p++) { 
		
    $titu = $preguntas[$p]->titulo;	
    $conten  = $preguntas[$p]->contenido;			
    $banner = $preguntas[$p]->portada;	
    
};
if(empty($conten )){
         $titu  =  "";
         $conten  =  "";
};
; ?>
<script>
 	document.querySelector('header').classList.add('header-v4');
 </script>
<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url(<?= base_url().'assets/Template/Admin/images/uploads/'.$banner?>);">
  <h2 class="ltext-105 cl0 txt-center">
    <?= $titu ?>
  </h2>
</section>

<br>
<section>
  <main class="app-content">    
    <div class="app-title">
      <div class="container">
          <div class="row">
                  <div class="col-md-12">
                    <div class="tile">
                      <div class="tile-body">                                                   
                          </div>
                          <div class="body">
                                  <div class="page-content">
                                  <?= $conten; ?>
                                  </div>
                          </div>      
                    </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
  </main > 
</section>
   