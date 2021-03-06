<!DOCTYPE html>
<html lang="es">
<head>
  <?php include 'templates/head.php'?>
  <title>Preguntas - <?php echo NOMBRE_SISTEMA?></title>
</head>
<body>
  <div id="wrapper">
    <?php include 'templates/menu-nav.php'?>
    <div class="container">
      <div class="row">
        <!-- Titulo -->
        <div class="span12">
          <h3>Gestión de Formularios</h3>
          <p>Esta sección contiene las funcionalidades necesarias para la gestión de los formularios utilizados para la toma de encuestas.</p>
        </div>
      </div>
      
      <div class="row">
        <!-- SideBar -->
        <div class="span3" id="menu">
          <?php $item_submenu = 2;
            include 'templates/submenu-formularios.php';
          ?>
        </div>
  
        <!-- Main -->
        <div class="span9">
          <h4>Preguntas</h4>
          <?php if(count($lista)== 0):?>
            <p>No se encontraron preguntas.</p>
          <?php else:?>
            <table class="table table-bordered table-striped">
              <thead>
                <th>Texto</th>
                <th>Creacion</th>
                <th>Tipo</th>
                <th>Acciones</th>
              </thead>
              <?php foreach($lista as $item): ?>  
                <tr>
                  <td class="texto"><?php echo $item['pregunta']->texto?></td>
                  <td class="creacion"><?php echo date('d/m/Y G:i:s', strtotime($item['pregunta']->creacion))?></td>
                  <td class="tipo"><?php echo $item['tipo']?></td>
                  <td>
                    <a class="modificar" href="<?php echo site_url('preguntas/modificar/'.$item['pregunta']->idPregunta)?>">Modificar</a> /
                    <a class="eliminar" href="#" value="<?php echo $item['pregunta']->idPregunta?>">Eliminar</a>
                  </td>
                </tr>
              <?php endforeach ?>
            </table>
          <?php endif ?>
          <?php echo $paginacion ?>
  
          <!-- Botones -->
          <div class="btn-group">
            <a class="btn btn-primary" href="<?php echo site_url('preguntas/nueva')?>">Agregar pregunta</a>
          </div>
        </div>
      </div>
    </div>
    <div id="push"></div><br />
  </div>
  <?php include 'templates/footer.php'?>
  
  <!-- ventana modal para eliminar preguntas -->
  <div id="modalEliminar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3 id="myModalLabel">Eliminar pregunta</h3>
    </div>
    <form action="<?php echo site_url('preguntas/eliminar')?>" method="post">
      <div class="modal-body">
        <input type="hidden" name="idPregunta" value="" />
        <h5 class="nombre"></h5>
        <p>¿Desea continuar?</p>      
      </div>
      <div class="modal-footer">
        <input class="btn btn-primary" type="submit" name="submit" value="Aceptar" />
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
      </div>
    </form>
  </div>
  
  <!-- Le javascript -->
  <script src="<?php echo base_url('js/bootstrap-transition.min.js')?>"></script>
  <script src="<?php echo base_url('js/bootstrap-modal.min.js')?>"></script>
  <script src="<?php echo base_url('js/bootstrap-collapse.min.js')?>"></script>
  <script src="<?php echo base_url('js/bootstrap-dropdown.min.js')?>"></script>
  <script src="<?php echo base_url('js/bootstrap-alert.min.js')?>"></script>
  <script>
    $('.eliminar').click(function(){
      idPregunta = $(this).attr('value');
      nombre = $(this).parentsUntil('tr').parent().find('.texto').text();
      //cargo el id de la pregunta en el formulario
      $('#modalEliminar input[name="idPregunta"]').val(idPregunta);
      //pongo el texto de la pregunta en el dialogo
      $("#modalEliminar").find('.nombre').html(nombre);
      $("#modalEliminar").modal();
      return false;
    });
  </script>
</body>
</html>