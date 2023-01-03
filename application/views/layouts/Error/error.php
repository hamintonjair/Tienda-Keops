<script>
  document.querySelector('header').classList.add('header-v4');
</script>
<div class="container text-center">
	<main class="app-content">
      <div class="page-error tile">
        <?php
       
         for($i=0; $i < count( $page); $i++){
          $contenido  = $page[$i]->contenido;          
          }         
         ?>
         <?= $contenido ?>
        <p><a class="btn btn-dark" href="<?= base_url(); ?>">Regresar</a></p>
      </div>
    </main>
</div>
