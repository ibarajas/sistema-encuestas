<!DOCTYPE html>
<!-- Última revisión: 2012-02-04 9:07 p.m. -->

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->
<head>
  <?php include 'elements/head.php'?> 
  <title>Lista preguntas</title>
</head>
<body>
  <!-- Header -->
  <div class="row">
    <div class="twelve columns">
      <?php include 'elements/header.php'?>
    </div>
  </div>

  <div class="row">
    <!-- Nav Sidebar -->
    <div class="three columns">
      <!-- Panel de navegación -->
      <?php include 'elements/nav-sidebar.php'?>
    </div>  
    
    <!-- Main Section -->  
    <div id="Main" class="nine columns">
      <div class="row">
        <div class="twelve columns">
          <h3>Preguntas</h3>
          <?php if(count($lista)== 0):?>
            <p>No se encontraron preguntas.</p>
          <?php else:?>
            <table class="twelve">
              <thead>
                <th>Texto</th>
                <th>Creacion</th>
                <th>Tipo</th>
                <th>Obligatoria</th>
                <th>Acciones</th>
              </thead>
              <?php foreach($lista as $item): ?>  
                <tr>
                  <td><a class="texto" href="<?php echo site_url('preguntas/ver/'.$item['pregunta']->idPregunta)?>"/><?php echo $item['pregunta']->texto?></a></td>
                  <td class="creacion"><?php echo $item['pregunta']->creacion?></td>
                  <td class="tipo"><?php echo $item['pregunta']->tipo?></td>
                  <td class="obligatoria"><?php echo $item['pregunta']->obligatoria?></td>
                  <td>
                    <a class="eliminar" href="" value="<?php echo $item['pregunta']->idPregunta?>">Eliminar</a>
                  </td>
                </tr>
              <?php endforeach ?>
            </table>
          <?php endif ?>
          <?php echo $paginacion ?>
        </div>
      </div>
      <div class="row">
        <div class="six mobile-two columns pull-one-mobile">
          <a class="button" href="<?php echo site_url('preguntas/nuevo')?>">Agregar pregunta</a>
        </div>          
      </div>
    </div>
  </div>

  <!-- Footer -->    
  <div class="row">    
    <?php include 'elements/footer.php'?>
  </div>
  
  <!-- ventana modal para eliminar preguntas -->
  <div id="modalEliminar" class="reveal-modal medium">
    <form action="<?php echo site_url('preguntas/eliminar')?>" method="post">
      <input type="hidden" name="idPregunta" value="" />
      <h3>Eliminar pregunta</h3>
      <h5 class="texto"></h5>
      <p>¿Desea continuar?</p>
      <div class="row">         
        <div class="ten columns centered">
          <div class="six mobile-one columns push-one-mobile">
            <input class="button cancelar" type="button" value="Cancelar"/>
          </div>
          <div class="six mobile-one columns pull-one-mobile ">
            <input class="button" type="submit" name="submit" value="Aceptar" />
          </div>
        </div>
      </div>
    </form>
    <a class="close-reveal-modal">&#215;</a>
  </div>
  
  <!-- Included JS Files (Compressed) -->
  <script src="<?php echo base_url()?>js/foundation/foundation.min.js"></script>
  <!-- Initialize JS Plugins -->
  <script src="<?php echo base_url()?>js/foundation/app.js"></script>
  
  <script>
    $('.cancelar').click(function(){
      $(this).trigger('reveal:close'); //cerrar ventana
    });

    $('.eliminar').click(function(){
      idPregunta = $(this).attr('value');
      texto = $(this).parentsUntil('tr').parent().find('.texto').text();
      //cargo el id de la pregunta en el formulario
      $('#modalEliminar input[name="idPregunta"]').val(idPregunta);
      //pongo el texto de la pregunta en el dialogo
      $("#modalEliminar").find('.texto').html(texto);
      $("#modalEliminar").reveal();
      return false;
    }); 
  </script>
</body>
</html>