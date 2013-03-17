<!DOCTYPE html>
<html lang="es">
<head>
  <?php include 'templates/head.php'?>
  <title>Formularios - <?php echo NOMBRE_SISTEMA?></title>
  <script src="<?php echo base_url('js/bootstrap-typeahead.js')?>"></script>
</head>
<body>
  <div id="wrapper">
    
    <?php include 'templates/menu-nav.php'?>
    
    <div class="container">
      <div class="row">
        <!-- Titulo -->
        <div class="span12">
          <h3>Gestión de Formularios</h3>
          <p>---Descripción---</p>
        </div>
      </div>
      
      <div class="row">
        <!-- SideBar -->
        <div class="span3" id="menu">
          <?php $item_submenu = 1;
            include 'templates/submenu-formularios.php';
          ?>
        </div>
        
        <!-- Main -->
        <div class="span9">
          <h4>Formularios</h4>
          <?php if(count($lista)== 0):?>
            <p>No se encontraron formularios.</p>
          <?php else:?>
            <table class="table table-bordered table-striped">
              <thead>
                <th>Nombre</th>
                <th>Título</th>
                <th>Creación</th>
                <th>Acciones</th>
              </thead>
              <?php foreach($lista as $item): ?>  
                <tr>
                  <td><a class="nombre verFormulario" href="#" value="<?php echo $item->idFormulario?>"/><?php echo $item->nombre?></a></td>
                  <td class="titulo"><?php echo $item->titulo?></td>
                  <td class="creacion"><?php echo date('d/m/Y G:i:s', strtotime($item->creacion))?></td>
                  <td>
                    <a class="editarFormulario" href="#" value="<?php echo $item->idFormulario?>">Modificar</a> /
                    <a class="" href="#" value="<?php echo $item->idFormulario?>">Pesos</a> /
                    <a class="eliminar" href="#" value="<?php echo $item->idFormulario?>">Eliminar</a>
                  </td>
                </tr>
              <?php endforeach ?>
            </table>
          <?php endif ?>
          <?php echo $paginacion ?>
  
          <!-- Botones -->
          <div class="btn-group">
            <a class="btn btn-primary" href="<?php echo site_url('formularios/editar')?>">Agregar formulario</a>
          </div>
        </div>
      </div>
    </div>
    <div id="push"></div><br />
  </div>
  <?php include 'templates/footer.php'?>  
  
  <!-- ventana modal para asociar docentes a la materia -->
  <div id="modalEditarFormulario" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3 id="myModalLabel">Ver Formulario</h3>
    </div>
    <form class="form-horizontal" action="<?php echo site_url('formularios/editar')?>" method="post">
      <div class="modal-body">
        <input type="hidden" name="idFormulario" value="" />
        <h5 class="nombre"></h5>
        <div class="control-group"> 
          <label class="control-label" for="buscarCarrera">Buscar carrera: </label>
          <div class="controls">
            <input class="input-xlarge" id="buscarCarrera" type="text" data-provide="typeahead" autocomplete="off">
            <input type="hidden" name="idCarrera" value=""/>
            <?php echo form_error('idCarrera')?>
          </div>
        </div> 
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
        <input class="btn btn-primary" type="submit" name="submit" value="Aceptar" />
      </div>
    </form>
  </div>
  
  <!-- ventana modal para asociar docentes a la materia -->
  <div id="modalMostrarFormulario" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3 id="myModalLabel">Editar Formulario</h3>
    </div>
    <form class="form-horizontal" action="" method="post">
      <div class="modal-body">
        <input type="hidden" name="idFormulario" value="<?php echo site_url('formularios/ver')?>" />
        <h5 class="nombre"></h5>
        <div class="control-group"> 
          <label class="control-label" for="buscarCarrera">Buscar carrera: </label>
          <div class="controls">
            <input class="input-xlarge" id="buscarCarrera" type="text" data-provide="typeahead" autocomplete="off">
            <input type="hidden" name="idCarrera" value=""/>
            <?php echo form_error('idCarrera')?>
          </div>
        </div> 
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
        <input class="btn btn-primary" type="submit" name="submit" value="Aceptar" />
      </div>
    </form>
  </div>
  
  <!-- ventana modal para eliminar formularios -->
  <div id="modalEliminar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3 id="myModalLabel">Eliminar formulario</h3>
    </div>
    <form action="<?php echo site_url('formularios/eliminar')?>" method="post">
      <div class="modal-body">
        <input type="hidden" name="idFormulario" value="" />
        <h5 class="nombre"></h5>
        <p>¿Desea continuar?</p>      
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
        <input class="btn btn-primary" type="submit" name="submit" value="Aceptar" />
      </div>
    </form>
  </div>
  
  <!-- Le javascript -->
  <script src="<?php echo base_url('js/bootstrap-transition.js')?>"></script>
  <script src="<?php echo base_url('js/bootstrap-modal.js')?>"></script>
  <script src="<?php echo base_url('js/bootstrap-collapse.js')?>"></script>
  <script src="<?php echo base_url('js/bootstrap-dropdown.js')?>"></script>
  <script src="<?php echo base_url('js/autocompletar.js')?>"></script>
  <script>
    $('.eliminar').click(function(){
      idFormulario = $(this).attr('value');
      nombre = $(this).parentsUntil('tr').parent().find('.nombre').text();
      //cargo el id del departamento en el formulario
      $('#modalEliminar input[name="idFormulario"]').val(idFormulario);
      //pongo el nombre del departamento en el dialogo
      $("#modalEliminar").find('.nombre').html(nombre);
      $("#modalEliminar").modal();
      return false;
    });
    $('.verFormulario').click(function(){
      idFormulario = $(this).attr('value');
      nombre = $(this).parentsUntil('tr').parent().find('.nombre').text();
      //cargo el id del departamento en el formulario
      $('#modalMostrarFormulario input[name="idFormulario"]').val(idFormulario);
      //pongo el nombre del departamento en el dialogo
      $("#modalMostrarFormulario").find('.nombre').html(nombre);
      $("#modalMostrarFormulario").find('input[type="text"], input[name="idCarrera"]').val(''); //borro los controles
      $("#modalMostrarFormulario").modal();
      return false;
    });
    $('.editarFormulario').click(function(){
      idFormulario = $(this).attr('value');
      nombre = $(this).parentsUntil('tr').parent().find('.nombre').text();
      //cargo el id del departamento en el formulario
      $('#modalEditarFormulario input[name="idFormulario"]').val(idFormulario);
      //pongo el nombre del departamento en el dialogo
      $("#modalEditarFormulario").find('.nombre').html(nombre);
      $("#modalEditarFormulario").find('input[type="text"], input[name="idCarrera"]').val(''); //borro los controles
      $("#modalEditarFormulario").modal();
      return false;
    });
    autocompletar_carrera("<?php echo site_url('carreras/buscarAJAX')?>");

  </script>
</body>
</html>