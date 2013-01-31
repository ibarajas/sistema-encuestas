<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->
<head>
  <?php include 'elements/head.php'?> 
  <title>Lista Departamentos</title>
</head>
<body>
  <!-- Header -->
  <div class="row">
    <div class="twelve columns">
      <?php include 'elements/header.php'?>
    </div>
  </div>

  <div class="row">
    <!-- Main Section -->  
    <div id="Main" class="nine columns push-three">
      <div class="row">
        <div class="twelve columns">
          <h3>Departamentos</h3>
          <?php if(count($tabla)== 0):?>
            <p>No se encontraron departamentos.</p>
          <?php else:?>
            <table class="twelve">
              <thead>
                <th>Nombre</th>
                <th>Jefe de Departamento</th>
                <th>Acciones</th>
              </thead>
              <?php foreach($tabla as $fila): ?>  
                <tr>
                  <td><a class="nombre" href="<?php echo site_url('departamentos/ver/'.$fila['idDepartamento'])?>"/><?php echo $fila['nombre']?></a></td>
                  <td><a class="jefeDepartamento" href="<?php echo site_url('usuarios/ver/'.$fila['jefeDepartamento']['id'])?>"/><?php echo $fila['jefeDepartamento']['nombre'].' '.$fila['jefeDepartamento']['apellido']?></a></td>
                  <td>
                    <a class="eliminar" href="" value="<?php echo $fila['idDepartamento']?>">Eliminar</a>
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
          <a class="button" data-reveal-id="modalNuevo">Agregar departamento...</a>
        </div>          
      </div>
    </div>

    <!-- Nav Sidebar -->
    <div class="three columns pull-nine">
      <!-- Panel de navegación -->
      <?php include 'elements/nav-sidebar.php'?>
    </div>    
  </div>

  <!-- Footer -->    
  <div class="row">    
    <?php include 'elements/footer.php'?>
  </div>

  <!-- ventana modal para editar datos del departamento -->
  <div id="modalNuevo" class="reveal-modal medium">
    <?php
      $titulo = 'Crear nuevo departamento';
      $link = site_url('departamentos/nuevo'); //a donde mandar los datos editados para darse de alta  
      $departamento = array('idDepartamento'=>'', 'idJefeDepartamento'=>'', 'nombre'=>'');
      include_once 'elements/form-editar-departamento.php'; 
    ?>
    <a class="close-reveal-modal">&#215;</a>
  </div>
    
  <!-- ventana modal para eliminar materias -->
  <div id="modalEliminar" class="reveal-modal small">
    <form action="<?php echo site_url('departamentos/eliminar')?>" method="post">
      <input type="hidden" name="idDepartamento" value="" />
      <h3>Eliminar departamento</h3>
      <h5 class="nombre"></h5>
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
      idDepartamento = $(this).attr('value');
      nombre = $(this).parentsUntil('tr').parent().find('.nombre').text();
      //cargo el id del departamento en el formulario
      $('#modalEliminar input[name="idDepartamento"]').val(idDepartamento);
      //pongo el nombre del departamento en el dialogo
      $("#modalEliminar").find('.nombre').html(nombre);
      $("#modalEliminar").reveal();
      return false;
    });

    //abrir automaticamente la ventana modal que contenga entradas con errores
    $('small.error').parentsUntil('.reveal-modal').parent().first().reveal();
  </script>
</body>
</html>