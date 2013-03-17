<!DOCTYPE html>
<html lang="es">
<head>
  <?php include 'templates/head.php'?>
  <title>Generar Informe por Materia</title>
  <script src="<?php echo base_url('js/bootstrap-typeahead.js')?>"></script>
  <style>
    .form-horizontal .controls {margin-left: 70px}
    .form-horizontal .control-label {width: 50px; float: left}
    #contenedor{padding-top:9px}
  </style>
</head>
<body>
  <div id="wrapper">
    <?php include 'templates/menu-nav.php'?>
    <div class="container">
      <div class="row">
        <!-- Titulo -->
        <div class="span12">
          <h3>Informes por Encuestas</h3>
          <p>---Descripción---</p>
        </div>
      </div>
      
      <div class="row">
        <!-- SideBar -->
        <div class="span3" id="menu">
          <?php $item_submenu = 1;
            include 'templates/submenu-informes.php';
          ?>
        </div>
        
        <!-- Main -->
        <div id="contenedor" class="span9">
          <h4>Solicitar informe por asignatura</h4>
          <form class="form-horizontal" action="<?php echo site_url('informes/materia')?>" method="post">
    
            <div class="control-group">
              <label class="control-label" for="buscarCarrera">Carrera:</label>
              <div class="controls">
                <input class="input-block-level" id="buscarCarrera" type="text" autocomplete="off" data-provide="typeahead" required>
                <input type="hidden" name="idCarrera" required/>
                <?php echo form_error('idCarrera')?>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="buscarMateria">Materia:</label>
              <div class="controls">
                <input class="input-block-level" id="buscarMateria" type="text" autocomplete="off" data-provide="typeahead" required>
                <input type="hidden" name="idMateria" required/>
                <?php echo form_error('idMateria')?>
              </div>
            </div>
            <div class="control-group">  
              <label class="control-label" for="buscarEncuesta">Año:</label>
              <div class="controls">
                <input class="input-block-level" id="buscarEncuesta" type="text" autocomplete="off" data-provide="typeahead" required>
                <input type="hidden" name="idEncuesta" required/>
                <?php echo form_error('idEncuesta')?>
                <input type="hidden" name="idFormulario" required/>
              </div>
            </div>
            <div class="control-group">
              <div class="controls">
                <label class="checkbox"><input type="checkbox" name="graficos" checked />Incluir gráficos de barras</label>
                <label class="checkbox"><input type="checkbox" name="indicesSecciones" checked />Incluir promedio de índices de secciones</label>
                <label class="checkbox"><input type="checkbox" name="indicesDocentes" checked />Incluir promedio de índices para cada docente</label>
                <label class="checkbox"><input type="checkbox" name="indiceGlobal" checked />Incluir indice general</label>
              </div>
            </div>
            <div class="controls btn-group">
              <input class="btn btn-primary" type="submit" name="submit" value="Aceptar" />
            </div>
          </form>
        </div>
      </div>
    </div>
    <div id="push"></div><br />
  </div>
  <?php include 'templates/footer.php'?>  
  
  <!-- Le javascript -->
  <script src="<?php echo base_url('js/bootstrap-transition.js')?>"></script>
  <script src="<?php echo base_url('js/bootstrap-modal.js')?>"></script>
  <script src="<?php echo base_url('js/bootstrap-collapse.js')?>"></script>
  <script src="<?php echo base_url('js/bootstrap-dropdown.js')?>"></script>
  <script src="<?php echo base_url('js/formulario.js')?>"></script>
  <script src="<?php echo base_url('js/autocompletar.js')?>"></script>
  <script>
    autocompletar_carrera("<?php echo site_url('carreras/buscarAJAX')?>");
    autocompletar_materia("<?php echo site_url('carreras/buscarMateriasAJAX')?>");
    autocompletar_encuesta("<?php echo site_url('encuestas/buscarAJAX')?>");
  </script>
</body>
</html>